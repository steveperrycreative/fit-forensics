<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_results', function (Blueprint $table) {
            $table->id();
            $table->string('image_name');
            $table->foreignId('investigation_id');
            $table->bigInteger('offset');
            $table->integer('header_size');
            $table->bigInteger('data_size');
            $table->integer('protocol_version');
            $table->integer('profile_version');
            $table->string('data_type');
            $table->string('crc')->nullable();
            $table->bigInteger('file_size');
            $table->string('initial_bytes');
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
        Schema::dropIfExists('search_results');
    }
}
