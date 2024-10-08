<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">CAJA</h4>
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
                    <div class="card-header mi_card_info">
                        <h3 class="card-title">FLUJO DE CAJA</h3>
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
                                <button class="btn btn-success btn-lg" id="btnIngresoEfectivo">
                                    <i class=" fas fa-plus"></i> ENTRADA
                                </button>

                                <button class="btn btn-danger btn-lg " id="btnSalidaEfectivo">
                                    <i class="fas fa-minus"></i> SALIDA
                                </button>

                                <button class="btn btn-warning btn-lg " id="btnCierreDeCaja">
                                    <i class="fas fa-cash-register"></i> CIERRE DE CAJA
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

<div class="card card-info">
    <div class="row">
        <div class="col-md-10 mb-3 text-center">
            <h3 style="font-weight: bold;">Total Caja: Q.<span id="total_Caja" style="font-weight: bold;">0.00</span></h3>
            <p></p>
            <h4 style="display: inline-block;">Efectivo: Q.<span id="efectivo" style="font-weight: bold;">0.00</span> / </h4>
            <h4 style="display: inline-block;">Tarjeta: Q.<span id="tarjeta" style="font-weight: bold;">0.00</span> / </h4>
            <h4 style="display: inline-block;">Transferencia: Q.<span id="transferencia" style="font-weight: bold;">0.00</span> / </h4>
            <h4 style="display: inline-block;">Otro: Q.<span id="otro" style="font-weight: bold;">0.00</span></h4>
        </div>
        <div class="col-md-2 mb-12 text-center">
            <div class="card">
                <div class="card-header mi_card_info">
                    <h6 class="modal-title text-white">VENTAS DEL DIA</h6>
                </div>

                <div class="card-body">
                    <h6 id="totalVentasHoy">Q.0.00</h6>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Main content -->
<div class="content pb-2">
    <div class="row p-0 m-0">
        <!-- Listado de categorias -->
        <div class="col-md-12">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-list-alt"></i> Listado flujo de caja</h3>
                </div>
                <div class="card-body">
                    <table id="tbl_Caja" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="mi_card_info text-left">
                            <th>id</th>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Saldo Actual</th>
                            <th>Usuario</th>
                            <th>Tipo Pago</th>
                            <th class="text-center">Opciones</th>

                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>

<!-- SE COLOCA SEPARACION DE DIV PORQUE EXISTE CONFLICTO AL ABRIR LA SEGUNDA VENTA MODAL
YA QUE NO SE MUESTRA -->

<!-- =============================================================
    VENTANA MODAL SALIDA DE EFECTIVO
    ============================================================= -->
<div>

    <div class="modal fade" id="mdlSalidaEfectivo" role="dialog">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <!-- contenido del modal -->
            <div class="modal-content ">

                <!-- cabecera del modal -->
                <div class="modal-header bg-danger py-1 text-center">
                    <h5 class="text-center fw-bold">Salida de Efectivo</h5>
                    <button type="button" class="btn btn-outline-light fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                        <i class="far fa-times-circle"></i>
                    </button>
                </div>

                <!-- *************************** CUERPO DE LA VENTANA ******************** -->
                <div class="modal-body">

                    <form class="needs-validation" novalidate method="POST">
                        <!-- Abrimos una fila -->
                        <div class="row">

                            <!-- Columna para registro SALIDA DE DINERO -->
                            <div class="col-12  col-lg-4">
                                <div class="form-group mb-2">
                                    <label class="" for="iptSalidaEfect"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Salida de efectivo
                                        </span><span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control form-control-sm" step="0.01" id="iptSalidaEfectivo" name="iptSalidaEfectivo" placeholder="Efectivo" required>

                                    <div class="invalid-feedback">Debe ingresar el efectivo</div>
                                </div>
                            </div>

                            <!-- Columna para registro de la descripción del producto -->
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <b-field expanded label class="" for="iptDescripcionSalida"><i class="fas fa-file-signature fs-6"></i> <span class="small">Descripción</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptDescripcionSalida" name="iptDescripcionSalida" placeholder="Descripción" required>
                                        <!--notificacion si no se ingresa la categoria -->
                                        <div class="invalid-feedback">Debe ingresar la descripción</div>
                                </div>
                            </div>

                            <!-- creacion de botones para cancelar y guardar el producto -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-block mt-3" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-block mt-3" id="btnGuardarSalidaEfectivo">Aceptar</button>
                                    </div>
                                </div>
                            </div>

                            <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->

                    </form>

                </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- =============================================================
    VENTANA MODAL INGRESO DE EFECTIVO
    ============================================================= -->
<div>
    <div class="modal fade" id="mdlIngresarEfectivo" role="dialog">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <!-- contenido del modal -->
            <div class="modal-content ">

                <!-- cabecera del modal -->
                <div class="modal-header bg-success py-1 text-center">
                    <h5 class="modal-title fw-bold">Ingreso de Efectivo</h5>
                    <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                        <i class="far fa-times-circle"></i>
                    </button>
                </div>



                <!-- *************************** CUERPO DE LA VENTA ******************** -->
                <div class="modal-body">

                    <form class="needs-validation" novalidate method="POST">
                        <!-- Abrimos una fila -->
                        <div class="row">

                            <!-- Columna para registro del Precio de Compra -->
                            <div class="col-12  col-lg-4">
                                <div class="form-group mb-2">
                                    <label class="" for="iptIngresoEfect"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Ingreso de efectivo
                                        </span><span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control form-control-sm" step="0.01" id="iptIngresoEfectivo" placeholder="Efectivo" required>
                                    <div class="invalid-feedback">Debe ingresar el efectivo</div>
                                </div>
                            </div>

                            <!-- Columna para registro de la descripción del producto -->
                            <div class="col-12">
                                <div class="form-group mb-2">



                                    <b-field expanded label class="" for="iptDescripcionIngreso"><i class="fas fa-file-signature fs-6"></i> <span class="small">Descripción</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptDescripcionIngreso" placeholder="Descripción" required>
                                        <!--notificacion si no se ingresa la categoria -->
                                        <div class="invalid-feedback">Debe ingresar la descripción</div>
                                </div>
                            </div>

                            <!-- creacion de botones para cancelar y guardar el producto -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger btn-block mt-3" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-block mt-3" id="btnGuardarIngresoEfectivo">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                    </form>

                </div>
                </form>

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
    var tbl_Caja;



    $(document).ready(function() {

        cargarDataTables();
        ajustarHeadersDataTables($('#tbl_Caja'));
        Ajax_Total_Caja();

        /*===================================================================
        =====================================================================
                                             EVENTOS
        =====================================================================
        ====================================================================*/

        //Función para ver el detalle
        $("#btnVerDetalle").on('click', function() {
            //Capturas página actual
            var pagina_actual = tbl_Caja.page();

            //Guardamos la página actual en el local storage
            localStorage.setItem("pagina_actual", pagina_actual);

            //capturamos la página guardada anteriormente
            var pagina = localStorage.getItem("pagina_actual");

            // Pregutnamos si existe el item
            if (pagina != undefined) {

                //Decimos a la table que cargue la página requerida
                tbl_Caja.page(pagina).draw('page');

                //Eliminamos el item para que no genere conflicto a la hora de dar click en otro botón detalle
                // localStorage.removeItem("pagina_actual");
            }

        });


        /*===================================================================*/
        //EVENTO ELIMINAR CAJA
        /*===================================================================*/
        $('#tbl_Caja tbody').on('click', '.btnEliminarCaja', function() {

            accion = 5;
            var data = tbl_Caja.row($(this).parents('tr')).data();

            var id_Caja = data["id_caja"];


            //alert(id_Caja);
            //return;
            //  alert(id_venta);

            Swal.fire({
                title: 'Está seguro de eliminar registro de caja ' + id_Caja + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {
                    var datos = new FormData();

                    datos.append("accion", accion);
                    datos.append("id_caja", id_Caja);

                    $.ajax({
                        url: "ajax/caja.ajax.php",
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta, error) {

                            if (respuesta == "ok") {
                                mensajeToast('success', 'SE ELIMINÓ EL REGISTRO CORRECTAMENTE');
                                tbl_Caja.ajax.reload();
                                Ajax_Total_Caja();
                            } else if (respuesta == "permiso_denegado") {
                                mensajeToast('info', 'SOLO EL ADMIN PUEDE REALIZAR ESTA ACCION');

                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR EL REGISTRO' +
                                        ' comunicate con tu administrador',
                                    showConfirmButton: false,
                                    timer: 3500
                                })

                            }
                        }
                    });



                }
            })
        });

        /*===================================================================*/
        //EVENTO ABRIR VENTANA MODAL INGRESO EFECTIVO
        /*===================================================================*/
        $('#btnIngresoEfectivo').on('click', function() {
            $('#mdlIngresarEfectivo').modal('show');
            LimpiarInputsVentanasModal();
            $(".needs-validation").removeClass("was-validated");
        });

        /*===================================================================*/
        //EVENTO ABRIR VENTANA MODAL SALIDA DE EFECTIVO
        /*===================================================================*/
        $('#btnSalidaEfectivo').on('click', function() {
            $('#mdlSalidaEfectivo').modal('show');
            LimpiarInputsVentanasModal();
            $(".needs-validation").removeClass("was-validated");
        });

        /*===================================================================*/
        //EVENTO CIERRE DE CAJA, ELIMINAR REGISTROS DE LA TABLA CAJA
        /*===================================================================*/
        $('#btnCierreDeCaja').on('click', function() {

            accion = 6;
            Swal.fire({
                title: 'ESTÁ SEGURO DE ELIMINAR EL REGISTRO DE CAJA?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    var datos = new FormData();
                    datos.append("accion", accion);

                    $.ajax({
                        url: "ajax/caja.ajax.php",
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {

                            if (respuesta == "caja_eliminada") {
                                mensajeToast('success', 'SE ELIMINÓ EL REGISTRO CORRECTAMENTE');
                                Ajax_Total_Caja();
                                tbl_Caja.ajax.reload();

                                $.ajax({
                                    url: "vistas/enviar_correo.php",
                                    type: "POST",
                                    data: {
                                        respuestaCierreCaja: respuesta
                                    },
                                    success: function(respuestaCierreCaja) {
                                        console.log("Correo enviado correctamente.");
                                    },
                                    error: function() {
                                        console.log("Error al enviar el correo.");
                                    }
                                });


                            } else if (respuesta == "permiso_denegado") {
                                mensajeToast('info', 'SOLO EL ADMIN PUEDE REALIZAR ESTA ACCIÓN');
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR EL REGISTRO' +
                                        ' comunicate con tu administrador',
                                    showConfirmButton: false,
                                    timer: 3500
                                })

                            }
                        }
                    });



                }
            })

        });

        /*===================================================================*/
        //EVENTO QUE GUARDA LOS DATOS DEL INGRESO DE EFECTIVO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
        /*===================================================================*/
        document.getElementById("btnGuardarIngresoEfectivo").addEventListener("click", function() {

            accion = 3;
            var btnGuardarIngresoEfectivo = document.getElementById("btnGuardarIngresoEfectivo");

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {

                if (form.checkValidity() === true) {

                    // Deshabilitar el botón para evitar múltiples envíos
                    btnGuardarIngresoEfectivo.disabled = true;

                    //capturamos los valores para llevar a la base de datos
                    entrada = $("#iptIngresoEfectivo").val();
                    descripcion = $("#iptDescripcionIngreso").val();

                    var datos = new FormData();


                    datos.append("accion", accion);
                    datos.append("entrada", entrada);
                    datos.append("descripcion", descripcion);

                    $.ajax({
                        url: "ajax/caja.ajax.php",
                        type: "POST",
                        //aqui es donde enviamos los datos capturados anteriormente
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {
                                mensajeToast('success', 'ENTRADA DE EFECTIVO CORRECTAMENTE');


                                // Deshabilitar el botón para evitar múltiples envíos
                                btnGuardarIngresoEfectivo.disabled = false;

                                LimpiarInputsVentanasModal();

                                $("#mdlIngresarEfectivo").modal('hide');

                                tbl_Caja.ajax.reload();
                                //llamar la funcion ajax
                                Ajax_Total_Caja();


                                document.getElementById("btnIngresoEfectivo").addEventListener("click", function() {
                                    $(".needs-validation").removeClass("was-validated");
                                })

                            } else {
                                mensajeToast('error', 'NO SE LOGRO EL INGRESO');
                            }

                        }
                    });


                } else {
                    console.log("No paso la validacion")
                }

                form.classList.add('was-validated');

            });
        });

        /*===================================================================*/
        //EVENTO QUE GUARDA LOS DATOS DEL SALIDA DE EFECTIVO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
        /*===================================================================*/
        document.getElementById("btnGuardarSalidaEfectivo").addEventListener("click", function() {


            accion = 4;
            var btnGuardarSalidaEfectivo = document.getElementById("btnGuardarSalidaEfectivo");

            efectivo = $("#efectivo").html();
            salida = $("#iptSalidaEfectivo").val();
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {

                if (form.checkValidity() === true) {

                    // Deshabilitar el botón para evitar múltiples envíos
                    btnGuardarSalidaEfectivo.disabled = true;

                    //capturamos los valores para llevar a la base de datos
                    salida = $("#iptSalidaEfectivo").val();
                    descripcion = $("#iptDescripcionSalida").val();

                    var datos = new FormData();


                    datos.append("accion", accion);
                    datos.append("salida", salida);
                    datos.append("descripcion", descripcion);

                    if (parseFloat(efectivo) < parseFloat(salida)) {
                        mensajeToast('warning', 'NO PUEDES RETIRAR MAS EFECTIVO');
                        // Habilitar el botón después de que se complete la acción
                        btnGuardarSalidaEfectivo.disabled = false;
                        return;
                    }

                    $.ajax({
                        url: "ajax/caja.ajax.php",
                        type: "POST",
                        //aqui es donde enviamos los datos capturados anteriormente
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {

                            if (respuesta == "ok") {

                                mensajeToast('success', 'SALIDA DE EFECTIVO CORRECTAMENTE');
                                // Habilitar el botón después de que se complete la acción
                                btnGuardarSalidaEfectivo.disabled = false;
                                LimpiarInputsVentanasModal();


                                $("#mdlSalidaEfectivo").modal('hide');
                                tbl_Caja.ajax.reload();
                                Ajax_Total_Caja();

                                document.getElementById("btnSalidaEfectivo").addEventListener("click", function() {
                                    $(".needs-validation").removeClass("was-validated");
                                })

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'No se retiro el efectivo'
                                });
                            }

                        }
                    });


                } else {
                    console.log("No paso la validacion")
                }

                form.classList.add('was-validated');

            });
        });


        /* =======================================================
            SOLICITUD AJAX VENTAS DE DIA
            =======================================================*/
        $.ajax({
            url: "ajax/dashboard.ajax.php",
            method: 'POST',
            dataType: 'json',
            success: function(respuesta) {
                $("#totalVentasHoy").html('Q.' + respuesta[0]['ventasHoy'].toFixed(2).toLocaleString('en'));
            }
        });



    })


    /*===================================================================
    =====================================================================
     FUNCIONES
    ===================================================================
    ===================================================================*/

    /* =======================================================
       SOLICITUD AJAX TOTAL_CAJA
       =======================================================*/
    function Ajax_Total_Caja() {
        $.ajax({
            url: "ajax/caja.ajax.php",
            method: 'POST',
            dataType: 'json',
            success: function(respuesta) {
                // Redondear y mostrar los valores
                $("#total_Caja").html(parseFloat(respuesta[0]['total_Caja']).toFixed(2));
                $("#efectivo").html(parseFloat(respuesta[0]['efectivo']).toFixed(2));
                $("#tarjeta").html(parseFloat(respuesta[0]['tarjeta']).toFixed(2));
                $("#transferencia").html(parseFloat(respuesta[0]['transferencia']).toFixed(2));
                $("#otro").html(parseFloat(respuesta[0]['otro']).toFixed(2));
            }
        });
    }



    /*===================================================================
    CARGAR DATATABLES 
    ===================================================================*/
    function cargarDataTables() {

        //VD 21 MIN 20:10 CREAMOS LA VARIABLE GROUPCOLUMN E INDICAMOS NO. DE QUE COLUMNA QUEREMOS AGRUPAR 2=fecha_venta
        var groupColumn = 2;

        //DATA TABLE CAJA
        tbl_Caja = $('#tbl_Caja').DataTable({

            ajax: {
                async: false,
                url: 'ajax/caja.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: "",
                data: {
                    accion: 2
                }
            },
            dom: 'Bfrtip', //se colocan los botones, copiar, Excel, CSV y print en el inventario
            buttons: [{

                    extend: 'copy',
                    titleAttr: 'copiar',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 8]
                    }
                },
                {

                    extend: 'excelHtml5',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 8]
                    }
                },
                {
                    extend: 'print',

                    titleAttr: 'Imprimir',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 8]
                    }
                },
            ],


            scrollX: true,
            order: [
                [2, 'desc']
            ],
            columnDefs: [{
                    targets: 0,
                    'data': 'id_caja',
                    orderable: false,
                    className: 'control',
                    visible: false
                },
                {
                    targets: 1,
                    'data': 'codigo_producto',
                    visible: false
                },
                {
                    targets: 2,
                    'data': 'fecha',
                    visible: false
                },
                {
                    targets: 3,
                    'data': 'descripcion',
                },
                {
                    targets: 4,
                    'data': 'cantidad',
                },
                {
                    targets: 5,
                    'data': 'entrada',
                },
                {
                    targets: 6,
                    'data': 'salida',
                },
                {
                    targets: 7,
                    'data': 'saldo_actual',
                    visible: false
                },
                {
                    targets: 8,
                    'data': 'usuario',

                },
                {
                    targets: 9,
                    'data': 'tipo_pago',

                },
                {
                    targets: 10,
                    'data': 'opciones',
                    render: function(td, cellData, rowData, row, col) {
                        if (parseFloat(rowData[1]) == 0 ) {
                            return "<center>" +
                                //opciones eliminar icono
                                "<span class='btnEliminarCaja text-danger px-1' style='cursor:pointer;'>" +
                                "<i class='fas fa-trash fs-5'></i>" +
                                "</span>" +
                                "</center>"
                        } else {
                            return "<center>" + "-";
                        }

                    }
                },


            ],
            drawCallback: function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(groupColumn, {
                    page: 'current'
                }).data().each(function(group, i) {
                    //console.log(group);
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group">' +
                            '<td colspan="8" class="fs-6 fw-bold fst-italic bg-success text-white">' +
                            group +
                            '</td>' +
                            '</tr>'
                        );
                        last = group;
                    }
                });
            },
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

    /*===================================================================
      FUNCION LIMPIAR INPUTS DE LA VENTA MODAL
      ===================================================================*/
    function LimpiarInputsVentanasModal() {

        $("#iptIngresoEfectivo").val("");

        $("#iptDescripcionIngreso").val("");

        $("#iptDescripcionSalida").val("");

        $("#iptSalidaEfectivo").val("");

    } /* FIN LimpiarInputs */
</script>



<!-- /.content -->