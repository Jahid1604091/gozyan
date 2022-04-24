<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name',128)->unique();
            $table->string('slug',128)->unique();
            $table->string('img_url');
            $table->string('location',128);
            $table->string('sub_location',128);
            $table->string('type',28);
            $table->string('rating',28);
            $table->string('old_price',28);
            $table->string('current_price',28);
            $table->longText('facilities');
            $table->longText('discount')->default(0);
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
        Schema::dropIfExists('properties');
    }
};
