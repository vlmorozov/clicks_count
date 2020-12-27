<?php

namespace Modules\Clicks\Entities;

use Illuminate\Database\Eloquent\Model;

class BadDomain extends Model
{

    protected $fillable = [
        'name'
    ];


    public $timestamps = false;
}
