<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKontrakToRealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reals', function (Blueprint $table) {
            //
            $table->string('penyedia')->nullable()->after('realTarget');
            $table->string('noKontrak')->nullable()->after('penyedia');
            $table->string('tglKontrak')->nullable()->after('noKontrak');
            $table->string('startKontrak')->nullable()->after('tglKontrak');
            $table->string('endKontrak')->nullable()->after('startKontrak');
            $table->string('noBAST')->nullable()->after('endKontrak');
            $table->string('tglBAST')->nullable()->after('noBAST');
            $table->string('metode')->nullable()->after('tglBAST');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reals', function (Blueprint $table) {
            //
            $table->dropColumn(['penyedia', 'noKontrak', 'tglKontrak', 'startKontrak', 'endKontrak', 'noBAST', 'tglBAST', 'metode']);
        });
    }
}