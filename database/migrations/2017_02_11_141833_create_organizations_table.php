<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->smallInteger('type');
            $table->unsignedInteger('parent_organization')->nullable();
            $table->string('instruction')->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->text('opt1')->nullable();
            $table->text('opt2')->nullable();
            $table->text('opt3')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
