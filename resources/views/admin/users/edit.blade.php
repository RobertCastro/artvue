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


        <form action="{{ route('admin.users.update', $user) }}" method="POST" >
          {{ csrf_field() }} {{ method_field('PUT') }}

          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" value="{{ old('name', $user->name) }}" name="name"  class="form-control">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{ old('email', $user->email) }}" name="email"  class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password"  class="form-control" placeholder="Ingrese su contraseña">
            <span class="help-block">Su contraseña no cambiará si deja en blanco este campo</span>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Repite Password</label>
            <input type="password" name="password_confirmation"  class="form-control" placeholder="Repetir contraseña">
          </div>

          <button class="btn btn-primary btn-block">Actualizar </button>
        </form>


      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Roles </h3>

      </div>
      <div class="box-body">
        @role('Admin')
        <form class="" action="{{ route('admin.users.roles.update', $user) }}" method="POST">
          {{ csrf_field() }} {{ method_field('PUT') }}

            @include('admin.roles.checkboxes')

          <button class="btn btn-primary btn-block">Actualizar Roles</button>
        </form>
        @else
          <ul class="list-group">
            @forelse($user->roles as $role)
              <li class="list-group-item">{{ $role->name }}</li>
            @empty
              <li class="list-group-item">No tiene roles</li>
            @endforelse


          </ul>
        @endrole
      </div>
    </div>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Permisos </h3>

      </div>
      <div class="box-body">
        @role('Admin')
        <form class="" action="{{ route('admin.users.permissions.update', $user) }}" method="POST">
          {{ csrf_field() }} {{ method_field('PUT') }}

            @include('admin.permissions.checkboxes', ['model' => $user])

          <button class="btn btn-primary btn-block">Actualizar Permisos</button>
        </form>
        @else
          <ul class="list-group">
            @forelse($user->permissions as $permission)
              <li class="list-group-item">{{ $permission->name }}</li>
            @empty
              <li class="list-group-item">No tiene permisos</li>
            @endforelse
          </ul>
        @endrole
      </div>
    </div>
  </div>

</div>



@stop
