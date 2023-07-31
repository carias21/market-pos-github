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
                        <thead class="bg-info text-left">
                            <th>CODIGO PRODUCTO</th>
                            <th>IMAGEN</th>
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


    $(document).ready(function() {

        cargarDataTables();
        ajustarHeadersDataTables($('#tbl_Inventario_Actual'));





        /*===================================================================
        =====================================================================
                                             EVENTOS
        =====================================================================
        ====================================================================*/


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
                    'data': 'foto',
                    'render': function(foto) {
                        /*  if (!foto) {
                              return 'N/A';
                          } else { */
                        var img = foto;
                        return '<img src="vistas/assets/imagenes/' + img + '" height="40px" width="40px" />';
                    }
                },
                {
                    targets: 2,
                    'data': 'descripcion_producto',
                },
                {
                    targets: 3,
                    'data': 'stock_producto',
                },
                {
                    targets: 4,
                    'data': 'precio_venta_producto',
                },
                

            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
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