<?php

namespace Modules\Clicks\Entities;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $table = 'click';


    protected $fillable = [
        'ua',
        'ip',
        'ref',
        'param1',
        'param2',
        'error',
        'bad_domain',
    ];

    public $timestamps = false;


    protected $casts = [
        'id' => Click::class.':castId'
    ];


    public function save(array $options = [])
    {
        if (empty($this->attributes['id'])) {
            $this->attributes['id'] = sha1("{$this->ua}:{$this->ip}:{$this->ref}:{$this->param1}");
        }
        return parent::save($options);
    }

}


