<?php

namespace App\Policies;

use App\User;
use App\Task;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function update(User $user, Task $task)
     {
         return $user->id === $task->project->owner_id;
     }
}
