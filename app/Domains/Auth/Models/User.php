<?php

namespace App\Domains\Auth\Models;

use App\Models\UserLesson;
use App\Domains\Auth\Models\Traits\Attribute\UserAttribute;
use App\Domains\Auth\Models\Traits\Method\UserMethod;
use App\Domains\Auth\Models\Traits\Relationship\UserRelationship;
use App\Domains\Auth\Models\Traits\Scope\UserScope;
use App\Domains\Auth\Notifications\Frontend\ResetPasswordNotification;
use App\Domains\Auth\Notifications\Frontend\VerifyEmail;
use DarkGhostHunter\Laraguard\Contracts\TwoFactorAuthenticatable;
use DarkGhostHunter\Laraguard\TwoFactorAuthentication;
use Database\Factories\UserFactory;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Rinvex\Subscriptions\Traits\HasSubscriptions;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 */
class User extends Authenticatable implements MustVerifyEmail, TwoFactorAuthenticatable
{
    use HasApiTokens,
        HasFactory,
        HasRoles,
        Impersonate,
        MustVerifyEmailTrait,
        Notifiable,
        SoftDeletes,
        TwoFactorAuthentication,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        HasSubscriptions;

    public const TYPE_ADMIN = 'admin';
    public const TYPE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'firstname',
        'lastname',
        'email',
        'email_verified_at',
        'password',
        'password_changed_at',
        'active',
        'timezone',
        'last_login_at',
        'last_login_ip',
        'to_be_logged_out',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'last_login_at',
        'email_verified_at',
        'password_changed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'last_login_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'to_be_logged_out' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'avatar',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'roles',
    ];

    public function lessons()
    {
        return $this->hasMany(UserLesson::class);
    }

    public function watched()
    {
        return $this->whereHas('lessons', function($query) {
            $query->where('watched', true);
        })->latest()->first()->watched ?? 0;
    }

    public function userSubscription()
    {
        return $this->subscriptions()->first();
    }

    public function userSubscriptionName()
    {
        return $this->userSubscription()->name ?? null;
    }

    public function userSubscriptionPlanName()
    {
        return $this->userSubscription()->plan->name ?? null;
    }

    public function userSubscriptionPlanPrice()
    {
        return $this->userSubscription()->plan->price ?? null;
    }

    public function userSubscriptionPlanInterval()
    {
        return $this->userSubscription()->plan->interval ?? null;
    }

    public function userSubscriptionPlanCurrency()
    {
        return $this->userSubscription()->plan->currency ?? null;
    }

    public function hasActiveSubscription()
    {
        if($this->userSubscription()) {
            return $this->isAdmin() || $this->userSubscription()->where('ends_at', '>', now())->exists();
        }

        return false;
    }

    public function userSubscriptionEnds()
    {
        return $this->userSubscription()->where('ends_at', '>', now())->first()->ends_at ?? null;
    }

    public function userSubscriptionStarts()
    {
        return $this->userSubscription()->where('starts_at', '<', now())->first()->starts_at ?? null;
    }

    public function userSubscriptionStartsAt()
    {
        return $this->userSubscriptionStarts()->format('d/m/Y');
    }

    public function userSubscriptionEndsAt()
    {
        return $this->userSubscriptionEnds()->format('d/m/Y');
    }

    public function userSubscriptionDaysLeft()
    {
        return $this->userSubscriptionEnds()->diffInDays();
    }

    public function userSubscriptionDaysLeftPercentage()
    {
        return $this->userSubscriptionDaysLeft() / 30 * 100;
    }

    public function userSubscriptionDaysLeftPercentageRounded()
    {
        return round($this->userSubscriptionDaysLeftPercentage());
    }

    public function userSubscriptionDaysLeftPercentageRoundedString()
    {
        return $this->userSubscriptionDaysLeftPercentageRounded() . '%';
    }

    public function userSubscriptionDaysLeftString()
    {
        return $this->userSubscriptionDaysLeft() . ' days';
    }

    public function userSubscriptionOnTrial()
    {
        return $this->userSubscription()->where('ends_at', '>', now())->first()->onTrial();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the registration verification email.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Return true or false if the user can impersonate an other user.
     *
     * @param void
     * @return bool
     */
    public function canImpersonate(): bool
    {
        return $this->can('admin.access.user.impersonate');
    }

    /**
     * Return true or false if the user can be impersonate.
     *
     * @param void
     * @return bool
     */
    public function canBeImpersonated(): bool
    {
        return ! $this->isMasterAdmin();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
