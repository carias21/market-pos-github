<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Administrar Módulos y Perfiles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Módulos y Perfiles</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="tabs-asignar-modulos-perfil" role="tablist">

            <li class="nav-item">
                <a class="nav-link" id="content-perfiles-tab" data-toggle="pill" href="#content-perfiles" role="tab" aria-controls="content-perfiles" aria-selected="false">Perfiles</a>
            </li>

           <!-- <li class="nav-item">
                <a class="nav-link" id="content-modulos-tab" data-toggle="pill" href="#content-modulos" role="tab" aria-controls="content-modulos" aria-selected="false">Modulos</a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link active" id="content-modulo-perfil-tab" data-toggle="pill" href="#content-modulo-perfil" role="tab" aria-controls="content-modulo-perfil" aria-selected="false">Asignar Modulo a Perfil</a>
            </li>
        </ul>


        <!--============================================================================================================================================
        CONTENIDO GENERAL
        =============================================================================================================================================-->
        <div class="tab-content" id="tabsContent-asignar-modulos-perfil">

            <!--============================================================================================================================================
        CONTENIDO PARA ADMINISTRAR PERFILES
        =============================================================================================================================================-->

            <div class="tab-pane fade mt-4 px-4" id="content-perfiles" role="tabpanel" aria-labelledby="content-perfiles-tab">
                <div class="row">

                    <!--LISTADO DE MODULOS -->
                    <div class="col-md-8">

                        <div class="card card-info card-outline shadow">

                            <div class="card-header">

                                <h3 class="card-title"><i class="fas fa-list"></i> Listado de Perfiles</h3>

                            </div>

                            <div class="card-body">

                                <table id="tblPerfiles" class="display nowrap table-striped shadow rounded" style="width:100%">

                                    <thead class="mi_card_info text-left">

                                        <th>id perfil</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>F. Creación </th>
                                        <th>F. Actualización </th>
                                        <th class="text-center">Acciones</th>
                                        <!--Se quitan las fechas ya que da un error y no son muy importantes-->
                                        <!--  <th>F. Creación</th>
                    <th>F. Actualización</th>  -->
                                    </thead>
                                    <tbody class="small text left">

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <!--FORMULARIO PARA EL REGISTRO Y EDIACION -->
                    <div class="col-md-4">
                        <div class="card card-info card-outline shadow">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-edit"></i> Registro de Perfiles </h3>
                            </div>

                            <div class="card-body">
                                <form class="needs-validation" novalidate>
                                    <div class="row">
                                        <!--------------------------------------------------------------------------------------------------------------->
                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <label class="col-form-label" for="iptPerfil">

                                                    <i class="fas fa-regular fa-users"></i>
                                                    <span class="small">Perfil</span><span class="text-danger">*</span>
                                                </label>

                                                <input type="text" class="form-control form-control-sm" id="iptPerfil" name="iptPerfil" placeholder="Ingrese el perfil" required>

                                                <div class="invalid-feedback">Debe ingresar el perfil</div>
                                            </div>
                                        </div>
                                        <!--------------------------------------------------------------------------------------------------------------->
                                        <div class="col-md-12">
                                            <div class="form-group mb-2"></div>

                                            <label class="col-form-label" for="selEstado">
                                                <i class="fas fa-solid fa-user-check"></i>
                                                <span class="small">Estado</span><span class="text-danger">*</span>
                                            </label>

                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selEstado" required>
                                                <option value="">---Selecione un estado---</option>
                                                <option value="0"> 0 - Inactivo</option>
                                                <option value="1"> 1 - Activo</option>
                                            </select>
                                            <div class="invalid-feedback">Seleccione un estado</div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group m-0 mt-3">
                                            <a style="cursor:pointer;" class="btn btn-primary btn-sm w-100" id="btnRegistrarPerfil">Registrar Perfil
                                            </a>

                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>



                </div>
                <!--/.row -->
            </div>


            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------->

            <!--============================================================================================================================================
            CONTENIDO PARA MODULOS 
            =============================================================================================================================================-->
            <div class="tab-pane fade  mt-4 px-4" id="content-modulos" role="tabpanel" aria-labelledby="content-modulos-tab">

                <div class="row">

                    <!--LISTADO DE MODULOS -->
                    <div class="col-md-8">

                        <div class="card card-info card-outline shadow">

                            <div class="card-header">

                                <h3 class="card-title"><i class="fas fa-list"></i> Listado de Módulos</h3>

                            </div>

                            <div class="card-body">

                                <table id="tblModulos" class="display nowrap table-striped shadow rounded" style="width:100%">

                                    <thead class="bg-info text-left">
                                        <th class="text-center">Acciones</th>
                                        <th>id</th>
                                        <th>orden</th>
                                        <th>Módulo</th>
                                        <th>Módulo Padre</th>
                                        <th>Vista</th>
                                        <th>Icono</th>
                                        <!--Se quitan las fechas ya que da un error y no son muy importantes-->
                                        <!--  <th>F. Creación</th>
                                        <th>F. Actualización</th>  -->
                                    </thead>
                                    <tbody class="small text left">

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                    <!--/. col-md-6 -->

                    <!--FORMULARIO PARA REGISTRO Y EDICION -->
                    <!-- <div class="col-md-3">

                        <div class="card card-info card-outline shadow">

                            <div class="card-header">

                                <h3 class="card-title"><i class="fas fa-edit"></i> Registro de Módulos</h3>

                            </div>

                            <div class="card-body">

                                <form method="post" class="needs-validation-registro-modulo" novalidate id="frm_registro_modulo">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group mb-2">

                                                <label class="col-form-label" for="iptModulo">

                                                    <i class="fas fa-laptop fs-6"></i>

                                                    <span class="small">Módulo</span><span class="text-danger">*</span>

                                                </label>

                                                <input type="text" class="form-control form-control-sm" id="iptModulo" name="iptModulo" placeholder="Ingrese el módulo" required>

                                                <div class="invalid-feedback">Debe ingresar el módulo</div>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="form-group mb-2">

                                                <label class="col-form-label" for="iptVistaModulo">

                                                    <i class="fas fa-code fs-6"></i>

                                                    <span class="small">Vista PHP</span>

                                                </label>

                                                <input type="text" class="form-control form-control-sm" id="iptVistaModulo" name="iptVistaModulo" placeholder="Ingrese la vista del módulo">

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="form-group mb-2">

                                                <label class="col-form-label" for="iptIconoModulo">

                                                    <i class="fas fa-images fs-6"></i>

                                                    <span class="small">Icono</span><span class="text-danger">*</span>

                                                </label>

                                                <input type="text" class="form-control form-control-sm" id="iptIconoModulo" name="iptIconoModulo" value="far fa-circle" placeholder="Ingrese el ícono del módulo: far fa-circle" required>

                                                <div class="invalid-feedback">Debe ingresar el ícono del módulo</div>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="form-group m-0 mt-2">

                                                <button type="button" class="btn btn-success w-100" id="btnRegistrarModulo">Guardar Módulo</button>

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>   -->
                    <!--/. col-md-3 -->



                    <!--ARBOL DE MODULOS PARA REORGANIZAR -->
                    <div class="col-md-4">

                        <div class="card card-info card-outline shadow">

                            <div class="card-header">

                                <h3 class="card-title"><i class="fas fa-edit"></i> Organizar Módulos</h3>

                            </div>

                            <div class="card-body">

                                <div class="">

                                    <div>Modulos del Sistema</div>

                                    <div class="" id="arbolModulos"></div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="text-center">

                                            <button id="btnReordenarModulos" class="btn btn-success mt-3 " style="width: 45%;">Organizar Módulos</button>

                                            <button id="btnReiniciar" class="btn btn-warning mt-3 " style="width: 45%;">Estado Inicial</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!--/. col-md-3 -->

                </div>
                <!--/.row -->

            </div><!-- /#content-modulos -->

            <!--============================================================================================================================================
            CONTENIDO PARA ASIGNACION DE PERFILES
            =============================================================================================================================================-->

            <div class="tab-pane fade active show mt-4 px-4" id="content-modulo-perfil" role="tabpanel" aria-labelledby="content-modulo-perfil-tab">
                <h4>Administrar Modulos y Perfiles</h4>
                <div class="row">
                    <div class="col-md-8">

                        <div class="card card-info card-outline shadow">
                            <div class="card-header">
                                <h3 class="card-title"> <i class="fas fa-list"></i>Listado de Perfiles</h3>
                            </div>

                            <div class="card-body">
                                <table id="tbl_perfiles_asignar" class="display nowrap table-striped w-100 shadow rounded">

                                    <thead class="mi_card_info text-left">
                                        <th>id Perfil</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>F. Creación</th>
                                        <th>F. Actualización</th>
                                        <th class="text-center">Opciones</th>
                                    </thead>
                                    <tbody class="small text left">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------------------------------------------------------------------->
                    <div class="col-md-4">

                        <div class="card card-info card-outline shadow" style="display:block" id="card-modulos">
                            <div class="card-header">
                                <h3 class="card-title"> <i class="fas fa-laptop"></i> Módulos del Sistema</h3>
                            </div>
                            <div class="card-body" id="card-body-modulos">
                                <div class="row m-2">
                                    <div class="col-md-6">
                                        <button class="btn btn-success btn-small m-0 p-0 w-100" id="marcar_modulos">Seleccionar todo</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-small m-0 p-0 w-100" id="desmarcar_modulos">Desmarcar todo</button>
                                    </div>
                                </div>

                                <!--SE CARGAN TODOS LOS MODULOS DEL SISTEMA -->
                                <div id="modulos" class="demo"></div>

                                <div class="row m-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Seleccione el modulo de inicio</label>
                                            <select class="custom-select" id="select_modulos">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-2">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-small w-50 text-center" id="asignar_modulos">Asignar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </div>
</div>
<!-- /.content -->

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });


    /* =============================================================
    VARIABLES GLOBALES
    ============================================================= */
    var tbl_perfiles_asignar, tbl_modulos, modulos_usuario, modulos_sistema, tbl_perfiles;

    $(document).ready(function() {

        //variables para registrar o editar el perfil
        var idPerfil = 0;
        var perfil = "";
        var estado = "";



        /* =============================================================
        FUNCIONES PARA LAS CARGAS INICIALES DE DATATABLES, ARBOL DE MODULOS Y REAJUSTE DE CABECERAS DE DATATABLES
        ============================================================= */
        cargarDataTables();
        //VD 30 MIN 24.30
        ajustarHeadersDataTables($('#tblModulos'));
        ajustarHeadersDataTables($('#tblPerfiles'));
        ajustarHeadersDataTables($('#tbl_perfiles_asignar'));
        iniciarArbolModulos();


        /* =============================================================
        VARIABLES PARA REGISTRAR EL PERFIL Y LOS MODULOS SELECCIOMADOS
        ============================================================= */
        var idPerfil = 0;
        var selectedElmsIds = [];


        /*===================================================================
        =====================================================================
                                             EVENTOS
        =====================================================================
        ====================================================================*/


        /* =============================================================
        EVENTO PARA SELECCIONAR UN PERFIL DEL DATATABLE Y MOSTRAR LOS MODULOS ASIGNADOS EN EL ARBOL DE MODULOS
        ============================================================= */
        //VD 27 MIN 48.09
        $('#tbl_perfiles_asignar tbody').on('click', '.btnSeleccionarPerfil', function() {

            var data = tbl_perfiles_asignar.row($(this).parents('tr')).data();

            if ($(this).parents('tr').hasClass('selected')) {
                $(this).parents('tr').removeClass('selected');
                //desmarcamos todos los checkbox del arbol
                //VD 28 MIN 4
                $('#modulos').jstree("deselect_all", false);
                //Dejamos vacio el select de la opcion de pagina principal
                $('#select_modulos option').remove();

                idPerfil = 0;
                //desmarcar el check y los datos

                //   $("#card-modulos").css("display", "none");
            } else {

                tbl_perfiles_asignar.$('tr.selected').removeClass('selected');

                $(this).parents('tr').addClass('selected');

                //VD 28 MIN 6:00
                //obtenemos el id del perfil
                idPerfil = data[0];

                // $("#card-modulos").css("display", "block"); //MOSTRAMOS EL ALRBOL DE MODULOS DEL SISTEMA

                // alert(idPerfil);

                //VD 28 MIN 7.08
                $.ajax({
                    asnc: false,
                    url: "ajax/modulo.ajax.php",
                    method: 'POST',
                    data: {
                        //mandamos la accion 2 y...
                        accion: 2,
                        //mandamos el id del perfil 
                        id_perfil: idPerfil
                    },
                    dataType: 'json',
                    success: function(respuesta) {
                        console.log(respuesta, 'seleccionarModulosPerfil');

                        //VD 28 MIN 20:35
                        modulos_usuario = respuesta;

                        //VD 28 MIN 28.24
                        seleccionarModulosPerfil(idPerfil);

                    }

                });
            }

        })

        /*========================================================================================================
        EVENTO EDITAR PERFIL seleccione la fila y seguidamente al dar clic quite el selecionado
        ==========================================================================================================*/
        $('#tblPerfiles tbody').on('click', '.btnEditarPerfil', function() {

            var data = tbl_Perfiles.row($(this).parents('tr')).data();

            if ($(this).parents('tr').hasClass('selected')) {

                $(this).parents('tr').removeClass('selected');

                idPerfil = 0;
                //al momento de selecionar para editar el modulo por 2da vez me borre los inputs de editar modulo
                $("#iptPerfil").val("");
                $("#selEstado").val("");

            } else {

                tbl_Perfiles.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');

                idPerfil = data[0];
                $("#iptPerfil").val(data[1]);
                $("#selEstado").val(data[2]);


            }
        })

        /*====================================================================
        EVENTO REGISTRAR NUEVO PERFIL
        ====================================================================== */
        document.getElementById("btnRegistrarPerfil").addEventListener("click", function() {

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                //si los datos son validados correctamente
                if (form.checkValidity() === true) {

                    //capturamos los valores para llevar a la base de datos
                    perfil = $("#iptPerfil").val();
                    estado = $("#selEstado").val();

                    var datos = new FormData();

                    datos.append("idPerfil", idPerfil);
                    datos.append("perfil", perfil);
                    datos.append("estado", estado);

                    Swal.fire({
                        title: 'ESTÁ SEGURO DE REGISTRAR EL PERFIL?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar!',
                    }).then((result) => {

                        if (result.isConfirmed) {

                            console.log(idPerfil, perfil, estado)

                            $.ajax({
                                url: "ajax/perfil.ajax.php",
                                type: "POST",
                                //aqui es donde enviamos los datos capturados anteriormente
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    if (respuesta == "ok") {

                                        mensajeToast('success', 'REGISTRADO CORRECTAMENTE');

                                        idPerfil = 0;
                                        perfil = "";
                                        estado = "";

                                        $("#iptPerfil").val("");
                                        $("#selEstado").val("");

                                        tbl_Perfiles.ajax.reload();
                                        tbl_perfiles_asignar.ajax.reload();
                                        $(".needs-validation").removeClass("was-validated");
                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'NO SE PUDO REGISTRAR EL PERFIL ' +
                                                'comunicate con tu administrador',
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    }
                                }
                            });
                        }
                    })
                }
                //me solicita que tengo que ingresar los campos 
                form.classList.add('was-validated');

            })

        });

        /*===========================================================================================
        EVENTO ELIMINAR PERFIL
        ============================================================================================*/
        $('#tblPerfiles tbody').on('click', '.btnEliminarPerfil', function() {

            accion = 2;
            var data = tbl_Perfiles.row($(this).parents('tr')).data();


            //     console.log(data);
            var idPerfil = data["id_perfil"]
            //   alert(idPerfil);

            Swal.fire({
                title: 'ESTÁ SEGURO DE ELIMINAR AL PERFIL: ' + data[1] + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                //SI ID PERFIL = 1 = ADMNISTRADOR, NO PROCEDE A LA ELIMINACION
                if (result.isConfirmed) {
                    if (idPerfil == 1) {
                        mensajeToast('error', 'NO SE PUEDE ELIMINAR AL ADMINISTRADOR');

                    } else {
                        var datos = new FormData();

                        datos.append("accion", accion);
                        datos.append("id_perfil", idPerfil);

                        $.ajax({
                            url: "ajax/perfil.ajax.php",
                            method: "POST",
                            data: datos,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {
                                if (respuesta == "ok") {
                                    mensajeToast('success', 'SE ELIMINÓ EL PERFIL CORRECTAMENTE');
                                    tbl_Perfiles.ajax.reload();
                                    tbl_perfiles_asignar.ajax.reload();
                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'NO SE PUDO ELIMINAR EL PERFIL ' +
                                            'comunicate con tu administrador',
                                        showConfirmButton: false,
                                        timer: 3500
                                    });
                                }
                            }
                        });

                    }



                }
            })
        })


        /* =============================================================
        EVENTO QUE SE DISPARA CADA VEZ QUE HAY UN CAMBIO EN EL ARBOL DE MODULOS
        EVENTO AL MOMENTO DE MARCAR O DESMARCAR EL CHECKBOX DE JSTREE
        ============================================================= */
        //VD 28 MIN 27.15
        $("#modulos").on("changed.jstree", function(evt, data) {
            //alert("pruebas de check")
            //primerdo desmarcamos todos los checkbox
            $("#select_modulos option").remove();
            //creamos un ARRAy
            //selectedElmsIds=[]
            //seleccione todos los elementos que estan seleccionados
            var selectedElms = $('#modulos').jstree("get_selected", true);
            //console.log(selectedElms, 'mostrar todos los elementos que ESTOY seleccionando en el checkbox');

            $.each(selectedElms, function() {
                for (let i = 0; i < modulos_sistema.length; i++) {
                    //
                    if (modulos_sistema[i]["id"] == this.id && modulos_sistema[i]["vista"]) {
                        $('#select_modulos').append($('<option>', {
                            value: this.id,
                            text: this.text
                        }));
                    }
                }
            })

            //VD 28 MIN 40.40
            //OPCION CUANDO SE DESELECCIONE LOS CHECKBOX 1 POR 1 Y MUESTRE EL MENSAJE NO HYA MODULOS EN SELECT
            if ($("#select_modulos").has('option').length <= 0) {
                $('#select_modulos').append($('<option>', {
                    value: 0,
                    text: "No hay modulos seleccionados"
                }));
            }
        })


        /*====================================================================
        EVENTO PARA MARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
        ====================================================================== */
        //VD 28 MIN 38.14
        $("#marcar_modulos").on('click', function() {
            $('#modulos').jstree('select_all');
        })

        /*====================================================================
        EVENTO PARA DESMARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
        ====================================================================== */
        //VD 28 MIN 38.14
        $("#desmarcar_modulos").on('click', function() {
            $('#modulos').jstree('deselect_all', false);
            $("#select_modulos option").remove();

            $('#select_modulos').append($('<option>', {
                value: 0,
                text: "No hay modulos seleccionados"
            }));
        })


        /*====================================================================
        EVENTO REGISTRO EN BASE DE DATOS DE LOS MODULOS ASOCIADOS O SELECCIONADOS AL PERFIL
        ====================================================================== */
        //VD 28 MIN 42.15
        $("#asignar_modulos").on('click', function() {
            //pruebas para validar que si estan llegando los eventos
            //  alert("entro al evento")

            selectedElmsIds = []
            var selectedElms = $('#modulos').jstree("get_selected", true);

            $.each(selectedElms, function() {
                selectedElmsIds.push(this.id);
                //VD 28 MIN 48:55
                if (this.parent != "#") {
                    selectedElmsIds.push(this.parent);
                }
            });
            console.log(selectedElmsIds, 'id de los modulos Seleccionados duplicados')

            //quitamos valores duplicados
            let modulosSeleccionados = [...new Set(selectedElmsIds)];

            //obtenemos el valor del modulo de inicio
            let modulo_inicio = $("#select_modulos").val();
            console.log(modulosSeleccionados, "modulosSeleccionados no duplicados");
            //  console.log(modulo_inicio, ' <- numero del modulo inicio')

            //VD 28 MIN 52:36
            if (idPerfil != 0 && modulosSeleccionados.length > 0) {
                registrarPerfilModulos(modulosSeleccionados, idPerfil, modulo_inicio);
            } else {
                //SI NO HAY NINGUN MODULO SELECCIONADO
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Debe seleccionar el perfil y módulos a registrar',
                    showConfirmButton: false,
                    timer: 3000
                })
            }


        })

        /*======================================================================
        ====================================================================
           EVENTO  MANTENIMIENTO DE MODULOS
        ======================================================================
        ====================================================================== */
        //VD 30 MIN 27.00
        fnCargarArbolModulos();


        /*====================================================================
          EVENTO REORGANIZAR MODULOS DEL SISTEMA
           ====================================================================== */
        //VD 31 MIN 1:10
        $("#btnReordenarModulos").on('click', function() {

            fnOrganizarModulos();
        })

        /*====================================================================
          EVENTO REORGANIZAR MODULOS DEL SISTEMA
           ====================================================================== */
        //VD 31 MIN 1:10
        $("#btnReiniciar").on('click', function() {

            actualizarArbolModulos();
        })

        /*=============================================================
        EVENTO VISTA PREVIA DEL ICONO DE LA VISTA
        ==============================================================*/
        $("#iptIconoModulo").change(function() {

            $("#spn_icono_modulo").html($("#iptIconoModulo").val())

            if ($("#iptIconoModulo").val().length === 0) {
                $("#spn_icono_modulo").html("<i class='far fa-circle fs-6 text-white'></i>")
            }
        })

        /*===================================================================*/
        //EVENTO QUE GUARDA LOS DATOS DEL MODULO
        /*===================================================================*/
        /*  document.getElementById("btnRegistrarModulo").addEventListener("click", function() {
              fnRegistrarModulo();
          })*/




    }) // FIN DOCUMENT READY



    /*===================================================================
    =====================================================================
                                  FUNCTION
    =====================================================================
    ====================================================================*/


    /*===================================================================
    CARGAR DATATABLES (3 TABLES)
    ===================================================================*/
    function cargarDataTables() {

        //DATA TABLE PERFILES
        tbl_Perfiles = $('#tblPerfiles').DataTable({
            ajax: {
                async: false,
                url: 'ajax/perfil.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: "",
                data: {
                    accion: 1
                }
            },
            scrollX: true,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    targets: 2,
                    sortable: false,
                    createdCell: function(td, celldata, rowData, row, col) {
                        //si el valor de la celda 3 es = a 1 entonces significa que esta activo
                        if (parseInt(rowData[2]) == 1) {
                            $(td).html("Activo")
                        } else {
                            $(td).html("Inactivo")
                        }
                    }
                },
                {
                    //columna 5
                    targets: 5,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarPerfil text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Perfil'> " +
                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarPerfil text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Perfil'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";
                        if (parseInt(rowData[0]) == 1) {

                        }
                    }

                }
            ],
            "columns": [{
                "data": "id_perfil"
            }],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });


        //DATA TABLE ASIGNAR PERFILES
        tbl_perfiles_asignar = $('#tbl_perfiles_asignar').DataTable({
            ajax: {
                async: false,
                url: 'ajax/perfil.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: "",
                data: {
                    accion: 1
                }
            },
            scrollX: true,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    targets: 2,
                    sortable: false,
                    createdCell: function(td, celldata, rowData, row, col) {
                        //si el valor de la celda 3 es = a 1 entonces significa que esta activo
                        if (parseInt(rowData[2]) == 1) {
                            $(td).html("Activo")
                        } else {
                            $(td).html("Inactivo")
                        }
                    }
                },
                {
                    //columna 5
                    targets: 5,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnSeleccionarPerfil text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Seleccionar perfil'> " +
                            "<i class='fas fa-check fs-5'></i> " +
                            "</span> " +
                            "</center>";
                    }
                }
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });

        //DATA TABLE MODULOS
        //VD 30 MIN 15.25
        tbl_modulos = $('#tblModulos').DataTable({
            ajax: {
                async: false,
                url: 'ajax/modulo.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: "",
                data: {
                    'accion': 3
                }

            },
            columnDefs: [{
                //VD 30 MIN 22.50
                targets: 0,
                sortable: false,
                render: function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='fas fa-edit fs-6 btnSeleccionarModulo text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Seleccionar Módulo'>" +
                        "</span>" +
                        "<span class='fas fa-trash fs-6 btnEliminarModulo text-danger px-1 'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Módulo'>" +
                        "</span>" +
                        "</center>";
                }
            }],
            scrollX: true,
            order: [
                [2, 'asc']
            ],
            lengthMenu: [0, 5, 20, 50],
            //por defecto muestre 20 registro
            pageLength: 20,
            lenguaje: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }

        });
    }


    //FUNCION AJUSTAR LAS TABLAS POR DEFORMARCE O NO SE MIRAN BIEN
    //VD 30 MIN 25.10
    function ajustarHeadersDataTables(element) {

        var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
            entries.forEach(function(entry) {
                $(entry.target).DataTable().columns.adjust();
            });
        }) : null;

        // Function to add a datatable to the ResizeObserver entries array
        resizeHandler = function($table) {
            if (observer)
                observer.observe($table[0]);
        };

        // Initiate additional resize handling on datatable
        resizeHandler(element);
    }


    function iniciarArbolModulos() {
        $.ajax({
            async: false,
            url: "ajax/modulo.ajax.php",
            method: 'POST',
            data: {
                accion: 1
            },
            dataType: 'json',
            //OBTENEMOS LOS DATOS DE LA TABLA MODULOS CON "RESPUESTA"
            success: function(respuesta) {
                //VD 28 MIN 21:16
                modulos_sistema = respuesta;

                console.log(respuesta);


                //CARGAMOS LOS MODULOS DE MODO DINAMICO, PARA QUE SE MIREN VISUALMENTE EN LA PANTALLA
                $('#modulos').jstree({
                    'core': {
                        "check_callback": true,
                        //que es lo que queremos que se muestre
                        'data': respuesta
                    },
                    //estilo de color de fondo de los modulos al seleccionarlos
                    "checkbox": {
                        "keep_selected_style": true
                    },
                    "types": {
                        "default": {
                            "icon": "fas fa-laptop text-warning"
                        }
                    },
                    "plugins": ["wholerow", "checkbox", "types", "changed"]
                    //CON EL SIGUIENTE, ES SOLO DISEÑO (SE PUEDE ELIMINAR PARA FINES DE PRUEBA), SIRVE PARA QUE 
                    //SE MIRE QUE ESTE COLAPSADO LOS MODULOS
                }).bind("loaded.jstree", function(event, data) {

                    $(this).jstree("open_all");
                });


            }
        })
    }

    //VD 28 MIN 22.50
    function seleccionarModulosPerfil(pin_idPerfil) {
        //desmarcar los checks de los modulos
        $('#modulos').jstree('deselect_all');
        //  console.log("pin_idPerfil", pin_idPerfil);

        for (let i = 0; i < modulos_sistema.length; i++) {

            //  console.log("modulos_sistema[i]['id']", modulos_sistema[i]["id"]);

            if (parseInt(modulos_sistema[i]["id"]) == parseInt(modulos_usuario[i]["id"]) && parseInt(modulos_usuario[i]["sel"]) == 1) {
                // if (modulos_sistema[i]["id"] == modulos_usuario[i]["id"] && modulos_usuario[i]["sel"] == 1) {
                $("#modulos").jstree("select_node", modulos_sistema[i]["id"]);
            }
        }

        //OCULTAMOS LA OPCION DE MODULOS Y PERFILES PARA EL PERFIL DE ADMINISTRADOR
        //VD 29 MIN 4.10
        if (pin_idPerfil == 1) { //1 ES IGUAL A ADMINISTRADOR
            $("#modulos").jstree(true).hide_node(13); //NODO 13 ES DE MODULOS Y PERFILES
        } else {
            $('#modulos').jstree(true).show_all();
        }
    }

    //VD 29 MIN 7.00
    function registrarPerfilModulos(modulosSeleccionados, idPerfil, idModulo_inicio) {
        $.ajax({
            async: false,
            url: "ajax/perfil_modulo.ajax.php",
            method: 'POST',
            data: {
                accion: 1,
                id_modulosSeleccionados: modulosSeleccionados,
                id_Perfil: idPerfil,
                id_modulo_inicio: idModulo_inicio
            },
            //VD 29 MIN 22.00
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta > 0) {
                    mensajeToast('success', 'SE REGISTRÓ CORRECTAMENTE');

                    $("#select_modulos option").remove();
                    $('#modulos').jstree("deselect_all", false);
                    tbl_perfiles_asignar.ajax.reload();
                    //       $("#card-modulos").css("display", "none");
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ERROR AL REGISTRAR ' +
                            'comunicate con tu administrador',
                        showConfirmButton: false,
                        timer: 3500
                    });

                }

            }
        });
    }

    function actualizarArbolModulosPerfiles() {
        $.ajax({
            async: false,
            url: "ajax/modulo.ajax.php",
            method: 'POST',
            data: {
                accion: 1
            },
            dataType: 'json',
            success: function(respuesta) {
                modulos_sistema = respuesta;

                // console.log(modulos_sistema);

                $('#modulos').jstree(true).settings.core.data = respuesta;
                $('#modulos').jstree(true).refresh()
            }
        });
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------
    //FUNCIONES PARA EL MANTENIMIENTO DE MODULOS
    //----------------------------------------------------------------------------------------------------------------------------------------------

    //VD 30 MIN 27.45
    function fnCargarArbolModulos() {
        var dataSource;

        $.ajax({
            async: false,
            url: "ajax/modulo.ajax.php",
            method: 'POST',
            data: {
                //se reutiliza la accion
                accion: 1
            },
            dataType: 'json',
            success: function(respuesta) {
                dataSource = respuesta;
                console.log(dataSource, "pruebasCargarArobolModulos")
            }
        });


        //VD #) 
        /*
        $.jstree.defaults.core.check_callback:
            Determina lo que sucede cuando un usuario intenta modificar la estructura del árbol .
            Si se deja como false se impiden todas las operaciones como crear, renombrar, eliminar, mover o copiar.
            Puede configurar esto en true para permitir todas las interacciones o usar una función para tener un mejor control.
        */

        $('#arbolModulos').jstree({
            "core": {
                "check_callback": true,
                "data": dataSource
            },
            "types": {
                "default": {
                    "icon": "fas fa-laptop"
                },
                "file": {
                    "icon": "fas fa-laptop"
                }
            },
            "plugins": ["types", "dnd"]
        }).bind('ready.jstree', function(e, data) {
            $('#arbolModulos').jstree('open_all')
        })

    }

    //VD 31 MIN 2:00

    function actualizarArbolModulos() {
        $.ajax({
            async: false,
            url: "ajax/modulo.ajax.php",
            method: 'POST',
            data: {
                //se reutiliza la accion
                accion: 1
            },
            dataType: 'json',
            success: function(respuesta) {
                $('#arbolModulos').jstree(true).settings.core.data = respuesta;
                $('#arbolModulos').jstree(true).refresh();
            }
        });
    }

    //VD 31 MIN 4:00
    function fnOrganizarModulos() {
        var array_modulos = [];
        var reg_id, reg_padre_id, reg_orden;

        var v = $("#arbolModulos").jstree(true).get_json('#', {
            'flat': true
        });
        console.log(v, "organizarModulos")

        for (i = 0; i < v.length; i++) {

            var z = v[i];
            console.log(v, "variable z")

            //asignamos el id, el padre Id y el nombre del modulo
            reg_id = z["id"];
            reg_padre_id = z["parent"];
            reg_orden = i;

            array_modulos[i] = reg_id + ';' + reg_padre_id + ';' + reg_orden;

        }


        //  console.log(array_modulos, "array_modulos")

        //REGISTRAMOS LOS MODULOS CON EL NUEVO ORDENAMIENTO 
        //VD 31 MIN 10:55
        $.ajax({
            async: false,
            url: "ajax/modulo.ajax.php",
            method: 'POST',
            data: {
                accion: 4,
                modulos: array_modulos
            },
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta > 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se registró correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    tbl_modulos.ajax.reload();
                    //recargamos arbol de modulos 
                    actualizarArbolModulosPerfiles();
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error al registrar',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }



            }
        });

    }

    function fnRegistrarModulo() {

        var forms = document.getElementsByClassName('needs-validation-registro-modulo');

        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() === true) {

                console.log("Listo para registrar el producto");

                Swal.fire({
                    title: 'Está seguro de registrar el producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo registrarlo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {

                    if (result.isConfirmed) {

                        $("#iptIconoModulo").val($('#spn_icono_modulo i').attr('class'));

                        $.ajax({
                            async: false,
                            url: "ajax/modulo.ajax.php",
                            method: 'POST',
                            data: {
                                accion: 5,
                                datos: $('#frm_registro_modulo').serialize()
                            },
                            dataType: 'json',
                            success: function(respuesta) {

                                console.log("🚀 ~ file: modulos_perfiles.php ~ line 1240 ~ validation ~ respuesta", respuesta)

                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: respuesta,
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                tbl_modulos.ajax.reload();

                                //recargamos arbol de modulos - MANTENIMIENTO MODULOS
                                actualizarArbolModulos();

                                //recargamos arbol de modulos - MANTENIMIENTO MODULOS ASIGNADOS A PERFILES                                
                                actualizarArbolModulosPerfiles();

                                $("#iptModulo").val("");
                                $("#iptVistaModulo").val("");
                                $("#iptIconoModulo").val("");

                                $(".needs-validation-registro-modulo").removeClass("was-validated");
                            }

                        })

                    }
                });

            }

            form.classList.add('was-validated');
        })

    }
</script>