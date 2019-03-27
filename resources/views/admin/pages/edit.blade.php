@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border"> 
        <h3 class="box-title">Datos página</h3>

      </div>
      <div class="box-body">
        @include('admin.partials.error-messages')


        <form action="{{ route('admin.pages.update', $page) }}" method="POST" >
          {{ csrf_field() }} {{ method_field('PUT') }}

          <div class="form-group">
            <label for="Pagina">Página web</label>
            <input type="text" value="{{ old('page_name', $page->page_name) }}" name="page_name"  class="form-control">
          </div>

          <div class="form-group">
            <label for="email">Usuario FTP</label>
            <input type="text" value="{{ old('user_ftp', $page->user_ftp) }}" name="user_ftp"  class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password FTP</label>
            <input type="text" name="pass_ftp" value="{{ old('pass_ftp', $page->pass_ftp) }}"  class="form-control" placeholder="">

          </div>
          <div class="form-group">
            <label for="password">Link archivo</label>
            <input type="text" name="link_file" value="{{ old('link_file', $page->link_file) }}"  class="form-control" placeholder="">
          </div>



        <!--    <div class="form-group">
            <label for="password">Codigo</label>
            <input type="text" name="current_code" value="{{ old('current_code', $page->current_code) }}"  class="form-control" placeholder="">
          </div>
 -->
<!--           <div class="form-group">
            <label for="password">Fecha actualización</label>
            <input name="cron_update" value="{{ old('cron_update', $page->cron_update != null ? $page->cron_update->format('m/d/Y') : '' ) }}" type="text" class="form-control" id="datepicker">

          </div> -->

          <button class="btn btn-primary btn-block">Actualizar </button>
        </form>


      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Añadir cron  </h3>
      </div>
      <div class="box-body">

         <form action="{{ route('admin.codes.store') }}" method="POST" >
          {{ csrf_field() }} 

          <div class="form-group">
            <label for="update_code">Codigo actualizar</label>
            <input type="text" value="" name="update_code"  class="form-control">
          </div>

         
         <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input name="cron_date" type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                      // format: 'YYYY/MM/DD'
                    });
                });
            </script>

          <input type="hidden" name="page_id" value="{{$page->id}}">

        <button class="btn btn-primary btn-block">Programar </button>
        </form>
      </div>
     

    </div>

    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Codigo actual </h3>
      </div>
      <div class="box-body">
          <pre> <code > {{ $page->current_code }} </code> </pre>
      </div>

    </div>
  </div>


 <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header with-border"> 
        <h3 class="box-title">Programados</h3>
      </div>
        <!-- /.box-header -->
      <div class="box-body">
        <table id="posts-table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>ID</th>
            <th>Fecha actualización</th>
            <th>Codigo actualizar</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
            @foreach($programados as $programado)
              <tr>
                <td>{{ $programado->id }}</td>
                <!-- <td>{{ $programado->cron_date != null ? $programado->cron_date->format('m/d/Y') : '' }}</td> -->

                <td> {{ old('cron_date', $programado->cron_date != null ? $programado->cron_date->diffForHumans() : '' ) }} </td> 
                
                <td><pre><code >{{ $programado->update_code }}</code></pre></td>

                <td>
                  <a href="" class="btn btn-xs btn-default"> <i class="fa fa-eye"></i> </a>
                  <a href="" class="btn btn-xs btn-info"> <i class="fa fa-pencil"></i> </a>
                  <a href="" class="btn btn-xs btn-danger"> <i class="fa fa-times"></i> </a>
                </td>
              </tr>

            @endforeach

          </tbody>

        </table>
      </div>
      <!-- /.box-body -->
    </div>
 </div>


</div>
@stop

@push('styles')

@endpush

@push('scripts')

<!--   <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script>

    $('#datepicker').datepicker({
    format: "mm/dd/yyyy",
    autoclose: true

  
});
  </script> -->
@endpush