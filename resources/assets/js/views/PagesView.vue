<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border"> 
                        <h3 class="box-title">Datos página</h3>
                    </div>
                    <div class="box-body">
                        <form action="" method="POST" >
                        <!-- {{ csrf_field() }} {{ method_field('PUT') }} -->
                            <div class="form-group">
                                <label for="Pagina">Página web</label>
                                <input type="text" v-model="page_name" name="page_name"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Usuario FTP</label>
                                <input type="text" v-model="user_ftp" name="user_ftp"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password FTP</label>
                                <input type="text" v-model="pass_ftp" name="pass_ftp"  class="form-control" placeholder="">

                            </div>
                            <div class="form-group">
                                <label for="password">Link archivo</label>
                                <input type="text" v-model="link_file" name="link_file"  class="form-control" placeholder="">
                            </div>

                            
                        </form>

                        <button @click="updatePage()" type="button" class="btn btn-primary btn-block">Actualizar </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Añadir cron  </h3>
                    </div>
                    <div class="box-body">
                        <form action="" method="POST" >
                        <!-- {{ csrf_field() }}  -->
                            <div class="form-group">
                                <label for="update_code">Codigo actualizar</label>
                                <input type="text" v-model="update_code" class="form-control">
                            </div>
                            <div class="form-group">
                               <!--  <div class='input-group date' id='datetimepicker1'>
                                
                                    <input type="date" v-model="cron_date" name="cron_date"   class="form-control" />
                           
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div> -->

                                <input type="date" v-model="cron_date" class="form-control" >
                            </div>
                           
                            <button @click="newCron()" type="button" class="btn btn-primary btn-block">Programar </button>
                            
                        </form>
                        
                    </div>
                </div>
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Codigo actual </h3>
                    </div>
                    <div class="box-body">
                        <!-- <pre> <code v-text="page.current_code"> </code> </pre> -->
                        <textarea v-model="current_code"  name="current_code"  class="form-control" > </textarea>
                    </div>
                </div>
            </div>


            <div class="col-md-12" id="codes">
                <div class="box box-danger">
                    <div class="box-header with-border"> 
                        <h3 class="box-title">Programados</h3>
                    </div>
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
                                <!-- @foreach($programados as $programado) -->
                                <tr v-for="code in page.codes">
                                    <td v-text="code.id"></td>
                                    <!-- <td>{{ $programado->cron_date != null ? $programado->cron_date->format('m/d/Y') : '' }}</td> -->

                                    <!-- <td> {{ old('cron_date', $programado->cron_date != null ? $programado->cron_date->diffForHumans() : '' ) }} </td>  -->
                                    <td v-text="code.cron_date"></td>
                                    
                                    <td><pre><code v-text="code.update_code"></code></pre></td>

                                    <td>
                                      <a href="" class="btn btn-xs btn-default"> <i class="fa fa-eye"></i> </a>
                                      <a href="" class="btn btn-xs btn-info"> <i class="fa fa-pencil"></i> </a>
                                      <a href="" class="btn btn-xs btn-danger"> <i class="fa fa-times"></i> </a>
                                    </td>
                                </tr>
                              <!-- @endforeach -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default { 
        data(){
            return{
                    page_id : '',
                    page_name : '',
                    user_ftp : '',
                    pass_ftp : '',
                    link_file : '',
                    current_code : '',
                    update_code: '',
                    cron_date: '',
                    page : {},
                    codes : {},
                    errorPage : 0,
                    errorMostrarMsjPage : 0,

                    fecha: {
                      date: ''
                    }
                }
            },

            methods : {
                getPage(){

                    let me=this;
                    var url = 'admin/pages/'+ this.$route.params.id +'/edit';
                    axios.get(url).then(function (response) {
                        // var respuesta = response.data;
                        me.page = response.data.page;

                        me.page_name = me.page.page_name;
                        me.user_ftp = me.page.user_ftp;
                        me.pass_ftp = me.page.pass_ftp;
                        me.link_file = me.page.link_file;
                        me.current_code = me.page.current_code;
                    })
                    .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                },

                updatePage(){

                    if(this.validatePage()){
                        return;
                    }

                    const swalWithBootstrapButtons = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000,
                      buttonsStyling: true
                    });

                    let me = this;
                    // let page_id = data['id'];
                    var url = 'admin/pages/' + this.$route.params.id;
                    axios.put(url, {
                        'page_name': this.page_name,
                        'user_ftp': this.user_ftp,
                        'pass_ftp': this.pass_ftp,
                        'link_file': this.link_file,
                        'current_code': this.current_code,
                        'id' : this.page_id
                    })
                    .then(function (response) {
                        swalWithBootstrapButtons(
                        'Página actualizada!',
                        'La página ha sido actualizada.',
                        'success'
                        )
                    })
                    .catch(function (error) {
                        console.log(error);

                        swalWithBootstrapButtons(
                        'Error al actualizar!',
                        'warning'
                        )
                    });

                },

                newCron()
                {
                    if(this.validateCron()){
                        return;
                    }

                    const swalWithBootstrapButtons = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000,
                      buttonsStyling: true
                    });

                    let me = this;
                    var url = 'admin/codes';
                    axios.post(url, {
                        'cron_date': this.cron_date,
                        'update_code': this.update_code,
                        'page_id': this.$route.params.id
                    })
                    .then(function (response) {

                        swalWithBootstrapButtons(
                        'Cron creado!',
                        'El cron ha sido agregado.',
                        'success'
                        )

                        me.getPage();
                        me.clearCron();

                        
                        window.setTimeout( function () { me.scrollDown('codes'); }, 1000 );
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },

                scrollDown(id)
                {
                    document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'center' });
                },

                validateCron(){

                    this.errorCron = 0;
                    this.errorMostrarMsjCron = [];
                    if (!this.update_code) this.errorMostrarMsjCron.push("Ingrese un codigo");
                    if (!this.cron_date) this.errorMostrarMsjCron.push("Ingrese la fecha");
                   
                    if(this.errorMostrarMsjCron.length) this.errorCron = 1;
                    return this.errorCron;
                },

                validatePage(){

                    this.errorPage = 0;
                    this.errorMostrarMsjPage = [];

                    if (!this.page_name) this.errorMostrarMsjPage.push("Ingrese al url de la página.");
                    if (!this.user_ftp) this.errorMostrarMsjPage.push("Ingrese el usuario FTP.");
                    if (!this.pass_ftp) this.errorMostrarMsjPage.push("Ingrese la contraseña FTP.");
                    if (!this.link_file) this.errorMostrarMsjPage.push("Ingrese el link del archivo a actualizar.");
                    // if (!this.current_code) this.errorMostrarMsjPage.push("Ingrese el codigo actual del archivo.");
                    if(this.errorMostrarMsjPage.length) this.errorPage = 1;
                    return this.errorPage;
                },
                clearCron()
                {
                    this.update_code = '';
                    this.cron_date = '';
                }

            },

        mounted() {
                this.getPage();
            }
}
    </script>

    <style>
        
        

        textarea.form-control {
            background-color: #27221e;
            color: #b3b3b3;
            font-weight: 100;
            font-family: monospace;
            font-size: 12px;
        }
    </style>