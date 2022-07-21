<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->integer('otp')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('otp_expire_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('gender')->default(0)->comment('1=male,2=female');
            $table->string('image')->nullable();
            $table->tinyInteger('is_reset_password')->default(0);
            $table->tinyInteger('is_suspend')->default(0);
            $table->tinyInteger('user_type')->default(0)->comment('0=super_admin,1=admin,2=company_admin,3=company_user');
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
