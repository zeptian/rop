<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->string('action');
            $table->string('planTanggal');
            $table->decimal('planBudget', 12, 2);
            $table->string('planSource');
            $table->string('planTarget');
            $table->string('realTanggal');
            $table->decimal('realBudget', 12, 2);
            $table->string('realSource');
            $table->string('realTarget');
            $table->text('description')->nullable();
            $table->string('report')->nullable();
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
        Schema::dropIfExists('rops');
    }
}