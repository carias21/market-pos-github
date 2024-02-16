<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">INVENTARIO-PRODUCTOS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                    <li class="breadcrumb-item active">INVENTARIO-PRODUCTOS</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container-fluid">

        <!-- row para criterios de busqueda -->
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-info">
                    <div class="card-header mi_card_info">
                        <h3 class="card-title">CRITERIOS DE BÚSQUEDA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-danger" id="btnLimpiarBusqueda">
                                <i class="fas fa-times"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body">

                        <div class="row">

                            <div class="d-none d-md-flex col-md-12 ">

                                <div style="width: 20%;" class="form-floating mx-1">
                                    <input type="text" id="iptCodigoBarras" class="form-control" data-index="2">
                                    <label for="iptCodigoBarras">Código de Barras</label>
                                </div>

                                <div style="width: 20%;" class="form-floating mx-1">
                                    <input type="text" id="iptCategoria" class="form-control" data-index="5">
                                    <label for="iptCategoria">Categoría</label>
                                </div>

                                <div style="width: 20%;" class="form-floating mx-1">
                                    <!--data-index, indica el numero de columna que esta el valor -->
                                    <input type="text" id="iptProducto" class="form-control" data-index="6">
                                    <label for="iptProducto">Producto</label>
                                </div>

                                <div style="width: 20%;" class="form-floating mx-1">
                                    <input type="text" id="iptPrecioVentaDesde" class="form-control">
                                    <label for="iptPrecioVentaDesde">P. Venta Desde</label>
                                </div>

                                <div style="width: 20%;" class="form-floating mx-1">
                                    <input type="text" id="iptPrecioVentaHasta" class="form-control">
                                    <label for="iptPrecioVentaHasta">P. Venta Hasta</label>
                                </div>
                            </div>

                            <div class="d-block d-sm-none">

                                <div style="width: 100%;" class="form-floating mx-1 my-1">
                                    <input type="text" id="iptCodigoBarras" class="form-control" data-index="2">
                                    <label for="iptCodigoBarras">Código de Barras</label>
                                </div>

                                <div style="width: 100%;" class="form-floating mx-1 my-1">
                                    <input type="text" id="iptCategoria" class="form-control" data-index="4">
                                    <label for="iptCategoria">Categoría</label>
                                </div>

                                <div style="width: 100%;" class="form-floating mx-1 my-1">
                                    <input type="text" id="iptProducto" class="form-control" data-index="5">
                                    <label for="iptProducto">Producto</label>
                                </div>

                                <div style="width: 100%;" class="form-floating mx-1 my-1">
                                    <input type="text" id="iptPrecioVentaDesde" class="form-control">
                                    <label for="iptPrecioVentaDesde">P. Venta Desde</label>
                                </div>

                                <div style="width: 100%;" class="form-floating mx-1 my-1">
                                    <input type="text" id="iptPrecioVentaHasta" class="form-control">
                                    <label for="iptPrecioVentaHasta">P. Venta Hasta</label>
                                </div>
                            </div>

                        </div>
                    </div> <!-- ./ end card-body -->
                </div>

            </div>

        </div>

        <!-- row para listado de productos/inventario -->
        <!-- TABLE DEL INVENTARIO PRODUCTO-->
        <div class="row">
            <div class="col-lg-12">
                <!--*******************    //TIPOS DE TABLAS *******************-->
                <!--  Tabla original:   <table id="tbl_productos" class="table table-striped w-100 shadow">-->
                <table id="tbl_productos" class="display nowrap  table-bordered  w-100 shadow rounded">
                    <thead class="mi_card_info">
                        <tr style="font-size: 15px;">
                            <th></th>
                            <th>id</th>
                            <th>Código</th>
                            <th>Img</th>
                            <th>Id Categoria</th>
                            <th>Categoría</th>
                            <th>Producto</th>
                            <th>P. Compra</th>
                            <th>P. Venta</th>
                            <th>Ganancia</th>
                            <th>Stock</th>
                            <th>Min. Stock</th>
                            <th>Ventas</th>
                            <th>Fecha Creación</th>
                            <th>Fecha Actualización</th>
                            <th>Id Proveedor</th>
                            <th>Proveedor</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-small">
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->

</div>
<!-- /.content -->

<!-- Ventana Modal para ingresar o modificar un Productos -->
<!-- *************************** CABECERA ******************** -->
<!-- Ingresar un producto, es la ventana para agregar el producto nuevo -->
<div class="modal fade" id="mdlGestionarProducto" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content ">

            <!-- cabecera del modal -->
            <div class="modal-header bg-dark py-3">
                <h4 class="modal-title text-white">AGREGAR PRODUCTO</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <form method="POST" enctype="multipart/form-data" id="form_cargar_imagen">
                        <input type="submit">
                        </form> -->

            <!-- *************************** CUERPO DE LA VENTA ******************** -->
            <div class="modal-body">

                <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" id="form_cargar_imagen">
                    <!-- Abrimos una fila -->
                    <div class="row">


                        <!-- Columna para registro del codigo de barras -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptCodigoReg "><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">CODIGO DEL PRODUCTO</span><span class="text-danger">*</span>
                                </label>

                                <input type="number" style="border: 1px solid #66B3FF" class="form-control form-control-sm" id="iptCodigoReg" name="iptCodigoReg" placeholder="Código de Barras" required>
                                <div class="invalid-feedback">Debe ingresar el codigo de barras</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la categoría del producto -->
                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selCategoriaReg"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Categoría</span><span class="text-danger">*</span>
                                </label>
                                <select style="border: 1px solid #66B3FF" class="form-select form-select-sm" aria-label=".form-select-sm example" id="selCategoriaReg" required>
                                </select>
                                <!--notificacion si no se ingresa la categoria -->
                                <div class="invalid-feedback">Seleccione la categoria</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptDescripcionReg"><i class="fas fa-file-signature fs-6"></i> <span class="small">Descripción</span><span class="text-danger">*</span></label>
                                <input type="text" style="border: 1px solid #66B3FF" class="form-control form-control-sm" id="iptDescripcionReg" placeholder="Descripción" required>
                                <!--notificacion si no se ingresa la categoria -->
                                <div class="invalid-feedback">Debe ingresar la descripción</div>
                            </div>
                        </div>

                        <div class="col-12  col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="selProveedor"><i class="fas fa-truck"></i>
                                    <span class="small">Proveedor</span><span class="text-danger">*</span>
                                </label>
                                <select style="border: 1px solid #66B3FF" class="form-select form-select-sm" aria-label=".form-select-sm example" id="selProveedor" required>
                                </select>
                                <!--notificacion si no se ingresa la categoria -->
                                <div class="invalid-feedback">Seleccione un proveedor</div>
                            </div>
                        </div>

                        <!-- Columna para registro del Precio de Compra -->
                        <div class="col-12  col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptPrecioCompraReg"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Precio
                                        Compra</span><span class="text-danger">*</span></label>
                                <input type="number" style="border: 1px solid #66B3FF" min="0" class="form-control form-control-sm" step="0.01" id="iptPrecioCompraReg" placeholder="Precio de Compra" required>
                                <div class="invalid-feedback">Debe ingresar el Precio de compra</div>
                            </div>
                        </div>

                        <!-- Columna para registro del Precio de Venta -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptPrecioVentaReg"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Precio
                                        Venta</span><span class="text-danger">*</span></label>
                                <input type="number" style="border: 1px solid #66B3FF" min="0" class="form-control form-control-sm" id="iptPrecioVentaReg" placeholder="Precio de Venta" step="0.01" required>
                                <div class="invalid-feedback">Debe ingresar el precio de venta</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la Utilidad -->
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-2">
                                <label class="" for="iptUtilidadReg"><i class="fas fa-dollar-sign fs-6"></i> <span class="small">Ganancia</span></label>
                                <input type="number" style="border: 1px solid #66B3FF" min="0" class="form-control form-control-sm" id="iptUtilidadReg" placeholder="Ganancia" disabled>
                            </div>
                        </div>

                        <!-- Columna para registro del Stock del producto -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptStockReg"><i class="fas fa-plus-circle fs-6"></i>
                                    <span class="small">Stock</span><span class="text-danger">*</span></label>
                                <input type="number" style="border: 1px solid #66B3FF" min="0" class="form-control form-control-sm" id="iptStockReg" placeholder="Stock" required>
                                <div class="invalid-feedback">Debe ingresar el stock</div>
                            </div>
                        </div>

                        <!-- Columna para registro del Minimo de Stock -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="" for="iptMinimoStockReg"><i class="fas fa-minus-circle fs-6"></i> <span class="small">Mínimo
                                        Stock</span><span class="text-danger">*</span></label>
                                <input type="number" style="border: 1px solid #66B3FF" min="0" class="form-control form-control-sm" id="iptMinimoStockReg" placeholder="Mínimo Stock" required>
                                <div class="invalid-feedback">Debe ingresar el minimo stock</div>
                            </div>
                        </div>

                        <form method="POST">
                            <!-- Colum agregar imagen -->
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                            <span id="icon-cerrar"></span>
                                            <input id="imagen" style="border: 1px solid #66B3FF" class="d-none" type="file" name="imagen" accept="image/*" onchange="preview(event)">
                                            <!--colocamos dos inputos ocultos, al momento de editar, saber que se esta seleccionando otra imagen o se quito para reemplazarla. -->
                                            <input type="hidden" id="foto_actual" name="foto_actual">
                                            <input type="hidden" id="foto_delete" name="foto_delete">
                                            <img class="img-thumbnail" id="img-preview">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- creacion de botones para cancelar y guardar el producto -->
                            <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                            <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarProducto">Guardar Producto</button>
                            <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->

                        </form>

                    </div>
                </form>

            </div>

        </div>
    </div>


</div>
<!-- /. End Ventana Modal para ingreso de Productos -->

<div class="modal fade" id="mdlGestionarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-gray py-2">
                <h6 class="modal-title" id="titulo_modal_stock">Agregar Stock</h6>
                <button type="button" class="btn-close text-white fs-6" data-bs-dismiss="modal" aria-label="Close" id="btnCerrarModalStock">
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-12 mb-3">
                        <label for="" class="form-label text-primary d-block">Codigo: <span id="stock_codigoProducto" class="text-secondary"></span></label>
                        <label for="" class="form-label text-primary d-block">Producto: <span id="stock_Producto" class="text-secondary"></span></label>
                        <label for="" class="form-label text-primary d-block">Stock: <span id="stock_Stock" class="text-secondary"></span></label>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label class="" for="iptStockSumar">
                                <i class="fas fa-plus-circle fs-6"></i> <span class="small" id="titulo_modal_label">Agregar al Stock</span>
                            </label>
                            <input type="number" min="0" class="form-control form-control-sm" id="iptStockSumar" placeholder="Ingrese cantidad a agregar al Stock">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="" class="form-label text-danger">Nuevo Stock: <span id="stock_NuevoStock" class="text-secondary"></span></label><br>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="btnCancelarRegistroStock">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnGuardarNuevoStock">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script>
    var accion;
    var table;
    var operacion_stock = 0;
    /*permite definir si sumamos o restamos el stock,
    como empiza en 0 no realiza nada, pero si se le damos a 1: sera sumar, y se le damos a 2: sera restar */

    /*===================================================================*/
    //INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
    /*===================================================================*/
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {


        ajustarHeadersDataTables($('#tbl_productos'));

        /*===================================================================*/
        //SOLICITUD AJAX PARA CARGAR SELECT DE CATEGORIAS
        /*===================================================================*/
        //Solicitud Ajax para Cargar los datos de la categorias en la ventana de agregar nuevo producto
        //VD 11 MIN 46:00
        $.ajax({
            url: "ajax/categorias.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

                var options = '<option selected value="">Seleccione una categoria</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                        1
                    ] + '</option>';
                }
                //  console.log("Pruebas de respuesta de Cateforias!!!:::",options);
                $("#selCategoriaReg").append(options);
            }
        });


        $.ajax({
            url: "ajax/proveedores.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

                var options = '<option selected value="">Seleccione un proveedor</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                        1
                    ] + '</option>';
                }
                //  console.log("Pruebas de respuesta de Cateforias!!!:::",options);
                $("#selProveedor").append(options);
            }
        });


        /*===================================================================*/
        // CARGA DEL LISTADO CON EL PLUGIN DATATABLE JS
        /*===================================================================*/
        table = $("#tbl_productos").DataTable({
            dom: 'Bfrtip', //se colocan los botones, copiar, Excel, CSV y print en el inventario
            buttons: [{
                    text: 'Agregar Producto',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        //codigo que funciona para mostrar la ventana modal, o venta para agregar un nuevo producto
                        $("#mdlGestionarProducto").modal('show');
                        LimpiarInputsVentanaModal();
                        $("#iptCodigoReg").prop("disabled", false);
                        deleteImg();
                        accion = 2;
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
            fixedColumns: {
                leftColumns: 0, // No se fijan columnas a la izquierda
                rightColumns: 1, // Fija la columna con la clase "columna-fija" a la derecha
            },


            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: "ajax/productos.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 1 //1: LISTAR PRODUCTOS
                },
            },
            // tabla ajustable
            /* responsive: {
                 details: {
                     type: 'column'
                 }
             }, */
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    className: 'control',
                    visible: false
                },
                {
                    targets: 1,
                    'data': 'id',
                    visible: false
                },
                {
                    targets: 2,
                    'data': 'codigo_producto'
                },
                {
                    targets: 3,
                    data: 'foto',
                    render: function(foto) {
                        if (!foto) {
                            return 'N/A';
                        } else {
                            var img = foto;
                            return '<img class="imagen-agrandable" src="vistas/assets/imagenes/' + img + '" height="50px" width="50px" />';
                        }
                    }
                },

                {
                    targets: 4,
                    'data': 'id_categoria',
                    visible: false

                },
                {
                    targets: 5,
                    'data': 'nombre_categoria',
                },
                {
                    targets: 6,
                    'data': 'descripcion_producto'
                },
                {
                    targets: 7,
                    data: 'precio_compra',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Redondear el valor a dos decimales
                            var roundedValue = parseFloat(data).toFixed(2);

                            // Agregar "Q." al comienzo del valor redondeado
                            return 'Q. ' + roundedValue;
                        } else {
                            return data;
                        }
                    }
                },

                {
                    targets: 8,
                    'data': 'precio_venta',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Redondear el valor a dos decimales
                            var roundedValue = parseFloat(data).toFixed(2);

                            // Agregar "Q." al comienzo del valor redondeado
                            return 'Q. ' + roundedValue;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    targets: 9,
                    'data': 'utilidad',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Redondear el valor a dos decimales
                            var roundedValue = parseFloat(data).toFixed(2);

                            // Agregar "Q." al comienzo del valor redondeado
                            return 'Q. ' + roundedValue;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    /*indicamos que en la columna 9 que seria Stock, que al momento de que 
          el minStock sea  igual o menor a la columna stock nos pinte de color rojo la fila */
                    targets: 10,
                    'data': 'stock',
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (parseFloat(rowData[9]) <= parseFloat(rowData[10])) {
                            $(td).parent().css('background', '#c38500');
                        }
                    }
                },

                {
                    targets: 11,
                    'data': 'minimo_stock'
                },
                {

                    targets: 12,
                    'data': 'ventas',
                    visible: false
                },
                {
                    //colocamos no visible las columnas del...
                    targets: 13,
                    'data': 'fecha_creacion_producto',
                    visible: false
                },
                {
                    //colocamos no visible las columnas del...
                    targets: 14,
                    'data': 'fecha_actualizacion_producto',
                    visible: false
                },
                {
                    //colocamos no visible las columnas del...
                    targets: 15,
                    'data': 'id_proveedor',
                    visible: false
                },
                {
                    //colocamos no visible las columnas del...
                    targets: 16,
                    'data': 'nombre',
                    visible: true
                },
                {
                    //colocamos no visible las columnas del...
                    targets: 17,
                    'data': 'opciones',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        /*retorna un ocono de un lapiz en inventario en opciones, con el style cursor... indicamos que al seleccionar el 
                        icono aparezca en el puntero del mause una mano*/
                        return "<center>" +
                            "<span class='btnEditarProducto text-primary px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +
                            //opciones eliminar icono
                            "<span class='btnAumentarStock text-success px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-plus-circle fs-5'></i>" +
                            "</span>" +
                            //opciones Aumentar Stock icono
                            "<span class='btnDisminuirStock text-warning px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-minus-circle fs-5'></i>" +
                            "</span>" +
                            //disminuir stock icono
                            "<span class='btnEliminarProducto text-danger px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +
                            "</center>"
                    }
                }

            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });


        

        /*===================================================================*/
        // EVENTOS PARA AGRANDAR LA IMAGEN
        /*===================================================================*/


        $('#tbl_productos tbody').on('click', 'img.imagen-agrandable', function() {
            var img = $(this);
            if (img.hasClass('imagen-agrandada')) {
                img.removeClass('imagen-agrandada');
            } else {
                img.addClass('imagen-agrandada');
            }


        });





        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA (CODIGO, CATEGORIA Y PRODUCTO)
        /*===================================================================*/
        $("#iptCodigoBarras").keyup(function() {
            /*seleccionamos la table para buscar y que en la columna de indice no sleecione el idCodigoBarras y con el search que 
      busque en la columa el codigo de barras */
            table.column($(this).data('index')).search(this.value).draw();
        })

        $("#iptCategoria").keyup(function() {
            /*seleccionamos la table para buscar y que en la columna de indice no sleecione el categoria y con el search que 
      busque en la columa el codigo de barras */
            table.column($(this).data('index')).search(this.value).draw();
        })

        $("#iptProducto").keyup(function() {
            /*seleccionamos la table para buscar y que en la columna de indice no sleecione el producto y con el search que 
      busque en la columa el codigo de barras */
            table.column($(this).data('index')).search(this.value).draw();
        })

        /*===================================================================*/
        // EVENTOS PARA CRITERIOS DE BUSQUEDA POR RANGO (PREVIO VENTA)
        /*===================================================================*/
        $("#iptPrecioVentaDesde, #iptPrecioVentaHasta").keyup(function() {
            table.draw(); //que pinte los valores
        })

        $.fn.dataTable.ext.search.push(

            function(settings, data, dataIndex) {
                //capturamos los valores
                var precioDesde = parseFloat($("#iptPrecioVentaDesde").val());
                var precioHasta = parseFloat($("#iptPrecioVentaHasta").val());

                var col_venta = parseFloat(data[7]);

                if ((isNaN(precioDesde) && isNaN(precioHasta)) ||
                    // explicacion de la siguiente condicional https://www.youtube.com/watch?v=BooGmf21udc&t=1170s
                    (isNaN(precioDesde) && col_venta <= precioHasta) ||
                    (precioDesde <= col_venta && isNaN(precioHasta)) ||
                    (precioDesde <= col_venta && col_venta <= precioHasta)) {
                    return true;
                }

                return false;
            }
        )
        //console.log(precioDesde);



        /*===================================================================*/
        // EVENTO PARA LIMPIAR INPUTS DE CRITERIOS DE BUSQUEDA
        /*===================================================================*/
        //id para poder borrar los datos del criterios de busqueda en el inventario
        $("#btnLimpiarBusqueda").on('click', function() {

            $("#iptCodigoBarras").val('')
            $("#iptCategoria").val('')
            $("#iptProducto").val('')
            $("#iptPrecioVentaDesde").val('')
            $("#iptPrecioVentaHasta").val('')

            table.search('').columns().search('').draw();
        })
        /*con el siguiente codigo indicamos que al momento de dar en el boton ce cancelar de la pesta;a de agregar producto nuevo
        que si se agrego datos, y se vuelva a abrir la pesta;a, se borren los datos ingresados anteriortemte.
        Tambien sirve para colocar datos automatiamente, como por ejemplo el codigo de producto */
        $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

            $("#validate_codigo").css("display", "none");
            $("#validate_categoria").css("display", "none");
            $("#validate_descripcion").css("display", "none");
            $("#validate_precio_compra").css("display", "none");
            $("#validate_precio_venta").css("display", "none");
            $("#validate_stock").css("display", "none");
            $("#validate_min_stock").css("display", "none");

            LimpiarInputsVentanaModal();
            //quita imagen
            deleteImg();

            /*  $("#iptCodigoReg").val("");
              $("#selCategoriaReg").val(0);
              $("#iptDescripcionReg").val("");
              $("#iptPrecioCompraReg").val("");
              $("#iptPrecioVentaReg").val("");
              $("#iptUtilidadReg").val("");
              $("#iptStockReg").val("");
              $("#iptMinimoStockReg").val("");*/

        })

        /*===================================================================*/
        //EVENTO QUE AL TECLEAR EN EL INPUT P.COMPRA Y P. VENTA, NOS TIRE EL RESULTADO DE LA GANANCIA.
        /*===================================================================*/
        $("#iptPrecioCompraReg, #iptPrecioVentaReg").keyup(function() {
            calcularUtilidad();
        });

        /*===================================================================*/
        //CALCULAR LA UTILIDAD AL CAMBIAR DEL INPUT
        /*===================================================================*/
        $("#iptPrecioCompraReg, #iptPrecioVentaReg").change(function() {
            calcularUtilidad();
        });

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON AUMENTAR STOCK
        =========================================================================================*/
        $('#tbl_productos tbody').on('click', '.btnAumentarStock', function() {


            operacion_stock = 1; //sumar stock
            accion = 3;

            $("#mdlGestionarStock").modal('show'); //MOSTRAR VENTANA MODAL

            $("#titulo_modal_stock").html('Aumentar Stock'); // CAMBIAR EL TITULO DE LA VENTANA MODAL
            $("#titulo_modal_label").html('Agregar al Stock'); // CAMBIAR EL TEXTO DEL LABEL DEL INPUT PARA INGRESO DE STOCK
            $("#iptStockSumar").attr("placeholder", "Ingrese cantidad a agregar al Stock"); //CAMBIAR EL PLACEHOLDER 

            var data = table.row($(this).parents('tr')).data(); //OBTENER EL ARRAY CON LOS DATOS DE CADA COLUMNA DEL DATATABLE

            $("#stock_codigoProducto").html(data[2]) //CODIGO DEL PRODUCTO DEL DATATABLE
            $("#stock_Producto").html(data[5]) //NOMBRE DEL PRODUCTO DEL DATATABLE
            $("#stock_Stock").html(data[9]) //STOCK ACTUAL DEL PRODUCTO DEL DATATABLE

            $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));

        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON DISMINUIR STOCK
        =========================================================================================*/
        $('#tbl_productos tbody').on('click', '.btnDisminuirStock', function() {

            operacion_stock = 2; //restar stock
            accion = 3;
            $("#mdlGestionarStock").modal('show'); //MOSTRAR VENTANA MODAL

            $("#titulo_modal_stock").html('Disminuir Stock'); // CAMBIAR EL TITULO DE LA VENTANA MODAL
            $("#titulo_modal_label").html('Disminuir al Stock'); // CAMBIAR EL TEXTO DEL LABEL DEL INPUT PARA INGRESO DE STOCK
            $("#iptStockSumar").attr("placeholder", "Ingrese cantidad a disminuir al Stock"); //CAMBIAR EL PLACEHOLDER 


            var data = table.row($(this).parents('tr')).data(); //OBTENER EL ARRAY CON LOS DATOS DE CADA COLUMNA DEL DATATABLE

            $("#stock_codigoProducto").html(data[2]) //CODIGO DEL PRODUCTO DEL DATATABLE
            $("#stock_Producto").html(data[4]) //NOMBRE DEL PRODUCTO DEL DATATABLE
            $("#stock_Stock").html(data[9]) //STOCK ACTUAL DEL PRODUCTO DEL DATATABLE

            $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));

        })

        /* ======================================================================================
        EVENTO QUE LIMPIA EL INPUT DE INGRESO DE STOCK AL CERRAR LA VENTANA MODAL
        =========================================================================================*/
        $("#btnCancelarRegistroStock, #btnCerrarModalStock").on('click', function() {
            $("#iptStockSumar").val("")
        })

        /* ======================================================================================
        EVENTO AL DIGITAR LA CANTIDAD A AUMENTAR O DISMINUIR DEL STOCK
        =========================================================================================*/
        $("#iptStockSumar").keyup(function() {

            // console.log($("#iptStockSumar").val());

            if (operacion_stock == 1) {

                if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

                    var stockActual = parseFloat($("#stock_Stock").html());
                    var cantidadAgregar = parseFloat($("#iptStockSumar").val());

                    $("#stock_NuevoStock").html(stockActual + cantidadAgregar);

                } else {

                    Toast.fire({
                        icon: 'warning',
                        title: 'Ingrese un valor mayor a 0'
                    });
                    $("#iptStockSumar").val("")
                    $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));

                }

            } else {

                if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

                    var stockActual = parseFloat($("#stock_Stock").html());
                    var cantidadAgregar = parseFloat($("#iptStockSumar").val());

                    $("#stock_NuevoStock").html(stockActual - cantidadAgregar);

                    if (parseInt($("#stock_NuevoStock").html()) < 0) {

                        Toast.fire({
                            icon: 'warning',
                            title: 'La cantidad a disminuir no puede ser mayor al stock actual (Nuevo stock < 0)'
                        });

                        $("#iptStockSumar").val("");
                        $("#iptStockSumar").focus();
                        $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
                    }
                } else {

                    Toast.fire({
                        icon: 'warning',
                        title: 'Ingrese un valor mayor a 0'
                    });

                    $("#iptStockSumar").val("")
                    $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
                }
            }

        })

        /* ======================================================================================
        EVENTO QUE REGISTRA EN BD EL AUMENTO O DISMINUCION DE STOCK
        =========================================================================================*/
        $("#btnGuardarNuevoStock").on('click', function() {


            if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

                var nuevoStock = parseFloat($("#stock_NuevoStock").html()),
                    codigo_producto = $("#stock_codigoProducto").html();

                var datos = new FormData();

                datos.append('accion', accion);
                datos.append('nuevoStock', nuevoStock);
                datos.append('codigo_producto', codigo_producto);

                $.ajax({
                    url: "ajax/productos.ajax.php",
                    method: "POST",
                    data: datos,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(respuesta) {

                        $("#stock_NuevoStock").html("");
                        $("#iptStockSumar").val("");

                        $("#mdlGestionarStock").modal('hide');

                        table.ajax.reload();

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: respuesta,
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });

            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'Debe ingresar la cantidad a aumentar'
                });
            }

        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON EDITAR PRODUCTO 
        VD 14 MIN 1:30
        =========================================================================================*/
        $('#tbl_productos tbody').on('click', '.btnEditarProducto', function() {

            $("#iptCodigoReg").prop("disabled", true);


            accion = 4; //seteamos la accion para editar

            $("#mdlGestionarProducto").modal('show');

            var data = new FormData($(form_cargar_imagen)[0]);
            var data = table.row($(this).parents('tr')).data();
            var datos = new FormData();

            /*se definen estas variables para enviar el parametro $name, para que en el llamado .ajax, 
             se reconozca y se pueda realizar la condicion if si no se agrega imagen, igual al momento de editar */
            $img = $("#imagen");
            $name = $('name');


            $("#iptCodigoReg").val(data["codigo_producto"]);
            $("#selCategoriaReg").val(data[3]);
            $("#iptDescripcionReg").val(data[5]);
            $("#iptPrecioCompraReg").val(data[6]);
            $("#iptPrecioVentaReg").val(data[7]);
            $("#iptUtilidadReg").val(data[8]);
            $("#iptStockReg").val(data[9]);
            $("#iptMinimoStockReg").val(data[10]);
            $("#selProveedor").val(data[15]);
            //colocamos la imagen
            document.getElementById("img-preview").src = 'vistas/assets/imagenes/' + data['foto'];
            //agregamos el icono de quitar imagen
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onclick="deleteImg()">
            <i class="fas fa-times"></i></button>`;
            //quitamos el icono de agregar nueva imagen, y solo dejamos el de quitar
            document.getElementById("icon-image").classList.add("d-none");
            //almacenamos los valores de la foto
            document.getElementById("foto_actual").value = data['foto'];
            document.getElementById("foto_delete").value = data['foto'];

            console.log(data);


        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON ELIMINAR PRODUCTO
        =========================================================================================*/
        $('#tbl_productos tbody').on('click', '.btnEliminarProducto', function() {

            accion = 5; //seteamos la accion para editar

            var data = table.row($(this).parents('tr')).data();

            var codigo_producto = data["codigo_producto"];

            Swal.fire({
                title: 'ESTÁ SEGURO DE ELIMINAR EL PRODUCTO ' + data[5] + '?',
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
                    datos.append("codigo_producto", codigo_producto); //codigo_producto               

                    $.ajax({
                        url: "ajax/productos.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {

                            if (respuesta == "ok") {
                                mensajeToast('success', 'EL PRODUCTO SE ELIMINÓ CORRECTAMENTE');
                                table.ajax.reload();

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
        })


    }); //FIN DEL DOCUMENT READY


    /*===================================================================*/
    //FUNCION PARA LIMPIAR TODOS LOS INPUTS DE MI PAGINA VENTAS 
    /*===================================================================*/

    function LimpiarInputsVentanaModal() {

        $("#iptCodigoReg").val("");
        $("#selCategoriaReg").val(0);
        $("#iptDescripcionReg").val("");
        $("#iptPrecioCompraReg").val("");
        $("#iptPrecioVentaReg").val("");
        $("#iptUtilidadReg").val("");
        $("#iptStockReg").val("");
        $("#iptMinimoStockReg").val("");
        //     $("#imagen").val("");

    } /* FIN LimpiarInputs */

    // CALCULA LA GANANCIA 
    function calcularUtilidad() {

        var iptPrecioCompraReg = $("#iptPrecioCompraReg").val();
        var iptPrecioVentaReg = $("#iptPrecioVentaReg").val();
        var Utilidad = iptPrecioVentaReg - iptPrecioCompraReg;

        $("#iptUtilidadReg").val(Utilidad.toFixed(2));

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


    //FUNCION VER IMAGEN PRECARGADA, ANTES DE SER INSERTADA DESDE LA VENTANA MODAL
    function preview(e) {
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        //se oculte el icono de agregar imagen
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML =
            //aqui llamamos nuestra funcion quitar imagen
            `<button class="btn btn-danger" onclick="deleteImg(event)"><i class="fas fa-times"></i></button>
        ${url['name']}`; //mostramos el nombre de la imagen previo

    }

    //FUNCION PARA QUITAR IMAGEN SELECCIONADA PARA INSERTAR
    function deleteImg(e) {
        //quitamos el icono cerrar
        document.getElementById("icon-cerrar").innerHTML = '';
        //removemos el icon de la imagen
        document.getElementById("icon-image").classList.remove("d-none");
        //quitamos imagen preview
        document.getElementById("img-preview").src = '';
        //quitamos la imagen que se habia seleccionados
        document.getElementById("imagen").value = '';
        document.getElementById("foto_delete").value = '';
    }



    /*===================================================================*/
    //EVENTO QUE GUARDA LOS DATOS DEL PRODUCTO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
    /*===================================================================*/
    document.getElementById("btnGuardarProducto").addEventListener("click", function() {

        /*se definen estas variables para enviar el parametro $name, para que en el llamado .ajax, 
        se reconozca y se pueda realizar la condicion if si no se agrega imagen, igual al momento de editar */
        $img = $("#imagen");
        $name = $('name');

        console.log($name, "pruebas");

        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() === true) {
                //console.log("Listo para registrar el producto")
                Swal.fire({
                    title: '¿ESTÁ SEGURO DE REGISTRAR EL PRODUCTO?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo registrarlo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {

                    if (result.isConfirmed) {

                        var datos = new FormData();
                        var datos = new FormData($(form_cargar_imagen)[0]);

                        datos.append("accion", accion);
                        datos.append("codigo_producto", $("#iptCodigoReg").val());
                        datos.append("id_categoria_producto", $("#selCategoriaReg").val());
                        datos.append("descripcion_producto", $("#iptDescripcionReg").val());
                        datos.append("id_proveedor", $("#selProveedor").val());
                        datos.append("descripcion_producto", $("#iptDescripcionReg").val());
                        datos.append("precio_compra_producto", $("#iptPrecioCompraReg").val());
                        datos.append("precio_venta_producto", $("#iptPrecioVentaReg").val());
                        datos.append("utilidad", $("#iptUtilidadReg").val());
                        datos.append("stock_producto", $("#iptStockReg").val());
                        datos.append("minimo_stock_producto", $("#iptMinimoStockReg").val());
                        datos.append("ventas_producto", 0);
                        datos.append("name", $name);


                        if (accion == 2) {
                            var titulo_msj = "EL PRODUCTO SE REGISTRÓ CORRECTAMENTE"
                        }

                        if (accion == 4) {
                            var titulo_msj = "EL PRODUCTO SE ACTUALIZÓ CORRECTAMENTE"
                        }

                        $.ajax({
                            url: "ajax/productos.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {
                                if (respuesta == "ok") {

                                    mensajeToast('success', titulo_msj);

                                    LimpiarInputsVentanaModal();
                                    //limpia imagenes
                                    deleteImg();

                                    table.ajax.reload();

                                    $("#mdlGestionarProducto").modal('hide');
                                    $(".needs-validation").removeClass("was-validated");


                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'ERROR' + ' valida el codigo del producto',
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


    /*===================================================================*/
    //EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
    /*===================================================================*/
    /*Codigo, funcion que al momento de ir a registrar un producto, y al momento de dar clic en el boton
  guardar producto y se activen las alertas de que hace falta algun campo, al dar clic en cancelar y volver nuevamente 
  abrir la pesta;a de abirir para ingresar el producto, ya no aparezca que tenga que validar o que hace falta un campo */
    document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
        $(".needs-validation").removeClass("was-validated");
    })
</script>