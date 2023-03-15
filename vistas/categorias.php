<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">CATEGORIAS</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item">PRODUCTOS</li>
                    <li class="breadcrumb-item active">CATEGORIAS</li>
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
        <div class="col-md-8">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-list-alt"></i> Listado de Categorías</h3>
                </div>
                <div class="card-body">
                    <table id="lstCategorias" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="bg-info text-left">
                            <th>id</th>
                            <th>Categoría</th>
                            <th>Medida</th>
                            <th>F. Creación</th>
                            <th>F. Actualización</th>
                            <th class="text-center">Opciones</th>

                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--FORMULARIO PARA EL REGISTRO Y EDIACION -->
        <div class="col-md-4">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Registro de Categorias </h3>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="iptCategoria">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Categoría</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="iptCategoria" name="iptCategoria" placeholder="Ingrese la Categoría" required>

                                    <div class="invalid-feedback">Debe ingresar la Categoria</div>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2"></div>

                                <label class="col-form-label" for="selMedida">
                                    <i class="fas fa-file-alt fs-6"></i>
                                    <span class="small">Medida</span><span class="text-danger">*</span>
                                </label>

                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selMedida" required>
                                    <option value="">---Selecione una medida---</option>
                                    <option value="0">Unidades</option>
                                    <option value="1">Kilogramos</option>
                                </select>
                                <div class="invalid-feedback">Seleccione una medida</div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group m-0 mt-3">
                                <a style="cursor:pointer;" class="btn btn-primary btn-sm w-100" id="btnRegistrarCategoria">Registrar Categoría
                                </a>

                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!--  CREACION DE LA TABLA Y CONEXION A LA BASE DE DATOS MEDIANTE
 AJAX, VIDEO EXPLICATIVO DE COMO MOSTRAR LA BASE DE DATOS EN LA TABLA: https://www.youtube.com/watch?v=K9g20dqM9N0&t=1391s -->

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        //variables para registrar o editar la categoria
        var idCategoria = 0;
        var categoria = "";
        var medida = "";

        /*===================================================================
        =====================================================================
                                       CARGAR DATATABLES (3 TABLES)
        =====================================================================
        ====================================================================*/
        var tableCategorias = $('#lstCategorias').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print', 'pageLength',
            ],
            ajax: {
                url: 'ajax/categorias.ajax.php',
                dataSrc: "",

            },
            scrollX: true,
            //INDICAMOS QUE EN LA COLUMNA 2, SI ES 0 QUE COLOQUE UNIDADES Y SI ES 1 COLOQUE KILOGRAMOS
            columnDefs: [{
                    targets: 0,
                    "data": "id_categoria",
                },
                {
                    targets: 1,
                    "data": "nombre_categoria",
                },
                {
                    targets: 2,
                    "data": "medida",
                    sortable: false,
                    //con el RowData obtenemos la informacion de la columna
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (parseInt(rowData[2]) == 0) {
                            $(td).html("Und(s)")
                        } else {
                            $(td).html("Kg(s)")
                        }

                    }
                },
                {
                    targets: 3,
                    "data": "fecha_creacion_categoria",
                },
                {
                    targets: 5,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarCategoria text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Categoría'> " +
                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarCategoria text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Categoría'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";
                    }
                }
            ],
            "order": [
                [1, 'asc']
            ],
            lengthMenu: [0, 5, 10, 15, 20, 50],
            "pageLength": 15,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });


        /*===================================================================
        =====================================================================
                                       EVENTOS
        =====================================================================
        ====================================================================*/


        /*===========================================================================================
           EVENTOS EDITAR CATEGORIA,  seleccione la fila y seguidamente al dar clic quite el selecionado
        ============================================================================================*/
        $('#lstCategorias tbody').on('click', '.btnEditarCategoria', function() {

            var data = tableCategorias.row($(this).parents('tr')).data();

            if ($(this).parents('tr').hasClass('selected')) {

                $(this).parents('tr').removeClass('selected');

                idCategoria = 0;
                //al momento de selecionar para editar la categoria por 2da vez me borre los inputs de editar categoria
                $("#iptCategoria").val("");
                $("#selMedida").val("");

            } else {

                tableCategorias.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');

                idCategoria = data[0];
                $("#iptCategoria").val(data[1]);
                $("#selMedida").val(data[2]);


            }
        })

        /*===========================================================================================
        EVENTOS ELIMINAR CATEGORIA
        ============================================================================================*/
        $('#lstCategorias tbody').on('click', '.btnEliminarCategoria', function() {

            accion = 5;
            var data = tableCategorias.row($(this).parents('tr')).data();

            //     alert(data["id_categoria", idCategoria]);   
            //     console.log(data);
            var id_categoria = data["id_categoria"]
            //     alert(id_categoria);

            Swal.fire({
                title: 'ESTÁ SEGURO DE ELIMINAR LA CATEGORÍA: ' + data[1] + '?',
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
                    datos.append("id_categoria", id_categoria);

                    $.ajax({
                        url: "ajax/categorias.ajax.php",
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {
                                mensajeToast('success', 'SE ELIMINÓ LA CATEGORÍA CORRECTAMENTE');
                                tableCategorias.ajax.reload();
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR LA CATEGORÍA',
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            }
                        }
                    });

                }
            })
        });


        /*===========================================================================================
         REGISTRAR CATEGORIA
         ============================================================================================*/
        document.getElementById("btnRegistrarCategoria").addEventListener("click", function() {

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                //si los datos son validados correctamente
                if (form.checkValidity() === true) {

                    //capturamos los valores para llevar a la base de datos
                    categoria = $("#iptCategoria").val();
                    medida = $("#selMedida").val();

                    var datos = new FormData();

                    datos.append("idCategoria", idCategoria);
                    datos.append("categoria", categoria);
                    datos.append("medida", medida);

                    Swal.fire({
                        title: 'ESTÁ SEGURO DE ELIMINAR LA CATEGORÍA?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar!',
                    }).then((result) => {

                        if (result.isConfirmed) {

                            $.ajax({
                                url: "ajax/categorias.ajax.php",
                                type: "POST",
                                //aqui es donde enviamos los datos capturados anteriormente
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    if (respuesta == "ok") {
                                        mensajeToast('success', 'REGISTRADO CORRECTAMENTE');

                                        idCategoria = 0;
                                        categoria = "";
                                        medida = "";

                                        $("#iptCategoria").val("");
                                        $("#selMedida").val("");

                                        tableCategorias.ajax.reload();
                                        $(".needs-validation").removeClass("was-validated");
                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'NO SE PUEDO REGISTRAR LA CATEGORIA ' +
                                            'verifica si ya existe',
                                            showConfirmButton: false,
                                            timer: 2500
                                        });
                                    }
                                }
                            });
                        }
                    })
                }
                //me solicita que tengo que ingresar los campos 
                form.classList.add('was-validated');

            })

        });
    })
</script>



<!-- /.content -->