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

                 <div class="card card-info">

                     <div class="card-header">

                         <h3 class="card-title" id="Productos_vendidos"></h3>

                         <div class="card-tools">

                             <!-- el siguiente codigo agrega dos botones a la pesta;a de ventas del mes
            con el fin de que el usuario pueda minimizar la pesta;a o eliminarla-->
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove">
                                 <i class="fas fa-times"></i>
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
        GRAFICO DE BARRAS TOTAL VENTAS POR MES DE A??O ACTUAL
        -------------------------------------------------------------------------------------------->
         <!-- row Grafico de barras -->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info">

                     <div class="card-header">

                         <h3 class="card-title" id="Total_Ventas_Mes_A??o"></h3>

                         <div class="card-tools">

                             <!-- el siguiente codigo agrega dos botones a la pesta;a de ventas del mes
            con el fin de que el usuario pueda minimizar la pesta;a o eliminarla-->
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove">
                                 <i class="fas fa-times"></i>
                             </button>

                         </div> <!-- ./ end card-tools -->

                     </div> <!-- ./ end card-header -->


                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart_Total_Ventas_Mes_A??o" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

         </div><!-- ./row Grafico de barras toal ventas mes por a??o-->


            <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS TOP VENTAS POR CATEGORIA
        -------------------------------------------------------------------------------------------->
         <div class="col-12">

             <div class="card card-gray shadow">

                 <div class="card-header">

                     <h3 class="card-title" id="title-header"> TOP VENTAS POR CATEGOR??A</h3>

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

                     <div class="chart">

                         <div id="chartContainer" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;"></div>

                     </div>

                 </div> <!-- ./ end card-body -->

             </div>

         </div>



     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->

 <script>
     $(document).ready(function() {

         /* =======================================================
          SOLICITUD AJAX GRAFICO DE BARRAS PRODUCTOS VENDIDOS
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
                 $("#Productos_vendidos").html('Cantidad productos vendidos');

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


         /* =======================================================
         SOLICITUD AJAX GRAFICO DE BARRAS TOTAL VENTAS MES POR A??O
         =======================================================*/
         $.ajax({
             url: "ajax/reportes.ajax.php",
             method: 'POST',
             data: {
                 'accion': 1 //parametro para obtener TOTALES DE VENTAS DE MES POR A??O
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
                 $("#Total_Ventas_Mes_A??o").html('Total ventas * Mes');

                 var barChartCanvas = $("#barChart_Total_Ventas_Mes_A??o").get(0).getContext('2d');

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

     })
 </script>