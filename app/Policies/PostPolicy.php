<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    //validar que solo el usuario propietario del post sea capaz de editar
   public function author(User $user, Post $post){
    if ($user->id == $post->user->id) {
        return true; 
    }else{
        return false; //return true; si permite hacer la edicion
    }    
   }

   public function published(?User $user, Post $post){//el simbolo ? es para indicar que el parámetro es opcional
    if ($post->status == 2) {
        return true;
    }else{
        return false;
    }
   }
}
