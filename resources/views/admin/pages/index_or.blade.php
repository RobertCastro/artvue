@extends('admin.layout')

@section('header')
<h1>
  Paginas
  <small> Listado</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{!! route('dashboard') !!}"><i class="fa fa-chart-line"></i> Inicio</a></li>
  <li class="active">Paginas</li>
</ol>
@stop


@section('content')
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"> Listado de Páginas</h3>
   <!--  <a href="{!! route('admin.pages.create') !!}" class="btn btn-primary pull-right">
      <i class="fa fa-plus"></i> Crear pagina
    </a> -->
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
                Crear Página
    </button>
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <table id="posts-table" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>Página</th>

        <th>Link de archivo</th>


      </tr>
      </thead>
      <tbody>
        @foreach($pages as $page)
          <tr>
            <td>{!! $page->id !!}</td>
            <td>{!! $page->page_name !!}</td>
            <td><pre><code class="html">{!! $page->link_file !!}</code></pre></td>

            <td>
              <!-- <a href="{!! route('admin.pages.show', $page) !!}" class="btn btn-xs btn-default"> <i class="fa fa-eye"></i> </a> -->
              <a href="{!! route('admin.pages.edit', $page) !!}" class="btn btn-xs btn-info"> <i class="fa fa-pencil"></i> </a>
              <a href="{!! route('admin.pages.destroy', $page) !!}" class="btn btn-xs btn-danger"> <i class="fa fa-times"></i> </a>
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
  <link rel="stylesheet" href="{!! asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">
@endpush

@push('scripts')
<script src="{!! asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}"></script>
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
  <form method="POST" action="{!! route('admin.posts.store') !!}">
    {!! csrf_field() !!}
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

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                        <form action="{!! route('admin.pages.store') !!}" method="POST" >
          {!! csrf_field() !!}

          <div class="form-group">
            <label >Página web</label>
            <input type="text" value="{!! old('page_name') !!}" name="page_name"  class="form-control">
          </div>

          <div class="form-group">
            <label >Usuario FTP</label>
            <input type="text" value="{!! old('user_ftp') !!}" name="user_ftp"  class="form-control">
          </div>

          <div class="form-group">
            <label >Password FTP</label>
            <input type="text" name="pass_ftp" value="{!! old('pass_ftp') !!}"  class="form-control" placeholder="">

          </div>
          <div class="form-group">
            <label >Link archivo</label>
            <input type="text" name="link_file" value="{!! old('link_file') !!}"  class="form-control" placeholder="">

          </div>

          <div class="form-group">
            <label >Codigo actual</label>
            <input type="text" name="current_code" value="{!! old('current_code') !!}"  class="form-control" placeholder="">

          </div>

          <button class="btn btn-primary btn-block">Crear </button>
        </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>-->
          </div>
        </div>
        <!-- /.modal -->

@endpush
