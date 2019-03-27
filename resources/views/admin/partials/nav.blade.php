<ul class="sidebar-menu" data-widget="tree">
  <li class="header">NAVEGACIÓN</li>

   <li @click="menu=0" class="{!! setActiveRoute('dashboard') !!}"> 
    <a href=""> 
      <i class="fa fa-circle-o text-red"></i> <span>Páginas</span>
    </a>
  </li>

  <li @click="menu=1" class="{!! setActiveRoute('admin.pages.create') !!}">
    <a href="">
      <i class="fa fa-circle-o text-red"></i> <span>Nueva Página</span>
    </a>
  </li>

  <li @click="menu=2" class="{!! setActiveRoute('admin.users.index') !!}">
    <a href="">
      <i class="fa fa-users"></i> <span>Usuarios</span>
    </a>
  </li>


  <li @click="menu=3" class="bg-success {!! setActiveRoute('cron') !!}">
    <a href="" style="background-color: rgb(0, 166, 90);">
      <i class="fa fa-rocket" style="color: rgb(255, 255, 255);"></i>
      <span style="color: rgb(255, 255, 255);">Ejecutar Cron</span>
    </a>
  </li>


<!--   <li class="treeview {!! setActiveRoute('admin.posts.index') !!}">
    <a href="#"><i class="fa fa-link"></i> <span>Blog</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{!! setActiveRoute('admin.posts.index') !!}" ><a href=" {!! route('admin.posts.index') !!} ">
        <i class="fa fa-eye"></i> Ver Posts</a>
      </li>

      <li><a href="#"data-toggle="modal" data-target="#myModal" ><i class="fa fa-pencil"></i> Crear nuevo Post</a></li>
    </ul>
  </li> -->

<!--   <li class="treeview {!! setActiveRoute(['admin.users.index', 'admin.users.create']) !!}">
    <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{!! setActiveRoute('admin.users.index') !!}" ><a href=" {!! route('admin.users.index') !!} ">
        <i class="fa fa-users"></i> Ver usuarios</a>
      </li>
      <li class="{!! setActiveRoute('admin.users.create') !!}" ><a href=" {!! route('admin.users.create') !!} ">
        <i class="fa fa-user"></i> Crear usuario</a>
      </li>

    </ul>
  </li> -->
</ul>
