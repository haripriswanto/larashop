<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('desciption');
            $table->string('author');
            $table->string('publisher');
            $table->string('cover');
            $table->float('price', 8, 2);
            $table->integer('views');
            $table->integer('stock');
            $table->enum('status', ['PUBLISH', 'DRAFT']);
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('deleted_by');
            $table->integer('updated_by');
            $table->softDeletes();

            // $table->foreign('id')->references('book_id')->on('book_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
