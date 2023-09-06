<x-app-layout>

    <div class="max-w-7xl px-2 sm:px-6 lg:px-8 py-8 justify-center py-8">
        <h1 class="text-4x font-bold text-gray-600">{{$post->name}}</h1>
        <div cals="text-lg text-gray-500 mb-2">
            {{($post->extract)}}
        </div>

        <div class="grid grid-cols-3 sm:px-6 lg:px-8 px-2 py-8">

            <div calss="col-span-2">

                <figure>
                    <img class="w-full h-80 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="">
                </figure>
                <div class="text-base text-gray-500 mt-4">
                    {{$post->body}}
                </div>                

            </div> 
            <aside>
                <h1 class="text-2x1 font-bold text-gray-600 mb-4">Mas en {{$post->category->name}}</h1>

                <ul>
                    @foreach ($similares as $similar)      
                        <li>
                            <a class="flex" href="{{route('posts.show', $similar)}}">
                                
                                <img src="{{Storage::url($similar->image->url)}}" alt="">
                            </a>
                        </li>              
                    @endforeach
                </ul>
            </aside>

        </div>
    </div>
</x-app-layout>