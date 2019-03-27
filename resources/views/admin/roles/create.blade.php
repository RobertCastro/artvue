@extends('admin.layout')


@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear rol</h3>

      </div>
      <div class="box-body">

        @include('admin.partials.error-messages')

        <form action="{{ route('admin.roles.store') }}" method="POST" >
          {{ csrf_field() }}

          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" value="{{ old('name') }}" name="name"  class="form-control">
          </div>

          <div class="form-group">
            <label for="email">Guard:</label>

            <select class="form-control" name="guard_name">
              @foreach( config('auth.guards') as $guardName => $guard )
                <option {{ old('guard_name') === $guardName ? 'select' : '' }}
                value=" {{ $guardName }} "> {{ $guardName }} </option>
              @endforeach

            </select>
          </div>


          <div class="form-group col-md-6">
            <label>Permisos</label>
              @include('admin.permissions.checkboxes', ['model' => $role])
          </div>

          <button class="btn btn-primary btn-block">Crear rol</button>
        </form>


      </div>
    </div>
  </div>
</div>

@stop
