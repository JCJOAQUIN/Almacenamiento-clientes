<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('kind')->comment('1. Physical, 2. Moral');
            $table->string('rfc');
            $table->unsignedBigInteger('using_cfdi_id')->nullable();
            $table->string('name_physical')->nullable();
            $table->string('last_name')->nullable();
            $table->string('second_last_name')->nullable();
            $table->string('name_moral')->nullable();
            $table->string('business_name')->nullable();
            $table->string('status')->nullable()->comment('a. Activo, b. Inactivo, c. Baja');
            $table->string('contact_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('celphone')->nullable();
            $table->string('email_address')->nullable();
            $table->text('comments')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('suburb')->nullable();
            $table->string('street')->nullable();
            $table->string('external_number')->nullable();
            $table->string('inside_number')->nullable();
            $table->timestamps();
            $table->foreign('using_cfdi_id')->references('id')->on('cfdis');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
