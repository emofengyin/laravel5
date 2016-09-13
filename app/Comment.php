<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function belongsToArticle() {
        return $this->belongsTo('App\Article', 'article_id', 'id');
    }
}
