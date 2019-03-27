@extends('admin.layout')

@section('header')
<h1>
  Posts
  <small> Listado</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ route('dashboard') }}"><i class="fa fa-chart-line"></i> Inicio</a></li>
  <li class="active">Posts</li>
</ol>
@stop


@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"> Listado de Publicaiones</h3>
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Crear publicación</button>
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <table id="posts-table" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Extracto</th>

      </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
          <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->except }}</td>
            <td>
              <a href="{{ route('posts.show', $post) }}"  target="_blank" class="btn btn-xs btn-default"> <i class="fa fa-eye"></i> </a>
              <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-xs btn-info"> <i class="fa fa-pencil"></i> </a>
              <a href="" class="btn btn-xs btn-danger"> <i class="fa fa-times"></i> </a>
            </td>
          </tr>

        @endforeach

      </tbody>

    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@stop


@push('styles')
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      $('#posts-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })

  </script>

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="POST" action="{{ route('admin.posts.store') }}">
    {{ csrf_field() }}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Titulo del post </h4>
      </div>
      <div class="modal-body">
        <div class="form--group">

          <input class="form-control" name="title" placeholder="Ingres el titulo ">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Crear</button>
      </div>
    </div>
  </div>
</form>
</div>
@endpush
