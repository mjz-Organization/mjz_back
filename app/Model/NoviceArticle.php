<?php

namespace App\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class NoviceArticle extends BaseModel
{

    use SoftDeletes;

    protected $table = 'novice_article';

    public static $dbTable = 'novice_article';

    protected $guarded = [];

    protected $dates = ['delete_at'];
}
