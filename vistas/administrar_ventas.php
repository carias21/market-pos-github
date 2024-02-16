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
                     <div class="card-header mi_card_info">
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
                                         <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="ventas_desde" readonly>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <div class="form-group">
                                     <label for="">Ventas hasta:</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                         <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="ventas_hasta" readonly>
                                     </div>
                                 </div>
                             </div>

                             <div class="col-md-2">
                                 <div class="form-group">
                                     <label for="">Usuario:</label>
                                     <select class="form-select form-select-sm  form-control" aria-label=".form-select-sm example" id="sel_Usuario">
                                     </select>
                                 </div>
                             </div>

                             <div class="col-md-2">
                                 <div class="form-group">
                                     <label for="">Tipo Pago:</label>
                                     <select class="form-select form-select-sm  form-control" aria-label=".form-select-sm example" id="sel_Tipo_Pago">
                                         <option value="">TIPO DE PAGO</option>
                                         <option value="1">EFECTIVO</option>
                                         <option value="2">TARJETA</option>
                                         <option value="3">TRANFERENCIA</option>
                                         <option value="4">OTRO</option>
                                     </select>
                                 </div>
                             </div>

                             <div class="col-md-4 d-flex flex-row align-items-center justify-content-end">
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
                                 <thead class=" mi_card_info text-left">
                                     <th>id</th>
                                     <th>Codigo</th>
                                     <th>Categoría</th>
                                     <th>Producto</th>
                                     <th>Cantidad</th>
                                     <th>P. Venta</th>
                                     <th>Descuento</th>
                                     <th>Total</th>
                                     <th>Fecha de Venta</th>
                                     <th>Usuario</th>
                                     <th>Precio_compra</th>
                                     <th>Tipo Pago</th>
                                     <th>Cliente</th>

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

                         cargarSelectUsuarios();

                         var tableVentas, ventas_desde, ventas_hasta, sel_Tipo_Pago, sel_Usuario;
                         var groupColumn = 8;

                         // // VD 21 MIN 8:40
                         //CRITERIOS DE BUSQUEDA
                         $('#ventas_desde, #ventas_hasta').inputmask('dd/mm/yyyy', {
                             'placeholder': 'dd/mm/yyyy'
                         })



                         //INDICAMOS QUE POR DEFECTO NOS MUESTRE LA FECHA INICIANDO EL MES HASTA EL DIA DE HOY EN LOS INPUTS
                         $("#ventas_desde").val(moment().startOf('month').format('DD/MM/YYYY'));
                         //CAPUTAMOS EL DIA DE HOY       
                         $("#ventas_hasta").val(moment().format('DD/MM/YYYY'));


                         //VD 21 MIN 16:40
                         ventas_desde = $("#ventas_desde").val();
                         ventas_hasta = $("#ventas_hasta").val();
                         sel_Usuario = $("#sel_Usuario").val();
                         sel_Tipo_Pago = $("#sel_Tipo_Pago").val();



                         ventas_desde = ventas_desde.substr(6, 4) + '-' + ventas_desde.substr(3, 2) + '-' + ventas_desde.substr(0, 2);
                         console.log(ventas_desde, "Ventas Desde")
                         ventas_hasta = ventas_hasta.substr(6, 4) + '-' + ventas_hasta.substr(3, 2) + '-' + ventas_hasta.substr(0, 2);



                         /*===================================================================*/
                         //LISTAR VENTAS
                         /*===================================================================*/
                         var tableVentas = $('#lstVentas').DataTable({
                             //ajustable 
                             scrollX: true,
                             dom: 'Bfrtip',
                             paging: true, // Habilita la paginación

                             pageLength: 10,
                             buttons: [{

                                     extend: 'excelHtml5',
                                     titleAttr: 'Exportar a Excel',
                                     className: 'btn btn-success',
                                     exportOptions: {
                                         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11]
                                     }
                                 },
                                 {
                                     extend: 'print',

                                     titleAttr: 'Imprimir',
                                     className: 'btn btn-info',
                                     exportOptions: {
                                         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11]
                                     }
                                 },
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
                                     'fechaHasta': ventas_hasta,
                                     'id_usuario': sel_Usuario,
                                     'tipo_pago': sel_Tipo_Pago
                                 }

                             },
                             "order": [
                                 [8, 'desc']
                             ],

                             columnDefs: [{
                                     //oculte las columnas
                                     targets: 0,
                                     visible: false,
                                     'data': 'id_venta',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 1,
                                     'data': 'codigo_producto',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 2,
                                     'data': 'nombre_categoria',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 3,
                                     'data': 'producto',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 4,
                                     'data': 'cantidad',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 5,
                                     'data': 'precio_venta',
                                     orderable: false,
                                 },

                                 {
                                     targets: 6,
                                     'data': 'descuento_venta',
                                     orderable: false,

                                 },
                                 {
                                     //oculte las columnas
                                     targets: 7,
                                     'data': 'total_venta',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 8,
                                     'data': 'fecha_venta',
                                     orderable: false,
                                     visible: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 9,
                                     'data': 'usuario',
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 10,
                                     'data': 'precio_compra',
                                     visible: false,
                                     //que no busque registro en la tabla
                                     searchable: false,
                                     orderable: false,
                                 },
                                 {
                                     //oculte las columnas
                                     targets: 11,
                                     'data': 'tipo_pago',
                                     orderable: false,

                                 },
                                 {

                                     targets: 12,
                                     'data': 'nombre_cliente',
                                     orderable: false,

                                 },
                                 {
                                     targets: 13,

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
                             drawCallback: function(settings) {
                                 var api = this.api();
                                 var rows = api.rows({
                                     page: 'current'
                                 }).nodes();
                                 var last = null;

                                 api.column(groupColumn, {
                                     page: 'current'
                                 }).data().each(function(group, i) {
                                     //console.log(group);
                                     if (last !== group) {
                                         $(rows).eq(i).before(
                                             '<tr class="group">' +
                                             '<td colspan="12" class="fs-6 fw-bold fst-italic bg-warning text-white">' +
                                             group +
                                             '</td>' +
                                             '</tr>'
                                         );
                                         last = group;
                                     }
                                 });
                             },
                             fixedColumns: {
                                 leftColumns: 0, // No se fijan columnas a la izquierda
                                 rightColumns: 1, // Fija la columna con la clase "columna-fija" a la derecha
                             },
                             "language": {
                                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                             },

                             "aLengthMenu": [
                                 [90000000]
                             ]



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
                                 title: 'ESTÁ SEGURO DE ELIMINAR LA VENTA?',
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

                                                 mensajeToast('success', 'SE ELIMINÓ LA VENTA CORRECTAMENTE');

                                                 tableVentas.ajax.reload();
                                             } else {
                                                 Swal.fire({
                                                     position: 'center',
                                                     icon: 'error',
                                                     title: 'ERROR AL ELIMINAR LA VENTA' +
                                                         'comunicate con tu administrador',
                                                     showConfirmButton: false,
                                                     timer: 3500
                                                 });
                                                 $.ajax({
                                                     url: "vistas/enviar_correo.php",
                                                     type: "POST",
                                                     data: {
                                                         respuesta: respuesta
                                                     },
                                                     success: function(respuesta) {
                                                         console.log("Correo enviado correctamente.");
                                                     },
                                                     error: function() {
                                                         console.log("Error al enviar el correo.");
                                                     }
                                                 });
                                             }
                                         }
                                     });
                                 }
                             })
                         });



                         $(function() {
                             $("#ventas_desde, #ventas_hasta").datepicker({
                                 dateFormat: "dd/mm/yy",
                                 language: "es",
                                 selectOtherMonths: true,
                                 // Opciones de configuración aquí
                             });
                         });




                         /*===================================================================*/
                         //EVENTO BUSCAR POR RANGO DE FECHAS
                         /*===================================================================*/
                         //VD 2:50

                         $('#btnFiltrar').on('click', function() {
                             sel_Usuario = $("#sel_Usuario").val();
                             sel_Tipo_Pago = $("#sel_Tipo_Pago").val();

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

                             var groupColumn = 8;

                             tableVentas = $('#lstVentas').DataTable({
                                 //ajustable 
                                 scrollX: true,
                                 dom: 'Bfrtip',
                                 buttons: [{

                                         extend: 'excelHtml5',
                                         titleAttr: 'Exportar a Excel',
                                         className: 'btn btn-success',
                                         exportOptions: {
                                             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11]
                                         }
                                     },
                                     {
                                         extend: 'print',

                                         titleAttr: 'Imprimir',
                                         className: 'btn btn-info',
                                         exportOptions: {
                                             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11]
                                         }
                                     },
                                 ],
                                 ajax: {

                                     url: 'ajax/administrar_ventas.ajax.php',
                                     type: 'POST',
                                     dataType: 'json',
                                     //VD 22 MIN 1.10

                                     data: {
                                         'accion': 2,
                                         'fechaDesde': ventas_desde,
                                         'fechaHasta': ventas_hasta,
                                         'id_usuario': sel_Usuario,
                                         'tipo_pago': sel_Tipo_Pago
                                     },
                                     "dataSrc": function(respuesta) {
                                         //console.log(respuesta, "Total Venta !");
                                         var TotalVenta = 0.00;
                                         for (let i = 0; i < respuesta.length; i++) {
                                             TotalVenta = parseFloat(respuesta[i][7].replace('Q.', '')) + parseFloat(TotalVenta);
                                         }
                                         $("#id_totalVenta").html(TotalVenta.toFixed(2).toString().replace(
                                             /\d(?=(\d{3})+\.)/g, "$&,"))
                                         return respuesta;
                                     }
                                 },

                                 "order": [
                                     [8, 'desc']
                                 ],



                                 columnDefs: [{
                                         //oculte las columnas
                                         targets: 0,
                                         visible: false,
                                         'data': 'id_venta',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 1,
                                         'data': 'codigo_producto',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 2,
                                         'data': 'nombre_categoria',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 3,
                                         'data': 'producto',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 4,
                                         'data': 'cantidad',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 5,
                                         'data': 'precio_venta',
                                         orderable: false,
                                     },

                                     {
                                         targets: 6,
                                         'data': 'descuento_venta',
                                         orderable: false,

                                     },
                                     {
                                         //oculte las columnas
                                         targets: 7,
                                         'data': 'total_venta',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 8,
                                         'data': 'fecha_venta',
                                         orderable: false,
                                         visible: false
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 9,
                                         'data': 'usuario',
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 10,
                                         'data': 'precio_compra',
                                         visible: false,
                                         //que no busque registro en la tabla
                                         searchable: false,
                                         orderable: false,
                                     },
                                     {
                                         //oculte las columnas
                                         targets: 11,
                                         'data': 'tipo_pago',
                                         orderable: false,

                                     },
                                     {
                                         //oculte las columnas
                                         targets: 12,
                                         'data': 'nombre_cliente',
                                         orderable: false,

                                     },
                                     {
                                         targets: 13,

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
                                 drawCallback: function(settings) {
                                     var api = this.api();
                                     var rows = api.rows({
                                         page: 'current'
                                     }).nodes();
                                     var last = null;

                                     api.column(groupColumn, {
                                         page: 'current'
                                     }).data().each(function(group, i) {
                                         //console.log(group);
                                         if (last !== group) {
                                             $(rows).eq(i).before(
                                                 '<tr class="group">' +
                                                 '<td colspan="12" class="fs-6 fw-bold fst-italic bg-success text-white">' +
                                                 group +
                                                 '</td>' +
                                                 '</tr>'
                                             );
                                             last = group;
                                         }
                                     });
                                 },

                                 lengthMenu: [0, 15, 50, 100, 500, 1000],
                                 "pageLength": 15,
                                 "language": {
                                     "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"

                                 }
                             });

                         })

                     }) //FUN DOCUMENT READY

                     /*===================================================================*/
                     //SOLICITUD AJAX PARA CARGAR SELECT USUARIO
                     /*===================================================================*/
                     //VD 11 MIN 46:00
                     function cargarSelectUsuarios() {
                         $.ajax({
                             url: "ajax/usuario.ajax.php",
                             cache: false,
                             contentType: false,
                             processData: false,
                             dataType: 'json',
                             success: function(respuesta) {

                                 var options = '<option selected value="">USUARIO</option>';

                                 for (let index = 0; index < respuesta.length; index++) {
                                     options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][
                                         3
                                     ] + '</option>';
                                 }
                                 //  console.log("Pruebas de respuesta de usuarios::",options);
                                 $("#sel_Usuario").append(options);
                             }
                         });


                     }
                 </script>




                 <!-- /.content -->