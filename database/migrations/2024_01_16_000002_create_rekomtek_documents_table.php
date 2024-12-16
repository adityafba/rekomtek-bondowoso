<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rekomtek_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekomtek_application_id')
                  ->constrained('rekomtek_applications')
                  ->onDelete('cascade');
            $table->string('document_type');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekomtek_documents');
    }
};
