<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Models\Tweet;
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

        return new JsonResponse(
            Tweet::query()
                ->when($request->input('word'), function ($query, $word) {
                    $query->where('word', 'like', sprintf('%%%s%%', strtolower($word)));
                })
                ->limit(25)
                ->orderByDesc('updated_at')
        );
    }
}
