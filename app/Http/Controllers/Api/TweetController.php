<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TweetController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return TweetResource
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $this->validate($request, [
            'word' => 'sometimes|string',
        ]);

        return TweetResource::collection(
            Tweet::query()
                ->when($request->input('word'), function ($query, $word) {
                    $query->where('word', 'like', sprintf('%%%s%%', strtolower($word)));
                })
                ->limit(25)
                ->orderByDesc('updated_at')
                ->get()
        );
    }
}
