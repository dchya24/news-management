<?php
namespace App\Repository\News;

use App\Events\NewsActivity;
use App\Exceptions\NullException;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use App\Service\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Str;

class NewsRepository implements NewsRepositoryInterface {
  public function get(){
    $news = DB::table('news')
      ->select([
        'news.id as id',
        'news.title as title',
        'news.slug as slug',
        'news.content as content',
        'news.image as image',
        'news.created_at as created_at',
        'news.updated_at as updated_at',
        'users.id as user_id',
        'users.name as user_name',
      ])
      ->join("users", "users.id", 'news.user_id')
      ->whereNull('news.deleted_at')
      ->paginate(5);

      return new NewsCollection($news);
  }

  public function getOneBy($column, $value){
    $news = News::with(['comment.user', 'author'])->where($column, $value)->first();

    if(!$news){
      throw new NullException("News Not Found", 404);
    }

    return new NewsResource($news);
  }

  public function create(Request $request){
    $data = $request->only(['title', 'content']);
    $user = $request->user();
    $image = $request->file('image');

    $data['user_id'] = $user->id;

    $random_number = rand(10000, 99999);
    $data['slug'] = Str::slug($data['title']) . '-' . $random_number;

    $data['image'] = ImageService::uploadFromRequest($image);

    $news = News::create($data);

    event(new NewsActivity($user->id, $news->id, 'Create News'));

    return $news;
  }

  public function update(Request $request, News $news){
    $data = $request->only(['title', 'content']);

    $random_number = rand(10000, 99999);
    $slug = Str::slug($data['title']) . '-' . $random_number;

    $news->title = $data['title'];
    $news->slug = $slug;
    $news->content = $data['content'];

    if($request->hasFile('image')){
      ImageService::deleteImage($news->image);
      $image = $request->file('image');
      $news->image = ImageService::uploadFromRequest($image);
    }

    $news->save();

    event(new NewsActivity($news_id, $news->id, 'Update News'));

    return $news;
  }
}