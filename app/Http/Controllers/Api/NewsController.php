<?php

namespace App\Http\Controllers\Api;

use App\Events\NewsActivity;
use App\Exceptions\NullException;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use App\Repository\News\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function __construct(
        private NewsRepositoryInterface $newsRepo
    )
    { }

    public function getNews(){
        $news = $this->newsRepo->get();

        return response()->json([
            'data' => $news->resource,
        ], 200);
    }

    public function getNewsDetailBySlug(string $slug){
        $news = $this->newsRepo->getOneBy('slug', $slug);

        return response()->json([
            'data' => $news
        ]);
    }

    public function getNewsDetailById(int $id){
        $news = $this->newsRepo->getOneBy('id', $id);

        if(!$news){
            return response()->json([
                'data' => "News Not Found"
            ], 404);
        }

        return response()->json([
            'data' => $news
        ]);
    }

    public function createNews(StoreNewsRequest $request){
        $request->validated();
        $news = $this->newsRepo->create($request);

        return response()->json([
            "message" => "News Was Created",
            "data" => new NewsResource($news),
        ]);
    }

    public function updateNews(UpdateNewsRequest $request, $id){        
        $user = $request->user();
        $news = News::find($id);

        if(!$news){
            throw new NullException("News Not Found", 404);
        }

        if($user->id !== $news->user_id){
            return response()->json([
                "message" => "Unauthorized",
            ], 403);
        }

        $news = $this->newsRepo->update($request, $news);

        return response()->json([
            "message" => "News Was Updated",
            "data" => new NewsResource($news),
        ]);
    }

    public function deleteNews(Request $request, $id){
        $news = News::find($id);
        $user = $request->user();

        if(!$news){
            throw new NullException("News Not Found", 404);
        }

        if($user->id !== $news->user_id){
            return response()->json([
                "message" => "Unauthorized",
            ], 403);
        }

        $news->delete();

        event(new NewsActivity($user->id, $news->id, 'Delete News'));

        return response()->json([
            "message" => "News Was Deleted",
        ]);
    }
}
