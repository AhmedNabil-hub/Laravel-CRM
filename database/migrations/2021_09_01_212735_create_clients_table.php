<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{

  public function up()
  {
    Schema::create('clients', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('phone_number')->unique();

      $table->string('company_name')->unique();
      $table->string('company_address');
      $table->string('company_city');
      $table->string('company_zip');
      $table->integer('company_vat')->unique();

      $table->timestamps();
    });
  }


  public function down()
  {
    Schema::dropIfExists('clients');
  }
}
