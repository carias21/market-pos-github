<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">GASTOS OPERATIVOS</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item">GASTOS</li>
                    <li class="breadcrumb-item active">GASTOS OPERATIVOS</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->




<!-- Main content -->
<div class="content pb-2">

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Criterios de Busqueda</h3>
                    <div class="card-tools"><button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Reporte desde:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                    <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="gastos_desde" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Reporte hasta:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                    <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="gastos_hasta" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 d-flex flex-row align-items-center justify-content-end">
                            <!-- href="" se le coloca # para que no dirija a ningun lugar -->
                            <div class="form-group m-0"><a href="#" class="btn btn-outline-info" style="width:120px;" id="btnFiltrar">Buscar</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4 mb-3">
        <h4>Gastos Operativos: Q. <span id="id_totalGastosOp">0.00</span></h4>
    </div>


    <div class="row p-0 m-0">
        <!-- Listado de categorias -->
        <div class="col-md-12">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-list-alt"></i> Listado Gastos Operativos</h3>
                </div>
                <div class="card-body">
                    <table id="tblGastosOp" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="bg-info text-left">
                            <th>ID</th>
                            <th>TIPO GASTO</th>
                            <th>DESCRIPCION</th>
                            <th>MONTO</th>
                            <th>FECHA</th>
                            <th class="text-center">OPCIONES</th>

                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="mdlAgregarNuevoGasto" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content ">

            <div class="modal-header bg-info py-3">
                <h4 class="modal-title text-white">REGISTRO GASTOS</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- *************************** CUERPO DE LA VENTA ******************** -->
            <div class="modal-body">

                <form class="needs-validation" novalidate method="POST">
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro de la categoría del producto -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selCategoriaModal"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Categoría</span><span class="text-danger">*</span>
                                </label>
                                <select style="border: 1px solid #66B3FF" class="form-select form-select-sm" aria-label=".form-select-sm example" id="selCategoriaModal" required>
                                </select>
                                <!--notificacion si no se ingresa la categoria -->
                                <div class="invalid-feedback">Seleccione la categoría</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptDescripcionModal"><i class="fas fa-file-signature fs-6"></i> <span class="small">Descripción</span><span class="text-danger">*</span></label>
                                <input type="text" style="border: 1px solid #66B3FF" class="form-control form-control-sm" id="iptDescripcionModal" placeholder="Descripción" required>
                                <!--notificacion si no se ingresa la categoria -->
                                <div class="invalid-feedback">Debe ingresar la descripción</div>
                            </div>
                        </div>

                        <!-- Columna para registro del Precio de Compra -->
                        <div class="col-6  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptMontoModal"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Monto</span><span class="text-danger">*</span></label>
                                <input type="number" style="border: 1px solid #66B3FF" min="0" class="form-control form-control-sm" step="0.01" id="iptMontoModal" placeholder="Precio de Compra" required>
                                <div class="invalid-feedback">Debe ingresar el monto</div>
                            </div>
                        </div>


                    </div>
                </form>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnGuardarGastoOp">Guardar</button>
            </div>

        </div>
    </div>


</div>

<script>
    var groupColumn = 1;
    $(document).ready(function() {



        listarCategoriasGastos();
        filtrarbusqueda();

        tblGastosOp = $("#tblGastosOp").DataTable({
            dom: 'Bfrtip', //se colocan los botones, copiar, Excel, CSV y print en el inventario
            buttons: [{
                    className: 'bg-info',
                    text: 'AGREGAR NUEVO GASTO',
                    action: function(e, dt, node, config) {
                        $("#mdlAgregarNuevoGasto").modal('show');
                        // $("#iptCodigoReg").prop("disabled", false);
                        accion = 2; //registrar producto
                    }
                },
                'excel', 'print', 'pageLength'
            ],
            //ajustable 
            scrollX: true,
            dom: 'Bfrtip',
            paging: true, // Habilita la paginación
            "scrollY": "500px", //altura de la tabla visible
            "deferRender": true, //habilita la opción de Lazy Loading
            "scrollCollapse": true,

            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: "ajax/gastos.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 2 //1: LISTAR 
                },
            },
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    className: 'id_gasto',
                },
                {
                    targets: 1,
                    'data': 'tipo_gasto',
                    visible: false
                },
                {
                    targets: 2,
                    'data': 'descripcion'
                },
                {
                    targets: 3,
                    'data': 'monto'
                },
                {
                    targets: 4,
                    'data': 'fecha'
                },

                {
                    //colocamos no visible las columnas del...
                    targets: 5,
                    'data': 'opciones',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        /*retorna un ocono de un lapiz en inventario en opciones, con el style cursor... indicamos que al seleccionar el 
                        icono aparezca en el puntero del mause una mano*/
                        return "<center>" +

                            "<span class='btnEliminarGastoOp text-danger px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +
                            "</center>"
                    }
                }

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
                            '<td colspan="12" class="fs-6 fw-bold fst-italic bg-secondary text-white">' +
                            group +
                            '</td>' +
                            '</tr>'
                        );
                        last = group;
                    }
                });
            },

            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON ELIMINAR GASTO OPERATIVO
        =========================================================================================*/
        $('#tblGastosOp tbody').on('click', '.btnEliminarGastoOp', function() {

            accion = 3; //seteamos la accion para editar

            var data = tblGastosOp.row($(this).parents('tr')).data();

            var id_gasto_op = data["id_gasto"];

            Swal.fire({
                title: 'ESTÁ SEGURO DE ELIMINAR EL REGISTRO ' + data[0] + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    var datos = new FormData();

                    datos.append("accion", accion);
                    datos.append("id_gasto", id_gasto_op); //codigo_producto               

                    $.ajax({
                        url: "ajax/gastos.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {

                            if (respuesta == "ok") {
                                mensajeToast('success', 'EL REGISTRO SE ELIMINO CORRECTAMENTE');
                                tblGastosOp.ajax.reload();

                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR EL PRODUCTO' +
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


        $(function() {
            $("#gastos_desde, #gastos_hasta").datepicker({
                dateFormat: "dd/mm/yy",
                language: "es",
                selectOtherMonths: true,
                // Opciones de configuración aquí
            });
        });


    }); //fin document REady


    function filtrarbusqueda() {


        $('#gastos_desde, #gastos_hasta').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        });


        //INDICAMOS QUE POR DEFECTO NOS MUESTRE LA FECHA INICIANDO EL MES HASTA EL DIA DE HOY EN LOS INPUTS
        $("#gastos_desde").val(moment().startOf('month').format('DD/MM/YYYY'));
        //CAPUTAMOS EL DIA DE HOY       
        $("#gastos_hasta").val(moment().format('DD/MM/YYYY'));


        $('#btnFiltrar').on('click', function() {

            tblGastosOp.destroy();

            if ($("#gastos_desde").val() == '') {
                gastos_desde = '21/10/2001';
            } else {
                gastos_desde = $("#gastos_desde").val()
            }

            if ($("#gastos_hasta").val() == '') {
                gastos_hasta = '21/10/2099';
            } else {
                gastos_hasta = $("#gastos_hasta").val()
            }

            gastos_desde = gastos_desde.substr(6, 4) + '-' + gastos_desde.substr(3, 2) + '-' + gastos_desde.substr(0, 2);

            gastos_hasta = gastos_hasta.substr(6, 4) + '-' + gastos_hasta.substr(3, 2) + '-' + gastos_hasta.substr(0, 2);

            tblGastosOp = $('#tblGastosOp').DataTable({
                //ajustable 
                scrollX: true,
                dom: 'Bfrtip',
                buttons: [{
                        className: 'bg-info',
                        text: 'AGREGAR NUEVO GASTO',
                        action: function(e, dt, node, config) {
                            $("#mdlAgregarNuevoGasto").modal('show');
                            // $("#iptCodigoReg").prop("disabled", false);
                            accion = 2; //registrar producto
                        }
                    },
                    'excel', 'print', 'pageLength'
                ],
                ajax: {
                    url: 'ajax/gastos.ajax.php',
                    type: 'POST',
                    dataType: 'json',
                    //VD 22 MIN 1.10
                    data: {
                        'accion': 6,
                        'gastosDesde': gastos_desde,
                        'gastosHasta': gastos_hasta,
                    },
                    "dataSrc": function(respuesta) {
                        //console.log(respuesta, "Total Venta !");
                        var TotalGasto = 0.00;
                        for (let i = 0; i < respuesta.length; i++) {
                            TotalGasto = parseFloat(respuesta[i][3].replace('Q.', '')) + parseFloat(TotalGasto);
                        }
                        $("#id_totalGastosOp").html(TotalGasto.toFixed(2).toString().replace(
                            /\d(?=(\d{3})+\.)/g, "$&,"))
                        return respuesta;
                    }
                },

                "order": [
                    [4, 'desc']
                ],

                columnDefs: [{
                    targets: 5,
                    render: function(data, type, full, meta) {
                        /*retorna un ocono de un lapiz en inventario en opciones, con el style cursor... indicamos que al seleccionar el 
                        icono aparezca en el puntero del mause una mano*/
                        return "<center>" +
                            //opciones eliminar icono
                            "<span class='btnEliminarGastoOp text-danger px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +
                            "</center>"
                    }
                },  
                {
                    targets: 1,
                    'data': 'tipo_gasto',
                    visible: false
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
                                '<td colspan="12" class="fs-6 fw-bold fst-italic bg-secondary text-white">' +
                                group +
                                '</td>' +
                                '</tr>'
                            );
                            last = group;
                        }
                    });
                },

                lengthMenu: [0, 15, 50, 100, 500, 1000],
                "pageLength": 15,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"

                }
            });

        });
    }



    document.getElementById("btnGuardarGastoOp").addEventListener("click", function() {

        accion = 5;

        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() === true) {
                //console.log("Listo para registrar el producto")
                Swal.fire({
                    title: '¿ESTÁ SEGURO DE REALIZAR EL REGISTRO?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo registrarlo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {

                    if (result.isConfirmed) {

                        var datos = new FormData();

                        datos.append("accion", accion);
                        datos.append("selCategoriaModal", $("#selCategoriaModal").val());
                        datos.append("iptDescripcionModal", $("#iptDescripcionModal").val());
                        datos.append("iptMontoModal", $("#iptMontoModal").val());


                        $.ajax({
                            url: "ajax/gastos.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {
                                if (respuesta == "ok") {

                                    mensajeToast('success', 'RIGISTRADO CORRECTAMENTE');

                                    LimpiarInputsVentanaModal();


                                    tblGastosOp.ajax.reload();

                                    $("#mdlAgregarNuevoGasto").modal('hide');
                                    $(".needs-validation").removeClass("was-validated");

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

                    }
                })
            } else {
                mensajeToast('warning', 'INGRESA TODOS LOS CAMPOS');
            }

            form.classList.add('was-validated');

        });
    });

    function LimpiarInputsVentanaModal() {

        $("#selCategoriaModal").val(0);
        $("#iptDescripcionModal").val("");
        $("#iptMontoModal").val("");
    }


    function listarCategoriasGastos() {

        $.ajax({
            url: "ajax/gastos.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

                var options = '<option selected value="">Seleccione una categoría</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                        1
                    ] + '</option>';
                }
                //  console.log("Pruebas de respuesta de Cateforias!!!:::",options);
                $("#selCategoriaModal").append(options);
            }
        });

    }
</script>