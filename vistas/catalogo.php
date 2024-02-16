<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">CATALOGO</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>

                    <li class="breadcrumb-item active">CATALOGO</li>
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
                    <h3 class="card-title"><i class="far fa-list-alt"></i> PROMOCIONES Y PUBLICIDAD</h3>
                    <br>
                    <button class="btn-success" id="btnAgregarSlider">AGREGAR SLIDER</button>
                </div>
                <div class="card-body">
                    <table id="tbl_Catalogo" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="mi_card_info text-left">
                            <th>id</th>
                            <th>Foto</th>
                            <th>Descripcion</th>
                            <th class="text-center">Opciones</th>

                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
</div>



<div class="modal fade" id="mdlAgregarSlider" role="dialog">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <!-- contenido del modal -->
        <div class="modal-content ">

            <!-- cabecera del modal -->
            <div class="modal-header mi_card_info py-1 text-center">
                <h5 class="text-center fw-bold">NUEVO SLIDER</h5>
                <button type="button" class="btn btn-outline-light fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
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


                        <!-- Columna para registro de la descripción del producto -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <b-field expanded label class="" for="iptDescripcionSlider"><i class="fas fa-file-signature fs-6"></i> <span class="small">Descripción</span><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="iptDescripcionSlider" name="iptDescripcionSlider" placeholder="Descripción" maxlength="44" required>



                            </div>
                        </div>

                        <!-- creacion de botones para cancelar y guardar el producto -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-block mt-3" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-block mt-3" id="btnGuardarSlider">Aceptar</button>
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
    var accion;
    $(document).ready(function() {


        cargarDataTables();
        ajustarHeadersDataTables($('#tbl_Catalogo'));


        $('#btnAgregarSlider').on('click', function() {
            $('#mdlAgregarSlider').modal('show');

            $(".needs-validation").removeClass("was-validated");
        });



        /*===================================================================*/
        //EVENTO QUE GUARDA LOS DATOS DEL PRODUCTO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
        /*===================================================================*/
        document.getElementById("btnGuardarSlider").addEventListener("click", function() {

            var $name = $('name');
            accion = 2;

            Swal.fire({
                title: '¿ESTÁ SEGURO DE REGISTRAR EL SLIDER',
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
                    datos.append("name", $name);
                    datos.append("descripcionSlider", $("#iptDescripcionSlider").val());


                    $.ajax({
                        url: "ajax/catalogo.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {

                                mensajeToast('success', 'SE REGISTRO CORRECTAMENTE');

                                //limpia imagenes
                                deleteImg();

                                tbl_Catalogo.ajax.reload();

                                $("#mdlAgregarSlider").modal('hide');


                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'ERROR' + 'ERROR AL REGISTRAR',
                                    showConfirmButton: false,
                                    timer: 3500
                                })
                            }

                        }
                    });

                }
            })







        });


        /*===========================================================================================
        EVENTOS ELIMINAR CATEGORIA
        ============================================================================================*/
        $('#tbl_Catalogo tbody').on('click', '.btnEliminarSlider', function() {

            accion = 3;
            var data = tbl_Catalogo.row($(this).parents('tr')).data();

            //     alert(data["id_categoria", idCategoria]);   
            //     console.log(data);
            var id_slider = data["id"]
            //     alert(id_categoria);

            Swal.fire({
                title: 'ESTÁ SEGURO DE ELIMINAR EL REGISTRO ',
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
                    datos.append("id_slider", id_slider);

                    $.ajax({
                        url: "ajax/catalogo.ajax.php",
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {
                                mensajeToast('success', 'SE ELIMINÓ EL REGISTRO CORRECTAMENTE');
                                tbl_Catalogo.ajax.reload();
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR EL REGISTRO',
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            }
                        }
                    });

                }
            })
        });


    });




    /*===================================================================
    CARGAR DATATABLES 
    ===================================================================*/
    function cargarDataTables() {

        //DATA TABLE USUARIOS
        tbl_Catalogo = $('#tbl_Catalogo').DataTable({
            ajax: {
                async: false,
                url: 'ajax/catalogo.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: ""
            },
            //ajustable 
            scrollX: true,
            dom: 'rtip',
            paging: true, // Habilita la paginación
            "scrollY": "500px", //altura de la tabla visible
            "deferRender": true, //habilita la opción de Lazy Loading
            "scrollCollapse": true,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    targets: 0,
                    'data': 'id',
                },
                {
                    targets: 1,
                    'data': 'foto',
                    "className": "dt-center",
                    render: function(foto) {
                        if (!foto) {
                            return 'N/A';
                        } else {
                            var img = foto;
                            return '<img class="imagen-agrandable" src="vistas/assets/imagenes/slider/' + img + '" height="200px" width="200px" />';
                        }
                    }
                },
                {

                    targets: 2,
                    data: 'descripcion',
                    className: 'dt-center',
                    render: function(data, type, row, meta) {
                        // Renderizar textarea solo en la vista 'display' (no en la fuente ni en la edición)
                        if (type === 'display') {
                            return '<textarea id="iptDescripcion" style="max-width: 200px; height: auto; width: 100%; box-sizing: border-box;" class="form-control text-center p-0 m-0" readonly>' + row.descripcion + '</textarea>';



                        }
                        // Devolver el valor de datos para otras vistas
                        return data;

                    }

                },

                {
                    targets: 3,
                    'data': 'opciones',
                    "className": "dt-center",

                    render: function(data, type, full, meta) {
                        return "<center>" +

                            "<span class='btnEliminarSlider text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Slider'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";

                    },
                },
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
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

    //FUNCION AJUSTAR LAS TABLAS POR DEFORMARCE O NO SE MIRAN BIEN
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