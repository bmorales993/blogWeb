<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('status', 2)->latest('id')->paginate(8);/**MUESTRA EL CONTENIDO POR PAGINAS DE 8 EN OREDEN DECENDIENTE**/ 
        /**$posts = Post::where('status', 2)->paginate(8); MUESTRA EL CONTENIDO POR PAGINAS DE 8**/
        /**$posts = Post::where('status', 2)->get(); MUESRA TODO EL CONTENIDO EN UNA PAGINA**/

        return view('posts.index', compact('posts'));
    }

    //METODO PARA MOSTRAR POST
    public function show(Post $post){
        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->latest('id')
                            ->take(4)
                            ->get();

        return view('posts.show', compact('post', 'similares'));        
    }
}
