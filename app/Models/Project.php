<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
// アプリケーション側でcreateなどできない値を記述する
//テーブル対して，Laravel 側からデータの作成や編集が行えないカラムを$guardedで設定
// 以下の処理を記述

  protected $guarded = [
    'id',
    'created_at',
    'updated_at',
 ];
 
   // 更新日時が新しい順にソートしてデータを表示する関数
  public static function getAllOrderByUpdated_at()
  {
    return self::orderBy('updated_at', 'desc')->get();
  }
 
   public function user()
  {
    return $this->belongsTo(User::class);
  }
  
  public function images()
  {
    return $this->belongsToMany(Image::class, 'project_images')
    ->using(ProjectImage::class);
  }
  
  public function getProjects()
  {
    return Project::with('images')->orderBy('create_at', 'DESC')->get();
  }

 
}
