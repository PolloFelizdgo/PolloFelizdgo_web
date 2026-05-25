<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_block_id')->constrained('content_blocks')->cascadeOnDelete();
            $table->longText('previous_payload')->nullable();
            $table->longText('new_payload');
            $table->string('change_note')->nullable();
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('content_block_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_revisions');
    }
};
