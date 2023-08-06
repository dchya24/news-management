<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Jobs\CreateComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreCommentRequest $request)
    {
        $comment = $request->comment;
        $news_id = $request->news_id;
        $user_id = $request->user()->id;

        $job = CreateComment::dispatch($user_id, $news_id, $comment);

        return response()->json([
            "message" => "Comment was Created",
        ]);
    }
}
