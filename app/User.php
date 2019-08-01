<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Project;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'timezone',
    ];

    protected static function boot()
    {
      parent::boot();

      static::created(function($user)
      {
        $project = [
          'owner_id' => $user->id,
          'title' => 'General Tasks',
          'description' => 'This is the project where tasks created from the dashboard will be inserted to by default if no projects are specified',
          'deadline' => date_create_from_format('Y-m-d H:i:s', '1970-01-01 00:00:00' )->format('Y-m-d H:i:s'),
        ];
        Project::create($project);
      });

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects()
    {
      return $this->hasMany('App\Project','owner_id');
    }
}
