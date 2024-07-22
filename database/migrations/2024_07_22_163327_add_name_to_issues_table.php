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
    Schema::table('issues', function (Blueprint $table) {
        $table->string('name')->after('id'); // Add the 'name' column after 'id'
    });
}

public function down()
{
    Schema::table('issues', function (Blueprint $table) {
        $table->dropColumn('name');
    });
}

};
