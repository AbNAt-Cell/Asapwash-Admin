<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerShopsTable extends Migration
{
    public function up()
    {
        Schema::create('owner_shops', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('phone_no')->nullable();
            $table->integer('is_popular')->default(0);
            $table->integer('is_best')->default(0);
            $table->integer('status')->default(1);
            $table->string('end_time')->nullable();
            $table->string('start_time')->nullable();
            $table->string('package_id')->nullable();
            $table->integer('service_type')->default(0);
            // lat and lng will be added by the other migration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('owner_shops');
    }
}
