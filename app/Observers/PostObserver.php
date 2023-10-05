<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        if (! \App::runningInConsole()) { //con el if validamos que se ejecute el seeder cuando se lo envie desde la consola, caso contrario da error porque la consola no tiene un usuario autenticado
            $post->user_id = auth()->user()->id; //para asignar el post al usuario autenticado
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleting(Post $post): void
    {
        if ($post->image) {
            Storage::delete($post->image->url);
        }
    }

}
