<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Image;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use PharIo\Manifest\Author;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::pluck('name', 'id');

        $tags = Tag::all();
        
        //return $categories;

        return view('admin.posts.create', compact('categories', 'tags'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        //return Storage::put('storage/posts', $request->file('file'));

        //return $request->file('file');
        //return $request->all();
        
        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('public/posts', $request->file('file'));

            //para almacenar la imagen relacionada en la db
            $post->image()->create([
                'url' => $url
            ]);
        }

        if($request->tags){
            $post->tags()->attach($request->tags);//tags() esl la relacion de muchos a muchos
        }

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post); //llamar a la politica de seguridad para editar el post

        $categories = Category::pluck('name', 'id');

        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post); //llamar a la politica de seguridad para modificar el post

        $post->update($request->all());

        if ($request->file('file')) {
            
            $url = Storage::put('public/posts', $request->file('file'));

            if ($post->image) {
                
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
        if($request->tags){
            $post->tags()->sync($request->tags);//tags() esl la relacion de muchos a muchos el metodo sync es para update de esa manera no crea un nuevo registro
        }


        return redirect()->route('admin.posts.edit', $post)->with('info', 'Post Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post); //llamar a la politica de seguridad para eliminar el post

        $post->delete();

        return redirect()->route('admin.posts.index', $post)->with('info', 'Post Eliminado');
    }
}
