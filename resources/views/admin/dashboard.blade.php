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

  <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir codigo </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="linkacambiar">Link archivo</label>
                  <input name="linkacambiar" type="text" class="form-control" id="" placeholder="Links de archivo">
                </div>
                <div class="form-group">
                  <label for="">Nuevo cadena</label>
                  <input name="nuevacadena" type="text" class="form-control" id="" placeholder="Nueva cadena">
                </div>

                <div class="form-group">
                  <label for="">Cadena a buscar</label>
                  <input name="buscar" type="text" class="form-control" id="" placeholder="Cadena a buscar">
                </div>
               
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


      </div>

@stop
