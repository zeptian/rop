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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('action');
            $table->string('planTanggal');
            $table->decimal('planBudget', 12, 2);
            $table->string('planSource');
            $table->string('planTarget');
            $table->string('realTanggal');
            $table->decimal('realBudget', 12, 2);
            $table->string('realSource');
            $table->string('realTarget');
            $table->text('description');
            $table->string('report');
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