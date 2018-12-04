<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TweetController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request): JsonResponse
    {
        $this->validate($request, [
            'word' => 'sometimes|string',
        ]);

        $query = Tweet::query()->limit(25)->orderByDesc('updated_at');
        if ($request->has('word')) {
            $query->whereHas('tweeted_word', function (Builder $query) use ($request) {
                $query->where('word', 'like', sprintf('%%%s%%', strtolower($request->input('word'))));
            });
        }

        return response()->json($query->get());
    }
}
