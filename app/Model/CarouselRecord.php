<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CarouselRecord extends BaseModel
{
    use SoftDeletes;

    protected $table = 'carousel_record';

    public $dbTable = 'carousel_record';

    protected $guarded = [];

    protected $dates = ['delete_at'];

}
