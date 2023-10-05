<x-app-layout>

    <div class="max-w-7xl px-2 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{$post->name}}</h1>
        <div calss="text-lg text-gray-500 mb-2">
            {{($post->extract)}}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 py-8 gap-6">

            <!--Contenido proncipal  */-->
            <div class="lg:col-span-2">

                <figure>
                    @if ($post->image)
                        <img class="w-full h-80 object-cover object-center" src="{{Storage::url($post->image->url)}}" al t="">                                                       
                    @else
                        <img class="w-full h-80 object-cover object-center" src="https://cdn.pixabay.com/photo/2023/08/30/12/37/leaves-8223213_1280.jpg" al t="">                                                       
                    @endif
                </figure>
                <div class="text-base text-gray-500 mt-4">
                    {!!$post->body!!}<!--los signos !! es para que no aparezca con etiquetas <p></p> en el index  */-->
                </div>                

            </div> 
            <!-- Conteinido Relacionado -->
            <aside>
                <h1 class="text-2x1 font-bold text-gray-600 mb-4">Mas en {{$post->category->name}}</h1>

                <ul>
                    @foreach ($similares as $similar) <!--iteracion de similares-->     
                        <li class="mb-4">
                            <a class="flex" href="{{route('posts.show', $similar)}}">                                
                                @if ($post->image)
                                    <img class="w-36 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt=""> <!--el h-20 es para el alto de la imagen-->
                                @else
                                    <img class="w-36 object-cover object-center" src="https://cdn.pixabay.com/photo/2023/08/30/12/37/leaves-8223213_1280.jpg" alt="">
                                @endif
                                <span class="ml-2 text-gray-600">{{$similar->name}}</span>
                            </a>
                        </li>              
                    @endforeach
                </ul>
            </aside>

        </div>
    </div>
</x-app-layout>