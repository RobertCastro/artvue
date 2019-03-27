<template>
    
<main>
    <div class="box box-primary">
        <router-view></router-view>
        <div class="box-header">
            <h3 class="box-title"> Listado de Páginas</h3>
            <button @click="openModal('page', 'registrar')" type="button" class="btn btn-primary pull-right">
                Nueva página
            </button>
        </div>
        <div class="box-body">
            <!-- FILTROS -->
            <div class="row">
                <div class="col-sm-2">
                    <select v-model="criterio" @change = "listPages(1, buscar, criterio)" class="form-control input-sm">
                        <option value="active">Activa</option>
                        <option value="inactive">Inactiva</option>
                    </select>
                   
                    <!-- <input  v-model="criterio" type="checkbox" @change = "listPages(1, buscar, criterio)" > -->
                </div>

                <div class="col-sm-5">
                    <div class="input-group input-group-sm">
                        <input v-model="buscar" @keyup.enter="listPages(1, buscar, criterio)" type="search" class="form-control">
                        <span class="input-group-btn">
                            <button @click="listPages(1, buscar, criterio)" type="submit" class="btn btn-info btn-flat">Buscar por nombre</button>
                            </span>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="input-group input-group-sm">
                        <button @click="clearFilter()" type="submit" class="btn bg-maroon btn-sm">Limpiar</button>
                    </div>
                    
                </div>

            </div>
            <!-- FIN FILTROS -->
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Página</th>
                        <th>Link de archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pagina in arrayPage" :key="pagina.id" :pagina="pagina.id">
                        <td v-text="pagina.id"></td>
                        <td v-text="pagina.page_name"></td>
                        <td v-text="pagina.link_file"></td>
                        <td>
                            <!-- <button  @click="vueRoot.menu = 2 " class="btn btn-xs bg-olive btn-flat"> <i class="fa fa-eye"></i> </button> -->
                            <router-link :to="{name: 'page_show', params:{id: pagina.id}}"
                                          class="btn btn-xs bg-olive btn-flat">
                                <i class="fa fa-eye"></i>
                            </router-link> 
                            <!-- <button @click="vueRoot.menu = 2;" class="btn btn-xs bg-olive btn-flat"> <i class="fa fa-eye"></i> </button> -->
                            <button @click="openModal('page', 'actualizar', pagina)" class="btn btn-xs bg-purple btn-flat"> <i class="fa fa-pencil"></i> </button>
                            <template v-if="pagina.active==1">
                                <button  @click="deactivatePage(pagina.id)" class="btn btn-xs bg-maroon btn-flat"> <i class="fa fa-times" title="Activar"></i> </button>
                            </template>
                            <template v-else>
                                <button @click="activatePage(pagina.id)" class="btn btn-xs bg-navy btn-flat"> <i class="fa fa-check" title="Desactivar"></i> </button>
                            </template>
                            <button @click="deletePage(pagina.id)" class="btn btn-xs bg-defaut btn-flat pull-right"> <i class="fa fa-times" title="Eliminar"></i> </button>
                        </td>
                    </tr>
                        
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Anterior</a>
                    </li>
                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']" >
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"> </a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Siguiente</a>
                    </li>
                </ul>
            </nav>
            
        </div>
    </div>
    <!-- MODAL -->
    <div class="modal fade" id="modal-default" :class="{'mostrar' : modal}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button @click="closeModal()" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" >
                        <div class="form-group">
                            <!-- <label >Página web</label> -->
                            <input v-model="page_name" type="text" class="form-control" placeholder="Página web">
                        </div>

                        <div class="form-group">
                            <!-- <label >Usuario FTP</label> -->
                            <input v-model="user_ftp" type="text" class="form-control" placeholder="Usuario FTP">
                        </div>

                        <div class="form-group">
                            <!-- <label >Password FTP</label> -->
                            <input v-model="pass_ftp" type="text" class="form-control" placeholder="Password FTP">

                        </div>
                        <div class="form-group">
                            <!-- <label >Link archivo</label> -->
                            <input v-model="link_file" type="text" class="form-control" placeholder="Link de archivo">
                        </div>

                        <div class="form-group">
                            <!-- <label >Codigo actual</label> -->
                            <input v-model="current_code" type="text" class="form-control" placeholder="Codigo actual">
                        </div>

                        <div v-show="errorPage" class="callout callout-danger">
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            <div class="">
                                <div v-for="error in errorMostrarMsjPage" :key="error" v-text="error"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click="closeModal()" type="button" class="btn btn-default pull-left">Cerrar</button>
                    <button v-if="tipoAccion == 1" @click="registerPage()" type="button" class="btn btn-primary">Agregar</button>
                    <button @click="updatePage()" v-if="tipoAccion == 2" type="button" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
</main>
</template>

<script>

    export default {

        data (){
            return {
                page_id : '',
                page_name : '',
                user_ftp : '',
                pass_ftp : '',
                link_file : '',
                current_code : '',
                arrayPage : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPage : 0,
                errorMostrarMsjPage : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0
                },
                offset : 3,
                // tipo de busqueda
                criterio : '',
                // cadena a buscar
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pageArray = [];
                while(from <= to){
                    pageArray.push(from);
                    from++;
                }
                return pageArray;
            },
            vueRoot()
            { 
                return this.$root;
                
            },
        },
        methods : {
            listPages(page, buscar, criterio){

                let me=this;
                var url = '/admin/pages?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPage = respuesta.pages.data;
                    me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });

            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_Page = page;

                me.listPages(page, buscar, criterio);
            },
            registerPage(){

                if(this.validatePage()){
                    return;
                }

                // const swalWithBootstrapButtons = swal.mixin({
                //     confirmButtonClass: 'btn btn-success',
                //     cancelButtonClass: 'btn btn-danger',
                //     buttonsStyling: false,
                // });

                const swalWithBootstrapButtons = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000,
                  buttonsStyling: true
                });

              
              
                let me = this;
                var url = 'admin/pages';
                axios.post(url, {
                    'page_name': this.page_name,
                    'user_ftp': this.user_ftp,
                    'pass_ftp': this.pass_ftp,
                    'link_file': this.link_file,
                    'current_code': this.current_code
                })
                .then(function (response) {
                    me.closeModal();
                    me.listPages(1, '', 'page_name');

                    swalWithBootstrapButtons(
                    'Página creada!',
                    'La página ha sido creada.',
                    'success'
                    )
                })
                .catch(function (error) {
                    console.log(error);
                });

                    
           
             

              
            },   
            updatePage(){

                if(this.validatePage()){
                    return;
                }

                let me = this;
                var url = 'admin/pages/' + this.page_id;
                axios.put(url, {
                    'page_name': this.page_name,
                    'user_ftp': this.user_ftp,
                    'pass_ftp': this.pass_ftp,
                    'link_file': this.link_file,
                    'current_code': this.current_code,
                    'id' : this.page_id
                })
                .then(function (response) {
                    me.closeModal();
                    me.listPages(1, '', 'page_name');
                })
                .catch(function (error) {
                    console.log(error);
                });

            },

            deactivatePage(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success btn-flat',
                cancelButtonClass: 'btn btn-danger btn-flat',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Esta seguro?',
                text: "Estás seguro de desactivar esta página!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, desactivar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    var url = 'admin/pages/deactivate/' + this.id;
                    axios.put(url, {
                        id: id
                    })
                    .then(function (response) {
                        me.listPages(1, '', 'page_name');
                        swalWithBootstrapButtons(
                        'Desactivada!',
                        'La página ha sido desactivada.',
                        'success'
                        )
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons(
                    // 'Cancelled',
                    // 'Your imaginary file is safe :)',
                    // 'error'
                    // )
                }
                })
            },

            deletePage(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Esta seguro?',
                text: "Se eliminará la informacion!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    var url = 'admin/pages/' + id;
                    axios.delete(url, {
                        id: id
                    })
                    .then(function (response) {
                        me.listPages(1, '', 'page_name');
                        swalWithBootstrapButtons(
                        'Eliminada!',
                        'La página ha sido eliminada.',
                        'success'
                        )
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    
                } else if (
                    
                    result.dismiss === swal.DismissReason.cancel
                ) {
                
                }
                })
            },
            activatePage(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Esta seguro?',
                text: "Estás seguro de activar esta categoria!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, activar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    var url = 'admin/pages/activate/' + this.id;
                    axios.put(url, {
                        id: id
                    })
                    .then(function (response) {
                        me.listPages(1, '', 'page_name');
                        swalWithBootstrapButtons(
                        'Activado!',
                        'La categoria ha sido activada.',
                        'success'
                        )
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    // swalWithBootstrapButtons(
                    // 'Cancelled',
                    // 'Your imaginary file is safe :)',
                    // 'error'
                    // )
                }
                })
            },
            validatePage(){

                this.errorPage = 0;
                this.errorMostrarMsjPage = [];

                if (!this.page_name) this.errorMostrarMsjPage.push("Ingrese al url de la página.");
                if (!this.user_ftp) this.errorMostrarMsjPage.push("Ingrese el usuario FTP.");
                if (!this.pass_ftp) this.errorMostrarMsjPage.push("Ingrese la contraseña FTP.");
                if (!this.link_file) this.errorMostrarMsjPage.push("Ingrese el link del archivo a actualizar.");
                if (!this.current_code) this.errorMostrarMsjPage.push("Ingrese el codigo actual del archivo.");
                if(this.errorMostrarMsjPage.length) this.errorPage = 1;
                return this.errorPage;
            },
            closeModal(){

                this.modal = 0;
                this.tituloModal = '';
                this.page_name ='';
                this.user_ftp = '';
                this.pass_ftp ='';
                this.link_file ='';
                this.current_code = '';
                this.errorPage = 0;

            },

            clearFilter(){
                let me = this;

                this.buscar = '';
                this.criterio ='';
                me.listPages(1, '', 'page_name');

            },
            openModal(modelo, accion, data =[]){
                switch(modelo){
                    case "page":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Agregar Página';
                                this.page_name ='';
                                this.user_ftp = '';
                                this.pass_ftp ='';
                                this.link_file ='';
                                this.current_code = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Página';
                                this.page_name =data['page_name'];
                                this.user_ftp =data['user_ftp'];
                                this.pass_ftp =data['pass_ftp'];
                                this.link_file =data['link_file'];
                                this.current_code =data['current_code'];
                                this.tipoAccion = 2;
                                this.page_id = data['id'];
                                break; 
                            }
                        }
                    }
                }
            }
        },
        mounted() {
           this.listPages(1, this.buscar, this.criterio);
        }
    }
</script>

    <style>
        .modal-content{
            width: 100% !important;
            position: absolute !important;
        }
        .mostrar{
            display: list-item !important;
            opacity: 1 !important;
            position: absolute !important;
            background-color: #060d10ad !important;
        }
    </style>

