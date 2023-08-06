<?php
namespace App\Repository\News;

use App\Models\News;
use Illuminate\Http\Request;

interface NewsRepositoryInterface {
  public function get();
  public function getOneBy($column, $value);
  public function store($type, $data);
  public function create(Request $request);
  public function update(Request $request, News $news);
}