<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable =
    [
      'model_id', 'description', 'model_type',
    ];

    public function noteable()
    {
      return $this->morphTo();
    }

}
