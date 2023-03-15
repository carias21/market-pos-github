<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">USUARIOS</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>

                    <li class="breadcrumb-item active">USUARIOS</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content pb-2">
    <div class="row p-0 m-0">
        <!-- Listado de categorias -->
        <div class="col-md-8">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-list-alt"></i> Listado de usuarios</h3>
                </div>
                <div class="card-body">
                    <table id="tbl_Usuarios" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="bg-info text-left">
                            <th>id</th>
                            <th>Nombre U.</th>
                            <th>Apellido U.</th>
                            <th>Usuario</th>
                            <th>Password</th>
                            <th>Perfil U.</th>
                            <th>Estado</th>
                            <th class="text-center">Opciones</th>

                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--FORMULARIO PARA EL REGISTRO Y EDICION -->
        <div class="col-md-4">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Registro de Usuarios </h3>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Nombre_Usuario">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Nombre Usuario</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="ipt_Nombre_Usuario" name="ipt_Nombre_Usuario" placeholder="Ingrese el Nombre del Usuario" required>

                                    <div class="invalid-feedback">Debe ingresar el nombre</div>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Apellido_Usuario">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Apellido Usuario</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="ipt_Apellido_Usuario" name="ipt_Apellido_Usuario" placeholder="Ingrese el apellido del Usuario" required>

                                    <div class="invalid-feedback">Debe ingresar el apellido</div>
                                </div>
                            </div>

                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Usuario">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Usuario</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="ipt_Usuario" name="ipt_Usuario" placeholder="Ingrese el usuario" required>

                                    <div class="invalid-feedback">Debe ingresar el usuario</div>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->

                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Contraseña">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Contraseña</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="password" class="form-control form-control-sm" id="ipt_Contraseña" name="ipt_Contraseña" placeholder="Ingrese una contraseña" required>

                                    <div class="invalid-feedback">Debe ingresar la contraseña</div>
                                </div>
                            </div>


                            <!--------------------------------------------------------------------------------------------------------------->

                            <div class="col-md-12">
                                <div class="form-group mb-2"></div>

                                <label class="col-form-label" for="sel_Perfil_Usuario">
                                    <i class="fas fa-file-alt fs-6"></i>
                                    <span class="small">Perfil</span><span class="text-danger">*</span>
                                </label>

                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="sel_Perfil_Usuario" required>
                                </select>

                                <div class="invalid-feedback">Seleccione un perfil</div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2"></div>

                                <label class="col-form-label" for="sel_Estado_Usuario">
                                    <i class="fas fa-file-alt fs-6"></i>
                                    <span class="small">Estado</span><span class="text-danger">*</span>
                                </label>

                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="sel_Estado_Usuario" required>
                                    <option value="">Selecione un estado</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <div class="invalid-feedback">Seleccione un estado</div>

                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->
                        </div>
                        <div class="col-md-12">
                            <div class="form-group m-0 mt-3">
                                <a style="cursor:pointer;" class="btn btn-primary btn-sm w-100" id="btnRegistrarUsuario">Registrar Usuario
                                </a>

                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


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
    var tbl_Usuarios;
    var id_Usuario = 0;


    $(document).ready(function() {

        cargarDataTables();
        ajustarHeadersDataTables($('#tbl_Usuarios'));
        cargarSelectPerfiles();





        /*===================================================================
        =====================================================================
                                             EVENTOS
        =====================================================================
        ====================================================================*/

        /*========================================================================================================
        EVENTO EDITAR PERFIL seleccione la fila y seguidamente al dar clic quite el selecionado
        ==========================================================================================================*/
        $('#tbl_Usuarios tbody').on('click', '.btnEditarUsuario', function() {


            var data = tbl_Usuarios.row($(this).parents('tr')).data();

            console.log(data);
            if ($(this).parents('tr').hasClass('selected')) {

                $(this).parents('tr').removeClass('selected');
                id_Usuario = 0;
                //al momento de selecionar para editarel usuario por 2da vez me borre los inputs de editar categoria
                $("#ipt_Nombre_Usuario").val("");
                $("#ipt_Apellido_Usuario").val("");
                $("#ipt_Usuario").val("");
                $("#ipt_Contraseña").val("");
                $("#sel_Perfil_Usuario").val("");
                $("#sel_Estado_Usuario").val("");




            } else {

                tbl_Usuarios.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');

                id_Usuario = data[0];

                $("#ipt_Nombre_Usuario").val(data[1]);
                $("#ipt_Apellido_Usuario").val(data[2]);
                $("#ipt_Usuario").val(data[3]);
                $("#ipt_Contraseña").val(data[4]);
                $("#sel_Perfil_Usuario").val('descripcion');
                $("#sel_Estado_Usuario").val(data[6]);


            }
        })



        /*===========================================================================================
         REGISTRAR USUARIO
         ============================================================================================*/
        document.getElementById("btnRegistrarUsuario").addEventListener("click", function() {

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                //si los datos son validados correctamente
                if (form.checkValidity() === true) {

                    //capturamos los valores para llevar a la base de datos
                    var nombre_Usuario = $("#ipt_Nombre_Usuario").val();
                    var apellido_Usuario = $("#ipt_Apellido_Usuario").val();
                    var usuario = $("#ipt_Usuario").val();
                    var contraseña = $("#ipt_Contraseña").val();
                    var perfil = $("#sel_Perfil_Usuario").val();
                    var estado_Usuario = $("#sel_Estado_Usuario").val();


                    var datos = new FormData();

                    datos.append("id_Usuario", id_Usuario);
                    datos.append("nombre_Usuario", nombre_Usuario);
                    datos.append("apellido_Usuario", apellido_Usuario);
                    datos.append("usuario", usuario);
                    datos.append("contraseña", contraseña);
                    datos.append("perfil", perfil);
                    datos.append("estado_Usuario", estado_Usuario);


                    Swal.fire({
                        title: '¿ESTÁ SEGURO DE REGISTRAR EL USUARIO?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar!',
                    }).then((result) => {

                        if (result.isConfirmed) {

                            //  console.log(id_Usuario, nombre_Usuario, apellido_Usuario, usuario, contraseña, perfil, estado_Usuario);

                            $.ajax({
                                url: "ajax/usuario.ajax.php",
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

                                        $("#ipt_Nombre_Usuario").val("");
                                        $("#ipt_Apellido_Usuario").val("");
                                        $("#ipt_Usuario").val("");
                                        $("#ipt_Contraseña").val("");
                                        $("#sel_Perfil_Usuario").val("");
                                        $("#sel_Estado_Usuario").val("");

                                        tbl_Usuarios.ajax.reload();
                                        $(".needs-validation").removeClass("was-validated");

                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'NO SE PUDO REGISTRAR EL USUARIO' +
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
        EVENTOS ELIMINAR CATEGORIA
        ============================================================================================*/
        $('#tbl_Usuarios tbody').on('click', '.btnEliminarUsuario', function() {

            accion = 3;
            var data = tbl_Usuarios.row($(this).parents('tr')).data();

            //     alert(data["id_categoria", idCategoria]);   
            //     console.log(data);
            var id_Usuario = data["id_usuario"]
            //     alert(id_categoria);

            Swal.fire({
                title: '¿ESTÁ SEGURO DE ELIMINAR EL USUARIO: ' + data[3] + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    if (id_Usuario == 1) {
                        mensajeToast('error', 'NO SE PUEDE ELIMINAR EL USUARIO (ADMIN)');

                    } else {
                        //  console.log(id_Usuario);
                        var datos = new FormData();

                        datos.append("accion", accion);
                        datos.append("id_usuario", id_Usuario);

                        $.ajax({
                            url: "ajax/usuario.ajax.php",
                            method: "POST",
                            data: datos,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {
                                if (respuesta == "ok") {
                                    mensajeToast('success', 'SE ELIMINÓ EL USUARIO CORRECTAMENTE');
                                  
                                    tbl_Usuarios.ajax.reload();
                                } else {
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR EL USUARIO' +
                                        ' comunicate con tu administrador',
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                                }
                            }
                        });
                    }
                }
            })
        });


    })


    /*===================================================================
    =====================================================================
     FUNCIONES
    ===================================================================
    ===================================================================*/

    /*===================================================================
    CARGAR DATATABLES 
    ===================================================================*/
    function cargarDataTables() {

        //DATA TABLE USUARIOS
        tbl_Usuarios = $('#tbl_Usuarios').DataTable({
            ajax: {
                async: false,
                url: 'ajax/usuario.ajax.php',
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
                    targets: 0,
                    'data': 'id_usuario',
                },
                {
                    targets: 1,
                    'data': 'nombre_usuario',
                },
                {
                    targets: 2,
                    'data': 'apellido_usuario',
                },
                {
                    targets: 3,
                    'data': 'usuario',
                },
                {
                    //colocamos no visible las columnas del....
                    targets: 4,
                    visible: false,
                    'data': 'clave',
                },
                {
                    targets: 5,
                    'data': 'descripcion',
                },
                {
                    targets: 6,
                    'data': 'estado',
                },
                {
                    //columna 7 OPCIONES
                    //columna 5
                    targets: 7,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarUsuario text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Usuario'> " +
                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarUsuario text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Usuario'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";
                        /*
                        if (parseInt(rowData[0]) == 1) {
                        }*/
                    },
                },

            ],



            "columns": [{
                "data": "id_usuario"
            }],
            language: {
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

    /*===================================================================*/
    //SOLICITUD AJAX PARA CARGAR SELECT PERFILES DEL USUARIO
    /*===================================================================*/
    //Solicitud Ajax para Cargar los datos de laperfiles en la ventana agregar nuevo usuario
    //VD 11 MIN 46:00
    function cargarSelectPerfiles() {
        $.ajax({
            url: "ajax/perfil.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

                var options = '<option selected value="">Seleccione un perfil</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                        1
                    ] + '</option>';
                }
                //  console.log("Pruebas de respuesta de perfiles::",options);
                $("#sel_Perfil_Usuario").append(options);
            }
        });


    }

    /*
        function decrypt($contraseña, $key)
        {
            
         $result = '';
         $string = base64_decode($string);
         for($i = 0; $i < strlen($string); $i++){
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)- ord($keychar));
            $result = $char;
         }   
         return $result;
        }
        */
</script>



<!-- /.content -->