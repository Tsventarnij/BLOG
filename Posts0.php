<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = ['id'];
    public function creator(){
      return $this->belongsTO(User::class, 'user_id');
    }
    public function isLike(){
      $atributs=['user_id'=>auth()->id(),
                 'posts_id'=>$this->id];
      $requ=Like::where($atributs)->first();
    //  dd($requ);
  //  if($requ->isemty){ return "Вы не выбрали";}
      if($requ['like']) return "Вам понравился пост!";
      if($requ['unlike']) return "Вам не понравился пост!";
    }
    //
}
