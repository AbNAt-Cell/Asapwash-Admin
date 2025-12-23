<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemainingTables extends Migration
{
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('star')->default(0);
            $table->text('cmt')->nullable();
            $table->timestamps();
        });

        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->integer('cat_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->default(1);
            $table->string('price')->nullable();
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('shop_employee', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->default(1);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->string('service')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('admin_setting', function (Blueprint $table) {
            $table->id();
            $table->string('currency_symbol')->default('$');
            $table->timestamps();
        });

        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('review');
        Schema::dropIfExists('sub_categories');
        Schema::dropIfExists('shop_employee');
        Schema::dropIfExists('package');
        Schema::dropIfExists('admin_setting');
        Schema::dropIfExists('app_users');
        Schema::dropIfExists('categories');
    }
}
