<?php

use App\Models\Tweet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeDatabaseStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->string('word')->nullable();
        });

        Tweet::query()->each(function (Tweet $tweet) {
            $tweet->word = DB::table('tweeted_words')
                ->where('id', $tweet->tweeted_word_id)
                ->value('word');
        });

        Schema::table('tweets', function (Blueprint $table) {
            $table->dropForeign('tweets_tweeted_word_id_foreign');
            $table->removeColumn('tweeted_word_id');
        });

        Schema::drop('tweeted_words');


        Schema::table('tweets', function (Blueprint $table) {
            $table->string('word')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No down, this migration should not be rolled back.
    }
}
