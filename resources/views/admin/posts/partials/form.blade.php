<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese en nombre del post']) !!}

    @error('name')
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese en Slug del post', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>

<div class="form-group">

    {!! Form::label('category_id', 'Categoria') !!}                    
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}                    

    @error('category_id')
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>

<div class="form-group">
    <p class="font-weigth-bold">Etiquetas</p>

    @foreach ($tags as $tag)

        <label class="mr-2">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{$tag->name}}
        </label>
        
    @endforeach

    @error('tags')
        <br>
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>

<div class="form-group">
    <p class="font-weigth-bold">Estado</p>

    <label>
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>

    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>

    @error('status')
        <br>
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image) <!--isset es para verificara si esta difinido la variable post similar a un id -->
                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2023/08/30/12/37/leaves-8223213_1280.jpg" alt="">
            @endisset
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen del Post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('image')
                <span class="text-danger">{{$message}}</span>                            
            @enderror

        </div>
        
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore earum sapiente minima eum at doloremque alias numquam. Doloribus sequi unde nihil a odit quasi sunt numquam harum, ab quibusdam? Laborum?</p>
        
    </div>
</div>

<div class="form-group">

    {!! Form::label('extrac', 'Extracto') !!}
    {!! Form::textarea('extrac', null, ['class' => 'form-control']) !!}

    @error('extrac')
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>

<div class="form-group">

    {!! Form::label('body', 'Cuerpo del post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <small class="text-danger">{{$message}}</small>
    @enderror

</div>