<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">INVENTARIO ACTUAL</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>

                    <li class="breadcrumb-item active">INVENTARIO</li>
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
        <div class="col-md-12">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-list-alt"></i>INVENTARIO ACTUAL</h3>
                </div>
                <div class="card-body">
                    <table id="tbl_Inventario_Actual" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="mi_card_info text-left">
                            <th>CODIGO PRODUCTO</th>
                            <th>IMAGEN</th>
                            <th>CATEGORIA</th>
                            <th>NOMBRE</th>
                            <th>EXISTENCIA ACTUAL</th>
                            <th>PRECIO VENTA</th>
                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>








<div class="modal fade" id="mdlEditarFoto" role="dialog">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <!-- contenido del modal -->
        <div class="modal-content ">

            <!-- cabecera del modal -->
            <div class="modal-header mi_card_info py-1 text-center">
                <h5 class="text-center fw-bold">EDITAR FOTO</h5>
                <button type="button" class="btn btn-outline-light fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>


            <div class="col-12 col-lg-6" style="display: none;">
                <div class="form-group mb-2">
                    <label class="" for="iptCodigoReg"><i class="fas fa-barcode fs-6"></i>
                        <span class="small">CODIGO DEL PRODUCTO</span><span class="text-danger">*</span>
                    </label>

                    <input type="text" style="border: 1px solid #66B3FF" class="form-control form-control-sm" id="iptCodigoReg" name="iptCodigoReg" placeholder="Código de Barras" required>
                    <div class="invalid-feedback">Debe ingresar el codigo de barras</div>
                </div>
            </div>


            <!-- *************************** CUERPO DE LA VENTANA ******************** -->
            <div class="modal-body">

                <form method="POST" enctype="multipart/form-data" id="form_cargar_imagen">

                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro SALIDA DE DINERO -->
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
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-block mt-3" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-block mt-3" id="btnGuardarFoto">Aceptar</button>
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
    var tbl_Inventario_Actual;
    var id_Usuario = 0;
    var accion;

    $(document).ready(function() {

        cargarDataTables();
        ajustarHeadersDataTables($('#tbl_Inventario_Actual'));




        /*===================================================================
        =====================================================================
                                             EVENTOS
        =====================================================================
        ====================================================================*/


        $('#tbl_Inventario_Actual tbody').on('click', '.btnEditarFoto', function() {

            accion = 11; //seteamos la accion para editar

            $("#mdlEditarFoto").modal('show');

            var data = tbl_Inventario_Actual.row($(this).parents('tr')).data();
            var datos = new FormData();

            /*se definen estas variables para enviar el parametro $name, para que en el llamado .ajax, 
             se reconozca y se pueda realizar la condicion if si no se agrega imagen, igual al momento de editar */
            $img = $("#imagen");
            $name = $('name');

            $("#iptCodigoReg").val(data["codigo_producto"]);


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



        })


    }) //FIN DOCUMEN READY


    /*===================================================================
    =====================================================================
     FUNCIONES
    ===================================================================
    ===================================================================*/




    function LimpiarInputsVentanaModal() {

        $("#iptCodigoReg").val("");

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



    /*===================================================================
    CARGAR DATATABLES 
    ===================================================================*/
    function cargarDataTables() {

        //DATA TABLE USUARIOS
        tbl_Inventario_Actual = $('#tbl_Inventario_Actual').DataTable({
            ajax: {
                async: false,
                url: 'ajax/productos.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: "",
                data: {
                    accion: 10
                }
            },
            //ajustable 
            scrollX: true,
            dom: 'Bfrtip',
            paging: true, // Habilita la paginación
            "scrollY": "500px", //altura de la tabla visible
            "deferRender": true, //habilita la opción de Lazy Loading
            "scrollCollapse": true,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    targets: 0,
                    'data': 'codigo_producto',
                },
                {
                    targets: 1,
                    data: 'foto',
                    "className": "dt-center",
                    render: function(foto) {
                        if (!foto) {
                            return 'N/A';
                        } else {
                            var img = foto;
                            var html = '<img class="imagen-agrandable" src="vistas/assets/imagenes/' + img + '" height="40px" width="40px" />';
                            html += '<span class="btnEditarFoto text-primary px-1" style="cursor:pointer;">';
                            html += '<i class="fas fa-pencil-alt fs-5"></i>';
                            html += '</span>';
                            return "<center>" + html;
                        }
                    }
                },

                {
                    targets: 2,
                    'data': 'nombre_categoria',
                    "className": "dt-center",
                },
                {
                    targets: 3,
                    'data': 'descripcion_producto',
                    "className": "dt-center",
                },
                {
                    targets: 4,
                    'data': 'stock_producto',
                    "className": "dt-center",
                },
                {
                    targets: 5,
                    'data': 'precio_venta_producto',
                    "className": "dt-center",
                },


            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    }




    $('#tbl_Inventario_Actual tbody').on('click', 'img.imagen-agrandable', function() {
        var img = $(this);
        if (img.hasClass('imagen-agrandada')) {
            img.removeClass('imagen-agrandada');
        } else {
            img.addClass('imagen-agrandada');
        }


    });




    /*===================================================================*/
    //EVENTO QUE GUARDA LOS DATOS DEL PRODUCTO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
    /*===================================================================*/
    document.getElementById("btnGuardarFoto").addEventListener("click", function() {


        $name = $('name');

        Swal.fire({
            title: '¿ESTÁ SEGURO DE REGISTRAR LA FOTO?',
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
                datos.append("name", $name);


                if (accion == 11) {
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

                            tbl_Inventario_Actual.ajax.reload();

                            $("#mdlEditarFoto").modal('hide');
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



    });



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
</script>



<!-- /.content -->