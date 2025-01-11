<?php

use App\Models\Folder;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Folder::class)->constrained()->onDelete('cascade');
            $table->string('title');

            // "shared" => public, "private" => only visible to owner
            $table->enum('visibility', ['shared', 'private'])->default('private');

            // two note types: text or pdf
            $table->enum('type', ['text', 'pdf'])->default('text');
            // for text type notes, store the text
            $table->longText('text_body')->nullable();
            // for pdf type notes, store a path to the PDF or something similar
            $table->string('pdf_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
