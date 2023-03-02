 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-6">
                 <h4 class="m-0">DETALLES DE VENTA</h4>
             </div><!-- /.col -->
             <div class="col-md-6">
                 <ol class="breadcrumb float-md-right">
                     <li class="breadcrumb-item"><a href="index.php">INICIO</a></li>
                     <li class="breadcrumb-item">VENTAS</li>
                     <li class="breadcrumb-item active">ADMINISTRAR VENTAS</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->


 <div class="content pb-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-info">
                     <div class="card-header">
                         <h3 class="card-title">Criterios de Busqueda</h3>
                         <div class="card-tools"><button class="btn btn-tool" type="button" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-2">
                                 <div class="form-group">
                                     <label for="">Ventas desde:</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                         <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="ventas_desde">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <div class="form-group">
                                     <label for="">Ventas hasta:</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                         <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="ventas_hasta">
                                     </div>
                                 </div>
                             </div>



                             <div class="col-md-8 d-flex flex-row align-items-center justify-content-end">
                                 <!-- href="" se le coloca # para que no dirija a ningun lugar -->
                                 <div class="form-group m-0"><a href="#" class="btn btn-primary" style="width:120px;" id="btnFiltrar">Buscar</a></div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-4 mb-3">
             <h4>Total Venta: Q. <span id="id_totalVenta">0.00</span></h4>
         </div>

         <!-- Main content -->
         <div class="content pb-2">
             <div class="row p-0 m-0">
                 <!-- Listado de categorias -->
                 <div class="col-md-12">
                     <div class="card card-info card-outline shadow">
                         <div class="card-header">
                             <h3 class="card-title"><i class="far fa-list-alt"></i> Listado de Ventas</h3>
                         </div>
                         <div class="card-body">
                             <table id="lstVentas" class="display nowrap table-striped w-100 shadow rounded">
                                 <thead class="bg-info text-left">
                                     <th>id</th>
                                     <th>Codigo</th>
                                     <th>Categoría</th>
                                     <th>Producto</th>
                                     <th>Cantidad</th>
                                     <th>P. Venta</th>
                                     <th>Descuento</th>
                                     <th>Total</th>
                                     <!--   <th>Observaciones</th>   -->
                                     <th>Fecha de Venta</th>
                                     <th>Usuario</th>
                                     <th class="text-center">Opciones</th>
                                   

                                 </thead>
                                 <tbody class="small text left"></tbody>
                             </table>
                         </div>
                     </div>
                 </div>




                 <!--  GUIA VD 19 MIN 19:42 -->
                 <script>
                     var Toast = Swal.mixin({
                         toast: true,
                         position: 'top',
                         showConfirmButton: false,
                         timer: 3000
                     });

                     // VD 21 MIN 6:38
                     $(document).ready(function() {
                        
                         var tableVentas, ventas_desde, ventas_hasta;
                         //VD 21 MIN 20:10 CREAMOS LA VARIABLE GROUPCOLUMN E INDICAMOS NO. DE QUE COLUMNA QUEREMOS AGRUPAR 8=fecha_venta
                         var groupColumn = 8;

                         // // VD 21 MIN 8:40
                         //CRITERIOS DE BUSQUEDA
                         $('#ventas_desde, #ventas_hasta').inputmask('dd/mm/yyyy', {
                             'placeholder': 'dd/mm/yyyy'
                         })
                         /*FUNCION PARA COLOCAR CALENDARIO PENDIENTE
                          $('#ventas_desde, #ventas_hasta').datepicker().format('DD/MM/YYYY');
                          */

                         //INDICAMOS QUE POR DEFECTO NOS MUESTRE LA FECHA INICIANDO EL MES HASTA EL DIA DE HOY EN LOS INPUTS
                         $("#ventas_desde").val(moment().startOf('month').format('DD/MM/YYYY'));
                         //CAPUTAMOS EL DIA DE HOY       
                         $("#ventas_hasta").val(moment().format('DD/MM/YYYY'));

                         //VD 21 MIN 16:40
                         ventas_desde = $("#ventas_desde").val();
                         ventas_hasta = $("#ventas_hasta").val();

                         ventas_desde = ventas_desde.substr(6, 4) + '-' + ventas_desde.substr(3, 2) + '-' + ventas_desde.substr(0, 2);
                         //  console.log(ventas_desde, "Ventas Desde")
                         ventas_hasta = ventas_hasta.substr(6, 4) + '-' + ventas_hasta.substr(3, 2) + '-' + ventas_hasta.substr(0, 2);

                         var tableVentas = $('#lstVentas').DataTable({
                             //ajustable 
                             scrollX: true,
                             dom: 'Bfrtip',
                             buttons: [
                                 'excel', 'print', 'pageLength',
                             ],
                             ajax: {
                                 url: 'ajax/administrar_ventas.ajax.php',
                                 type: 'POST',
                                 dataType: 'json',
                                 //VD 22 MIN 1:10
                                 "dataSrc": "",
                                 data: {
                                     'accion': 2,
                                     'fechaDesde': ventas_desde,
                                     'fechaHasta': ventas_hasta
                                 }
                                
                             },



                             /* ==========================================PENDIENTE (AGRUPAR POR FECHAS)===========================     //  
                                    //VD 21 MIN 21:5 FUNCTIO PARA BUSCAR EN LA TABLA DATOS REPETIDOS
                                    //ME MUESTRA LA FECHA PERO DEBO CONVERTIRLA A FECHA SIN HORA
                                     drawCallback: function(settings){
                                // Se separa fecha y hora para tomar solo la fecha
                                        var api = this.api();
                                        var rows = api.rows({page: 'current'}).nodes();
                                        var last=null;
                                        
                                        api.column(groupColumn, {page:'current'}).data().each(function(group,i){
                                        console.log(group,'recorre valores de la columna asignada (8)')
                                        })
                                     }, */


                             "columns": [{
                                 "data": "id_venta",
                                 "data": "codigo_producto",
                                 "data": "categoria",
                                 "data": "descripcion",
                                 "data": "cantidad",
                                 "data": "precio_venta",
                                 "data": "descuento_venta",
                                 "data": "total_venta",
                                 "data": "fecha_venta", 
                                 "data": "usuario"
                                

                             }],


                             "order": [
                                 [8, 'desc']
                             ],

                             columnDefs: [{
                                     //oculte las columnas
                                     targets: 0,
                                     visible: false
                                 },

                                 {
                                     targets: 6,
                                     orderable: false,


                                 },
                                 {
                                     targets: 10,

                                     render: function(data, type, full, meta) {
                                         /*retorna un ocono de un lapiz en inventario en opciones, con el style cursor... indicamos que al seleccionar el 
                                         icono aparezca en el puntero del mause una mano*/
                                         return "<center>" +
                                             //opciones eliminar icono
                                             "<span class='btnEliminarVenta text-danger px-1' style='cursor:pointer;'>" +
                                             "<i class='fas fa-trash fs-5'></i>" +
                                             "</span>" +
                                             "</center>"
                                     }
                                 }
                             ],

                             lengthMenu: [0, 15, 50, 100, 500, 1000],
                             "pageLength": 15,
                             "language": {
                                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                             }
                         });


                         /*===================================================================*/
                         //EVENTO ELIMINAR UNA VENTA
                         /*===================================================================*/
                         $('#lstVentas tbody').on('click', '.btnEliminarVenta', function() {
                             accion = 3;
                             var data = tableVentas.row($(this).parents('tr')).data();

                             var id_venta = data["id_venta"];
                             var codigo_producto = data["codigo_producto"];
                             var cantidad = data["cantidad"];
                             var fecha_venta = data["fecha_venta"];
                             
                            //alert(cantidad);
                            //return;
                             //  alert(id_venta);

                             Swal.fire({
                                 title: 'Está seguro de eliminar la venta con el id' + id_venta + '?',
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
                                     datos.append("id_venta", id_venta);
                                     datos.append("codigo_producto", codigo_producto);
                                     datos.append("cantidad", cantidad);
                                     datos.append("fecha_venta", fecha_venta)


                                     $.ajax({
                                         url: "ajax/administrar_ventas.ajax.php",
                                         method: "POST",
                                         data: datos,
                                         contentType: false,
                                         processData: false,
                                         dataType: 'json',
                                         success: function(respuesta) {
                                             if (respuesta == "ok") {
                                                 Toast.fire({
                                                     icon: 'success',
                                                     title: 'Se elimino la venta correctamente!'
                                                 });
                                                 tableVentas.ajax.reload();
                                             } else {
                                                 Toast.fire({
                                                     icon: 'error',
                                                     title: 'La venta, no se pudo eliminar'
                                                 });
                                             }
                                         }
                                     });



                                 }
                             })
                         });

                         /*===================================================================*/
                         //EVENTO BUSCAR POR RANGO DE FECHAS
                         /*===================================================================*/
                         //VD 2:50

                         $('#btnFiltrar').on('click', function() {

                             tableVentas.destroy();

                             if ($("#ventas_desde").val() == '') {
                                 ventas_desde = '21/10/2001';
                             } else {
                                 ventas_desde = $("#ventas_desde").val()
                             }

                             if ($("#ventas_hasta").val() == '') {
                                 ventas_hasta = '21/10/2099';
                             } else {
                                 ventas_hasta = $("#ventas_hasta").val()
                             }
                             //   console.log(ventas_hasta,"buscar por rango venta_hasta");
                             //  console.log(ventas_desde,"buscar por rango venta_desde");

                             ventas_desde = ventas_desde.substr(6, 4) + '-' + ventas_desde.substr(3, 2) + '-' + ventas_desde.substr(0, 2);
                             //    console.log(ventas_desde, "Con formato 2022-12-01")
                             ventas_hasta = ventas_hasta.substr(6, 4) + '-' + ventas_hasta.substr(3, 2) + '-' + ventas_hasta.substr(0, 2);

                             var groupColumn = 0;

                             tableVentas = $('#lstVentas').DataTable({
                                 //ajustable 
                                 scrollX: true,
                                 dom: 'Bfrtip',
                                 buttons: [
                                     'excel', 'print', 'pageLength',
                                 ],
                                 ajax: {
                                    
                                     url: 'ajax/administrar_ventas.ajax.php',
                                     type: 'POST',
                                     dataType: 'json',
                                     //VD 22 MIN 1.10
                                   
                                     data: {
                                         'accion': 2,
                                         'fechaDesde': ventas_desde,
                                         'fechaHasta': ventas_hasta
                                     },
                                     "dataSrc": function(respuesta) {
                                           console.log(respuesta, "Total Venta !");
                                         var TotalVenta = 0.00;
                                         for (let i = 0; i < respuesta.length; i++) {
                                             TotalVenta = parseFloat(respuesta[i][7].replace('Q.', '')) + parseFloat(TotalVenta);
                                         }
                                         $("#id_totalVenta").html(TotalVenta.toFixed(2).toString().replace(
                                             /\d(?=(\d{3})+\.)/g, "$&,"))
                                         return respuesta;
                                     }
                                 },

                                 /* ==========================================PENDIENTE (AGRUPAR POR FECHAS)===========================     //  
                                        //VD 21 MIN 21:5 FUNCTIO PARA BUSCAR EN LA TABLA DATOS REPETIDOS
                                        //ME MUESTRA LA FECHA PERO DEBO CONVERTIRLA A FECHA SIN HORA
                                         drawCallback: function(settings){
                                    // Se separa fecha y hora para tomar solo la fecha
                                            var api = this.api();
                                            var rows = api.rows({page: 'current'}).nodes();
                                            var last=null;
                                            
                                            api.column(groupColumn, {page:'current'}).data().each(function(group,i){
                                            console.log(group,'recorre valores de la columna asignada (8)')
                                            })
                                         }, */


                                 "columns": [{
                                     "data": "id_venta",
                                     "data": "codigo_producto"
                                 }],


                                 "order": [
                                     [8, 'desc']
                                 ],

                                 columnDefs: [{
                                         //oculte las columnas
                                         targets: 0,
                                         visible: false
                                     },

                                     {
                                         targets: 6,
                                         orderable: false,


                                     },
                                     {
                                         targets: 10,

                                         render: function(data, type, full, meta) {
                                             /*retorna un ocono de un lapiz en inventario en opciones, con el style cursor... indicamos que al seleccionar el 
                                             icono aparezca en el puntero del mause una mano*/
                                             return "<center>" +
                                                 //opciones eliminar icono
                                                 "<span class='btnEliminarVenta text-danger px-1' style='cursor:pointer;'>" +
                                                 "<i class='fas fa-trash fs-5'></i>" +
                                                 "</span>" +
                                                 "</center>"
                                         }
                                     }
                                 ],

                                 lengthMenu: [0, 15, 50, 100, 500, 1000],
                                 "pageLength": 15,
                                 "language": {
                                     "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"

                                 }
                             });

                         })
    //ACTUALIZAR CADA 5 SEGUNDOS LA TABLA
  /*  setInterval(() => {

tableVentas.ajax.reload();
console.log("Actualizar 7 segundos");
// 10000 = 10segundos 
}, 7000);
                             
                   */ 
                     })
                 </script>



                 <!-- /.content -->