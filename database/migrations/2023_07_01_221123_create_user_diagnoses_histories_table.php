<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_diagnoses_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('issue_id');
            $table->string('name');
            $table->decimal('accuracy', 5, 2);
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_diagnoses_histories');
    }
    
};
