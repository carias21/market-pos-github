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
        GRAFICO DE BARRAS PRODUCTOS VENDIDOS
        -------------------------------------------------------------------------------------------->
         <!-- row Grafico de barras -->
         <div class="row">

             <div class="col-12"> 

                 <div class="card card-info ">

                     <div class="card-header ">

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

                     </div> <!-- ./ end card-header -->


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
        GRAFICO DE BARRAS TOTAL VENTAS POR MES DE AÑO ACTUAL
        -------------------------------------------------------------------------------------------->
         <!-- row Grafico de barras -->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info">

                     <div class="card-header">

                         <h3 class="card-title" id="Total_Ventas_Mes_Año"></h3>

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

                     </div> <!-- ./ end card-header -->


                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart_Total_Ventas_Mes_Año" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

         </div><!-- ./row Grafico de barras toal ventas mes por año-->


         <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS TOP VENTAS POR CATEGORIA
        -------------------------------------------------------------------------------------------->
         <div class="col-12">

             <div class="card card-gray shadow">

                 <div class="card-header">

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

                 </div> <!-- ./ end card-header -->


                 <div class="card-body">

                     <div class="chart">

                         <div id="chartContainer" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;"></div>

                     </div>

                 </div> <!-- ./ end card-body -->

             </div>

         </div>


         <!-------------------------------------------------------------------------------------------
        REPORTE VENTAS, COMPRAS Y GANANCIAS
        -------------------------------------------------------------------------------------------->
         <div class="row">
             <div class="col-lg-6">
                 <div class="card card-info ">
                     <div class="card-header">
                         <h3 class="card-title">VENTAS COMPRAS GANANCIA, POR AÑO</h3>
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
                             <table class="table table-bordered" id="tbl_Ventas_Compras_Ganancias">
                                 <thead>
                                     <tr class="text-nowrap">
                                         <th>MES</th>
                                         <th>VENTAS</th>
                                         <th>COMPRAS</th>
                                         <th>GANANCIA</th>
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

         cargarGraficoDoughnut();
         cargarGraficoProductosVendidos();
         cargarGraficoVentasPorMes();
         cargarListadoVentasComprasGanancia();



     })

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

                 var chart = new CanvasJS.Chart("chartContainer", {
                     animationEnabled: true,
                     // title:{
                     //     text: "Email Categories",
                     //     horizontalAlign: "left"
                     // },
                     data: [{
                         type: "doughnut",
                         startAngle: 60,
                         //innerRadius: 60,
                         indexLabelFontSize: 17,
                         indexLabel: "{label} - #percent%",
                         toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                         dataPoints: respuesta
                     }]
                 });
                 chart.render();

             }
         });



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

                     /*    total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i][
                             'total_venta'
                         ] ); */

                 }

                 cantidad.push(0);
                 // total_venta.push(600);

                 // console.log(total_ventas_mes);

                 //indicamos en la clase card-title que coloque el dato de la conexion de total_ventas_mes de la base datos
                 $("#Productos_vendidos").html('CANTIDAD PRODUCTOS VENDIDOS');

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
                     type: 'bar',
                     data: barChartData,
                     options: barChartOptions
                 })


             }
         });


     }

     function cargarGraficoVentasPorMes() {

         /* =======================================================
         SOLICITUD AJAX GRAFICO DE BARRAS TOTAL VENTAS MES POR AÑO
         =======================================================*/
         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 1 //parametro para obtener TOTALES DE VENTAS DE MES POR AÑO
             },
             dataType: 'json',
             success: function(respuesta) {
                 // console.log("respuesta", respuesta);

                 var Mes = [];
                 var Total_Venta = [];


                 for (let i = 0; i < respuesta.length; i++) {

                     Mes.push(respuesta[i]['Mes']);
                     Total_Venta.push(respuesta[i]['Total_Venta']);

                     /*    total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i][
                             'total_venta'
                         ] ); */

                 }

                 Total_Venta.push(0);
                 // total_venta.push(600);

                 // console.log(total_ventas_mes);

                 //indicamos en la clase card-title que coloque el dato de la conexion de total_ventas_mes de la base datos
                 $("#Total_Ventas_Mes_Año").html('TOTAL VENTAS POR MES');

                 var barChartCanvas = $("#barChart_Total_Ventas_Mes_Año").get(0).getContext('2d');

                 var areaChartData = {
                     labels: Mes,
                     datasets: [
                         /*{
                                                 label: 'Ventas del mes anterior',
                                                    //color de las barras
                                                 // backgroundColor: 'rgba(60,141,188,0.9)',
                                                 /* data: total_venta_ant
                                              },*/
                         {
                             label: 'Total ventas Mes',
                             //color de las barras'rgba(60,141,188,0.9)',
                             backgroundColor: 'rgb(196, 230, 0)',

                             data: Total_Venta
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
                     type: 'bar',
                     data: barChartData,
                     options: barChartOptions
                 })


             }
         });
     }

     function cargarListadoVentasComprasGanancia(){

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
                         '<td> Q. ' + respuesta[i]["ganancia"] + '</td>' +
                         '</tr>'
                     $("#tbl_Ventas_Compras_Ganancias tbody").append(filas);
                 }

             }
         });


     }
 </script>