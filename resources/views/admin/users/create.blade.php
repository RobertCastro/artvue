@extends('admin.layout')


@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Datos personales</h3>

      </div>
      <div class="box-body">
        @include('admin.partials.error-messages')


        <form action="{{ route('admin.users.store') }}" method="POST" >
          {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" value="{{ old('name') }}" name="name"  class="form-control">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{ old('email') }}" name="email"  class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password"  class="form-control" placeholder="Ingrese su contraseña">

          </div>

          <div class="form-group">
            <label for="password_confirmation">Repite Password</label>
            <input type="password" name="password_confirmation"  class="form-control" placeholder="Repetir contraseña">
          </div>

          <div class="form-group col-md-6">
            <label>Roles</label>
              @include('admin.roles.checkboxes')
          </div>

          <div class="form-group col-md-6">
            <label>Permisos</label>
              @include('admin.permissions.checkboxes', ['model' => $user])
          </div>




          <button class="btn btn-primary btn-block">Crear </button>
        </form>


      </div>
    </div>
  </div>
</div>

@stop
