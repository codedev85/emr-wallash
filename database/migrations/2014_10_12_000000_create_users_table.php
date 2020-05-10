<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id')->default(6);
            $table->integer('state_id')->nullable();
            $table->integer('lga_id')->nullable();
            $table->integer('history_id')->nullable();
            $table->string('unique_id')->nullable();


            $table->longtext('address');
            $table->string('phone_number');
            $table->string('occupation')->nullable();
            $table->string('gender')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->longText('allergies')->nullable();
            $table->string('genotype')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('payment_method')->default('card'); //card and bank

            $table->integer('subscription_id')->default(0); //default means no plan 1 in single plan 2 is family
            // $table->integer('prescription_id');
            // $table->integer('complaint_id')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
