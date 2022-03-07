<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('tag_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('query_string');
        });

        DB::table('tag_categories')->insert([
            [
                'category' => 'General',
                'query_string' => 'general'
            ],
            [
                'category' => 'Esports',
                'query_string' => 'esports'
            ],
            [
                'category' => 'Teams',
                'query_string' => 'teams'
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_categories');
    }
};
