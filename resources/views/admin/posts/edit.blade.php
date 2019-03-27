@extends('admin.layout')

@section('header')
<h1>
  Page Header
  <small> Dashboard</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-chart-line"></i> Inicio</a></li>
  <li class="active">Posts</li>
</ol>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
  @if($post->photos->count())
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row">
          @foreach($post->photos as $photo)
          <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
            {{ method_field('DELETE') }} {{ csrf_field() }}

            <div class="col-md-3">
              <button class="btn btn-danger btn-xs" style="position:absolute">
                <i class="fa fa-remove"></i>
              </button>
              <img class="img-responsive" src="{{ url($photo->url) }}" >
            </div>
          </form>

          @endforeach
        </div>

      </div>
    </div>

  </div>
  @endif

  <form method="POST" action="{{ route('admin.posts.update', $post) }}">
    {{ csrf_field() }} {{ method_field('PUT') }}
  <div class="col-md-8">
<div class="box box-primary">


    <div class="box-body">
      <div class="form--group">
        <label>Titulo de la publicación </label>
        <input class="form-control" value="{{ old('title', $post->title) }}" name="title" placeholder="Ingres el titulo" >
      </div>

      <div class="form--group">
        <label>Contenido</label>
        <textarea rows="10" id="editor" class="form-control" name="body" placeholder="Ingresa el contenido" >{{ old('body', $post->body) }}</textarea>
      </div>

    </div>


</div>

</div>
<div class="col-md-4">
  <div class="box box-primary">

    <div class="box-body">
      <div class="form-group">
        <label>Fecha de publicación:</label>

        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input name="published_at" value="
          {{ old('published_at', $post->published_at != null ? $post->published_at->format('m/d/Y') : '' ) }} "
          type="text" class="form-control pull-right" id="datepicker">
        </div>
        <div class="form-group">
          <label>Categorias</label>
          <select name="category" class="form-control" >
            <option value="">Selecciona una categoria</option>
            @foreach ($categories as $category)
              <option  value="{{ $category->id }}"
                {{ old('category', $post->category_id) == $category->id ? 'selected' : ''}}
                >{{ $category->name }} </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Etiquetas</label>
          <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Selecciona etiquetas"
                  style="width: 100%;">
            @foreach($tags as $tag)
              <option {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form--group">
        <label>Extracto</label>
        <textarea class="form-control" name="except" placeholder="Ingresa un Extracto de la publicación" >
          {{ old('except', $post->except) }}
        </textarea>
      </div>
      <div class="form-group">
        <div class="dropzone">

        </div>
      </div>
      <div class="form-group">
        <button class="btn btn-primary btn-block">Guardar publicación</button>
      </div>

    </div>

  </div>
</div>

</form>

</div>
@stop

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    $('#datepicker').datepicker({
      autoclose: true
    })

    $('.select2').select2()

    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );

    } )
    .catch( error => {
        console.error( error );
    } );
    // ClassicEditor.config.height = 315;



    var myDropzone = new Dropzone('.dropzone', {
      url: '/admin/posts/{{ $post->url }}/photos',
      acceptedFiles: 'image/*',
      paramName: 'photo',
      maxFilesize: 2,
      headers:{
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      dictDefaultMessage: 'Añade las imagenes'
    });

    myDropzone.on('error', function(file, res){
      console.log(res);
      // var msg = res.errors.message;
      // $('.dz-error-message:last > span').text(msg);
    });
    Dropzone.autoDiscover = false;


  </script>
@endpush
