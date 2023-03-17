<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">COMPRAS</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item active">COMPRAS</li>
                </ol>
            </div>
        </div>
    </div>


</div>



<!-- main content -->
<!--======================================================================================
        		DISEÑO DE NUESTRA PAGINA COMPRAS
====================================================================================== -->

<div class="content">
    <div class="container-fluid">


<!--
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">DETALLE PROVEEDOR</h3>
                        <div class="card-tools"><button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">PROVEEDOR</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="IMAGEN"></i></span></div>
                                        <input type="text" class="form-control" id="compras_desde">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">DIRECCION</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="IMAGEN"></i></span></div>
                                        <input type="text" class="form-control" id="compras_desde">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
-->


        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">DATOS DEL PRODUCTO</h3>
                        <div class="card-tools"><button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">PRODUCTO</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="IMAGEN"></i></span></div>
                                        <input type="text" class="form-control" id="iptCodigoCompra">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>








        <div class="row mb-3">
            <div class="col-md-12">
                <div class="row">

                    <!--ETIQUETA QUE MUSTRA LA SUMA TOTAL DE LOS PRODUCTOS AGREGADOS AL LISTADO -->
                    <div class="col-md-6 mb-3 rounded-3">
                        <h3 class="fw-bold m-0">Total Compra: Q. <span id="totalCompra">0.00</span></h3>
                    </div>

                    <!-- BORONES PARA VACIAR LISTADO Y COMPLETAR LA COMPRA -->
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" id="btnIniciarCompra">
                            <i class="fas fa-shopping-cart"></i>Realizar Compra
                        </button>
                        <button class="btn btn-danger" id="btnVaciarListado">
                            <i class="far fa-trash-alt"></i> Vaciar Listado
                        </button>
                    </div>

                    <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO A LA COMPRA -->
                    <div class="col-md-12">
                        <table id="lstProductosCompra" class="display nowrap table-striped w-100 shadow">
                            <thead class="bg-info text-left fs-6">
                                <tr>
                                    <th>Item</th>
                                    <th>Codigo</th>
                                    <th>Imagen</th>
                                    <th>Id Categoria</th>
                                    <th>Categoria</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio C.</th>

                                    <th>Total</th>
                                    <th class="text-center">Opciones</th>
                                    <th>Comentarios</th>

                                </tr>
                            </thead>
                            <tbody class="small text-left fs-6">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>


<!--======================================================================================
        		FUNCIONALIDADES DEL CODIGO-
====================================================================================== -->
<script>
    var table;
    var items = []; //Se usa para el input de autocompletable
    var itemProducto = 1;

    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        /* ======================================================================================
        		EVENTO VACIAR LA TABLA COMPRAS, VACIAR EL LISTADO DE LA TABALA COMPRAS
        		======================================================================================*/
        $("#btnVaciarListado").on('click', function() {
            vaciarListado();
        })


        /* ======================================================================================
		EVENTO INICIALIZAR LA TABLA COMPRAS
		======================================================================================*/

        table = $('#lstProductosCompra').DataTable({
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "codigo_producto"
                },
                {
                    "data": "foto"
                },
                {
                    "data": "id_categoria"
                },
                {
                    "data": "nombre_categoria"
                },
                {
                    "data": "descripcion_producto"
                },
                {
                    "data": "cantidad"
                },
                {
                    "data": "precio_compra_producto"
                },
                {
                    "data": "total"
                },
                {
                    "data": "acciones"
                },
                {
                    "data": "comentarios"
                },
                // { "data": "precio_mayor_producto" },
                //{ "data": "precio_oferta_producto" }
            ],
            scrollX: true,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    //oculte las columnas
                    targets: 0,
                    visible: false
                },
                {
                    targets: 2,
                    'data': 'foto',
                    'render': function(foto) {
                        var img = foto;
                        return '<img src="vistas/assets/imagenes/' + img + '" height="40px" width="45px" />';
                    }
                },

                {
                    targets: 3,
                    visible: false
                },
                {
                    targets: 4,
                    visible: false
                },
                {
                    targets: 7,
                    orderable: false
                },
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
        VD 15 MIN 22:10
		======================================================================================*/
        $.ajax({
            async: false,
            url: "ajax/compras.ajax.php",
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
                //input iptCodigoCompra que lo autocomplete
                $("#iptCodigoCompra").autocomplete({
                    source: items,
                    select: function(event, ui) {
                        console.log("🚀 ~ file: compras.php ~ line 313 ~ $ ~ ui.item.value", ui.item.value)
                        CargarProductos(ui.item.value);
                        // $("#iptCodigoVenta").val("");
                        // $("#iptCodigoVenta").focus();
                        return false;
                    }
                })
            }
        });

        /* ======================================================================================
		REGISTRAR EL PRODUCTO EN LA TABLA CUANDO SE ESCANEE CON BARCODE TO PC AUTOMATICAMANTE
		======================================================================================*/
        $("#iptCodigoCompra").change(function() {
            CargarProductos();
        });

        /* ======================================================================================
        EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        ======================================================================================*/
        $('#lstProductosCompra tbody').on('click', '.btnEliminarProducto', function() {
            //se dirija a la table, recupere los datos de la fila con el tr
            table.row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });



        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DE COMPRA DE PRODUCTOS A COMPRAR
        ======================================================================================*/
        $('#lstProductosCompra tbody').on('change', '.iptPrecioCompra', function() {

            var data = table.row($(this).parents('tr')).data();
            //obtenemos los valores del input al realizar change
            nuevo_precio = $(this)[0]['value'];
            cod_producto_actual = $(this)[0]['attributes'][2]['value'];
            precio_actual = parseFloat($.parseHTML(data['precio_compra_producto'])[0]['value'])
            cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value']);
            //console.log("codigo Producto", $(this)[0]['attributes'][2]['value'])
            if (!$.isNumeric(nuevo_precio)) {

                mensajeToast('error', 'INGRESE UN VALOR NUMERICO ');
             
                $(this)[0]['value'] = precio_actual.toFixed(2);

                $("#iptPrecioCompra").val("");
                $("#iptPrecioCompra").focus();
                return;

            }

            //    console.log(nuevo_precio, 'cantidad actual 2023');
            table.rows().eq(0).each(function(index) {
                var row = table.row(index);
                var data = row.data();
                if (data['codigo_producto'] == cod_producto_actual) {
                    table.cell(index, 7).data('<input type="int" style="width:80px;" codigoProducto = "' + cod_producto_actual + '" class="form-control text-center iptPrecioCompra m-0 p-0" value="' + nuevo_precio + '">').draw();
                    // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE COMPRA 
                    NuevoPrecio = (parseFloat(cantidad_actual) * (nuevo_precio));
                    NuevoPrecio = "Q. " + NuevoPrecio.toFixed(2);
                    table.cell(index, 8).data(NuevoPrecio).draw();
                    recalcularTotales();
                }
            });
        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR LA CANTIDAD DE PRODUCTOS A COMPRAR
        ======================================================================================*/
        $('#lstProductosCompra tbody').on('change', '.iptCantidad', function() {

            var data = table.row($(this).parents('tr')).data();
            //obtenemos los valores del input al realizar change
            cantidad_actual = $(this)[0]['value'];
            cod_producto_actual = $(this)[0]['attributes'][2]['value'];
            nuevo_precio = $(this)[0]['value'];
            precio_actual = parseFloat($.parseHTML(data['precio_compra_producto'])[0]['value']);

            //console.log("precio_actual", precio_actual);
            //console.log("codigo Producto", $(this)[0]['attributes'][2]['value'])



            if (!$.isNumeric($(this)[0]['value']) || $(this)[0]['value'] <= 0) {

                
                mensajeToast('error', 'INGRESE UN VALOR NUMERICO Y MAYOR A 0');

                $(this)[0]['value'] = "1";

                $("#iptCantidad").val("");
                $("#iptCantidad").focus();
                return;

            }

            //console.log(cantidad_actual, 'cantidad actual');

            table.rows().eq(0).each(function(index) {
                var row = table.row(index);

                var data = row.data();

                if (data['codigo_producto'] == cod_producto_actual) {

                    //asignamos el valor a la celda (cantidad), en dado caso se agregan mas de dos productos a comprar. 
                    // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                    table.cell(index, 6).data('<input type="int" style="width:80px;" codigoProducto = "' + cod_producto_actual + '" class="form-control text-center iptCantidad m-0 p-0" value="' + cantidad_actual + '">').draw();
                    // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE COMPRA
                    NuevoPrecio = (parseFloat(cantidad_actual) * (precio_actual));
                    NuevoPrecio = "Q. " + NuevoPrecio.toFixed(2);
                    table.cell(index, 8).data(NuevoPrecio).draw();

                    recalcularTotales();

                }
            });
        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DE COMPRA DEL PRODUCTO
        ======================================================================================*/
        $('#lstProductosCompra tbody').on('click', '.dropdown-item', function() {

            codigo_producto = $(this).attr("codigo");
            precio_compra = parseFloat($(this).attr("precio").replaceAll("Q. ", "")).toFixed(2);

            recalcularMontos(codigo_producto, precio_compra);
        });

        /* ======================================================================================
        EVENTO PARA INICIAR EL REGISTRO DE LA COMPRA
        =========================================================================================*/

        $("#btnIniciarCompra").on('click', function() {
            realizarCompra();
        })

    }) //FIN DOCUMENT READY




    /*============================================================================================================================================ */
    //FUNCIONES
    /*===========================================================================================================================================*/


    /*===================================================================*/
    //FUNCION PARA LIMPIAR TOTOTALMENTE LA TABLA DE COMPRAS 
    /*===================================================================*/
    function vaciarListado() {
        table.clear().draw();
        LimpiarInputs();
    }

    /*===================================================================*/
    //FUNCION PARA LIMPIAR TODOS LOS INPUTS DE MI PAGINA COMPRAS 
    /*===================================================================*/
    function LimpiarInputs() {
        $("#totalCompra").html("0.00");
    } /* FIN LimpiarInputs */



    function recalcularMontos(codigo_producto, precio_compra) {

        table.rows().eq(0).each(function(index) {
            var row = table.row(index);
            var data = row.data();
            if (data['codigo_producto'] == codigo_producto) {
                // cantidad_actual = 
                console.log("🚀 ~ file: compras.php:483 ~ table.rows ~ data", parseFloat($.parseHTML(data['cantidad'])[0]['value']))
                cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value']);

                // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE COMPRA
                NuevoPrecio = (parseFloat(cantidad_actual) * data['precio_compra_producto'].replaceAll("Q. ", "")).toFixed(2);
                NuevoPrecio = "S./ " + NuevoPrecio;
                table.cell(index, 8).data(NuevoPrecio).draw();
            }
        });
        // RECALCULAMOS TOTALES
        recalcularTotales();
    }



    /*===================================================================*/
    //FUNCION PARA CARGAR RECALCULAR TODOS LOS TOTALES TANTO DE LA TABLA COMO EN LA PESTA:A 
    /*===================================================================*/

    function recalcularTotales() {
        var TotalCompra = 0.00;
        table.rows().eq(0).each(function(index) {
            var row = table.row(index);
            var data = row.data();
            TotalCompra = parseFloat(TotalCompra) + parseFloat(data['total'].replace("Q. ", ""));
        });
        $("#totalCompra").html("");
        $("#totalCompra").html(TotalCompra.toFixed(2));
        var totalCompra = $("#totalCompra").html();
        var iva = parseFloat(totalCompra) * 0.12
        var subtotal = parseFloat(totalCompra) - parseFloat(iva);
        $("#totalCompraRegistrar").html(totalCompra);
        $("#boleta_subtotal").html(parseFloat(subtotal).toFixed(2));
        $("#boleta_iva").html(parseFloat(iva).toFixed(2));
        $("#boleta_total").html(parseFloat(totalCompra).toFixed(2));
        //LIMPIAMOS LOS INPUTS DE EFECTIVO EXACTO, DESMARCAMOS EL CHECK DE EFECTIVO EXACTO
        //BORRAMOS LOS DATOS DE EFECTIVO ENTREGADO Y VUELTO
        $("#iptEfectivoRecibido").val("");
        $("#chkEfectivoExacto").prop('checked', false);
        $("#EfectivoEntregado").html("0.00");
        $("#Vuelto").html("0.00");
        $("#iptCodigoCompra").val("");
        //    $("#iptCodigoVenta").focus();
    }
    /*===================================================================*/
    //FUNCION PARA CARGAR PRODUCTOS EN EL DATATABLE
    /*===================================================================*/

    function CargarProductos(producto = "") {
        if (producto != "") {
            var codigo_producto = producto;
        } else {
            var codigo_producto = $("#iptCodigoCompra").val();
        }
        codigo_producto = $.trim(codigo_producto.split('/')[0]);
        // console.log("🚀 ~ file: compras.php:844 ~ CargarProductos ~ codigo_producto", codigo_producto)
        // return;
        var producto_repetido = 0;

        /*===================================================================*/
        // SI EL PRODUCTO YA EXISTE EN EL LISTADO NOTIFICACION
        /*===================================================================*/
        table.rows().eq(0).each(function(index) {
            var row = table.row(index);
            var data = row.data();
            console.log("🚀 ~ file: compras.php:829 ~ table.rows ~ data", $.parseHTML(data['cantidad'])[0]['value'])
            if (codigo_producto == data['codigo_producto']) {
                producto_repetido = 1;
                //  cantidad_a_comprar = parseFloat($.parseHTML(data['cantidad'])[0]['value'])
                mensajeToast('warning', 'EL PRODUCTO ' + data['descripcion_producto'] + ' YA ESTA EN EL LISTADO' );
                $("#iptCodigoCompra").val("");
                $("#iptCodigoCompra").focus();
            }
        });
        //SI LA RESPUESTA ES 1 (VERDADERO) RETORNA SI ES 0 CONTINUA CON
        if (producto_repetido == 1) {
            return;
        }
        $.ajax({
            url: "ajax/compras.ajax.php",
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
                    var TotalCompra = 0.00;
                    table.row.add({
                        'id': itemProducto,
                        'codigo_producto': respuesta['codigo_producto'],
                        'foto': respuesta['foto'],
                        'id_categoria': respuesta['id_categoria'],
                        'nombre_categoria': respuesta['nombre_categoria'],
                        'descripcion_producto': respuesta['descripcion_producto'],
                        'cantidad': '<input type="number" style="width:80px;" codigoProducto = "' + respuesta['codigo_producto'] + '" class="form-control text-center iptCantidad p-0 m-0" value="1">',
                        'precio_compra_producto': '<input type="number" style="width:80px;" codigoProducto = "' + respuesta['codigo_producto'] + '" class="form-control text-center iptPrecioCompra p-0 m-0" value= ' + respuesta['precio_compra_producto'] + ' >',

                        'total': respuesta['total'],
                        'acciones': "<center>" +

                            "<span class='btnEliminarProducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +

                            "</center>",
                        'comentarios': '<input type="text" style="width:150px;" codigoProducto = "' + respuesta['codigo_producto'] + '" class="form-control text-center iptComentarios p-0 m-0" value= ' + respuesta['comentarios'] + ' >',
                        /*  'precio_mayor_producto': respuesta['precio_mayor_producto'],
		                    'precio_oferta_producto': respuesta['precio_oferta_producto'] */
                    }).draw();
                    itemProducto = itemProducto + 1;
                    //  Recalculamos el total de la compra
                    recalcularTotales();
                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {
                    mensajeToast('info', 'EL PRODUCTO NO EXISTE, AGREGALO A TU INVENTARIO!');
                    $("#iptCodigoCompra").val("");
                    //     $("#iptCodigoVenta").focus();
                }
            }
        });
    } /* FIN CargarProductos */

    /*===================================================================*/
    //REALIZAR LA COMPRA
    /*===================================================================*/
    function realizarCompra() {
        var count = 0;
        var totalCompra = $("#totalCompra").html();
        table.rows().eq(0).each(function(index) { //recorremos los datos que tiene la tabla compras
            count = count + 1; // reccoriendo de 1 a 1 y sumando 


        });
        //si la cantidad es mayor a 0 quiere decir que si hay productos por lo que procede a realizar la compra
        if (count > 0) {
            //ENVIAMOS LOS VALORES A LA BASE DE DATOS
            var formData = new FormData();
            var arr = [];

            //recorremos la tabla
            table.rows().eq(0).each(function(index) {
                var row = table.row(index);

                var data = row.data();

                //console.log($.parseHTML(data['cantidad'])[0]['value'], "data cantidad");
                //return;
                //agregame a mi array 
                arr[index] = data['codigo_producto'] + "," +
                    data['nombre_categoria'] + "," +
                    data['descripcion_producto'] + "," +
                    //se agrega el siguiente cod para obtener desde un input el valor
                    parseFloat($.parseHTML(data['cantidad'])[0]['value']) + "," +
                    parseFloat($.parseHTML(data['precio_compra_producto'])[0]['value']) + "," +
                    data['total'].replace("Q. ", "") + "," +
                    parseFloat($.parseHTML(data['comentarios']));
                //  arr[index] =  data['codigo_producto'] + "," + parseFloat(data['cantidad']) + "," + data['total'].replace("Q. ", "");
                formData.append('arr[]', arr[index]);
            });
            // console.log(arr, "data realizar");
            formData.append('total_compra', parseFloat(totalCompra));

            $.ajax({
                url: "ajax/compras.ajax.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(respuesta) {
                    if (respuesta == "ok") {
                        mensajeToast('success', 'COMPRA REGISTRADA CORRECTAMENTE');
                    } else if (respuesta == "error_stock") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'ERROR AL ACTUALIZAR STOCK' +
                            'comunicate con tu administrador',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'ERROR AL REGISTRAR COMPRA' +
                            'comunicate con tu administrador',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    }
                    table.clear().draw();
                    LimpiarInputs();
                    //   CargarNroBoleta();
                }
            });

        } else {
            mensajeToast('warning', 'NO HAY PRODUCTOS EN EL LISTADO');
        }
        //    $("#iptCodigoVenta").focus();

    } /* FIN realizarVenta */
</script>