<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('section')->index();
            $table->longText('payload');
            $table->string('status')->default('draft');
            $table->unsignedInteger('version')->default(1);
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->index(['section', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_blocks');
    }
};
