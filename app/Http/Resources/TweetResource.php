<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * {@inheritDoc}
     */
    public function toArray($request)
    {
        return [
            'twitter_id' => $this->twitter_id,
            'word'       => $this->word,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
