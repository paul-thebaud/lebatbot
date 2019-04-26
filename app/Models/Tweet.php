<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tweet extends Model
{
    protected $fillable = ['twitter_id', 'word'];

    public function toArray()
    {
        return [
            'twitter_id' => $this->twitter_id,
            'word'       => $this->tweeted_word->word,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
