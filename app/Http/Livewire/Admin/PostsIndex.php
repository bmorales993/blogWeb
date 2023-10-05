<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;
    
    protected $paginationTheme = "bootstrap"; //para usar estilos de boostrap en la paginacion

    public $search;//para que busque mientras estoy buscando

    public function updatingSearch(){      //para que la busqueda empieze desde la pagina 1
        $this->resetPage(); 
    }

    public function render()
    {
        //mostrar el listado que le pertenece al usuario

        $posts = Post::where('user_id', auth()->user()->id)
                        ->where('name', 'LIKE', '%' . $this->search . '%')//filtro de busqueda     
                        ->latest('id')
                        ->paginate();
        return view('livewire.admin.posts-index', compact('posts'));
    }
}
