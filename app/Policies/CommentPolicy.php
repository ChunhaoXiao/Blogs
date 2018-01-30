<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Comment;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function before(User $user)
    {
        if($user->is_admin)
        {
            return true ;
        }    
    }
    public function delete(User $user, Comment $comment)
    {
         return $user->id === $comment->user_id ;   
    }

}
