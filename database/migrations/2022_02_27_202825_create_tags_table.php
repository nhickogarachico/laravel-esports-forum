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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('query_tag');
        });

        DB::table('tags')->insert([
            [
                'tag' => 'News',
                'query_tag' => 'news'
            ],
            [
                'tag' => 'Match Discussion',
                'query_tag' => 'match-discussion'
            ],
            [
                'tag' => 'League of Legends',
                'query_tag' => 'league-of-legends'
            ],
            [
                'tag' => 'CS:GO',
                'query_tag' => 'cs-go'
            ],
            [
                'tag' => 'Dota 2',
                'query_tag' => 'dota-2'
            ],
            [
                'tag' => 'Valorant',
                'query_tag' => 'valorant'
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
        Schema::dropIfExists('tags');
    }
};
