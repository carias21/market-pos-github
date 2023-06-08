<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">CLIENTES</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>

                    <li class="breadcrumb-item active">CAJA</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="content">
    <div class="container-fluid">
        <!-- FILA PARA INPUT FILE -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">NUEVO CLIENTE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->

                    <div class="card-body">
                        <div class="row">
                            <!-- BORONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                            <div class="col-md-12 text-center">
                                <button class="btn btn-success btn-lg" id="btnAgregarNuevoCliente">
                                    <i class=" fas fa-plus"></i> AGREGAR NUEVO CLIENTE
                                </button>
                            </div>
                        </div>
                    </div> <!-- ./ end card-body -->

                    <!--   <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 text-right">
                                <input type="submit" value="DETALLES" class="btn btn-primary" id="btnVerDetalle" size="50">
                            </div>
                        </div>
                    </div> --> <!-- ./ end card-body -->
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</div>


<div class="col-md-12">
    <div class="card card-info card-outline shadow">
        <div class="card-header">
            <h3 class="card-title"><i class="far fa-list-alt"></i> Listado Clientes</h3>
        </div>
        <div class="card-body">
            <table id="lstClientes" class="display nowrap table-striped w-100 shadow">
                <thead class="bg-info text-left fs-6">
                    <tr>
                        <th>ID</th>
                        <th>NIT</th>
                        <th>NOMBRE</th>
                        <th>TELEFONO</th>
                        <th>CORREO ELECTRONICO</th>
                        <th>DIRECCION</th>
                        <th>NOTAS</th>
                        <th>F. CREACION</th>
                        <th>F. ACTUALIZACION</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody class="small text-left fs-6">
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="mdlAgregarCliente" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content ">

            <!-- cabecera del modal -->
            <div class="modal-header bg-info py-3">
                <h4 class="modal-title text-white">AGREGAR CLIENTE</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- *************************** CUERPO DE LA VENTA ******************** -->
            <div class="modal-body">

                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" id="form_clientes">
                    <!-- Abrimos una fila -->
                    <div class="row">


                        <!-- Columna para registro del codigo de barras -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptNitCliente"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">NIT</span>
                                </label>
                                <input type="text" pattern="[0-9-C/Fc/f]+" title="Ingrese solo números y guiones" class="form-control form-control-sm" id="iptNitCliente" name="iptNitCliente" placeholder="Nit del Cliente">
                                <div class="invalid-feedback">Debe ingresar NIT válido</div>
                            </div>
                        </div>



                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-12 col-lg-8">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombreCliente"><i class="fas fa-users fs-6"></i> <span class="small">NOMBRE CLIENTE</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreCliente" placeholder="Nombre Cliente" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>

                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptNumeroTel"><i class="fa-solid fa-phone fs-6"></i> <span class="small">NUMERO CELULAR</span></label>
                                <input type="number" class="form-control form-control-sm" id="iptNumeroTel" placeholder="Numero Celular">


                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-12 col-lg-8">
                            <div class="form-group mb-2">
                                <label class="" for="iptCorreoElectronico"><i class="fas fa-file-signature fs-6"></i> <span class="small">E-MAIL</span></label>
                                <input type="email" class="form-control form-control-sm" id="iptCorreoElectronico" placeholder="Correo Electrónico" pattern="^$|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                <div class="invalid-feedback">Debe ingresar correo válido</div>
                            </div>
                        </div>


                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptDireccionCliente"><i class="fas fa-file-signature fs-6"></i> <span class="small">DIRECCIÓN</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptDireccionCliente" placeholder="Direccion">


                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptNotas"><i class="fas fa-file-signature fs-6"></i> <span class="small">NOTAS</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNotas" placeholder="Notas">


                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarCliente">Guardar Cliente</button>
                        </div>

                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->


                    </div>
                </form>

            </div>

        </div>
    </div>


</div>
<!-- /. End Ventana Modal para ingreso de Productos -->




<script>
    var tablaClientes;
    var accion;

    $(document).ready(function() {

        tablaClientes = $('#lstClientes').DataTable({
            //cambios GDO
            scrollX: true,
            dom: 'Bfrtip',
            "scrollCollapse": true,
            "paging": false,
            buttons: [{
                    extend: 'excelHtml5',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                },
                {
                    extend: 'print',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info',

                },
            ],

            ajax: {
                url: 'ajax/clientes.ajax.php',
                dataSrc: "",

            },

            columnDefs: [{
                    targets: 0,
                    'data': 'id_cliente',
                    visible: false
                },
                {
                    targets: 1,
                    'data': 'nit_cliente'
                },
                {
                    targets: 2,
                    'data': 'nombre_cliente'
                },
                {
                    targets: 3,
                    'data': 'numero_tel'
                },
                {
                    targets: 4,
                    'data': 'correo_electronico'
                },
                {
                    targets: 5,
                    'data': 'direccion'
                },
                {
                    targets: 6,
                    'data': 'notas'
                },
                {
                    targets: 7,
                    'data': 'fecha_creacion'
                },
                {
                    targets: 8,
                    'data': 'fecha_actualizacion'
                },
                {
                    targets: 9,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarCliente text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Categoría'> " +
                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarCliente text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Categoría'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";
                    }

                },

            ],
            "order": [
                [7, 'DESC']
            ],

        });

        //FUNCION AGREGAR CLIENTE
        document.getElementById("btnGuardarCliente").addEventListener("click", agregarCliente);


    });

    $("#btnAgregarNuevoCliente").on('click', function() {
        $("#iptNitCliente").prop("disabled", false);
        LimpiarInputsVentanaModal();
        accion = 1;
        $("#mdlAgregarCliente").modal('show'); //MOSTRAR VENTANA MODAL

    });

    $('#lstClientes tbody').on('click', '.btnEliminarCliente', function() {

        accion = 4;
        var data = tablaClientes.row($(this).parents('tr')).data();

        var id_cliente = data["id_cliente"];
        var nit_cliente = data["nit_cliente"];

        //alert(id_cliente);

        Swal.fire({
            title: 'ESTÁ SEGURO DE ELIMINAR EL CLIENTE: ' + data[1] + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            if (result.isConfirmed) {

                if (nit_cliente == 0) {

                    mensajeToast('error', 'NO PUEDES ELIMINAR ESTE CLIENTE');
                    return;
                }
                var datos = new FormData();

                datos.append("accion", accion);
                datos.append("id_cliente", id_cliente);

                $.ajax({
                    url: "ajax/clientes.ajax.php",
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(respuesta) {
                        if (respuesta == "ok") {
                            mensajeToast('success', 'SE ELIMINÓ EL CLIENTE CORRECTAMENTE');
                            tablaClientes.ajax.reload();
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'NO SE PUDO ELIMINAR EL CLIENTE' + '\n' +
                                    ' comunicate con tu administrador',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    }
                });

            }
        })
    });


    /* ======================================================================================
       EVENTO AL DAR CLICK EN EL BOTON EDITAR CATEGORIA
       =========================================================================================*/
    $('#lstClientes tbody').on('click', '.btnEditarCliente', function() {

     $("#iptNitCliente").prop("disabled", true);

        accion = 5; //seteamos la accion para editar

        $("#mdlAgregarCliente").modal('show');

        var data = new FormData($(form_clientes)[0]);
        var data = tablaClientes.row($(this).parents('tr')).data();
        var datos = new FormData();

        /*se definen estas variables para enviar el parametro $name, para que en el llamado .ajax, 
         se reconozca y se pueda realizar la condicion if si no se agrega imagen, igual al momento de editar */

        $("#iptNitCliente").val(data[1]);
        $("#iptNombreCliente").val(data[2]);
        $("#iptNumeroTel").val(data[3]);
        $("#iptCorreoElectronico").val(data[4]);
        $("#iptDireccionCliente").val(data[5]);

        $("#iptNotas").val(data[6]);

    })


    function agregarCliente() {

     
        var nit_cliente = $("#iptNitCliente").val();
        nit_cliente.disabled = false;

        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function(form) {
            if (form.checkValidity() === true) {
                Swal.fire({
                    title: '¿ESTÁ SEGURO DE REGISTRAR AL CLIENTE?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo registrarlo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {

                        if (nit_cliente == 0) {

                            mensajeToast('error', 'NO PUEDES EDITAR ESTE CLIENTE');
                            return;
                        }

                        var datos = new FormData();

                        datos.append("accion", accion);
                        datos.append("nit_cliente", $("#iptNitCliente").val());
                        datos.append("nombre_cliente", $("#iptNombreCliente").val());
                        datos.append("telefono", $("#iptNumeroTel").val());
                        datos.append("correo_e", $("#iptCorreoElectronico").val());
                        datos.append("direccion", $("#iptDireccionCliente").val());
                        datos.append("notas", $("#iptNotas").val());

                        if (accion == 1) {
                            var titulo_msj = "SE REGISTRÓ CORRECTAMENTE EL CLIENTE"
                        }

                        if (accion == 5) {
                            var titulo_msj = "EL CLIENTE SE ACTUALIZÓ CORRECTAMENTE"
                        }

                        $.ajax({
                            url: "ajax/clientes.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {
                                if (respuesta > 0 || respuesta == "ok") {
                                    mensajeToast('success', titulo_msj);
                                    LimpiarInputsVentanaModal();
                                    tablaClientes.ajax.reload();
                                    $("#mdlAgregarCliente").modal('hide');
                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'ERROR',
                                        showConfirmButton: false,
                                        timer: 3500
                                    })
                                }
                            }
                        });

                        //console.log(datos);
                    }
                })
            } else {
                mensajeToast('warning', 'INGRESA TODOS LOS CAMPOS');
            }
            form.classList.add('was-validated');
        });
    }

    function LimpiarInputsVentanaModal() {
        $("#iptNitCliente").val("");
        $("#iptNombreCliente").val("");
        $("#iptCorreoElectronico").val("");
        $("#iptDireccionCliente").val("");
        $("#iptNumeroTel").val("");
        $("#iptNotas").val("");
    }
</script>