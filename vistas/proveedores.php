<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="m-0">PROVEEDORES</h4>
            </div><!-- /.col -->
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>

                    <li class="breadcrumb-item active">PROVEEDORES</li>
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
                    <h3 class="card-title"><i class="far fa-list-alt"></i> Listado de proveedores</h3>
                </div>
                <div class="card-body">
                    <table id="tbl_Proveedores" class="display nowrap table-striped w-100 shadow rounded">
                        <thead class="mi_card_info text-left">
                            <th>id</th>
                            <th>Nombre P.</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>email</th>
                            <th>Fecha Registro</th>
                            <th>Tipo Producto</th>
                            <th>Estado</th>
                            <th class="text-center">Opciones</th>

                        </thead>
                        <tbody class="small text left"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--FORMULARIO PARA EL REGISTRO Y EDICION -->
        <div class="col-md-4">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Registro de Proveedores </h3>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Nombre_Proveedor">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Nombre Proveedor</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="ipt_Nombre_Proveedor" name="ipt_Nombre_Proveedor" placeholder="Ingrese el Nombre del Proveedor" required>

                                    <div class="invalid-feedback">Debe ingresar el nombre</div>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Direccion">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Direccion</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="ipt_Direccion" name="ipt_Direccion" placeholder="Ingrese la direccion" required>

                                    <div class="invalid-feedback">Debe ingresar la dirección</div>
                                </div>
                            </div>

                            <!--------------------------------------------------------------------------------------------------------------->
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Telefono">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Telefono</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="number" class="form-control form-control-sm" id="ipt_Telefono" name="ipt_Telefono" placeholder="Ingrese el telefono" required>

                                    <div class="invalid-feedback">Debe ingresar el telefono</div>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------->

                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Correo">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Email</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="email" class="form-control form-control-sm" id="ipt_Correo" name="ipt_Correo" placeholder="Ingrese el correo" required>

                                    <div class="invalid-feedback">Debe ingresar el correo</div>
                                </div>
                            </div>



                            <!--------------------------------------------------------------------------------------------------------------->

                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_Tipo_p">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Tipo Producto</span><span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control form-control-sm" id="ipt_Tipo_p" name="ipt_Tipo_p" placeholder="Ingrese el tipo de producto" required>

                                    <div class="invalid-feedback">Debe ingresar tipo producto</div>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="ipt_estado">

                                        <i class="fas fa-dumpster fs-6"></i>

                                        <span class="small">Estado</span><span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="ipt_estado" required>
                                        <option value="">---Seleccione el estado---</option>
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>

                                    <div class="invalid-feedback">Debe ingresar el estado</div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="form-group m-0 mt-3">
                                <a style="cursor:pointer;" class="btn btn-primary btn-sm w-100" id="btnRegistrarProveedores">Registrar Proveedor
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
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    /* =============================================================
    VARIABLES GLOBALES
    ============================================================= */
    var tbl_Proveedores;
    var id_Proveedores = 0;


    $(document).ready(function() {

        cargarDataTables();
        ajustarHeadersDataTables($('#tbl_Proveedores'));





        /*===================================================================
        =====================================================================
                                             EVENTOS
        =====================================================================
        ====================================================================*/

        /*========================================================================================================
        EVENTO EDITAR PERFIL seleccione la fila y seguidamente al dar clic quite el selecionado
        ==========================================================================================================*/
        $('#tbl_Proveedores tbody').on('click', '.btnEditarProveedores', function() {


            var data = tbl_Proveedores.row($(this).parents('tr')).data();

            //console.log(data);
            if ($(this).parents('tr').hasClass('selected')) {

                $(this).parents('tr').removeClass('selected');
                id_Proveedores = 0;
                //al momento de selecionar para editarel proveedor por 2da vez me borre los inputs de editar categoria
                $("#ipt_Nombre_Proveedor").val("");
                $("#ipt_Direccion").val("");
                $("#ipt_Telefono").val("");
                $("#ipt_Correo").val("");
                $("#ipt_Tipo_p").val("");
                $("#ipt_estado").val("");




            } else {

                tbl_Proveedores.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');

                id_Proveedores = data[0];

                $("#ipt_Nombre_Proveedor").val(data[1]);
                $("#ipt_Direccion").val(data[2]);
                $("#ipt_Telefono").val(data[3]);
                $("#ipt_Correo").val(data[4]);

                $("#ipt_Tipo_p").val(data[6]);
                $("#ipt_estado").val(data[7]);


            }
        })



        /*===========================================================================================
         REGISTRAR PROVEEDOR
         ============================================================================================*/
        document.getElementById("btnRegistrarProveedores").addEventListener("click", function() {

            // Obtener los formularios a los que queremos agregar estilos de validación
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                //si los datos son validados correctamente
                if (form.checkValidity() === true) {




                    //capturamos los valores para llevar a la base de datos
                    var nombre = $("#ipt_Nombre_Proveedor").val();
                    var direccion = $("#ipt_Direccion").val();
                    var telefono = $("#ipt_Telefono").val();
                    var correo = $("#ipt_Correo").val();
                    var tipo_producto = $("#ipt_Tipo_p").val();
                    var estado = $("#ipt_estado").val();


                    var datos = new FormData();

                    datos.append("id_Proveedores", id_Proveedores);
                    datos.append("nombre", nombre);
                    datos.append("direccion", direccion);
                    datos.append("telefono", telefono);
                    datos.append("correo", correo);
                    datos.append("tipo_producto", tipo_producto);
                    datos.append("estado", estado);

                    Swal.fire({
                        title: '¿ESTÁ SEGURO DE REGISTRAR EL PROVEEDOR?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar!',
                    }).then((result) => {

                        if (result.isConfirmed) {

                            $.ajax({
                                url: "ajax/proveedores.ajax.php",
                                type: "POST",
                                //aqui es donde enviamos los datos capturados anteriormente
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    if (respuesta == "ok") {

                                        id_Proveedores = 0;
                                        //al momento de selecionar para editarel proveedor por 2da vez me borre los inputs de editar categoria
                                        $("#ipt_Nombre_Proveedor").val("");
                                        $("#ipt_Direccion").val("");
                                        $("#ipt_Telefono").val("");
                                        $("#ipt_Correo").val("");
                                        $("#ipt_Tipo_p").val("");
                                        $("#ipt_estado").val("");

                                        mensajeToast('success', 'REGISTRADO CORRECTAMENTE');



                                        tbl_Proveedores.ajax.reload();
                                        $(".needs-validation").removeClass("was-validated");

                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'NO SE PUDO REGISTRAR EL PROVEEDOR' +
                                                'comunicate con tu administrador',
                                            showConfirmButton: false,
                                            timer: 3500
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



        /*===========================================================================================
        EVENTOS ELIMINAR CATEGORIA
        ============================================================================================*/
        $('#tbl_Proveedores tbody').on('click', '.btnEliminarProveedores', function() {

            accion = 3;
            var data = tbl_Proveedores.row($(this).parents('tr')).data();

            var id_proveedor = data["id_proveedor"]

            Swal.fire({
                title: '¿ESTÁ SEGURO DE ELIMINAR EL PROVEEDOR: ' + data[1] + '?',
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
                    datos.append("id_proveedor", id_proveedor);

                    $.ajax({
                        url: "ajax/proveedores.ajax.php",
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {
                                mensajeToast('success', 'SE ELIMINÓ EL PROVEEDOR CORRECTAMENTE');

                                tbl_Proveedores.ajax.reload();
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'NO SE PUDO ELIMINAR EL PROVEEDOR' +
                                        ' comunicate con tu administrador',
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }
                    });

                }
            })
        });


    })


    /*===================================================================
    =====================================================================
     FUNCIONES
    ===================================================================
    ===================================================================*/

    /*===================================================================
    CARGAR DATATABLES 
    ===================================================================*/
    function cargarDataTables() {

        //DATA TABLE PROVEEDORES
        tbl_Proveedores = $('#tbl_Proveedores').DataTable({
            ajax: {
                async: false,
                url: 'ajax/proveedores.ajax.php',
                type: 'POST',
                dataType: 'json',
                dataSrc: "",
                data: {
                    accion: 1
                }
            },
            scrollX: true,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    targets: 0,
                    'data': 'id_proveedor',
                },
                {
                    targets: 1,
                    'data': 'nombre',
                },
                {
                    targets: 2,
                    'data': 'direccion',
                },
                {
                    targets: 3,
                    'data': 'telefono',
                },
                {
                    //colocamos no visible las columnas del....
                    targets: 4,
                    'data': 'email',
                },
                {
                    targets: 5,
                    'data': 'fecha_registro',
                },
                {
                    targets: 6,
                    'data': 'tipo_producto',
                },
                {
                    targets: 7,
                    'data': 'estado',
                },
                {
                    //columna 7 OPCIONES
                    //columna 5
                    targets: 8,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarProveedores text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Proveedores'> " +
                            "<i class='fas fa-pencil-alt fs-5'></i> " +
                            "</span> " +
                            "<span class='btnEliminarProveedores text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Proveedores'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>";
                        /*
                        if (parseInt(rowData[0]) == 1) {
                        }*/
                    },
                },

            ],



            fixedColumns: {
                leftColumns: 0, // No se fijan columnas a la izquierda
                rightColumns: 1, // Fija la columna con la clase "columna-fija" a la derecha
            },
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
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


</script>



<!-- /.content -->