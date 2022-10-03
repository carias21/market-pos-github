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

 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-md-6">
                 <h4 class="m-0">Reportes</h4>
             </div>
             <div class="col-md-6">
                 <ol class="breadcrumb float-md-right">
                     <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                     <li class="breadcrumb-item">Ventas</li>
                     <li class="breadcrumb-item active">Administrar Ventas</li>
                 </ol>
             </div>
         </div>
     </div>
 </div>

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
                                 <div class="form-group m-0"><a href="" class="btn btn-primary" style="width:120px;" id="btnFiltrar">Buscar</a></div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
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

                     $(document).ready(function() {
                         var table;
                         //CRITERIOS DE BUSQUEDA
                         $('#ventas_desde, #ventas_hasta').inputmask('dd/mm/yyyy', {
                             'placeholder': 'dd/mm/yyyy'
                         })
                         //INDICAMOS QUE POR DEFECTO NOS MUESTRE LA FECHA INICIANDO EL MES HASTA EL DIA DE HOY EN LOS INPUTS
                         $("#ventas_desde").val(moment().startOf('month').format('DD/MM/YYYY'));
                         //CAPUTAMOS EL DIA DE HOY       
                         $("#ventas_hasta").val(moment().format('DD/MM/YYYY'));

                         var tableVentas = $('#lstVentas').DataTable({
                             //ajustable 
                             scrollX: true,
                             dom: 'Bfrtip',
                             buttons: [
                                 'excel', 'print', 'pageLength',
                             ],
                             ajax: {
                                 url: 'ajax/administrar_ventas.ajax.php',
                                 dataSrc: ""
                             },
                             

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
                                     targets: 9,

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

                             var id_venta = data["id_venta"]
                             //     alert(id_categoria);
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
                         })






                     })
                 </script>



                 <!-- /.content -->