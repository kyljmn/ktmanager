<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
      'owner_id', 'title', 'description', 'deadline',
  ];
  public function owner()
  {
    return $this->belongsTo('App\User');
  }
  public function tasks()
  {
    return $this->hasMany('App\Task');
  }
}
