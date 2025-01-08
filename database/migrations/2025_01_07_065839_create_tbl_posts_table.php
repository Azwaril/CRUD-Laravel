<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tbl_posts', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->string('title', 200); // Judul
            $table->string('slug', 200); // Slug
            $table->unsignedBigInteger('user_id'); // User ID
            $table->text('content'); // Konten
            $table->string('image')->nullable()->default('Noimage.jpg');
            $table->integer('hits')->default(0); // Jumlah hits
            $table->enum('aktif', ['Y', 'N'])->default('Y'); // Status aktif
            $table->enum('status', ['publish', 'draft'])->default('publish'); // Status postingan
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_posts');
        $table->dropColumn('image'); 
    }
};
