<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

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

        $this->authorize('published', $post);
        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2) 
                            ->where('id','!=', $post->id) //filtro para que no aparezca en los post similares
                            ->latest('id') //ordenar de manera decendente
                            ->take(4) //numero de post a solicitar
                            ->get(); //para crear la coleccion

        return view('posts.show', compact('post', 'similares'));        
    }
    public function category(Category $category){
        $posts = Post::where('category_id', $category->id)
                    ->where('status', 2)
                    ->latest('id')
                    ->paginate(4);
        return view('posts.category', compact('posts', 'category'));
    }
    public function tag(Tag $tag){
        $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(4);

        return view('posts.tag', compact('posts', 'tag'));
    }   
}
