<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_comment', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->enum('status', ['1', '2'])->default('1');
            $table->string('author');
            $table->string('email');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('tbl_post')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
