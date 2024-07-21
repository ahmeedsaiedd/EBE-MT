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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
