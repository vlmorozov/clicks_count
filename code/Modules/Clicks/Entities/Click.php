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


    public function getIdAttribute()
    {
        if (!empty($this->attributes['id'])) {
            return $this->attributes['id'];
        }
        return sha1("{$this->ua}:{$this->ip}:{$this->ref}:{$this->param1}");
    }

    public function save(array $options = [])
    {
        if (empty($this->attributes['id'])) {
            $this->attributes['id'] = $this->id;
        }
        return parent::save($options);
    }

}


