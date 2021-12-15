<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsIpayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_ipay', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('plan_id');
            $table->decimal('price');
            $table->string('currency');
            $table->string('transaction_hash')->nullable();
            $table->string('transaction_order_id')->nullable();
            $table->string('transaction_payment_id')->nullable();
            $table->string('transaction_payment_method')->nullable();
            $table->string('transaction_card_type')->nullable();
            $table->string('transaction_pan')->nullable();
            $table->string('gc_transaction_id')->nullable();
            $table->string('status');
            $table->boolean('is_recurring')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_ipay');
    }
}
