<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">VENTAS</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item active">VENTAS</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- main content -->

<div class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-9">
                <div class="row">
                    <!--INPUT PARA INGRESO DEL CODIGO O DESCRIPCION DEL PRODUCTO -->
                    <div class="col-md-12 mb-3">
                        <div class="form-group mb-2">
                            <label class="col-form-label" for="iptCodigoVenta">
                                <i class="fas fa-barcode fs-6"></i>
                                <span class="small">PRODUCTOS</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="iptCodigoVenta" placeholder="Ingrese el codigo o el nombre el producto">
                        </div>
                    </div>
                    <!--ETIQUETA QUE MUSTRA LA SUMA TOTAL DE LOS PRODUCTOS AGREGADOS AL LISTADO -->
                    <div class="col-md-6 mb-3">
                        <h3>Total Venta: Q. <span id="totalVenta">0.00</span></h3>
                    </div>

                    <!-- BORONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" id="btnIniciarVenta">
                            <i class="fas fa-shopping-cart"></i>Realizar Venta
                        </button>
                        <button class="btn btn-danger" id="btnVaciarListado">
                            <i class="far fa-trash-alt"></i> Vaciar Listado
                        </button>
                    </div>

                    <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO A LA VENTA -->
                    <div class="col-md-12">
                        <table id="lstProductosVenta" class="display nowrap table-striped w-100 shadow">
                            <thead class="bg-info text-left fs-6">
                                <tr>
                                    <th>Item</th>
                                    <th>Codigo</th>
                                    <th>Id Categoria</th>
                                    <th>Categoria</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th class="text-center">Opciones</th>
                                    <th>Aplica Peso</th>
                                </tr>
                            </thead>
                            <tbody class="small text-left fs-6">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-md-3">

                <div class="card shadow">

                    <h5 class="card-header py-1 bg-primary text-white text-center">
                        Total Venta: Q. <span id="totalVentaRegistrar">0.00</span>
                    </h5>

                    <div class="card-body p-2">

                        <!-- SELECCIONAR TIPO DE DOCUMENTO -->
                        <div class="form-group mb-2">

                            <label class="col-form-label" for="selCategoriaReg">
                                <i class="fas fa-file-alt fs-6"></i>
                                <span class="small">Documento</span><span class="text-danger">*</span>
                            </label>

                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selDocumentoVenta">
                                <option value="0">Seleccione Documento</option>
                                <!--por defecto se seleciona la boleta -->
                                <option value="1" selected="true">Boleta</option>
                                <option value="2">Factura</option>
                                <option value="3">Ticket</option>
                            </select>

                            <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                Debe Seleccionar documento
                            </span>

                        </div>

                        <!-- SELECCIONAR TIPO DE PAGO -->
                        <div class="form-group mb-2">

                            <label class="col-form-label" for="selCategoriaReg">
                                <i class="fas fa-money-bill-alt fs-6"></i>
                                <span class="small">Tipo Pago</span><span class="text-danger">*</span>
                            </label>

                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selTipoPago">
                                <option value="0">Seleccione Tipo Pago</option>
                                <!-- por defecto seleciona efectivo -->
                                <option value="1" selected="true">Efectivo</option>
                                <option value="2">Tarjeta</option>
                                <!-- Otros tipos de pagos -->
                                <!--   <option value="3">Yape</option>-->
                                <!--  <option value="4">plin</option>-->
                            </select>

                            <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">
                                Debe Ingresar tipo de pago
                            </span>

                        </div>
                        <!-- SERIE Y NRO DE BOLETA -->
                        <div class="form-group">

                            <div class="row">

                                <div class="col-md-4">

                                    <label for="iptNroSerie">Serie</label>

                                    <input type="text" min="0" name="iptEfectivo" id="iptNroSerie" class="form-control form-control-sm" placeholder="nro Serie" disabled>
                                </div>

                                <div class="col-md-8">

                                    <label for="iptNroVenta">No. Venta</label>

                                    <input type="text" min="0" name="iptEfectivo" id="iptNroVenta" class="form-control form-control-sm" placeholder="Nro Venta" disabled>

                                </div>
                            </div>
                        </div>

                        <!-- INPUT DE EFECTIVO ENTREGADO -->
                        <div class="form-group">
                            <label for="iptEfectivoRecibido">Efectivo recibido</label>
                            <input type="number" min="0" name="iptEfectivo" id="iptEfectivoRecibido" class="form-control form-control-sm" placeholder="Cantidad de efectivo recibida">
                        </div>

                        <!-- INPUT CHECK DE EFECTIVO EXACTO -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chkEfectivoExacto">
                            <label class="form-check-label" for="chkEfectivoExacto">
                                Efectivo Exacto
                            </label>
                        </div>

                        <!-- MOSTRAR MONTO EFECTIVO ENTREGADO Y EL VUELTO -->
                        <div class="row mt-2">

                            <div class="col-12">
                                <h6 class="text-start fw-bold">Monto Efectivo: Q. <span id="EfectivoEntregado">0.00</span></h6>
                            </div>

                            <div class="col-12">
                                <h6 class="text-start text-danger fw-bold">Vuelto: Q. <span id="Vuelto">0.00</span>
                                </h6>
                            </div>
                        </div>

                        <!-- MOSTRAR EL SUBTOTAL, IVA Y TOTAL DE LA VENTA -->
                        <div class="row">
                            <div class="col-md-7">
                                <span>SUBTOTAL</span>
                            </div>
                            <div class="col-md-5 text-right">
                                Q. <span class="" id="boleta_subtotal">0.00</span>
                            </div>

                            <div class="col-md-7">
                                <span>IVA (12%)</span>
                            </div>
                            <div class="col-md-5 text-right">
                                Q. <span class="" id="boleta_iva">0.00</span>
                            </div>

                            <div class="col-md-7">
                                <span>TOTAL</span>
                            </div>
                            <div class="col-md-5 text-right">
                                Q. <span class="" id="boleta_total">0.00</span>
                            </div>
                        </div>

                    </div><!-- ./ CARD BODY -->

                </div><!-- ./ CARD -->
            </div>

        </div>
    </div>
</div>

<script>
    var table;
    var items = []; //Se usa para el input de autocompletable
    var itemProducto = 1;
    $(document).ready(function() {
        /*INICIALIZAR LA TABLA DE VENTAS*/

        table = $('#lstProductosVenta').DataTable({
            columnDefs: [{
                    //oculte las columnas
                    targets: 0,
                    visible: false
                },
                {
                    targets: 3,
                    visible: false
                },
                {
                    targets: 2,
                    visible: false
                },
                {
                    targets: 6,
                    orderable: false
                },
                {
                    targets: 9,
                    visible: false
                }
            ],
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });


        /* ======================================================================================
		TRAER LISTADO DE PRODUCTOS PARA INPUT DE AUTOCOMPLETADO
		======================================================================================*/
        $.ajax({
            async: false,
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: {
                'accion': 6
            },
            dataType: 'json',
            //una vez que tengamos la "respuesta" de la base de datos
            success: function(respuesta) {
                //recorre el aray
                for (let i = 0; i < respuesta.length; i++) {
                    items.push(respuesta[i]['descripcion_producto'])
                }
                //input iptCodigoVenta que lo autocomplete
                $("#iptCodigoVenta").autocomplete({

                    source: items,
                    select: function(event, ui) {

                        console.log("🚀 ~ file: ventas.php ~ line 313 ~ $ ~ ui.item.value", ui.item.value)

                        CargarProductos(ui.item.value);


                        // $("#iptCodigoVenta").val("");

                        // $("#iptCodigoVenta").focus();

                        return false;
                    }
                })


            }
        });
    })




    /*===================================================================*/
    //FUNCION PARA CARGAR PRODUCTOS EN EL DATATABLE
    /*===================================================================*/

    function CargarProductos(producto = "") {

        if (producto != "") {
            var codigo_producto = producto;

        } else {
            var codigo_producto = $("#iptCodigoVenta").val();
        }

        console.log("🚀 ~ file: ventas.php ~ line 335 ~ CargarProductos ~ codigo_producto", codigo_producto)

        var producto_repetido = 0;

/*===================================================================*/
// AUMENTAMOS LA CANTIDAD SI EL PRODUCTO YA EXISTE EN EL LISTADO
/*===================================================================*/
table.rows().eq(0).each(function(index) {

    var row = table.row(index);
    var data = row.data();

    //si el codigo del producto es igual a 1 de los codigos ingresados anteriormente en la data table realiza lo sifuiente
    if (parseInt(codigo_producto) == data['codigo_producto']) {

        producto_repetido = 1;

/*antes de aumentar la cantidad de venta del mismo producto se procede mediante ajax, ver si 
el producto cuenta con stock */
        $.ajax({
            async: false,
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: {
                'accion': 8,
                'codigo_producto': data['codigo_producto'],
                'cantidad_a_comprar': data['cantidad']
            },
            dataType: 'json',
            success: function(respuesta) {

                if (parseInt(respuesta['existe']) == 0) {

                    Toast.fire({
                        icon: 'error',
                        title: ' El producto ' + data['descripcion_producto'] + ' ya no tiene stock'
                    })

                    $("#iptCodigoVenta").val("");
                    $("#iptCodigoVenta").focus();
                    

                } else {

                    // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                    table.cell(index, 5).data(parseFloat(data['cantidad']) + 1 + ' Und(s)').draw();

                    // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE VENTA
                    NuevoPrecio = (parseInt(data['cantidad']) * data['precio_venta_producto'].replace("S./ ", "")).toFixed(2);
                    NuevoPrecio = "S./ " + NuevoPrecio;
                    table.cell(index, 7).data(NuevoPrecio).draw();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();
                }
            }
        });

    }
});

if(producto_repetido == 1){
    return;   
}  

       

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: {
                'accion': 7, //BUSCAR PRODUCTOS POR SU CODIGO DE BARRAS
                'codigo_producto': codigo_producto
            },
            dataType: 'json',
            success: function(respuesta) {

                /*===================================================================*/
                //SI LA RESPUESTA ES VERDADERO, TRAE ALGUN DATO
                /*===================================================================*/
                if (respuesta) {

                    var TotalVenta = 0.00;

                    if (respuesta['aplica_peso'] == 1) {

                        //.add indicamos que podemos agregar un nuevo registro
                        table.row.add([
                            itemProducto,
                            respuesta['codigo_producto'],
                            respuesta['id_categoria'],
                            respuesta['nombre_categoria'],
                            respuesta['descripcion_producto'],
                            respuesta['cantidad'] /*+ ' Kg(s)' */ ,
                            respuesta['precio_venta_producto'],
                            respuesta['total'],
                            //iconos para agrgar y eliminar
                            "<center>" +
                            "<span class='btnIngresarPeso text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Aumentar Stock'> " +
                            "<i class='fas fa-balance-scale fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>",
                            respuesta['aplica_peso']
                        ]).draw();

                        itemProducto = itemProducto + 1;

                    } else {

                        table.row.add([
                            itemProducto,
                            respuesta['codigo_producto'],
                            respuesta['id_categoria'],
                            respuesta['nombre_categoria'],
                            respuesta['descripcion_producto'],
                            respuesta['cantidad'] /*+ ' Und(s)' */ ,
                            respuesta['precio_venta_producto'],
                            respuesta['total'],
                            //icono para aumentar, disminuir y eliminar
                            "<center>" +
                            "<span class='btnAumentarCantidad text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Aumentar Stock'> " +
                            "<i class='fas fa-cart-plus fs-5'></i> " +
                            "</span> " +
                            "<span class='btnDisminuirCantidad text-warning px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Disminuir Stock'> " +
                            "<i class='fas fa-cart-arrow-down fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>",
                            respuesta['aplica_peso']
                        ]).draw();

                        itemProducto = itemProducto + 1;

                    }


                    //  Recalculamos el total de la venta
                    table.rows().eq(0).each(function(index) {
                        var row = table.row(index);

                        var data = row.data();
                        TotalVenta = parseFloat(TotalVenta) + parseFloat(data[7].replace("Q. ", ""));

                    });

                    // TotalVenta = parseFloat(TotalVenta).toFixed(2);

                    $("#totalVenta").html("");
                    $("#totalVenta").html(TotalVenta.toFixed(2));

                    $("#iptCodigoVenta").val("");

                    //calcular el IVA
                    var iva = parseFloat(TotalVenta) * 0.12;
                    var subtotal = parseFloat(TotalVenta) - parseFloat(iva);

                    $("#boleta_subtotal").html(parseFloat(subtotal).toFixed(2));
                    $("#boleta_iva").html(parseFloat(iva).toFixed(2));
                    $("#boleta_total").html(parseFloat(TotalVenta).toFixed(2));

                    $("#totalVentaRegistrar").html(TotalVenta.toFixed(2));
                    $("#boleta_total").html(TotalVenta.toFixed(2));

                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {

                    Toast.fire({
                        icon: 'error',
                        title: ' El producto no existe o no tiene stock'
                    });

                    $("#iptCodigoVenta").val("");
                    $("#iptCodigoVenta").focus();

                }

            }
        });

    } /* FIN CargarProductos */
</script>