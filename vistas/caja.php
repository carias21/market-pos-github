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
                    <div class="card-header">
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
                            <div class="col-md-12 text-left">
                                <button class="btn btn-success btn-lg" id="btnIngresoEfectivo">
                                    <i class=" fas fa-plus"></i> ENTRADA
                                </button>

                                <button class="btn btn-danger btn-lg " id="btnSalidaEfectivo">
                                    <i class="fas fa-minus"></i> SALIDA
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

<div class="col-md-4 mb-3">
    <h4>Total Caja: Q. <span id="total_Caja">0.00</span></h4>
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
                        <thead class="bg-info text-left">
                            <th>id</th>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Descripcion</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Saldo Actual</th>
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
                <div class="modal-header bg-gray py-1">

                    <h5 class="modal-title">Salida de Efectivo</h5>

                    <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
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
                                    <input type="number" min="0" class="form-control form-control-sm" step="0.01" id="iptSalidaEfectivo" placeholder="Efectivo" required>
                                    <div class="invalid-feedback">Debe ingresar el efectivo</div>
                                </div>
                            </div>

                            <!-- Columna para registro de la descripción del producto -->
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <b-field expanded label class="" for="iptDescripcionSalida"><i class="fas fa-file-signature fs-6"></i> <span class="small">Descripción</span><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="iptDescripcionSalida" placeholder="Descripción" required>
                                        <!--notificacion si no se ingresa la categoria -->
                                        <div class="invalid-feedback">Debe ingresar la descripción</div>
                                </div>
                            </div>

                            <!-- creacion de botones para cancelar y guardar el producto -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarSalidaEfectivo">Aceptar</button>
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
                <div class="modal-header bg-gray py-1">

                    <h5 class="modal-title">Ingreso de Efectivo</h5>

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
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarIngresoEfectivo">Aceptar</button>
                            <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->

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
                            }else if(respuesta == 0){
                                 mensajeToast('warning', 'SOLO EL ADMIN PUEDE REALIZAR ESTA ACCION');

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
        //EVENTO QUE GUARDA LOS DATOS DEL INGRESO DE EFECTIVO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
        /*===================================================================*/
        document.getElementById("btnGuardarIngresoEfectivo").addEventListener("click", function() {

            accion = 3;

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {

                if (form.checkValidity() === true) {


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
                                LimpiarInputsVentanasModal();

                                $("#mdlIngresarEfectivo").modal('hide');

                                tbl_Caja.ajax.reload();
                                //    total_Caja = $("#total_Caja").html();


                                document.getElementById("btnIngresoEfectivo").addEventListener("click", function() {
                                    $(".needs-validation").removeClass("was-validated");
                                })

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'No se logro el ingreso'
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

        /*===================================================================*/
        //EVENTO QUE GUARDA LOS DATOS DEL SALIDA DE EFECTIVO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
        /*===================================================================*/
        document.getElementById("btnGuardarSalidaEfectivo").addEventListener("click", function() {
            accion = 4;
            total_Caja = $("#total_Caja").html();


            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {

                if (form.checkValidity() === true) {
                    //capturamos los valores para llevar a la base de datos
                    salida = $("#iptSalidaEfectivo").val();
                    descripcion = $("#iptDescripcionSalida").val();

                    var datos = new FormData();


                    datos.append("accion", accion);
                    datos.append("salida", salida);
                    datos.append("descripcion", descripcion);

                  /* HAY ERROR AL MOMENTO QUE TOTAL_CAJA TENGA 1,000 NO VALIDA LA ACCION 
                    if (total_Caja < salida) {
                        //console.log(salida);
                        console.log(total_Caja)
            
                        mensajeToast('warning', 'NO PUEDES RETIRAR MAS DINERO');
                          return;
                      } */

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
                           
                                LimpiarInputsVentanasModal();

                                tbl_Caja.ajax.reload();

                                $("#mdlSalidaEfectivo").modal('hide');


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


    })


    /*===================================================================
    =====================================================================
     FUNCIONES
    ===================================================================
    ===================================================================*/

    /* =======================================================
       SOLICITUD AJAX TOTAL_CAJA
       =======================================================*/
    $.ajax({
        url: "ajax/caja.ajax.php",
        method: 'POST',
        dataType: 'json',
        success: function(respuesta) {
            $("#total_Caja").html(respuesta[0]['total_Caja'].toLocaleString('en'))
        }


    });





    /*===================================================================
    CARGAR DATATABLES 
    ===================================================================*/
    function cargarDataTables() {

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
             buttons: [
                 'copy', 'excel', 'print',,
                 
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
                    visible: true
                },
                {
                    targets: 1,
                    'data': 'codigo_producto',
                    visible: false
                },
                {
                    targets: 6,
                    'data': 'saldo_actual',
                    visible: false
                },
                {
                    targets: 7,
                    'data': 'opciones',
                    render: function(td, cellData, rowData, row, col) {
                        if (parseFloat(rowData[1]) == 0) {
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