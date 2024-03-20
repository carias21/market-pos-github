<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">TABLERO PRINCIPAL</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                    <li class="breadcrumb-item active">TABLERO PRINCIPAL</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="container-fluid">

        <div class="col-lg-12">

            <div class="col-lg-12">
                <div class="row">

                    <div class="col-lg-3">
                    <div class="card card-info">
                            <div class="card-header mi_card_info">
                                <h3 class="card-title">TOP PRODUCTO PERIODO </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div> <!-- ./ end card-tools -->
                            </div> <!-- ./ end card-header -->

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table display nowrap table-bordered" id="tbl_top_producto_periodo">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>PERIODO</th>
                                                <th>PRODUCTO</th>
                                                <th>CANTIDAD</th>
                                                <th>TOTAL V.</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div> <!-- ./ end card-body -->
                        </div>

                    </div>



                    <div class="col-lg-3 " style="width: 50%;">
                        <div class="row-lg-3">
                            <div class="col-lg-12">
                                <!-- small box -->
                                <div class="small-box border border-dark">
                                    <div class="inner">
                                        <h4 id="totalProductos"></h4>
                                        <p>Total Productos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-clipboard"></i>
                                    </div>
                                    <a style="cursor:pointer;" onclick="CargarContenido('vistas/productos.php','content-wrapper')" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <!-- TARJETA TOTAL COMPRAS -->
                            <div class="col-lg-12">
                                <!-- small box -->
                                <div class="small-box border border-primary">
                                    <div class="inner">
                                        <h4 id="totalCompras">Q.0.00</h4>
                                        <p>Total Compras</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-cash"></i>
                                    </div>
                                    <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 " style="width: 50%;">
                        <div class="row-lg-3">

                            <div class="col-lg-12">
                                <div class="small-box border border-success">
                                    <div class="inner">
                                        <h4 id="totalVentas">Q.0.00</h4>
                                        <p>Total Ventas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-cart"></i>
                                    </div>
                                    <a style="cursor:pointer;" onclick="CargarContenido('vistas/administrar_ventas.php','content-wrapper')" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="small-box border border-warning">
                                    <div class="inner">
                                        <h4 id="totalGanancias">Q.0.00</h4>
                                        <p>Total Ganancias</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-pie"></i>
                                    </div>
                                    <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>





                    <div class="col-lg-3">
                        <div class="row-lg-3">

                            <div class="col-lg-12">
                                <!-- small box -->
                                <div class="small-box border border-danger">
                                    <div class="inner">
                                        <h4 id="totalProductosMinStock">2</h4>
                                        <p>Productos poco stock</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-remove-circle"></i>
                                    </div>
                                    <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="small-box border border-dark">
                                    <div class="inner">
                                        <h4 id="totalVentasHoy">Q.0.00</h4>
                                        <p>Ventas del día</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-calendar"></i>
                                    </div>
                                    <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>




            <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS VENTAS DEL MES
        -------------------------------------------------------------------------------------------->
            <!-- row Grafico de barras -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="card card-info">

                        <div class="card-header mi_card_info ">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h1 class="card-title " id="title-header"></h1>
                                    </div>
                                </div>
                                <br>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="fecha_desde" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="fecha_hasta" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"> <i class="fas fa-chart-pie"></i></span></div>
                                            <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example" id="selGrafico">
                                                <option value="0">GRAFICO</option>
                                                <option value="bar">BAR</option>
                                                <option value="line">LINE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- ./ end card-header -->
                        <div class="card-body">
                            <div class="chart">
                                <!-- Gráfico de barras -->

                                <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;"></canvas>
                                <div id="curveChart" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%; display: none;"></div>

                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card card-warning ">
                        <div class="card-header mi_card_info">
                            <h3 class="card-title">ULTIMAS VENTAS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div> <!-- ./ end card-tools -->
                        </div> <!-- ./ end card-header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_ultimas_ventas">
                                    <thead>
                                        <tr class="text-nowrap">

                                            <th>PRODUCTO</th>
                                            <th>CANTIDAD</th>
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>

            </div> <!-- ./row Grafico de barras -->




            <div class="col-lg-12">
                <div class="card card-info">

                    <div class="card-header mi_card_info">
                        <h3 class="card-title">BARRAS DE PROGRESO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="overflow-auto">
                                    <div class="d-flex">


                                        <div class="flex-shrink-0 col-lg-6">
                                            <div class="col-lg-12">
                                                <div class="card" style="border: 2px solid #808080;">
                                                    <div class="card-header">
                                                        <div class="text-center">BARRAS DE PROGRESO</div>
                                                        <div id="contenedorBarrasDeProgreso">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table  text-center table-bordered" id="tbl_Metas">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th style="background-color: #07A881;">PERIODO</th>
                                                                <th style="background-color: #07A881;">TOTAL V.</th>
                                                                <th style="background-color: #07A881;">META</th>
                                                            </tr>
                                                        </thead>
                                                        <!-- Contenido de la tabla aquí -->
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="table-responsive">
                                                <table class="table text-center table-bordered" id="tbl_Editar_Metas">
                                                    <thead>
                                                        <tr class="text-nowrap">
                                                            <th style="background-color: #07A881;">ID</th>
                                                            <th style="background-color: #07A881;">META</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <!-------------------------------------------------------------------------------------------
            BUSQUEDA CANTIDAD VENTAS POR MES
         -------------------------------------------------------------------------------------------->
            <div class="row">

                <div class="col-lg-9">

                    <div class="card card-info ">

                        <div class="card-header mi_card_info">

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h3 class="card-title">CANTIDAD VENTAS</h3>
                                    </div>
                                </div>

                                <div class="col-md-3 text-left">
                                    <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example" id="selAnio">
                                        <option value="0">AÑO ACTUAL</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                                <div class="col-md-3 text-left">
                                    <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example" id="sel_Mes">
                                        <option value="0">MES ACTUAL</option>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="010">Octubre</option>
                                        <option value="011">Noviembre</option>
                                        <option value="012">Diciembre</option>
                                    </select>
                                </div>



                                <div class="col-md-3 text-right">
                                    <div class="card-tools ml-auto">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                    </div> <!-- ./ end card-tools -->
                                </div>
                            </div>


                        </div> <!-- ./ end card-header -->


                        <div class="card-body">

                            <div class="chart">

                                <canvas id="lineChart"></canvas>

                                </canvas>

                            </div>

                        </div> <!-- ./ end card-body -->

                    </div>

                </div>

                <div class="col-lg-3">
                    <div class="card mi_card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table display nowrap table-bordered w-100 rounded" id="tbl_cantidad_ventas">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>DIA</th>
                                            <th>CANTIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>




            <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS LOS 10 PRODUCTOS MAS VENDIDOS
        -------------------------------------------------------------------------------------------->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-success ">
                        <div class="card-header">
                            <h3 class="card-title">LOS 10 PRODUCTOS MAS VENDIDOS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i></button>

                            </div> <!-- ./ end card-tools -->
                        </div> <!-- ./ end card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table display nowrap table-bordered w-100 rounded" id="tbl_productos_mas_vendidos">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>COD PRODUCTO</th>
                                            <th>PRODUCTO</th>
                                            <th>CANTIDAD</th>
                                            <th>VENTAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-danger ">
                        <div class="card-header">
                            <h3 class="card-title">LISTADO PRODUCTOS POCA EXISTENCIA</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div> <!-- ./ end card-tools -->
                        </div> <!-- ./ end card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table display nowrap table-bordered w-100 rounded" id="tbl_productos_poco_stock">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>COD PRODUCTO</th>
                                            <th>PRODUCTO</th>
                                            <th>EXISTENCIA ACTUAL</th>
                                            <th>MIN. EXISTENCIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->



    </div>
    <!-- /.content -->


    <?php

    $dia_actual = date('d');
    $ultimo_dia_del_mes = date('t'); // Obtiene el último día del mes actual

    // Verifica si la variable de sesión está definida antes de acceder a ella
    if (isset($session_id_usuario->nombre_usuario) && isset($session_id_usuario->apellido_usuario)) {
        $nombre_usuario = $session_id_usuario->nombre_usuario;
        $apellido_usuario = $session_id_usuario->apellido_usuario;

        // Mostrar la notificación con emoji de mano saludando
        echo '<script>';
        echo 'mensajeToast("info", "HOLA DE NUEVO! ' . $nombre_usuario . ' ' . $apellido_usuario . ' 👋 ");';
        echo '</script>';
    }
    if ($dia_actual == $ultimo_dia_del_mes) {
        // Mostrar la notificación con emoji de mano saludando
        echo '<script>';
        echo 'toastr.info(\'AVISO: REPORTA GASTOS IMPORTANTES\', {
        onclick: function() {
            CargarContenido(\'vistas/gastos.php\',\'content-wrapper\');
        }
    })';
        echo '</script>';

        echo '</script>';
    }
    ?>

    <script>
        $(document).ready(function() {


            obtenerCantidadVentas();
            graficoDeBarras();

            ajustarHeadersDataTables($('#tbl_productos_poco_stock'));
            ajustarHeadersDataTables($('#tbl_productos_mas_vendidos'));
            ajustarHeadersDataTables($('#tbl_ultimas_ventas'));
            ajustarHeadersDataTables($('#tbl_cantidad_ventas'));
            ajustarHeadersDataTables($('#tbl_top_producto_periodo'));




            var fecha_desde = $("#fecha_desde");
            var fecha_hasta = $("#fecha_hasta");



            //INDICAMOS QUE POR DEFECTO NOS MUESTRE LA FECHA INICIANDO EL MES HASTA EL DIA DE HOY EN LOS INPUTS
            $("#fecha_desde").val(moment().startOf('MONTH').format('DD/MM/YYYY'));

            //CAPUTAMOS EL DIA DE HOY       
            $("#fecha_hasta").val(moment().format('DD/MM/YYYY'));


            fecha_desde.on('change', function() {
                actualizarFechasSeleccionadas();
            });

            fecha_hasta.on('change', function() {
                actualizarFechasSeleccionadas();
            });

            function actualizarFechasSeleccionadas() {

                var div = document.getElementById("curveChart");

                if (div) {
                    // Muestra el elemento div cambiando su estilo
                    div.style.display = "block";
                }

                // Obtén una referencia al elemento canvas por su ID
                var canvas = document.getElementById("barChart");

                // Verifica si el elemento canvas existe antes de intentar ocultarlo
                if (canvas) {
                    // Oculta el elemento canvas cambiando su estilo
                    canvas.style.display = "none";
                }



                var fecha_desde = $("#fecha_desde").val();
                var fecha_hasta = $("#fecha_hasta").val();

                fecha_desde = fecha_desde.substr(6, 4) + '-' + fecha_desde.substr(3, 2) + '-' + fecha_desde.substr(0, 2);
                fecha_hasta = fecha_hasta.substr(6, 4) + '-' + fecha_hasta.substr(3, 2) + '-' + fecha_hasta.substr(0, 2);

                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);


                function drawChart() {
                    $.ajax({
                        url: "ajax/dashboard.ajax.php",
                        method: 'POST',
                        data: {
                            'accion': 4,
                            'fechaDesde': fecha_desde,
                            'fechaHasta': fecha_hasta,
                        },
                        dataType: 'json',
                        success: function(respuesta) {

                            console.log(respuesta);
                            var fecha_venta = [];
                            var total_venta = [];

                            var mes_actual = new Date();
                            var total_ventas_mes = 0;




                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Fecha');
                            data.addColumn('number', 'Ventas');


                            for (let i = 0; i < respuesta.length; i++) {
                                data.addRow([
                                    respuesta[i]['fecha_venta'],
                                    parseFloat(respuesta[i]['total_venta'])

                                ]);
                            }

                            for (let i = 0; i < respuesta.length; i++) {
                                total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i]['total_venta'])
                            }

                            total_venta.push(0);

                            $("#title-header").html('TOTAL VENTA: Q. ' + total_ventas_mes.toFixed(2).toString().replace(
                                /\d(?=(\d{3})+\.)/g, "$&,"));

                            var options = {

                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                },

                                series: {
                                    0: {
                                        labelInLegend: 'Ventas',
                                        annotations: {
                                            textStyle: {
                                                fontSize: 12,
                                                bold: true,
                                                color: '#333'
                                            }
                                        }
                                    },

                                },
                                vAxis: {
                                    minValue: 0
                                },
                                animation: {
                                    startup: true, // Habilitar animaciones al inicio
                                    duration: 1500, // Duración de la animación en milisegundos
                                    easing: 'out' // Tipo de animación ('in', 'out', 'linear')
                                },
                                width: '100%', // Hacer el gráfico responsive
                                chartArea: {
                                    left: 50, // Ajustar márgenes
                                    right: 20,
                                    width: '50%', // Ajustar el ancho del gráfico
                                    height: '50%' // Ajustar la altura del gráfico
                                },
                                colors: ['#007bff', '#dc3545'] // Personaliza los colores aquí
                            };

                            var chart = new google.visualization.AreaChart(document.getElementById('curveChart'));
                            chart.draw(data, options);

                            // Manejar redimensionamiento de ventana
                            $(window).on('resize', function() {
                                chart.draw(data, options);
                            });
                        }
                    });
                }



            };




            function ObtenerGraficoBarras() {

                var divCurve = document.getElementById("curveChart");
                var divBar = document.getElementById("barChart");


                if (divCurve) {
                    divCurve.style.display = "none";
                }


                if (divBar) {
                    divBar.style.display = "block";
                }
                var fecha_desde = $("#fecha_desde").val();
                var fecha_hasta = $("#fecha_hasta").val();

                fecha_desde = fecha_desde.substr(6, 4) + '-' + fecha_desde.substr(3, 2) + '-' + fecha_desde.substr(0, 2);
                fecha_hasta = fecha_hasta.substr(6, 4) + '-' + fecha_hasta.substr(3, 2) + '-' + fecha_hasta.substr(0, 2);


                $.ajax({
                    url: "ajax/dashboard.ajax.php",
                    method: 'POST',
                    data: {
                        'accion': 4,
                        'fechaDesde': fecha_desde,
                        'fechaHasta': fecha_hasta,
                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        console.log(respuesta);

                        var fecha_venta = [];
                        var total_venta = [];

                        var mes_actual = new Date();
                        var total_ventas_mes = 0;

                        for (let i = 0; i < respuesta.length; i++) {

                            fecha_venta.push(respuesta[i]['fecha_venta']);
                            total_venta.push(respuesta[i]['total_venta']);

                            total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i]['total_venta']);
                        }

                        total_venta.push(0);

                        var barChartCanvas = $("#barChart").get(0).getContext('2d');

                        var areaChartData = {
                            labels: fecha_venta,

                            datasets: [{
                                label: 'VENTAS',
                                backgroundColor: 'rgba(128, 0, 128, 0.9)',
                                borderColor: 'rgb(128, 0, 128)',

                                borderWidth: 5,
                                data: total_venta
                            }]
                        }

                        var barChartData = $.extend(true, {}, areaChartData);

                        var temp0 = areaChartData.datasets[0];

                        barChartData.datasets[0] = temp0;

                        $("#title-header").html('TOTAL VENTA: Q. ' + total_ventas_mes.toFixed(2).toString().replace(
                            /\d(?=(\d{3})+\.)/g, "$&,"));

                        var barChartOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            events: false,
                            legend: {
                                display: true
                            },
                            scales: {
                                xAxes: [{
                                    stacked: true,
                                }],
                                yAxes: [{
                                    stacked: true
                                }]
                            },
                            animation: {
                                duration: 500,
                                easing: "easeOutQuart",
                                onComplete: function() {
                                    var ctx = this.chart.ctx;
                                    ctx.font = Chart.helpers.fontString(Chart.defaults.global
                                        .defaultFontFamily, 'normal',
                                        Chart.defaults.global.defaultFontFamily);
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'bottom';

                                    this.data.datasets.forEach(function(dataset) {
                                        for (var i = 0; i < dataset.data.length; i++) {
                                            var model = dataset._meta[Object.keys(dataset
                                                    ._meta)[0]].data[i]._model,
                                                scale_max = dataset._meta[Object.keys(dataset
                                                    ._meta)[0]].data[i]._yScale.maxHeight;
                                            ctx.fillStyle = '#444';
                                            var y_pos = model.y - 5;
                                            if ((scale_max - model.y) / scale_max >= 0.93)
                                                y_pos = model.y + 20;
                                            ctx.fillText(dataset.data[i], model.x, y_pos);
                                        }
                                    });
                                }
                            }
                        }

                        new Chart(barChartCanvas, {
                            type: 'bar',
                            data: barChartData,
                            options: barChartOptions
                        })
                    }

                });
            };



            $.ajax({
                async: false,
                url: "ajax/dashboard.ajax.php",
                method: "POST",
                data: {
                    'accion': 8,
                },
                dataType: 'json',
                success: function(respuesta) {

                    console.log(respuesta)

                    $('#contenedorBarrasDeProgreso').empty();

                    var coloresBootstrap = ['bg-info', 'bg-warning', 'bg-danger'];

                    respuesta.forEach(function(datos, index) {
                        var valor = datos.total_venta;
                        var colorClase = coloresBootstrap[index % coloresBootstrap.length];
                        var periodo = datos.periodo;

                        var barraId = 'miBarraDeProgreso' + index;

                        // Utiliza el valor de la columna "meta" como máximo
                        var valorMeta = datos.meta;

                        // Calcula el porcentaje en relación al valor máximo
                        var porcentaje = (valor / valorMeta) * 100;

                        var nuevaBarra = $('<div>').addClass('progress-bar progress-bar-striped progress-bar-animated ' + colorClase)
                            .attr({
                                'id': barraId,
                                'role': 'progressbar',
                                'style': 'width: ' + porcentaje + '%;', // Ajusta el grosor y color del borde según tus preferencias
                                'aria-valuenow': valor,
                                'aria-valuemin': '0',
                            })
                            .text('Q.' + valor); // Nuevo: Agrega el dato del período como texto en la barra


                        $('#contenedorBarrasDeProgreso').append($('<div>').addClass('progress').append(nuevaBarra)).append('<br>');
                    });
                },
                error: function(error) {
                    console.error('Error al obtener el valor desde la base de datos:', error);
                }
            });






            /* =======================================================
            SOLICITUD AJAX TARJETAS INFORMATIVAS
            =======================================================*/
            $.ajax({
    url: "ajax/dashboard.ajax.php",
    method: 'POST',
    dataType: 'json',
    success: function(respuesta) {
        console.log("respuesta", respuesta);

        // Redondear los valores a dos decimales antes de mostrarlos
        var totalCompras = parseFloat(respuesta[0]['totalCompras']).toFixed(2);
        var totalVentas = parseFloat(respuesta[0]['totalVentas']).toFixed(2);
        var ganancias = parseFloat(respuesta[0]['ganancias']).toFixed(2);
        var ventasHoy = parseFloat(respuesta[0]['ventasHoy']).toFixed(2);

        $("#totalProductos").html(respuesta[0]['totalProductos']);
        $("#totalCompras").html('Q.' + totalCompras);
        $("#totalVentas").html('Q.' + totalVentas);
        $("#totalGanancias").html('Q.' + ganancias);
        $("#totalProductosMinStock").html(respuesta[0]['productosPocoStock']);
        $("#totalVentasHoy").html('Q.' + ventasHoy);
    }
});

 



            //******************************************************************************************************************** */
            //-------------AJAX LOS 10 PRODUCTOS MAS VENDIDOS------------------------------

            tableProductosMasVen = $("#tbl_productos_mas_vendidos").DataTable({
                searching: false,
                dom: 'Bfrtip', //se colocan los botones, copiar, Excel, CSV y print en el inventario
                scrollX: true,
                buttons: [
                    'copy', 'excel', 'print', 'pdfHtml5',
                ],
                "order": [
                    [2, 'desc']
                ],
                ajax: {
                    url: "ajax/dashboard.ajax.php",
                    dataSrc: '',
                    type: "POST",
                    data: {
                        'accion': 2 // listar LOS 10 PRODUCTOS MAS VENDIDOS
                    },


                },


                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                }
            });

            /*===================================================================*/
            // LISTADO PRODUCTOS POCO STOCK 
            /*===================================================================*/
            tablePocoStock = $("#tbl_productos_poco_stock").DataTable({
                searching: false,
                dom: 'Bfrtip', //se colocan los botones, copiar, Excel, CSV y print en el inventario
                scrollX: true,
                buttons: [
                    'copy', 'excel', 'print',

                ],
                "order": [
                    [2, 'desc']
                ],
                ajax: {
                    url: "ajax/dashboard.ajax.php",
                    dataSrc: '',
                    type: "POST",
                    data: {
                        'accion': 3 // listar los  productos con poco stock
                    },
                },



                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
                }
            });


            //-------------AJAX ULTIMAS VENTAS------------------------------

            tableUltimasVentas = $("#tbl_ultimas_ventas").DataTable({
                searching: false,
                dom: 'Bfrtip', // Se colocan los botones, copiar, Excel, CSV y print en el inventario
                responsive: true,
                buttons: [],
                paging: false,
                "scrollY": "285px",
                "order": [
                    [2, 'desc']
                ],
                ajax: {
                    url: "ajax/dashboard.ajax.php",
                    dataSrc: '',
                    type: "POST",
                    data: {
                        'accion': 6
                    },
                },
                info: false,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
                }
            });



            tableMetas = $("#tbl_Metas").DataTable({
                searching: false,
                dom: 'Bfrtip', // Se colocan los botones, copiar, Excel, CSV y print en el inventario
                responsive: true,
                buttons: [],
                paging: false,


                ajax: {
                    url: "ajax/dashboard.ajax.php",
                    dataSrc: '',
                    type: "POST",
                    data: {
                        'accion': 9
                    },
                },
                "order": [
                    [2, "asc"]
                ],

                columnDefs: [{
                        targets: 2,
                        data: 'meta',
                        visible: false,
                    }, {
                        targets: 0,
                        orderable: false
                    },

                    {
                        targets: 1,
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


                ],
                info: false,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
                }
            });



            table_Editar_Metas = $("#tbl_Editar_Metas").DataTable({
                searching: false,
                dom: 'Bfrtip',

                buttons: [],
                paging: false,
                ajax: {
                    url: "ajax/dashboard.ajax.php",
                    dataSrc: '',
                    type: "POST",
                    data: {
                        'accion': 10
                    },
                },
                order: [
                    [0, "asc"]
                ],
                columnDefs: [{
                        targets: 0,
                        data: 'id',
                        visible: true,
                        orderable: false
                    }, {
                        targets: 1,
                        data: 'metas',

                        orderable: false,
                        render: function(data, type, row) {
                            // Renderizar un input con el valor actual
                            if (type === 'display' || type === 'filter') {
                                var roundedValue = parseFloat(data).toFixed(2);


                                return 'Q. ' + '<input type="text" value="' + data + '" class="border text-center iptEditarMeta p-0 m-0">';
                            }
                            return data;
                        }
                    },


                ],
                info: false,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
                }
            });



            //-------------AJAX ULTIMAS VENTAS------------------------------

            tbl_top_producto_periodo = $("#tbl_top_producto_periodo").DataTable({
                searching: false,

                buttons: [],
                paging: false,
                responsive: true,
                "scrollY": "150px",
                "order": [
                    [1, "desc"]
                ],
                ajax: {
                    url: "ajax/dashboard.ajax.php",
                    dataSrc: '',
                    type: "POST",
                    data: {
                        'accion': 7
                    },
                },

                columnDefs: [{


                    targets: 3,
                    data: 'total_venta',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            var roundedValue = parseFloat(data).toFixed(2);
                            return 'Q. ' + roundedValue;
                        } else {
                            return data;
                        }
                    },

                }],

                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
                info: false

            });

            tableCantidadVenta = $("#tbl_cantidad_ventas").DataTable({
                searching: false,
                dom: 'Bfrtip', //se colocan los botones, copiar, Excel, CSV y print en el inventario
                scrollX: true,
                buttons: [
                    'copy', 'excel', 'print',

                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
                info: false,
                "scrollY": "130px",
                "scrollCollapse": true,
                "paging": false,
                "searching": false,


            });

            var selGrafico = $("#selGrafico");

            selGrafico.on('change', function() {
                console.log(selGrafico.val());
                if (selGrafico.val() == "line") {
                    actualizarFechasSeleccionadas();
                } else if (selGrafico.val() == "bar") {

                    ObtenerGraficoBarras()
                }

            });




            var sel_Mes = $("#sel_Mes");
            var selAnio = $("#selAnio");


            sel_Mes.on('change', function() {
                obtenerCantidadVentas();
            });

            selAnio.on('change', function() {
                obtenerCantidadVentas();
            });

            $("#tbl_Editar_Metas").on('change', '.iptEditarMeta', function() {
                var tabla = $(this).closest('table').DataTable();
                var fila = tabla.row($(this).closest('tr')).data();

                $.ajax({
                    async: false,
                    url: "ajax/dashboard.ajax.php",
                    method: "POST",
                    data: {
                        'accion': 11,
                        'id': fila[0],
                        'valorMeta': $(this).val()
                    },
                    success: function(response) {
                        // Manejar la respuesta del servidor si es necesario
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de la petición AJAX si es necesario
                        console.error(xhr.responseText);
                    }
                });
            });




        }) //FIN DOCUMENT READY



        function obtenerCantidadVentas() {
            var sel_Mes = $("#sel_Mes").val();
            var selAnio = $("#selAnio").val();

            if (sel_Mes === "0" && selAnio === "0") {
                // Obtener la fecha actual
                var fechaActual = new Date();
                sel_Mes = fechaActual.getMonth() + 1; // Sumamos 1 para que el mes esté en el rango 1-12
                selAnio = fechaActual.getFullYear();
            } else {
                var sel_Mes = $("#sel_Mes").val();
                var selAnio = $("#selAnio").val();
            }
            $.ajax({
                url: 'ajax/dashboard.ajax.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'accion': 5,
                    'mes': sel_Mes, // Utilizar la variable directamente
                    'anio': selAnio, // Utilizar la variable directamente
                },
                success: function(respuesta) {

                    tableCantidadVenta.clear().draw();


                    tableCantidadVenta.rows.add(respuesta).draw();

                    var dia = [];
                    var cantidad_venta = [];

                    for (let i = 0; i < respuesta.length; i++) {
                        dia.push(respuesta[i]['dia']);
                        cantidad_venta.push(respuesta[i]['ventas_dia']);
                    }
                    cantidad_venta.push(0);

                    var areaChartData = {
                        labels: dia,
                        datasets: [{
                            label: 'Cantidad de Ventas',
                            borderColor: 'rgb(94, 0, 0)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgb(94, 0, 0)',
                            pointRadius: 5,
                            data: cantidad_venta
                        }]
                    };

                    var barChartData = $.extend(true, {}, areaChartData);

                    // Configuración del gráfico
                    var options = {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Ventas Diarias',
                                font: {
                                    size: 16
                                }
                            },
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Día'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Cantidad de Ventas'
                                }
                            }
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    };

                    // Crear el gráfico de líneas
                    var ctx = document.getElementById('lineChart').getContext('2d');
                    var lineChart = new Chart(ctx, {
                        type: 'line',
                        data: areaChartData,
                        options: options
                    });
                }

            });


        }

        $(function() {
            $("#fecha_desde, #fecha_hasta").datepicker({
                dateFormat: "dd/mm/yy",
                language: "es",
                selectOtherMonths: true,
            });
        });

        //FUNCION AJUSTAR LAS TABLAS POR DEFORMARCE O NO SE MIRAN BIEN
        //VD 30 MIN 25.10
        function ajustarHeadersDataTables(element) {

            var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
                entries.forEach(function(entry) {
                    $(entry.target).DataTable().columns.adjust();
                });
            }) : null;

            resizeHandler = function($table) {
                if (observer)
                    observer.observe($table[0]);
            };

            resizeHandler(element);
        }

        function graficoDeBarras() {
            /* =======================================================
            SOLICITUD AJAX GRAFICO DE BARRAS DE VENTAS DEL MES
            =======================================================*/
            $.ajax({
                url: "ajax/dashboard.ajax.php",
                method: 'POST',
                data: {
                    'accion': 1 //parametro para obtener las ventas del mes
                },
                dataType: 'json',
                success: function(respuesta) {

                    var fecha_venta = [];
                    var total_venta = [];
                    var total_venta_ant = [];

                    var mes_actual = new Date();
                    var mes_anterior = moment(mes_actual, "DD-MM-YYYY").add(-1, 'months').format('MM/YYYY');

                    var total_ventas_mes = 0;

                    for (let i = 0; i < respuesta.length; i++) {
                        fecha_venta.push(respuesta[i]['fecha_venta']);
                        total_venta.push(respuesta[i]['total_venta']);
                        total_venta_ant.push(respuesta[i]['total_venta_ant']);
                        total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i]['total_venta']);
                    }

                    total_venta.push(0);

                    $("#title-header").html('VENTAS DEL MES: Q. ' + total_ventas_mes.toFixed(2).toString().replace(
                        /\d(?=(\d{3})+\.)/g, "$&,"));

                    var barChartCanvas = $("#barChart").get(0).getContext('2d');

                    var areaChartData = {
                        labels: fecha_venta,
                        datasets: [{
                            label: 'Ventas del Mes Actual',
                            backgroundColor: 'rgba(142, 255, 0, 0.8)',
                            borderColor: 'rgb(142, 255, 0)',
                            borderWidth: 5,
                            data: total_venta
                        }, {
                            label: 'Ventas del mes anterior',
                            backgroundColor: 'rgba(255, 171, 0, 0.8)',
                            borderColor: 'rgb(255, 171, 0)',
                            borderWidth: 5,
                            data: total_venta_ant
                        }]
                    }

                    var barChartData = $.extend(true, {}, areaChartData);

                    var barChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        events: false,
                        legend: {
                            display: true
                        },
                        scales: {
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    fontColor: 'F000000'
                                }
                            }],
                            yAxes: [{
                                stacked: false,
                                ticks: {
                                    fontColor: 'F000000'
                                }
                            }],
                        },
                        animation: {
                            duration: 900,
                            easing: "easeOutQuart",
                            onComplete: function() {
                                var ctx = this.chart.ctx;
                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';

                                this.data.datasets.forEach(function(dataset) {
                                    for (var i = 0; i < dataset.data.length; i++) {
                                        var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                            scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                        ctx.fillStyle = '#F000000'; // Cambiar color a blanco
                                        var y_pos = model.y - 10;

                                        if ((scale_max - model.y) / scale_max >= 0.93)
                                            y_pos = model.y + 20;
                                        ctx.fillText(dataset.data[i], model.x, y_pos);
                                    }
                                });
                            }
                        }

                    }

                    new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })
                }
            });
        }
    </script>