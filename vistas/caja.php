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