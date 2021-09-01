<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{

  public function up()
  {
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->date('deadline');
      $table->string('status');
      $table->text('description');

      $table->foreignId('user_id')
        ->constrained('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->foreignId('client_id')
        ->constrained('clients')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->timestamps();
    });
  }


  public function down()
  {
    Schema::dropIfExists('projects');
  }
}
