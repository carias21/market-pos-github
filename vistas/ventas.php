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
<!--======================================================================================
        		DISEÑO DE NUESTRA PAGINA VENTAS
====================================================================================== -->

<div class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="row">
                    <!--INPUT PARA INGRESO DEL CODIGO O DESCRIPCION DEL PRODUCTO -->
                    <div class="col-md-12 mb-3">
                        <div class="form-group mb-2">
                            <label class="col-form-label" for="iptCodigoVenta">
                                <i class="fas fa-barcode fs-6"></i>
                                <label for="">PRODUCTOS</label>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="iptCodigoVenta" placeholder="Ingrese el codigo o el nombre el producto">
                        </div>

                    </div>


                    <img src="vistas/assets/dist/img/loading.gif" id="img_carga" class="loader">



                    <div class="row">
                        <!-- ETIQUETA QUE MUESTRA LA SUMA TOTAL DE LOS PRODUCTOS AGREGADOS AL LISTADO -->
                        <div class="col-md-4 mb-3 rounded-3 mx-auto text-center">
                            <h3 class="fw-bold m-0">Total Venta: Q. <span id="totalVenta">0.00</span></h3>
                        </div>

                        <!-- BOTONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                        <div class="col-md-8 mb-2 mx-auto">
                            <div class="row">

                                <div class="col-md-4 text-center">
                                    <form class="needs-validation-iptBuscarNitCliente" novalidate method="POST" enctype="multipart/form-data" id="form_iptBuscarNitCliente" action="#">
                                        <input type="text" maxlength="13" class="form-control text-center" style="height: 36px;" id="iptBuscarNitCliente" name="iptBuscarNitCliente" placeholder="Nit del Cliente" required>
                                    </form>
                                </div>


                                <br></br>

                                <div class="col-md-8 text-center">
                                    <button class="btn btn-primary same-size-btn mr-2" id="btnIniciarVenta">
                                        <i class="fas fa-shopping-cart"></i>Realizar Venta
                                    </button>
                                    <button class="btn btn-danger same-size-btn mr-2" id="btnVaciarListado">
                                        <i class="far fa-trash-alt"></i> Vaciar Listado
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>



            <br></br>

            <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO A LA VENTA -->
            <div class="col-md-12">
                <table id="lstProductosVenta" class="display nowrap table-striped w-100 shadow">
                    <thead class="color_general text-left fs-6">
                        <tr>
                            <th>Item</th>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Imagen</th>
                            <th>Id Categoria</th>
                            <th>Categoria</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Total</th>
                            <th class="text-center">Opciones</th>
                            <th>Aplica Peso</th>
                            <th>Precio Compra Producto</th>
                        </tr>
                    </thead>
                    <tbody class="small text-left fs-6">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">

            <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data" id="tipo_de_pago">

                <div class="card card-success ">

                    <h5 class="card-header text-white text-center">
                        Total Venta: Q. <span id="totalVentaRegistrar">0.00</span>
                    </h5>

                    <div class="card-body p-2">


                        <div class="row col-md-12">
                            <input hidden id="iptIdNitCliente" name="iptIdNitCliente">
                            <input class="form-control form-control-sm" type="text" id="iptIdNombreCliente" name="iptIdNombreCliente" style="display: none; background-color: #FFD700; font-weight: bold;" ">
                        </div>


                        <div class=" row col-md-12">

                            <div class="form-group col-md-6">
                                <label for="selTipoPago">Tipo Pago</label>


                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selTipoPago" required>
                                    <option value="">--- TIPO DE PAGO ---</option>
                                    <option value="1">EFECTIVO</option>
                                    <option value="2">TARJETA</option>
                                    <option value="3">TRANFERENCIA</option>
                                    <option value="4">OTRO</option>
                                </select>

                                <div class="invalid-feedback">Seleccione tipo de pago</div>

                            </div>

                            <!-- INPUT DE EFECTIVO ENTREGADO -->
                            <div class="form-group col-md-6">
                                <label for="iptEfectivoRecibido">Efectivo recibido</label>
                                <input type="float" min="0" name="iptEfectivo" id="iptEfectivoRecibido" class="form-control form-control-sm" placeholder="Cantidad de efectivo recibida">
                            </div>

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
                                <h6 class="text-start text-danger fw-bold">Cambio: Q. <span id="Vuelto">0.00</span>
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

                </div><!-- ./ CARD SHADOW -->
            </form>
        </div> <!--col-md-3-->
    </div>
</div>
</div>
</div>

<!-----------------------------------------------------------------------------------------------
VENTANA MODAL PARA AGREGAR NUEVO CLIENTE
------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdlAgregarCliente" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content ">

            <!-- cabecera del modal -->
            <div class="modal-header color_general py-3">
                <h4 class="modal-title text-white">AGREGAR CLIENTE</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- *************************** CUERPO DE LA VENTA ******************** -->
            <div class="modal-body">

                <form class="needs-validation-modal" novalidate method="POST" enctype="multipart/form-data" id="form_clientes">
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
                                <label class="" for="iptNombreClienteModal"><i class="fas fa-users fs-6"></i> <span class="small">NOMBRE CLIENTE</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptNombreClienteModal" placeholder="Nombre Cliente" required>
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

<?php

if (isset($session_id_usuario->nombre_usuario) && isset($session_id_usuario->apellido_usuario)) {
    $nombre_usuario = $session_id_usuario->nombre_usuario;
    $apellido_usuario = $session_id_usuario->apellido_usuario;

    // Mostrar la notificación con emoji de mano saludando
    echo '<script>';
    echo 'mensajeToast("info", "HOLA DE NUEVO! ' . $nombre_usuario . ' ' . $apellido_usuario . ' 👋 ");';
    echo '</script>';
} else {

    $nombre_usuario = "";
    $apellido_usuario = "";
}
?>



<!--======================================================================================
        		FUNCIONALIDADES DEL CODIGO-
====================================================================================== -->
<script>
    var table;
    var items = []; //Se usa para el input de autocompletable
    var itemsClientes = [];
    var itemProducto = 1;

    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        $("#iptCodigoVenta").focus();



        var iptBuscarNitCliente = $("#mdlAgregarCliente").find("#iptBuscarNitCliente");


        /* ======================================================================================
        		EVENTO VACIAR LA TABLA VENTAS, VACIAR EL LISTADO DE LA TABALA VENTAS
        		======================================================================================*/
        $("#btnVaciarListado").on('click', function() {
            vaciarListado();
        })

        //Para bloquear la tecla "tab" en EL INPUT codigoventa para no duplicar productos
        var input = document.getElementById("iptCodigoVenta");
        input.addEventListener("keydown", function(event) {
            if (event.keyCode === 9) {
                event.preventDefault();
            }
        });

        /* ======================================================================================
		EVENTO INICIALIZAR LA TABLA VENTAS
		======================================================================================*/
        table = $('#lstProductosVenta').DataTable({

            scrollX: true,
            order: [
                [0, 'asc']
            ],
            //cambios GDO
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,
            "searching": false,
            fixedColumns: {
                leftColumns: 0, // No se fijan columnas a la izquierda
                rightColumns: 1, // Fija la columna con la clase "columna-fija" a la derecha
            },

            columnDefs: [{
                    //oculte las columnas
                    targets: 0,
                    "data": "id_Item",
                    visible: false,
                },
                {
                    //oculte las columnas
                    targets: 1,
                    "data": "id",
                    visible: false,

                },
                {
                    targets: 2,
                    "data": "codigo_producto",
                },
                {
                    targets: 3,
                    'data': 'foto',
                    'render': function(foto) {
                        var img = foto;
                        return '<img src="vistas/assets/imagenes/' + img + '" height="40px" width="45px" />';
                    }
                },
                {
                    targets: 4,
                    "data": "id_categoria",
                    visible: false
                },
                {
                    targets: 5,
                    "data": "nombre_categoria",
                    visible: false
                },
                {
                    targets: 6,
                    "data": "descripcion_producto",
                },
                {
                    targets: 7,
                    "data": "cantidad",
                    orderable: false,
                    render: function(data, type, row) {
                        // Aquí puedes acceder a los datos de la fila y construir tu HTML
                        return '<input type="number" style="width:80px;" codigo_producto="' + row.codigo_producto + '" class="form-control text-center iptCantidad p-0 m-0" value="' + data + '" step="1" min="0">';
                    }
                },


                {
                    targets: 8,
                    "data": "precio_venta_producto",
                    orderable: false
                },
                {
                    targets: 9,
                    "data": "descuento",
                    orderable: false,
                    render: function(data, type, row) {
                        // Aquí puedes acceder a los datos de la fila y construir tu HTML
                        return '<input type="number" style="width:80px;" codigo_producto="' + row.codigo_producto + '" class="form-control text-center iptDescuento p-0 m-0" value="' + data + '" step="1" min="0">';
                    }
                },
                {
                    targets: 10,
                    "data": "total",
                    orderable: false
                },
                {
                    targets: 11,
                    "data": "acciones",
                },
                {
                    targets: 12,
                    "data": "aplica_peso",
                    visible: false
                },
                {
                    targets: 13,
                    "data": "precio_compra_producto",
                    visible: false

                }

            ],
            "order": [
                [0, 'desc']
            ],

        });


        /* ======================================================================================
		TRAER LISTADO DE PRODUCTOS PARA INPUT DE AUTOCOMPLETADO
        VD 15 MIN 22:10
		======================================================================================*/


        var timeoutId;
        $("#iptCodigoVenta").on('input', function() {
            var codigoVenta = $(this).val();
            //limitar las llamadas ajax cada vez que se teclee
            clearTimeout(timeoutId);

            if (codigoVenta.length >= 2) {
                mostrarLoading();

                timeoutId = setTimeout(function() {


                    $.ajax({
                        async: false,
                        url: "ajax/productos.ajax.php",
                        method: "POST",
                        data: {
                            'accion': 6,
                            'valor': codigoVenta
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                            ocultarLoading();

                            if (respuesta.length === 0) {

                                toastr.warning('- <i class="fa fa-search"></i> SIN RESULTADOS -');


                            }

                            var flexibleResults = respuesta.map(function(item) {
                                return {
                                    label: item.label,
                                    value: item.value,
                                    keywords: item.label.split(" ").map(function(word) {
                                        return word.toLowerCase();
                                    })
                                };
                            });

                            $("#iptCodigoVenta").autocomplete({
                                source: function(request, response) {
                                    var terms = request.term.toLowerCase().split(" ");
                                    var filteredResults = flexibleResults.filter(function(item) {
                                        return terms.every(function(term) {
                                            return item.keywords.some(function(keyword) {
                                                return keyword.includes(term);
                                            });
                                        });
                                    });
                                    response(filteredResults);
                                },
                                select: function(event, ui) {
                                    CargarProductos(ui.item.value);
                                    return false;
                                }
                            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                                return $("<li class='ui-autocomplete-row'></li>")
                                    .data("item.autocomplete", item)
                                    .append(item.label)
                                    .appendTo(ul);
                            };

                            // Limitar el número de elementos que se muestran en la lista de sugerencias
                            $("#iptCodigoVenta").autocomplete("instance")._renderMenu = function(ul, items) {
                                var max = 4; // número máximo de elementos a mostrar
                                var that = this;
                                items = items.slice(0, max);
                                $.each(items, function(index, item) {
                                    that._renderItemData(ul, item);
                                });
                                $(ul).addClass("ui-autocomplete-list");
                            };

                            $("#iptCodigoVenta").autocomplete("widget").css("background", "#fafafa"); // Ejemplo con gris claro
                        }
                    });

                }, 700);

            } else {
                ocultarLoading();
            }
        });



        /* ======================================================================================
		TRAER LISTADO DE CLIENTES
		======================================================================================*/
        $.ajax({
            async: false,
            url: "ajax/clientes.ajax.php",
            method: "POST",
            data: {
                'accion': 2
            },
            dataType: 'json',
            success: function(respuesta) {


                //  console.log(respuesta, "hay respuesta");
                var itemsClientes = []; // Declara la variable 'items' antes del ciclo for
                for (let i = 0; i < respuesta.length; i++) {
                    itemsClientes.push(respuesta[i]['descripcion_cliente']);
                }
                $("#iptBuscarNitCliente").autocomplete({
                    source: itemsClientes,
                    select: function(event, ui) {
                        //console.log("🚀 ~ file: ventas.php ~ line 313 ~ $ ~ ui.item.value", ui.item.value);
                        CargarCliente(ui.item.value);
                        return false;
                    }
                });
            }
        });

        /* ======================================================================================
		REGISTRAR EL PRODUCTO EN LA TABLA CUANDO SE ESCANEE CON BARCODE TO PC AUTOMATICAMANTE
		======================================================================================*/
        $(document).ready(function() {
            $("#iptBuscarNitCliente").on("change keydown", function(e) {
                if (e.type === "change" || e.keyCode === 13) {
                    e.preventDefault();
                    CargarCliente();
                }
            });
        });


        $("#selTipoPago").change(function() {
            var tipo_pago = $("#selTipoPago").val();
            var labeliptEfectivoR = document.querySelector("label[for='iptEfectivoRecibido']");
            var labelchkEfectivoExacto = document.querySelector("label[for='chkEfectivoExacto']");

            if (tipo_pago != 1) {
                document.getElementById("iptEfectivoRecibido").style.visibility = "hidden";
                document.getElementById("chkEfectivoExacto").style.visibility = "hidden";

                labeliptEfectivoR.style.display = "none";
                labelchkEfectivoExacto.style.display = "none";

            } else {

                document.getElementById("iptEfectivoRecibido").style.visibility = "visible";
                document.getElementById("chkEfectivoExacto").style.visibility = "visible";
                labeliptEfectivoR.style.display = "block";
                labelchkEfectivoExacto.style.display = "block";
            }
        });


        /* ======================================================================================
		REGISTRAR EL PRODUCTO EN LA TABLA CUANDO SE ESCANEE CON BARCODE TO PC AUTOMATICAMANTE
		======================================================================================*/
        $("#iptCodigoVenta").change(function() {
            CargarProductos();
        });

        /* ======================================================================================
        EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        ======================================================================================*/
        $('#lstProductosVenta tbody').on('click', '.btnEliminarproducto', function() {
            //se dirija a la table, recupere los datos de la fila con el tr
            table.row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });

        /* ======================================================================================
        EVENTO PARA AUMENTAR LA CANTIDAD DE UN PRODUCTO DEL LISTADO
        ====================================================================================== */
        $('#lstProductosVenta tbody').on('click', '.btnAumentarCantidad', function() {
            let $row = $(this).closest('tr');
            let data = table.row($row).data();
            let idx = table.row($row).index();
            let codigo_producto = data['codigo_producto'];
            let cantidad = parseInt(data['cantidad'], 10);

            const $descuento = $row.find('.iptDescuento');
            // Reiniciar descuento
            $descuento.val(0);
            data['descuento'] = 0;

            $.ajax({
                url: "ajax/productos.ajax.php",
                method: "POST",
                data: {
                    'accion': 8,
                    'codigo_producto': codigo_producto,
                    'cantidad_a_comprar': cantidad,
                    'valor': 3
                },
                dataType: 'json',
                success: function(respuesta) {
                    let $inputCantidad = $row.find('input[codigo_producto="' + codigo_producto + '"]');

                    if (parseInt(respuesta['existe'], 10) === 0) {
                        mensajeToast('warning', 'EL PRODUCTO ' + data['descripcion_producto'] + ' YA NO TIENE EXISTENCIA');
                        $("#iptCodigoVenta").val("");
                    } else {
                        let nuevaCantidad = cantidad + 1;
                        $inputCantidad.val(nuevaCantidad);
                        data['cantidad'] = nuevaCantidad;
                    }

                    let nuevoPrecio = (parseFloat(data['cantidad']) * parseFloat(data['precio_venta_producto'].replace("Q. ", ""))).toFixed(2);
                    table.cell(idx, 10).data("Q. " + nuevoPrecio);
                    table.row(idx).data(data).draw(false);

                    recalcularTotales();
                }
            });
        });

        /* ======================================================================================
        EVENTO PARA DISMINUIR LA CANTIDAD DE UN PRODUCTO DEL LISTADO
        ======================================================================================*/
        $('#lstProductosVenta tbody').on('click', '.btnDisminuirCantidad', function() {
            let $row = $(this).closest('tr');
            let data = table.row($row).data();
            let idx = table.row($row).index();
            let codigo_producto = data['codigo_producto'];

            let $inputCantidad = $row.find('input[codigo_producto="' + codigo_producto + '"]');
            let cantidad = parseInt($inputCantidad.val(), 10);

            const $descuento = $row.find('.iptDescuento');
            // Reiniciar descuento
            $descuento.val(0);
            data['descuento'] = 0;

            if (cantidad >= 2) {
                let nuevaCantidad = cantidad - 1;
                $inputCantidad.val(nuevaCantidad);
                data['cantidad'] = nuevaCantidad;
            } else {
                mensajeToast('warning', 'YA NO PUEDES DISMINUIR EL STOCK');
            }

            let NuevoPrecio = (parseFloat(data['cantidad']) * parseFloat(data['precio_venta_producto'].replace(/Q\.\s*/, ""))).toFixed(2);
            table.cell(idx, 10).data("Q. " + NuevoPrecio);
            table.row(idx).data(data).draw(false);

            recalcularTotales();
        });


        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DE VENTA DEL PRODUCTO
        ======================================================================================*/
        $('#lstProductosVenta tbody').on('click', '.dropdown-item', function() {

            codigo_producto = $(this).attr("codigo");
            precio_venta = parseFloat($(this).attr("precio").replaceAll("Q. ", "")).toFixed(2);

            recalcularMontos(codigo_producto, precio_venta);
        });

        /* =======================================================================================
        EVENTO QUE PERMITE CHECKEAR EL EFECTIVO CUANDO ES EXACTO
        =========================================================================================*/
        $("#chkEfectivoExacto").change(function() {

            if ($("#chkEfectivoExacto").is(':checked')) {

                var vuelto = 0;
                var totalVenta = $("#totalVenta").html();

                $("#iptEfectivoRecibido").val(totalVenta);

                $("#EfectivoEntregado").html(totalVenta);

                var EfectivoRecibido = parseFloat($("#EfectivoEntregado").html().replace("Q. ", ""));

                vuelto = parseFloat(totalVenta) - parseFloat(EfectivoRecibido);

                $("#Vuelto").html(vuelto.toFixed(2));

            } else {

                $("#iptEfectivoRecibido").val("")
                $("#EfectivoEntregado").html("0.00");
                $("#Vuelto").html("0.00");

            }
        });

        /* ======================================================================================
        EVENTO QUE SE DISPARA AL DIGITAR EL MONTO EN EFECTIVO ENTREGADO POR EL CLIENTE
        =========================================================================================*/
        $("#iptEfectivoRecibido").keyup(function() {
            actualizarVuelto();
        });


        /* ======================================================================================
        EVENTO PARA INICIAR EL REGISTRO DE LA VENTA
        =========================================================================================*/

        $("#btnIniciarVenta").on('click', function() {
            realizarVenta();
        });


        /* ======================================================================================
        EVENTO CLIENTE
        =========================================================================================*/
        $("#btnAgregarNuevoCliente").on('click', function() {

            $("#mdlAgregarCliente").modal('show'); //MOSTRAR VENTANA MODAL
        });





    }) //FIN DOCUMENT READY






    /*============================================================================================================================================ */
    //FUNCIONES
    /*===========================================================================================================================================*/



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
    //FUNCION PARA LIMPIAR TOTOTALMENTE LA TABLA DE VENTAS 
    /*===================================================================*/
    function vaciarListado() {
        table.clear().draw();
        LimpiarInputs();
    }

    /*===================================================================*/
    //FUNCION PARA LIMPIAR TODOS LOS INPUTS DE MI PAGINA VENTAS 
    /*===================================================================*/

    function LimpiarInputs() {
        $("#totalVenta").html("0.00");
        $("#totalVentaRegistrar").html("0.00");
        $("#iptEfectivoRecibido").val("");
        $("#Vuelto").html("0.00");
        $("#EfectivoEntregado").html("0.00");
        $("#chkEfectivoExacto").prop('checked', false);
        $("#boleta_subtotal").html("0.00");
        $("#boleta_total").html("0.00");
        $("#boleta_iva").html("0.00");
        $("#selTipoPago").val("");
        $("#iptBuscarNitCliente").val("");
        $("#iptIdNitCliente").val("");
        $("#iptIdNombreCliente").val("");

    }


    function LimpiarInputsModal() {
        $("#iptNitCliente").val("");
        $("#iptNombreClienteModal").val("");
        $("#iptNumeroTel").val("");
        $("#iptCorreoElectronico").val("");
        $("#iptDireccionCliente").val("");
        $("#iptNotas").val("");

        $("#iptBuscarNitCliente").val("");


    }

    /*===================================================================*/
    //FUNCION PARA ACTUALIZAR EL VUELTO DE LA VENTA 
    /*===================================================================*/
    function actualizarVuelto() {

        var totalVenta = $("#totalVenta").html();

        //DESMARCAMOS EL CHECK YA QUE NO SE ESTA USANDO
        $("#chkEfectivoExacto").prop('checked', false);

        var efectivoRecibido = $("#iptEfectivoRecibido").val();

        if (efectivoRecibido > 0) {

            $("#EfectivoEntregado").html(parseFloat(efectivoRecibido).toFixed(2));

            vuelto = parseFloat(efectivoRecibido) - parseFloat(totalVenta);

            $("#Vuelto").html(vuelto.toFixed(2));

        } else {

            $("#EfectivoEntregado").html("0.00");
            $("#Vuelto").html("0.00");

        }
    }

    function recalcularMontos(codigo_producto, precio_venta) {

        table.rows().eq(0).each(function(index) {

            var row = table.row(index);

            var data = row.data();

            if (data['codigo_producto'] == codigo_producto) {

                // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                table.cell(index, 8).data("Q. " + parseFloat(precio_venta).toFixed(2)).draw();

                // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE VENTA
                NuevoPrecio = (parseFloat(data['cantidad']) * data['precio_venta_producto'].replaceAll("Q. ", "")).toFixed(2);
                NuevoPrecio = "Q. " + NuevoPrecio;
                table.cell(index, 10).data(NuevoPrecio).draw();

            }


        });

        // RECALCULAMOS TOTALES
        recalcularTotales();

    }


    /*===================================================================*/
    //FUNCION PARA CARGAR RECALCULAR TODOS LOS TOTALES TANTO DE LA TABLA COMO EN LA PESTA:A 
    /*===================================================================*/

    function recalcularTotales() {

        var TotalVenta = 0.00;

        table.rows().eq(0).each(function(index) {

            var row = table.row(index);
            var data = row.data();

            TotalVenta = parseFloat(TotalVenta) + parseFloat(data['total'].replace("Q. ", ""));

        });

        $("#totalVenta").html("");
        $("#totalVenta").html(TotalVenta.toFixed(2));

        var totalVenta = $("#totalVenta").html();
        var iva = parseFloat(totalVenta) * 0.12
        var subtotal = parseFloat(totalVenta) - parseFloat(iva);

        $("#totalVentaRegistrar").html(totalVenta);

        $("#boleta_subtotal").html(parseFloat(subtotal).toFixed(2));
        $("#boleta_iva").html(parseFloat(iva).toFixed(2));
        $("#boleta_total").html(parseFloat(totalVenta).toFixed(2));

        //LIMPIAMOS LOS INPUTS DE EFECTIVO EXACTO, DESMARCAMOS EL CHECK DE EFECTIVO EXACTO
        //BORRAMOS LOS DATOS DE EFECTIVO ENTREGADO Y VUELTO
        $("#iptEfectivoRecibido").val("");
        $("#chkEfectivoExacto").prop('checked', false);
        $("#EfectivoEntregado").html("0.00");
        $("#Vuelto").html("0.00");


        $("#iptCodigoVenta").val("");
        //    $("#iptCodigoVenta").focus();
    }

    /*===================================================================*/
    //FUNCION PARA CARGAR PRODUCTOS EN EL DATATABLE
    /*===================================================================*/

    function CargarProductos(producto = "") {


        if (producto != "") {
            var codigo_producto = producto;

        } else {
            var codigo_producto = $("#iptCodigoVenta").val();
        }


        //console.log("🚀 ~ file: ventas.php ~ line 335 ~ CargarProductos ~ codigo_producto", codigo_producto)

        var producto_repetido = 0;
        //  var codigo_repetido = 0;

        /*===================================================================*/
        // AUMENTAMOS LA CANTIDAD SI EL PRODUCTO YA EXISTE EN EL LISTADO
        /*===================================================================*/
        table.rows().eq(0).each(function(index) {

            var row = table.row(index);
            var data = row.data();

            var codigo_producto_primero = codigo_producto.split(' ')[0];


            if (codigo_producto_primero == data['codigo_producto']) { //si el codigo ya existe...


                producto_repetido = 1;

                $.ajax({
                    async: false,
                    url: "ajax/productos.ajax.php",
                    method: "POST",
                    data: {
                        'accion': 8,
                        'codigo_producto': data['codigo_producto'],
                        'cantidad_a_comprar': data['cantidad'],
                        'valor': 2

                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        //  console.log(respuesta, "estok")

                        //si la respuesta del stock es 0 es porque ya no hay productos en existencia
                        if (parseInt(respuesta['existe']) == 0) {

                            mensajeToast('warning', 'EL PRODUCTO ' + data['descripcion_producto'] + ' YA NO TIENE EXISTENCIA');

                            $("#iptCodigoVenta").val("");

                            recalcularTotales();

                        } else {
                            mensajeToast('info', 'EL PRODUCTO "' + data['descripcion_producto'] + '" YA ESTA EN EL LISTADO');
                            recalcularTotales();
                        }
                    }
                });

            }
        });

        //SI LA RESPUESTA ES 1 (VERDADERO) RETORNA SI ES 0 CONTINUA CON
        if (producto_repetido == 1) {
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

                //     console.log(respuesta);

                /*===================================================================*/
                //SI LA RESPUESTA ES VERDADERO, TRAE ALGUN DATO
                /*===================================================================*/
                if (respuesta) {

                    var TotalVenta = 0.00;

                    if (respuesta['aplica_peso'] == 1) {

                        table.row.add({
                            'id_Item': itemProducto,
                            'id': respuesta['id'],
                            'codigo_producto': respuesta['codigo_producto'],
                            'foto': respuesta['foto'],
                            'id_categoria': respuesta['id_categoria'],
                            'nombre_categoria': respuesta['nombre_categoria'],
                            'descripcion_producto': respuesta['descripcion_producto'],
                            'cantidad': respuesta['cantidad'] + ' Kg(s)',
                            'precio_venta_producto': respuesta['precio_venta_producto'],
                            'descuento': respuesta['descuento'],
                            'total': respuesta['total'],
                            'acciones': "<center>" +
                                "<span class='btnIngresarPeso text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Aumentar Stock'> " +
                                "<i class='fas fa-balance-scale fs-5'></i> " +
                                "</span> " +
                                "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                                "<i class='fas fa-trash fs-5'> </i> " +
                                "</span>" +

                                "</center>",
                            'aplica_peso': respuesta['aplica_peso'],
                            'precio_compra_producto': respuesta['precio_compra_producto'],
                            'precio_compra_producto': respuesta['precio_compra_producto'],

                        }).draw();

                        itemProducto = itemProducto + 1;

                    } else {


                        table.row.add({
                            'id_Item': itemProducto,
                            'id': respuesta['id'],
                            'codigo_producto': respuesta['codigo_producto'],
                            'foto': respuesta['foto'],
                            'id_categoria': respuesta['id_categoria'],
                            'nombre_categoria': respuesta['nombre_categoria'],
                            'descripcion_producto': respuesta['descripcion_producto'],
                            'cantidad': respuesta['cantidad'],
                            'precio_venta_producto': respuesta['precio_venta_producto'],
                            'descuento': respuesta['descuento'],
                            'total': respuesta['total'],
                            'acciones': "<center>" +
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
                            'aplica_peso': respuesta['aplica_peso'],
                            'precio_compra_producto': respuesta['precio_compra_producto'],

                            /*  'precio_mayor_producto': respuesta['precio_mayor_producto'],
		                    'precio_oferta_producto': respuesta['precio_oferta_producto'] */
                        }).draw();

                        itemProducto = itemProducto + 1;

                    }


                    recalcularTotales();
                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {

                    mensajeToast('warning', 'EL PRODUCTO NO EXISTE O YA NO TIENE EXISTENCIA');

                    $("#iptCodigoVenta").val("");
                    //     $("#iptCodigoVenta").focus();

                }

            }
        });





        /* ======================================================================================
        EVENTO PARA MODIFICAR LA CANTIDAD DE PRODUCTOS A COMPRAR
        ======================================================================================*/
        $('#lstProductosVenta tbody').on('change', '.iptCantidad', function() {
            const $input = $(this);
            const valor = parseFloat($input.val());
            const $row = $input.closest('tr');
            const data = table.row($row).data();

            const precio_actual = parseFloat(data['precio_venta_producto'].replace("Q. ", ""));
            const $descuento = $row.find('.iptDescuento');

            // Reiniciar descuento
            $descuento.val(0);
            data['descuento'] = 0;

            // Validar si el valor es numérico, mayor a 0 y entero positivo
            if (isNaN(valor) || valor <= 0) {
                mensajeToast('error', 'INGRESE UN VALOR NUMERICO Y MAYOR A 0');
                $input.val(1).focus();
                data['cantidad'] = 1;
            } else if (valor % 1 !== 0) {
                mensajeToast('error', 'NO DECIMALES ...');
                $input.val(1);
                data['cantidad'] = 1;
            } else {
                data['cantidad'] = valor;
            }

            // Actualizar el precio en la tabla
            const nuevo_precio = (data['cantidad'] * precio_actual).toFixed(2);
            table.cell($row, 10).data("Q. " + nuevo_precio).draw();

            // Recalcular totales
            recalcularTotales();

            // Verificar existencia del producto
            const codigo_producto = data['codigo_producto'];

            $.ajax({
                url: "ajax/productos.ajax.php",
                method: "POST",
                data: {
                    accion: 8,
                    codigo_producto: codigo_producto,
                    cantidad_a_comprar: data['cantidad'],
                    valor: 2
                },
                dataType: 'json',
                success: function(respuesta) {
                    if (parseInt(respuesta['existe']) === 0) {
                        mensajeToast('warning', 'EL PRODUCTO ' + data['descripcion_producto'] + ' YA NO TIENE EXISTENCIA');
                        $input.val(1).focus();
                        data['cantidad'] = 1;
                    }

                    const nuevo_precio_actualizado = (data['cantidad'] * precio_actual).toFixed(2);
                    table.cell($row, 10).data("Q. " + nuevo_precio_actualizado).draw();
                    recalcularTotales(); // Recalcular totales
                    table.row($row).data(data).invalidate().draw(); // Actualiza y redibuja la fila
                }
            });
        });



        /* ======================================================================================
        EVENTO PARA MODIFICAR  EL INPUT DE DESCUENTO
        ======================================================================================*/
        $('#lstProductosVenta tbody').on('change', '.iptDescuento', function() {
            const $input = $(this);
            const $row = $input.closest('tr');
            const data = table.row($row).data();

            let cantidad_descuento = parseFloat($input.val());
            const precio_actual = parseFloat(data['precio_venta_producto'].replace("Q. ", ""));
            const cantidad_actual = data['cantidad'];
            const total_venta = precio_actual * cantidad_actual;
            const precio_columna_index = 10;

            // Validar si el valor es numérico, mayor a 0, y no supera el total de la venta
            if (isNaN(cantidad_descuento) || cantidad_descuento < 0 || cantidad_descuento > total_venta) {
                cantidad_descuento = 0;
                $input.val(0).focus();
                mensajeToast('error', 'Dato no válido');
            }

            // Actualizar el descuento y el precio
            data['descuento'] = cantidad_descuento;
            let nuevo_precio = (cantidad_actual * precio_actual - cantidad_descuento).toFixed(2);

            // Verificar si el nuevo precio es negativo
            if (nuevo_precio < 0) {
                nuevo_precio = (cantidad_actual * precio_actual).toFixed(2);
                $input.val(0).focus();
                data['descuento'] = 0;
                mensajeToast('info', 'No se puede descontar más');
            }

            // Actualizar el precio en la tabla
            table.cell($row, precio_columna_index).data("Q. " + nuevo_precio).draw();

            // Recalcular los totales
            recalcularTotales();
        });


    } /* FIN CargarProductos */




    function CargarCliente(cliente = "") {
        var iptBuscarNitCliente = $("#iptBuscarNitCliente").val();
        var iptNombreClienteModal = $("#iptNombreClienteModal").val(); // Agregar el símbolo "#" antes de "iptNombreClienteModal"

        var nit_cliente;


        if (cliente != "") {
            nit_cliente = cliente;
        } else {
            nit_cliente = $("#iptBuscarNitCliente").val();
        }

        $.ajax({
            url: "ajax/clientes.ajax.php",
            method: "POST",
            data: {
                'accion': 3,
                'nit_cliente': nit_cliente
            },
            dataType: 'json',
            success: function(respuesta) {

                // console.log(respuesta);
                var id_cliente = respuesta['id_cliente'];
                var iptIdNombreCliente = respuesta['nombre_cliente'];

                if (!respuesta) {
                    var forms = document.getElementsByClassName('needs-validation-iptBuscarNitCliente');
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        var iptBuscarNitCliente = $("#iptBuscarNitCliente").val();
                        var regex = /[a-zA-Z]/; // Expresión regular para letras

                        if (regex.test(iptBuscarNitCliente)) {
                            mensajeToast('error', 'CAMPOS INCORRECTOS');
                            $("#iptBuscarNitCliente").val("");
                        } else if (form.checkValidity() === true) {
                            mensajeToast('info', 'NO EXISTE EL CLIENTE, AGREGALO');
                            $("#mdlAgregarCliente").modal('show');
                            $("#iptNitCliente").val(iptBuscarNitCliente);
                            $("#mdlAgregarCliente").on("shown.bs.modal", function() {
                                $("#iptNombreClienteModal").focus();
                            });
                            document.getElementById("btnGuardarCliente").addEventListener("click", agregarCliente);
                        } else {
                            mensajeToast('error', 'CAMPOS INCORRECTOS');
                        }
                    });
                } else {
                    $(".needs-validation").removeClass("was-validated");
                    // Para mostrar el campo
                    $("#iptIdNombreCliente").css("display", "block");
                    $("#iptBuscarNitCliente").val("");
                    $("#iptIdNitCliente").val(id_cliente);
                    $("#iptIdNombreCliente").val(iptIdNombreCliente);

                    //console.log("existe cliente", id_cliente);
                }
            }
        });
    }



    function agregarCliente() {

        var id_cliente = $("#iptIdNitCliente").val();

        var iptNombreClienteModal = $("#iptNombreClienteModal").val();

        var accion = 1;

        var forms = document.getElementsByClassName('needs-validation-modal');

        var validation = Array.prototype.filter.call(forms, function(form) {
            if (form.checkValidity() === true) {
                Swal.fire({
                    title: '¿ESTÁ SEGURO DE REGISTRA AL CLIENTE?',
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
                        datos.append("nit_cliente", $("#iptNitCliente").val());
                        datos.append("nombre_cliente", $("#iptNombreClienteModal").val());
                        datos.append("telefono", $("#iptNumeroTel").val());
                        datos.append("correo_e", $("#iptCorreoElectronico").val());
                        datos.append("direccion", $("#iptDireccionCliente").val());
                        datos.append("notas", $("#iptNotas").val());

                        if (accion == 1) {
                            var titulo_msj = "SE REGISTRÓ CORRECTAMENTE EL CLIENTE"
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
                                if (respuesta > 0) {
                                    $("#iptIdNitCliente").val(respuesta);
                                    $("#iptIdNombreCliente").css("display", "block");
                                    $("#iptIdNombreCliente").val(iptNombreClienteModal);

                                    mensajeToast('success', titulo_msj);
                                    $("#mdlAgregarCliente").modal('hide');
                                    LimpiarInputsModal();
                                    $(".needs-validation-modal").removeClass("was-validated");

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


    /*===================================================================*/
    //REALIZAR LA VENTA
    /*===================================================================*/
    function realizarVenta() {

        var count = 0;
        var totalVenta = $("#totalVenta").html();
        var btnRealizarVenta = document.getElementById("btnIniciarVenta");

        var tipo_pago = $("#selTipoPago").val();

        var efectivo_recibido = $("#iptEfectivoRecibido").val();

        table.rows().eq(0).each(function(index) { //recorremos los datos que tiene la tabla ventas
            count = count + 1; // reccoriendo de 1 a 1 y sumando 
        });

        //si la cantidad es mayor a 0 quiere decir que si hay productos por lo que procede a realizar la venta
        if (count > 0) {


            if (tipo_pago == 1) {

                if (efectivo_recibido == "") {

                    mensajeToast('warning', 'INGRESE EL MONTO EN EFECTIVO');
                    return false;
                } else if (efectivo_recibido < parseFloat(totalVenta)) {
                    mensajeToast('warning', 'EL EFECTIVO ES MENOR AL COSTO TOTAL DE LA VENTA');
                    return false;
                } else {
                    var forms = document.getElementsByClassName('needs-validation');

                    var validation = Array.prototype.filter.call(forms, function(form) {

                        if (form.checkValidity() === true) {
                            btnRealizarVenta.disabled = true;
                            mostrarLoading();

                            var formData = new FormData();
                            var arr = [];

                            var datos = new FormData();
                            var datos = new FormData();

                            table.rows().eq(0).each(function(index) {

                                var row = table.row(index);
                                var data = row.data();

                                var tipo_pago = $("#selTipoPago").val();
                                var id_cliente = $("#iptIdNitCliente").val();

                                if (id_cliente == "") {
                                    id_cliente = 1;
                                }

                                arr[index] = data['codigo_producto'] + "," +
                                    data['id_categoria'] + "," +
                                    data['id'] + "," +
                                    parseFloat(data['cantidad']) + "," +
                                    data['precio_venta_producto'].replace("Q. ", "") + "," +
                                    parseFloat(data['descuento']) + "," +
                                    data['total'].replace("Q. ", "") + "," +
                                    data['precio_compra_producto'] + "," +
                                    tipo_pago + "," +
                                    id_cliente + "," +
                                    data['descripcion_producto'];

                                formData.append('arr[]', arr[index]);
                            });


                            $.ajax({
                                url: "ajax/ventas.ajax.php",
                                method: "POST",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    var venta = 0;

                                    if (respuesta.length === 19) {

                                        mensajeToast('success', 'VENTA REGISTRADA CORRECTAMENTE');
                                        $(".needs-validation").removeClass("was-validated");



                                        Swal.fire({
                                            title: 'GENERAR DOCUMENTO',
                                            icon: 'success',
                                            showCancelButton: true,
                                            showDenyButton: true, // Muestra el botón Deny
                                            confirmButtonColor: '#f69a10',
                                            cancelButtonColor: '#b21807',
                                            denyButtonColor: '#057581', // Color para el botón Deny
                                            confirmButtonText: 'Generar PDF',
                                            cancelButtonText: 'Cancelar',
                                            denyButtonText: 'Generar Ticket',
                                        }).then((result) => {
                                            if (result.isConfirmed) {

                                                window.open('https://pvtecnet.com/tecnet/vistas/generar_pdf.php?fecha_venta=' + respuesta);
                                            } else if (result.isDenied) {
                                                // Acción para generar el Ticket
                                                window.open('https://pvtecnet.com/tecnet/vistas/generar_ticket.php?fecha_venta=' + respuesta);
                                            }
                                        });




                                    } else {
                                        $.ajax({
                                            url: "vistas/enviar_correo.php",
                                            type: "POST",
                                            data: {
                                                respuesta: respuesta
                                            },
                                            success: function(respuesta) {
                                                console.log("Correo enviado correctamente.");
                                            },
                                            error: function() {
                                                console.log("Error al enviar el correo.");
                                            }
                                        });

                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'ERROR AL REGISTRAR LA VENTA ' + '\n' +
                                                ' comunicate con tu administrador',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });

                                    }
                                    table.clear().draw();
                                    // Habilitar el botón después de que se complete la acción
                                    btnRealizarVenta.disabled = false;
                                    LimpiarInputs();
                                    $("#iptIdNombreCliente").css("display", "none");
                                    ocultarLoading();


                                }
                            });



                        } else {
                            //me solicita que tengo que ingresar los campos 
                            form.classList.add('was-validated');
                        }
                    })


                }
            } else if (tipo_pago > 1) {
                // Obtener los formularios a los que queremos agregar estilos de validación
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {

                    if (form.checkValidity() === true) {
                        btnRealizarVenta.disabled = true;
                        mostrarLoading();

                        //ENVIAMOS LOS VALORES A LA BASE DE DATOS
                        var formData = new FormData();
                        var arr = [];
                        //agregamos datos para almacenar el tipo de pago
                        var datos = new FormData();

                        //capturamos los valores para llevar a la base de datos

                        // $tipo_pago = $("#selTipoPago").val();
                        var datos = new FormData();

                        //recorremos la tabla
                        table.rows().eq(0).each(function(index) {

                            var row = table.row(index);
                            var data = row.data();
                            //agregame a mi array 

                            var tipo_pago = $("#selTipoPago").val();
                            var id_cliente = $("#iptIdNitCliente").val();

                            if (id_cliente == "") {
                                id_cliente = 1;
                            }


                            arr[index] = data['codigo_producto'] + "," +
                                data['id_categoria'] + "," +
                                data['id'] + "," +
                                parseFloat(data['cantidad']) + "," +
                                data['precio_venta_producto'].replace("Q. ", "") + "," +
                                parseFloat(data['descuento']) + "," +
                                data['total'].replace("Q. ", "") + "," +
                                data['precio_compra_producto'] + "," +
                                tipo_pago + "," +
                                id_cliente + "," +
                                data['descripcion_producto'];

                            formData.append('arr[]', arr[index]);
                        });


                        $.ajax({
                            url: "ajax/ventas.ajax.php",
                            method: "POST",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {
                                var venta = 0;

                                if (respuesta.length === 19) {

                                    mensajeToast('success', 'VENTA REGISTRADA CORRECTAMENTE');
                                    $(".needs-validation").removeClass("was-validated");



                                    Swal.fire({
                                        title: 'GENERAR DOCUMENTO',
                                        icon: 'success',
                                        showCancelButton: true,
                                        showDenyButton: true, // Muestra el botón Deny
                                        confirmButtonColor: '#f69a10',
                                        cancelButtonColor: '#b21807',
                                        denyButtonColor: '#057581', // Color para el botón Deny
                                        confirmButtonText: 'Generar PDF',
                                        cancelButtonText: 'Cancelar',
                                        denyButtonText: 'Generar Ticket',
                                    }).then((result) => {
                                        if (result.isConfirmed) {

                                            window.open('https://pvtecnet.com/tecnet/vistas/generar_pdf.php?fecha_venta=' + respuesta);
                                        } else if (result.isDenied) {
                                            // Acción para generar el Ticket
                                            window.open('https://pvtecnet.com/tecnet/vistas/generar_ticket.php?fecha_venta=' + respuesta);
                                        }
                                    });





                                } else {
                                    $.ajax({
                                        url: "vistas/enviar_correo.php",
                                        type: "POST",
                                        data: {
                                            respuesta: respuesta
                                        },
                                        success: function(respuesta) {
                                            console.log("Correo enviado correctamente.");
                                        },
                                        error: function() {
                                            console.log("Error al enviar el correo.");
                                        }
                                    });

                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'ERROR AL REGISTRAR LA VENTA ' + '\n' +
                                            ' comunicate con tu administrador',
                                        showConfirmButton: false,
                                        timer: 2500
                                    });

                                }
                                table.clear().draw();
                                // Habilitar el botón después de que se complete la acción
                                btnRealizarVenta.disabled = false;
                                LimpiarInputs();
                                $("#iptIdNombreCliente").css("display", "none");
                                ocultarLoading();


                            }
                        });



                    } else {
                        //me solicita que tengo que ingresar los campos 
                        form.classList.add('was-validated');
                    }
                });
            } else {
                mensajeToast('warning', 'INGRESE EL TIPO DE PAGO');
            }

        } else {

            mensajeToast('warning', 'NO HAY PRODUCTOS EN EL LISTADO');

            //    $("#iptCodigoVenta").focus();

            // Mostrar un mensaje de Toastr con acción al hacer clic
            toastr.info('?QUIERES REPORTAR VENTAS 0¿', 'Mensaje con acción', {
                onclick: function() {
                    Swal.fire({
                        title: '¿QUIERES REPORTAR VENTA DEL DIA = 0?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar!',
                    }).then((result) => {
                        if (result.isConfirmed) {

                            mostrarLoading();
                            var accion = 2;

                            var cantidad = 0;
                            var precio_venta = 0;
                            var descuento = 0;
                            var total = 0;
                            var precio_compra = 0;
                            var id_tipo_pago = 5;

                            var datos = new FormData();

                            datos.append("accion", accion);
                            datos.append("cantidad", cantidad);
                            datos.append("precio_venta", precio_venta);
                            datos.append("descuento", descuento);
                            datos.append("total", total);
                            datos.append("precio_compra", precio_compra);
                            datos.append("id_tipo_pago", id_tipo_pago);


                            $.ajax({
                                url: "ajax/ventas.ajax.php",
                                method: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    //console.log(respuesta);
                                    if (respuesta == "ok") {
                                        mensajeToast('success', 'VENTA REGISTRADA CORRECTAMENTE');
                                        $(".needs-validation").removeClass("was-validated");
                                    } else if (respuesta == "error_ya_registros") {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'info',
                                            title: 'YA HAY VENTA REGISTRADA :)',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });
                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'ERROR AL REGISTRAR LA VENTA ' + '\n' +
                                                ' comunicate con tu administrador',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });

                                    }

                                    // Habilitar el botón después de que se complete la acción
                                    btnRealizarVenta.disabled = false;
                                    LimpiarInputs();
                                    ocultarLoading();
                                    $("#iptIdNombreCliente").css("display", "none");


                                }
                            });
                        } else {
                            return;
                        }


                    });
                }
            });

        }
    } /* FIN realizarVenta */
</script>