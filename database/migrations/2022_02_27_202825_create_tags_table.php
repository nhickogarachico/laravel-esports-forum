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
            $table->foreignId('tag_category_id')->constrained();
            $table->text('flavor')->nullable();
            $table->string('tag_color')->nullable()->default('#297373');
            $table->string('query_tag');
        });

        DB::table('tags')->insert([
            [
                'tag' => 'News',
                'query_tag' => 'news',
                'flavor' => 'Get latest news from different esports.',
                'tag_category_id' => 1
            ],
            [
                'tag' => 'Match Discussion',
                'query_tag' => 'match-discussion',
                'flavor' => 'Latest match across different esports.',
                'tag_category_id' => 1
            ],
            [
                'tag' => 'League of Legends',
                'query_tag' => 'league-of-legends',
                'flavor' => 'News and updates on League of Legends esports.',
                'tag_category_id' => 2
            ],
            [
                'tag' => 'CS:GO',
                'query_tag' => 'cs-go',
                'flavor' => 'CS:GO news and updates.',
                'tag_category_id' => 2
            ],
            [
                'tag' => 'Dota 2',
                'query_tag' => 'dota-2',
                'flavor' => 'Latest from Dota 2 esports.',
                'tag_category_id' => 2
            ],
            [
                'tag' => 'Valorant',
                'query_tag' => 'valorant',
                'flavor' => 'Valorant esports discussions.',
                'tag_category_id' => 2
            ],
            [
                'tag' => 'PUBG',
                'query_tag' => 'pubg',
                'flavor' => 'PUBG esports discussions.',
                'tag_category_id' => 2
            ],
            [
                'tag' => 'Rocket League',
                'query_tag' => 'rocket-league',
                'flavor' => 'Rocket League esports discussions.',
                'tag_category_id' => 2
            ],
            [
                'tag' => 'Team Liquid',
                'query_tag' => 'team-liquid',
                'flavor' => 'Team Liquid org news.',
                'tag_category_id' => 3
            ],
            [
                'tag' => 'G2 Esports',
                'query_tag' => 'g2-esports',
                'flavor' => 'G2 Esports org news.',
                'tag_category_id' => 3
            ],
            [
                'tag' => 'Fnatic',
                'query_tag' => 'fnatic',
                'flavor' => 'Fnatic org news.',
                'tag_category_id' => 3
            ],
            [
                'tag' => 'FaZe Clan',
                'query_tag' => 'faze-clan',
                'flavor' => 'FaZe Clan org news.',
                'tag_category_id' => 3
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
