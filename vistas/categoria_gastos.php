<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">GATEGORIA GASTOS</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                    <li class="breadcrumb-item">PRODUCTOS</li>
                    <li class="breadcrumb-item active">CATEGORIA GASTOS</li>
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
                    <table id="tblCategoriaGastos" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="bg-info text-left">
                            <th>ID</th>
                            <th>CATEGORIA</th>
                            <th>F. CREACION</th>
                            <th class="text-center">OPCIONES</th>

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
                    <h3 class="card-title"><i class="fas fa-edit"></i> REGISTRO TIPOS DE GASTOS </h3>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="iptCategoriaGasto">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">TIPO GASTO</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="iptCategoriaGasto" name="iptCategoriaGasto" placeholder="Ingrese el tipo de gasto" required>

                                    <div class="invalid-feedback">Debe ingresar el tipo de gasto</div>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->
                        </div>

                        <div class="col-md-12">
                            <div class="form-group m-0 mt-3">
                                <a style="cursor:pointer;" class="btn btn-primary btn-sm w-100" id="btnRegistrarCategoriaGasto">REGISTRAR TIPO GASTO
                                </a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {


        //variables para registrar o editar la categoria
        var idCategoriaGasto = 0;
        var categoriaGasto = "";
        var medida = "";

        var tblCategoriaGastos = $('#tblCategoriaGastos').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print', 'pageLength',
            ],
            ajax: {
                url: 'ajax/gastos.ajax.php',
                dataSrc: "",

            },
            scrollX: true,
            //INDICAMOS QUE EN LA COLUMNA 2, SI ES 0 QUE COLOQUE UNIDADES Y SI ES 1 COLOQUE KILOGRAMOS
            columnDefs: [{
                    targets: 0,
                    "data": "id_tipo_gasto",
                },
                {
                    targets: 1,
                    "data": "descripcion",
                },
                {
                    targets: 2,
                    "data": "fecha_creacion",
                },
                {
                    targets: 3,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarTipoGasto text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'> " +
                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarTipoGasto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";
                    }
                }
            ],
            "order": [
                [0, 'desc']
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
         EVENTOS EDITAR CATEGORIA GASTOS
        ============================================================================================*/

        $('#tblCategoriaGastos tbody').on('click', '.btnEditarTipoGasto', function() {

            var data = tblCategoriaGastos.row($(this).parents('tr')).data();

            if ($(this).parents('tr').hasClass('selected')) {

                $(this).parents('tr').removeClass('selected');

                idCategoriaGasto = 0;
                //al momento de selecionar para editar la categoria por 2da vez me borre los inputs de editar categoria
                $("#iptCategoriaGasto").val("");

            } else {

                tblCategoriaGastos.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');

                idCategoriaGasto = data["id_tipo_gasto"];
                $("#iptCategoriaGasto").val(data[1]);
            }
        });

        /*===========================================================================================
        EVENTOS ELIMINAR CATEGORIA
        ============================================================================================*/
        $('#tblCategoriaGastos tbody').on('click', '.btnEliminarTipoGasto', function() {

            accion = 1;
            var data = tblCategoriaGastos.row($(this).parents('tr')).data();

            var idCategoriaGasto = data["id_tipo_gasto"]

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
                    datos.append("id_tipo_gasto", idCategoriaGasto);

                    $.ajax({
                        url: "ajax/gastos.ajax.php",
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {
                                mensajeToast('success', 'SE ELIMINÓ LA CATEGORÍA CORRECTAMENTE');
                                tblCategoriaGastos.ajax.reload();
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
         REGISTRAR CATEGORIA GASTOS
         ============================================================================================*/
        document.getElementById("btnRegistrarCategoriaGasto").addEventListener("click", function() {

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                //si los datos son validados correctamente
                if (form.checkValidity() === true) {

                    //capturamos los valores para llevar a la base de datos
                    iptCategoriaGasto = $("#iptCategoriaGasto").val();

                    var datos = new FormData();

                    datos.append("idCategoriaGasto", idCategoriaGasto);
                    datos.append("categoriaGasto", iptCategoriaGasto);

                    Swal.fire({
                        title: 'ESTÁ SEGURO DE REGISTRAR LA CATEGORÍA?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar!',
                    }).then((result) => {

                        if (result.isConfirmed) {

                            $.ajax({
                                url: "ajax/gastos.ajax.php",
                                type: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    if (respuesta == "ok") {
                                        mensajeToast('success', 'REGISTRADO CORRECTAMENTE');

                                        idCategoriaGasto = 0;
                                        iptCategoriaGasto = "";

                                        $("#iptCategoriaGasto").val("");

                                        tblCategoriaGastos.ajax.reload();
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
    });
</script>



<!-- /.content -->