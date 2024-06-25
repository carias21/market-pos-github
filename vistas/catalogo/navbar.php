<nav class="navbar navbar-expand-md navbar-info bg-white navbar-fixed-top">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand font-weight-bold d-flex align-items-center" href="index.php">
            <img src="../assets/imagenes/default.png" alt="Logo" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
            <span class="ml-2">CATALOGO </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <input type="search" class="form-control text-center" style="height: 36px;" id="iptBuscarProducto" name="iptBuscarProducto" placeholder="BUSCAR PRODUCTO" required>

            <select name="filtroCategoria" id="filtroCategoria" class="form-control text-center "></select>

        </div>

    </div>
</nav>
<br>

<br>
<br>
<br>

<br>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="./recursos/jquery-ui/js/jquery-ui.js"></script>






<script>
    $(document).ready(function() {



        $("#iptBuscarProducto").on('keypress', function(e) {
            if (e.which == 13) {
                e.preventDefault();
                var BusquedaGeneral = $(this).val();

                // Verificar si la longitud de la cadena es al menos 3
                if (BusquedaGeneral.trim().length >= 3) {
                    window.location.href = "busqueda_general.php?dato=" + BusquedaGeneral;
                }
            }
        });


        $.ajax({
            async: true,
            url: "ajax/catalogo.ajax.php",
            method: "POST",
            data: {
                'accion': 1
            },
            dataType: 'json',

            success: function(respuesta) {

                $("#iptBuscarProducto").autocomplete({


                        source: respuesta,
                        //minLength: 3, // Mínimo de 3 caracteres antes de buscar
                        select: function(event, ui) {
                            // Obtén el código del producto seleccionado
                            var selectedCodigo = ui.item.id;

                            // Redirige a la página de detalles del producto pasando el código como parámetro en la URL
                            window.location.href = 'detalle_producto.php?codigo=' + selectedCodigo;
                        }

                    }).data("ui-autocomplete")._renderItem = function(ul, item) {
                        return $("<li class ='ui-autocomplete-row'></li>")
                            .data("item.autocomplete", item)
                            .append(item.label)
                            .appendTo(ul);
                    },

                    // Limitar el número de elementos que se muestran en la lista de sugerencias
                    $("#iptBuscarProducto").autocomplete("instance")._renderMenu = function(ul, items) {
                        var max = 4; // número máximo de elementos a mostrar
                        var that = this;
                        items = items.slice(0, max);
                        $.each(items, function(index, item) {
                            that._renderItemData(ul, item);
                        });
                        $(ul).addClass("ui-autocomplete-list");
                    };


            }
        });




        $.ajax({
            async: true,
            url: "ajax/catalogo.ajax.php",
            method: "POST",
            dataType: 'json',
            success: function(respuesta) {
                console.log(respuesta);

                var options = '<option selected value="">CATEGORIAS</option>';

                respuesta.forEach(function(item) {
                    var value = item[0];
                    var text = item[1];
                    options += `<option value="${value}">${text}</option>`;
                });

                $("#filtroCategoria").html(options); // Usando html() en lugar de append()
            }
        });



        // Evento de cambio para el select
        $("#filtroCategoria").on("change", function() {
            // Obtener el valor seleccionado (ID de categoría)
            var categoriaId = $(this).val();

            // Redireccionar a la página detalle_categoria.php con el ID de la categoría como parámetro
            window.location.href = "detalle_categoria.php?id=" + categoriaId;
        });



    });
</script>