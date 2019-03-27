@extends('admin.layout')


@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Datos pagina</h3>

      </div>
      <div class="box-body">
        @include('admin.partials.error-messages')


        <form action="{{ route('admin.pages.store') }}" method="POST" >
          {{ csrf_field() }}

          <div class="form-group">
            <label >Página web</label>
            <input type="text" value="{{ old('page_name') }}" name="page_name"  class="form-control">
          </div>

          <div class="form-group">
            <label >Usuario FTP</label>
            <input type="text" value="{{ old('user_ftp') }}" name="user_ftp"  class="form-control">
          </div>

          <div class="form-group">
            <label >Password FTP</label>
            <input type="text" name="pass_ftp" value="{{ old('pass_ftp') }}"  class="form-control" placeholder="">

          </div>
          <div class="form-group">
            <label >Link archivo</label>
            <input type="text" name="link_file" value="{{ old('link_file') }}"  class="form-control" placeholder="">

          </div>

          <div class="form-group">
            <label >Codigo actual</label>
            <input type="text" name="current_code" value="{{ old('current_code') }}"  class="form-control" placeholder="">

          </div>

         

         <!--  <div class="form-group">
            <label >Fecha actualización</label>
            <input type="date" name="cron_update"  value="{{ old('cron_update') }}" class="form-control" placeholder="">
            
          </div> -->

         

        
          <button class="btn btn-primary btn-block">Crear </button>
        </form>


      </div>
    </div>
  </div>
</div>

@stop
