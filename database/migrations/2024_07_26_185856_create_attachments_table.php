<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_id');
            $table->string('file_path');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
