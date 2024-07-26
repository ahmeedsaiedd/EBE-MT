<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); // Assuming you have a foreign key for projects
            $table->unsignedInteger('status_id'); // Assuming you have a foreign key for projects
            $table->string('name'); // Add this field if it is required
            $table->string('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('epic_title')->nullable();
            $table->text('epic_description')->nullable();
            $table->text('user_story_description')->nullable();
            $table->string('test_case_title')->nullable();
            $table->text('test_case_description')->nullable();
            $table->string('test_set_title')->nullable();
            $table->text('test_set_description')->nullable();
            $table->string('test_execution_title')->nullable();
            $table->text('test_execution_description')->nullable();
            $table->string('bug_title')->nullable();
            $table->text('bug_description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint if necessary
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }



    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
