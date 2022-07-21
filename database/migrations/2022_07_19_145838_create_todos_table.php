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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('category')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('owner')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('done')->default(false);
            $table->string('name', 30);
            $table->string('description', 300);
            $table->softDeletes('deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
};
