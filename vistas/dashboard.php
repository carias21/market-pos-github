 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">TABLERO PRINCIPAL</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                     <li class="breadcrumb-item active">TABLERO PRINCIPAL</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">

     <div class="container-fluid">

         <!-- row Tarjetas Informativas -->
         <div class="row">

             <!-- productos registrados -->
             <div class="col-lg-2">
                 <!-- small box -->
                 <div class="small-box border border-info">
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
             <div class="col-lg-2">
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

             <!-- TARJETA TOTAL VENTAS -->
             <div class="col-lg-2">
                 <!-- small box -->
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

             <!-- TARJETA TOTAL GANANCIAS -->
             <div class="col-lg-2">
                 <!-- small box -->
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

             <!-- TARJETA PRODUCTOS POCO STOCK -->
             <div class="col-lg-2">
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

             <!-- TARJETA TOTAL VENTAS DIA ACTUAL -->
             <div class="col-lg-2">
                 <!-- small box -->
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


         </div> <!-- ./row Tarjetas Informativas -->


         <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS VENTAS DEL MES
        -------------------------------------------------------------------------------------------->
         <!-- row Grafico de barras -->
         <div class="row">

             <div class="col-12">

                 <div class="card card-info">

                     <div class="card-header">

                         <h3 class="card-title" id="title-header"></h3>

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
                                 <i class="fas fa-expand"></i></button>


                         </div> <!-- ./ end card-tools -->

                     </div> <!-- ./ end card-header -->


                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> <!-- ./ end card-body -->

                 </div>

             </div>

         </div><!-- ./row Grafico de barras -->

         <!-------------------------------------------------------------------------------------------
        GRAFICO DE BARRAS LOS 10 PRODUCTOS MAS VENDIDOS
        -------------------------------------------------------------------------------------------->
         <div class="row">
             <div class="col-lg-6">
                 <div class="card card-info ">
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
                 <div class="card card-info ">
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


 <script>
     /* solicitus ajax, tarjetas de informacion en el tablero
      princial */
     $(document).ready(function() {

         ajustarHeadersDataTables($('#tbl_productos_poco_stock'));
         ajustarHeadersDataTables($('#tbl_productos_mas_vendidos'));

         function numberWithCommas(x) {
             return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }

         /* =======================================================
         SOLICITUD AJAX TARJETAS INFORMATIVAS
         =======================================================*/
         $.ajax({
             url: "ajax/dashboard.ajax.php",
             method: 'POST',
             dataType: 'json',
             success: function(respuesta) {
                 //     console.log("respuesta", respuesta);
                 $("#totalProductos").html(respuesta[0]['totalProductos']);
                 $("#totalCompras").html('Q.' + respuesta[0]['totalCompras'].toLocaleString('en'))
                 //otras opciones de mostrar las cantidades: .toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}))
                 $("#totalVentas").html('Q.' + respuesta[0]['totalVentas'].toLocaleString('en'))
                 //  console.log(totalVentas);
                 $("#totalGanancias").html('Q.' + respuesta[0]['ganancias'].toLocaleString('en'))
                 $("#totalProductosMinStock").html(respuesta[0]['productosPocoStock'].toLocaleString('en'))
                 $("#totalVentasHoy").html('Q.' + respuesta[0]['ventasHoy'].toLocaleString('en'))
             }
         });


         /*SetInterval siver para que cada 10 segundos se actualicen las tarjetas
         10000 = 10segundos */

         setInterval(() => {
             $.ajax({
                 url: "ajax/dashboard.ajax.php",
                 method: 'POST',
                 dataType: 'json',
                 success: function(respuesta) {

                     $("#totalProductos").html(respuesta[0]['totalProductos']);
                     $("#totalCompras").html('Q.' + respuesta[0]['totalCompras'].toLocaleString('en'))
                     $("#totalVentas").html('Q.' + respuesta[0]['totalVentas'].toLocaleString('en'))
                     $("#totalGancias").html('Q.' + respuesta[0]['ganancias'].toLocaleString('en'))
                     $("#totalProductosMinStock").html(respuesta[0]['productosPocoStock'].toLocaleString('en'))
                     $("#totalVentasHoy").html('Q.' + respuesta[0]['ventasHoy'].toLocaleString('en'))
                     //console.log("respuesta", respuesta);
                 }
             });
             /* 10000 = 10segundos */
         }, 15000);


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
                 //console.log(total_ventas_mes);

                 //indicamos en la clase card-title que coloque el dato de la conexion de total_ventas_mes de la base datos
                 $("#title-header").html('Ventas del Mes: Q. ' + total_ventas_mes.toFixed(2).toString().replace(
                     /\d(?=(\d{3})+\.)/g, "$&,"));

                 var barChartCanvas = $("#barChart").get(0).getContext('2d');

                 var areaChartData = {
                     labels: fecha_venta,
                     datasets: [{
                             label: 'Ventas del mes anterior',
                             //color de las barras
                             backgroundColor: 'rgb(255, 171, 0)',
                             data: total_venta_ant
                         },
                         {
                             label: 'Ventas del Mes Actual',
                             //color de las barras'rgba(60,141,188,0.9)',
                             backgroundColor: 'rgb(142, 255, 0)',
                             data: total_venta
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






         //******************************************************************************************************************** */
         //-------------AJAX LOS 10 PRODUCTOS MAS VENDIDOS------------------------------

         table = $("#tbl_productos_mas_vendidos").DataTable({
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
         table = $("#tbl_productos_poco_stock").DataTable({
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
                 url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             }
         });


     }) //FIN DOCUMENT READY

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