<?php

namespace App;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
      public function user(){
        return  $this->belongsTo(User::class);
      }

      public function category(){
          return  $this->belongsTo(Category::class,'cat_id');
      }

      public function comments(){
        return  $this->hasMany(Comment::class,'post_id');
      }

      protected $dispatchesEvents = [
        'created' => PostCreated::class //When a post is created then this Event will be fired
      ];
}

