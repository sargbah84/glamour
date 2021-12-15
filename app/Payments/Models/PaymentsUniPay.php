<?php

namespace App\Payments\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rinvex\Subscriptions\Models\Plan;

class PaymentsUniPay extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments_unipay';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'price',
        'currency',
        'status',
        'transaction_hash',
        'transaction_order_id',
        'error'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
