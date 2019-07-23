<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
      'project_id', 'description', 'status', 'deadline',
    ];
    public function project()
    {
      return $this->belongsTo('App\Project');
    }

}
