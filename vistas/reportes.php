 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Reportes</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Reportes</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">


         <!-------------------------------------------------------------------------------------------
        GRAFICO DE LINEA TOTAL VENTAS POR MES DE AÑO ACTUAL
        -------------------------------------------------------------------------------------------->
         <!-- row Grafico de barras -->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info">

                     <div class="card-header mi_card_info">





                         <div class="row">
                             <div class="col-md-3 text-centered">
                                 <h3 class="card-title" id="title-header"> TOTAL VENTAS POR MES</h3>
                                 <br>
                             </div>


                             <div class="col-md-2 text-left">
                                 <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example" id="selAnio">
                                     <option value="0">AÑO ACTUAL</option>
                                     <option value="2022">2022</option>
                                     <option value="2023">2023</option>
                                     <option value="2024">2024</option>
                                 </select>
                             </div>


                             <div class="col-md text-right">
                                 <div class="card-tools">

                                     <!-- el siguiente codigo agrega dos botones a la pesta;a de ventas del mes
                 con el fin de que el usuario pueda minimizar la pesta;a o eliminarla-->
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



                     </div> <!-- ./ end card-header mi_card_info -->


                     <div class="card-body">

                         <div class="lineChart">
                             <div id="curve_chart_Google" style="width: 100%; height: 100%;"></div>


                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

         </div><!-- ./row Grafico de LINEA toal ventas mes por año-->



         <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS TOP VENTAS POR CATEGORIA
        -------------------------------------------------------------------------------------------->
         <div class="row">

             <div class="col-lg-6">


                 <div class="card card-info">

                     <div class="card-header mi_card_info">

                         <h3 class="card-title" id="title-header"> TOP VENTAS POR CATEGORÍA</h3>

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

                     </div> <!-- ./ end card-header mi_card_info -->


                     <div class="card-body">

                         <div class="chart">

                             <div id="piechart_3d" style="width: 100%; height: 350px; "></div>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

             <!-------------------------------------------------------------------------------------------
        GRAFICO VENTAS DIA SEMANA
        -------------------------------------------------------------------------------------------->
             <div class="col-lg-6">

                 <div class="card card-info">

                     <div class="card-header mi_card_info">

                         <h3 class="card-title" id="title-header">MAYOR VENTA DIA-SEMANA</h3>

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

                     </div> <!-- ./ end card-header mi_card_info -->


                     <div class="card-body">

                         <div class="chart">

                             <div id="charVentasDiaSemana" style="width: 100%; height: 350px;"></div>
                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>
         </div>



         <!-------------------------------------------------------------------------------------------
        GRAFICO CIRCULAR VENTAS POR USUARIOS
        -------------------------------------------------------------------------------------------->
         <div class="row">

             <div class="col-lg-12">

                 <div class="card card-info">

                     <div class="card-header mi_card_info">

                         <h3 class="card-title" id="Ventas_Por_Usuario"></h3>

                         <div class="card-tools">

                             <!-- el siguiente codigo agrega dos botones a la pesta;a de ventas del mes
       con el fin de que el usuario pueda minimizar la pesta;a o eliminarla-->
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

                     </div> <!-- ./ end card-header mi_card_info -->


                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart_Ventas_Por_Usuario" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>
         </div>


         <!-------------------------------------------------------------------------------------------
        REPORTE VENTAS, COMPRAS Y GANANCIAS
        -------------------------------------------------------------------------------------------->
         <div class="row">
             <div class="col-lg-6">
                 <div class="card card-info ">
                     <div class="card-header mi_card_info">
                         <h3 class="card-title">GANANCIA NETA POR MES</h3>
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
                     </div> <!-- ./ end card-header mi_card_info -->

                     <div class="card-body">
                         <div class="table-responsive">
                             <table class="table table-bordered" id="tbl_Ganancia_Neta">
                                 <thead>
                                     <tr class="text-nowrap">
                                         <th>MES</th>
                                         <th>VENTAS</th>
                                         <th>COMPRAS</th>
                                         <th>GANANCIA NETA</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <!-- AQUI SE ALMACENAN LOS DATOS TBODY -->
                                 </tbody>
                             </table>
                         </div>
                     </div> <!-- ./ end card-body -->
                 </div>
             </div>



             <!-------------------------------------------------------------------------------------------
        REPORTE GANANCIA BRUTA
        -------------------------------------------------------------------------------------------->
             <div class="col-lg-6">
                 <div class="card card-info ">
                     <div class="card-header mi_card_info">
                         <h3 class="card-title">GANANCIA BRUTA POR MES</h3>
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
                     </div> <!-- ./ end card-header mi_card_info -->

                     <div class="card-body">
                         <div class="table-responsive">
                             <table class="table table-bordered" id="tbl_Ganancia_Bruta">
                                 <thead>
                                     <tr class="text-nowrap">
                                         <th>MES</th>
                                         <th>VENTAS</th>
                                         <th>COMPRAS</th>
                                         <th>GANANCIA BRUTA</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <!-- AQUI SE ALMACENAN LOS DATOS TBODY -->
                                 </tbody>
                             </table>
                         </div>
                     </div> <!-- ./ end card-body -->
                 </div>
             </div>
         </div>

         <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS PRODUCTOS VENDIDOS
        -------------------------------------------------------------------------------------------->
         <!-- row Grafico de barras -->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info ">

                     <div class="card-header mi_card_info ">

                         <h3 class="card-title" id="Productos_vendidos"></h3>

                         <div class="card-tools ">

                             <!-- el siguiente codigo agrega dos botones a la pesta;a de ventas del mes
            con el fin de que el usuario pueda minimizar la pesta;a o eliminarla-->

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

                     </div> <!-- ./ end card-header mi_card_info -->


                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart_Productos_Vendidos" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

         </div><!-- ./row Grafico de barras -->


         <!-------------------------------------------------------------------------------------------
            BUSQUEDA PROMEDIOS DE VENTAS
         -------------------------------------------------------------------------------------------->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info ">

                     <div class="card-header mi_card_info ">

                         <h3 class="card-title" id="promedio_ventas"></h3>


                         <div class="row">
                             <div class="col-md-3 text-left">
                                 <div class="form-group">
                                     <select class="form-select form-select-sm form-control" aria-label=".form-select-sm example" id="sel_promedio">
                                         <option value="1">PROMEDIO VENTAS DIARIAS</option>
                                         <option value="2">PROMEDIO VENTAS SEMANALES</option>
                                         <option value="3">PROMEDIO VENTAS MENSUALES</option>
                                         <option value="4">PROMEDIO VENTAS ANUALES</option>
                                     </select>
                                 </div>
                             </div>

                             <div class="col-md-2">
                                 <div class="form-group">
                                     <div class="input-group">
                                         <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                         <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="fecha_desde" readonly>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <div class="form-group">
                                     <div class="input-group">
                                         <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                         <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="fecha_hasta" readonly>
                                     </div>
                                 </div>
                             </div>


                             <div class="col-md-2 text-center">
                                 <!-- href="" se le coloca # para que no dirija a ningun lugar -->
                                 <div class="form-group m-0"><a class="btn btn-primary" style="width:120px;" id="btnFiltrar">Buscar</a></div>

                             </div>

                             <div class="col-md-1 text-center">
                                 <!-- href="" se le coloca # para que no dirija a ningun lugar -->
                                 <div class="form-group m-0"><a class="btn btn-danger" style="width:120px;" id="btnVaciar">VACIAR</a></div>

                             </div>
                             <div class="col-md-2 text-right">
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


                     </div> <!-- ./ end card-header mi_card_info -->


                     <div class="card-body">

                         <div class="table-responsive">
                             <table class="table display nowrap table-bordered w-100 rounded" id="tbl_Promedios">
                                 <thead>
                                     <tr class="text-nowrap">
                                         <th>TOTAL VENTAS</th>
                                         <th>PROMEDIO VENTAS</th>

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





 <script>
     $(document).ready(function() {

         var tbl_promedios;

         cargarGraficoDoughnut();
         cargarGraficoProductosVendidos();
         cargarGraficoVentasPorMes();
         cargarListadoGananciaNeta();
         cargarListadoGananciaBruta();
         cargarGraficoTotalVentasUsuario();
         cargarVentasSemana();

         var sel_Mes = $("#sel_Mes");
         var fecha_desde, fecha_hasta, sel_promedio;

         sel_Mes.on('change', function() {
             $.ajax({
                 url: 'ajax/reportes.ajax.php',
                 type: 'POST',
                 dataType: 'json',
                 data: {
                     'accion': 9,
                     'sel_Mes': sel_Mes.val()
                 },
                 success: function(respuesta) {
                     // console.log("respuesta", respuesta);

                     var fecha_venta = [];
                     var total_venta = [];
                     var total_venta_ant = [];

                     var mes_actual = new Date();
                     // console.log("🚀 ~ file: dashboard.php:351 ~ cargarGraficoBarras ~ mes_actual", mes_actual)
                     var mes_anterior = moment(mes_actual, "DD-MM-YYYY").add(-1, 'months').format('MM/YYYY');
                     //console.log("🚀 ~ file: dashboard.php:353 ~ cargarGraficoBarras ~ mes_anterior", mes_anterior)

                     var total_ventas_mes = 0;

                     for (let i = 0; i < respuesta.length; i++) {

                         fecha_venta.push(respuesta[i]['fecha_venta']);
                         total_venta.push(respuesta[i]['total_venta']);
                         total_venta_ant.push(respuesta[i]['total_venta_ant']);
                         total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i]['total_venta']);
                     }

                     total_venta.push(0);

                     var barChartCanvas = $("#barChart_Ventas_Del_Mes").get(0).getContext('2d');

                     var areaChartData = {
                         labels: fecha_venta,

                         datasets: [{
                             label: 'VENTAS',
                             backgroundColor: 'rgb(142, 255, 0,0.8)',
                             borderColor: 'rgb(142, 255, 0)',
                             borderWidth: 5, // ancho del borde en píxeles
                             data: total_venta
                         }]
                     }

                     var barChartData = $.extend(true, {}, areaChartData);

                     var temp0 = areaChartData.datasets[0];

                     barChartData.datasets[0] = temp0;

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
                                         // Make sure data value does not get overflown and hidden
                                         // when the bar's value is too close to max value of scale
                                         // Note: The y value is reverse, it counts from top down
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
         });

         tbl_promedios = $("#tbl_Promedios").DataTable({
             searching: false,
             dom: 'Bfrtip',
             scrollX: true,
             buttons: [
                 'copy', 'excel', 'print',
             ],
             columnDefs: [{
                     targets: 0,
                     visible: true,
                     orderable: false
                 },
                 {
                     targets: 1,
                     createdCell: function(td, cellData, rowData, row, col) {

                         if (cellData.indexOf("DIARIAS") !== -1) {
                             $(td).parent().css('background', '#00afe5');
                         } else if (cellData.indexOf("SEMANALES") !== -1) {
                             $(td).parent().css('background', '#ff9633');
                         } else if (cellData.indexOf("MENSUALES") !== -1) {
                             $(td).parent().css('background', '#cccc00');
                         } else if (cellData.indexOf("ANUALES") !== -1) {
                             $(td).parent().css('background', '#714acd');
                         }
                     }
                 }
             ],
             language: {
                 url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             },

         });


         $('#btnFiltrar').on('click', function() {
             var sel_promedio = $("#sel_promedio").val();
             var fecha_desde = $("#fecha_desde").val();
             var fecha_hasta = $("#fecha_hasta").val();

             fecha_desde = fecha_desde.substr(6, 4) + '-' + fecha_desde.substr(3, 2) + '-' + fecha_desde.substr(0, 2);
             fecha_hasta = fecha_hasta.substr(6, 4) + '-' + fecha_hasta.substr(3, 2) + '-' + fecha_hasta.substr(0, 2);

             $.ajax({
                 url: 'ajax/reportes.ajax.php',
                 type: 'POST',
                 dataType: 'json',
                 data: {
                     'accion': 10,
                     'sel_Promedio': sel_promedio,
                     'fechaDesde': fecha_desde,
                     'fechaHasta': fecha_hasta,
                 },
                 success: function(respuesta) {


                     for (let i = 0; i < respuesta.length; i++) {
                         let filas = [
                             'Q. ' + respuesta[i]["Total_Venta"],
                             'Q. ' + respuesta[i]["promedio"]
                         ];
                         tbl_promedios.row.add(filas).draw();
                     }
                 }
             });
         });

         $('#btnVaciar').on('click', function() {
             tbl_promedios.clear().draw();
         });



         //CRITERIOS DE BUSQUEDA
         $('#fecha_desde, #fecha_hasta').inputmask('dd/mm/yyyy', {
             'placeholder': 'dd/mm/yyyy'
         });


         //INDICAMOS QUE POR DEFECTO NOS MUESTRE LA FECHA INICIANDO EL MES HASTA EL DIA DE HOY EN LOS INPUTS
         $("#fecha_desde").val(moment().startOf('MONTH').format('DD/MM/YYYY'));

         //CAPUTAMOS EL DIA DE HOY       
         $("#fecha_hasta").val(moment().format('DD/MM/YYYY'));




         var selAnio = $("#selAnio");

         selAnio.on('change', function() {
             obtenerGraficoVentasAnio();
         });




     }); //FIN DOCUMENT READY

     $(function() {
         $("#fecha_desde, #fecha_hasta").datepicker({
             dateFormat: "dd/mm/yy",
             language: "es",
             selectOtherMonths: true,
             // Opciones de configuración aquí
         });
     });

     /* =======================================================
     SOLICITUD AJAX GRAFICO DE DOUGHNUT
     =======================================================*/
     function cargarGraficoDoughnut() {

         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 3
             },
             dataType: 'json',
             success: function(respuesta) {
                 google.charts.load("current", {
                     packages: ["corechart"]
                 });
                 google.charts.setOnLoadCallback(function() {
                     drawChart(respuesta);
                 });
             }
         });

         function drawChart(responseData) {
             var data = new google.visualization.DataTable();
             data.addColumn('string', 'Label');
             data.addColumn('number', 'Y');

             for (var i = 0; i < responseData.length; i++) {
                 data.addRow([responseData[i].label, responseData[i].y]);
             }



             var options = {
                 is3D: true,

                 chartArea: {
                     width: '80%',
                     height: '80%'
                 },
                 legend: {
                     position: 'top'
                 },
                 backgroundColor: 'transparent'
             };


             var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
             chart.draw(data, options);
         }


     }


     function cargarGraficoProductosVendidos() {
         /* =======================================================
          SOLICITUD AJAX CANTIDAD PRODUCTOS VENDIDOS
          =======================================================*/
         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 4 //parametro para obtener los productos vendidos
             },
             dataType: 'json',
             success: function(respuesta) {
                 // console.log("respuesta", respuesta);

                 var descripcion_producto = [];
                 var cantidad = [];


                 for (let i = 0; i < respuesta.length; i++) {

                     descripcion_producto.push(respuesta[i]['descripcion_producto']);
                     cantidad.push(respuesta[i]['cantidad']);

                 }

                 cantidad.push(0);
                 // total_venta.push(600);

                 // console.log(total_ventas_mes);

                 //indicamos en la clase card-title que coloque el dato de la conexion de total_ventas_mes de la base datos
                 $("#Productos_vendidos").html('TOP CANTIDAD PRODUCTOS VENDIDOS');

                 var barChartCanvas = $("#barChart_Productos_Vendidos").get(0).getContext('2d');

                 var areaChartData = {
                     labels: descripcion_producto,
                     datasets: [
                         /*{
                                                 label: 'Ventas del mes anterior',
                                                    //color de las barras
                                                 // backgroundColor: 'rgba(60,141,188,0.9)',
                                                 /* data: total_venta_ant
                                              },*/
                         {
                             label: 'Cantidad Productos vendidos',
                             //color de las barras'rgba(60,141,188,0.9)',
                             backgroundColor: 'rgb(65, 0, 0)',

                             data: cantidad
                         }
                     ]
                 }

                 var barChartData = $.extend(true, {}, areaChartData);

                 var temp0 = areaChartData.datasets[0];

                 barChartData.datasets[0] = temp0;

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
                         duration: 2000,
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
                                     // Make sure data value does not get overflown and hidden
                                     // when the bar's value is too close to max value of scale
                                     // Note: The y value is reverse, it counts from top down
                                     if ((scale_max - model.y) / scale_max >= 0.93)
                                         y_pos = model.y + 20;
                                     ctx.fillText(dataset.data[i], model.x, y_pos);
                                 }
                             });
                         }
                     }
                 }

                 new Chart(barChartCanvas, {
                     type: 'horizontalBar',
                     data: barChartData,
                     options: barChartOptions
                 })


             }
         });


     }



     google.charts.load('current', {
         'packages': ['corechart']
     });
     google.charts.setOnLoadCallback(cargarGraficoVentasPorMes);

     function cargarGraficoVentasPorMes() {
         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 1 //parametro para obtener TOTALES DE VENTAS DE MES POR AÑO
             },
             dataType: 'json',
             success: function(respuesta) {
                 var data = new google.visualization.DataTable();
                 data.addColumn('string', 'Mes');
                 data.addColumn('number', 'Total Venta');
                 data.addColumn({
                     type: 'string',
                     role: 'annotation'
                 });

                 for (let i = 0; i < respuesta.length; i++) {
                     var totalVenta = " Q." + respuesta[i]['Total_Venta'];
                     data.addRow([respuesta[i]['Mes'], parseFloat(respuesta[i]['Total_Venta']), totalVenta]);
                 }

                 var options = {

                     curveType: 'function',
                     legend: {
                         position: 'bottom'
                     },
                     backgroundColor: 'transparent', // Establecer el color de fondo del gráfico en transparente
                     chartArea: {
                         backgroundColor: 'transparent' // Establecer el color de fondo del área del gráfico en transparente
                     },
                     annotations: {
                         textStyle: {
                             fontSize: 12,
                             color: 'black',
                             auraColor: 'none',
                             bold: true // Hacer que el texto esté en negrita
                         }
                     },
                     chartArea: {
                         width: '90%',
                         height: '65%'
                     }, // Ajusta el área del gráfico
                     series: {
                         0: { // Define opciones específicas para la serie (en este caso, la primera serie)
                             pointSize: 10 // Tamaño de los puntos
                         },
                         0: {
                             pointSize: 12, // Tamaño de los puntos
                             lineWidth: 4, // Grosor de la línea
                             color: '#0C4A76' // Color de la línea
                         },
                     },
                     animation: {
        duration: 1000, // Duración de la animación en milisegundos
        startup: true // Habilita la animación al cargar el gráfico por primera vez
    }
                 };

                 var chart = new google.visualization.LineChart(document.getElementById('curve_chart_Google'));
                 chart.draw(data, options);
             }
         });
     }





     /* =======================================================
     SOLICITUD AJAX GRAFICO DE BARRAS TOTAL VENTAS MES POR AÑO
     =======================================================*/


     function cargarGraficoTotalVentasUsuario() {
         /* =======================================================
          SOLICITUD AJAX GRAFICO DE BARRAS TOTAL VENTAS MES POR AÑO
          =======================================================*/
         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 8 //parametro para obtener TOTALES DE VENTAS DE MES POR AÑO
             },
             dataType: 'json',
             success: function(respuesta) {
                 // console.log("respuesta", respuesta);

                 var usuario = [];
                 var ventas_totales = [];

                 for (let i = 0; i < respuesta.length; i++) {
                     usuario.push(respuesta[i]['usuario']);
                     ventas_totales.push(respuesta[i]['ventas_totales']);
                 }

                 ventas_totales.push(0);

                 //indicamos en la clase card-title que coloque el dato de la conexion de total_ventas_mes de la base datos
                 $("#Ventas_Por_Usuario").html('VENTAS DEL MES POR USUARIO');

                 var CharCircular = $("#barChart_Ventas_Por_Usuario").get(0).getContext('2d');

                 var data = {
                     labels: usuario,
                     datasets: [{
                         data: ventas_totales,
                         backgroundColor: [


                             'rgba(128, 0, 128, 0.7)', // morado
                             'rgb(255, 204, 0, 0.7)', // anaranjado
                             'rgba(255, 0, 0, 0.7)', // rojo
                             'rgba(255, 255, 0, 0.7)' // amarillo
                         ],
                         borderColor: [

                             'rgba(128, 0, 128, 1)', // morado
                             'rgba(255, 204, 0, 1)', // anaranjado
                             'rgba(255, 0, 0, 1)', // rojo
                             'rgba(255, 255, 0, 1)' // amarillo
                         ],
                         borderWidth: 3
                     }]
                 };

                 var options = {
                     title: {
                         display: true,
                         text: 'VENTAS DEL MES POR USUARIO'
                     },
                     responsive: true,
                     maintainAspectRatio: false // Desactivar el aspect ratio para mejor ajuste
                 };

                 new Chart(CharCircular, {
                     type: 'pie',
                     data: data,
                     options: options
                 });
             }
         });
     }


     function cargarListadoGananciaNeta() {

         /* =======================================================
          SOLICITUD AJAX VENTAS, COMPRAS Y GANANCIAS
          =======================================================*/
         $.ajax({
             url: "ajax/reportes.ajax.php",
             type: "POST",
             data: {
                 'accion': 5 // listado ventas, compras y ganancias
             },


             dataType: 'json',
             success: function(respuesta) {
                 // console.log("respuesta",respuesta);

                 for (let i = 0; i < respuesta.length; i++) {
                     filas = '<tr>' +
                         '<td>' + respuesta[i]["fecha"] + '</td>' +
                         '<td> Q. ' + respuesta[i]["ventas"] + '</td>' +
                         '<td> Q. ' + respuesta[i]["compras"] + '</td>' +
                         '<td> Q. ' + respuesta[i]["gananciaNeta"] + '</td>' +
                         '</tr>'
                     $("#tbl_Ganancia_Neta tbody").append(filas);
                 }

             }
         });


     }

     function cargarListadoGananciaBruta() {

         /* =======================================================
          SOLICITUD AJAX VENTAS, COMPRAS Y GANANCIAS
          =======================================================*/
         $.ajax({
             url: "ajax/reportes.ajax.php",
             type: "POST",
             data: {
                 'accion': 6 // listado ventas, compras y ganancias bruta
             },


             dataType: 'json',
             success: function(respuesta) {
                 console.log("respuesta", respuesta);

                 for (let i = 0; i < respuesta.length; i++) {
                     filas = '<tr>' +
                         '<td>' + respuesta[i]["fecha"] + '</td>' +
                         '<td> Q. ' + respuesta[i]["ventas"] + '</td>' +
                         '<td> Q. ' + respuesta[i]["compras"] + '</td>' +
                         '<td> Q. ' + respuesta[i]["gananciaBruta"] + '</td>' +
                         '</tr>'
                     $("#tbl_Ganancia_Bruta tbody").append(filas);
                 }

             }
         });
     }




     /* =======================================================
     SOLICITUD AJAX GRAFICO DE DOUGHNUT
     =======================================================*/
     function cargarVentasSemana() {

         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 11
             },
             dataType: 'json',
             success: function(respuesta) {
                 google.charts.load("current", {
                     packages: ["corechart"]
                 });
                 google.charts.setOnLoadCallback(function() {
                     drawChart(respuesta);
                 });


                 function drawChart(responseData) {
                     var data = new google.visualization.DataTable();
                     data.addColumn('string', 'Label');
                     data.addColumn('number', 'Y');

                     for (var i = 0; i < responseData.length; i++) {
                         data.addRow([responseData[i].label, responseData[i].y]);
                     }

                     var options = {
                         pieHole: 0.4,
                         responsive: true,
                         chartArea: {
                             width: '80%',
                             height: '80%'
                         }, // Ajusta el área del gráfico
                         legend: {
                             position: 'top'
                         },
                         backgroundColor: 'transparent'
                     };
                     var chart = new google.visualization.PieChart(document.getElementById('charVentasDiaSemana'));
                     chart.draw(data, options);
                 }
             }
         });



     }


// Volver a dibujar el gráfico cuando cambia el tamaño de la ventana
window.addEventListener('resize', function() {
    cargarGraficoVentasPorMes();
});



     function obtenerGraficoVentasAnio() {
         var selAnio = $("#selAnio").val();

         if (selAnio === "0") {

             selAnio = fechaActual.getFullYear();
         } else {
             var selAnio = $("#selAnio").val();
         }
         $.ajax({
             url: 'ajax/reportes.ajax.php',
             type: 'POST',
             dataType: 'json',
             data: {
                 'accion': 12,
                 'anio': selAnio,
             },
             success: function(respuesta) {
                var data = new google.visualization.DataTable();
            data.addColumn('string', 'Mes');
            data.addColumn('number', 'Total Venta');
            data.addColumn({
                type: 'string',
                role: 'annotation'
            });

            for (let i = 0; i < respuesta.length; i++) {
                var totalVenta = " Q." + respuesta[i]['Total_Venta'];
                data.addRow([respuesta[i]['Mes'], parseFloat(respuesta[i]['Total_Venta']), totalVenta]);
            }

            var options = {

                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'transparent', // Establecer el color de fondo del gráfico en transparente
                chartArea: {
                    backgroundColor: 'transparent' // Establecer el color de fondo del área del gráfico en transparente
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        color: 'black',
                        auraColor: 'none',
                        bold: true // Hacer que el texto esté en negrita
                    }
                },
                chartArea: {
                    width: '90%',
                    height: '65%'
                }, // Ajusta el área del gráfico
                series: {
                    0: { // Define opciones específicas para la serie (en este caso, la primera serie)
                        pointSize: 10 // Tamaño de los puntos
                    },
                    0: {
                        pointSize: 12, // Tamaño de los puntos
                        lineWidth: 4, // Grosor de la línea
                        color: '#0C4A76' // Color de la línea
                    },
                },
                animation: {
        duration: 1000, // Duración de la animación en milisegundos
        startup: true // Habilita la animación al cargar el gráfico por primera vez
    }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart_Google'));
            chart.draw(data, options);
             }

         });


     }
 </script>