<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class AjaxClientes
{

    public $nit_cliente;
    public $nombre_cliente;
    public $telefono;
    public $correo_e;
    public $direccion;
    public $notas;



    public function ajaxListarClientes()
    {

        $listarClientes = ClientesControlador::ctrListarClientes();

        echo json_encode($listarClientes, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxRegistrarCliente()
    {
        $registrarCliente = ClientesControlador::ctrRegistrarCliente(
            $this->nit_cliente,
            $this->nombre_cliente,
            $this->telefono,
            $this->correo_e,
            $this->direccion,
            $this->notas
        );

        echo json_encode($registrarCliente);
    }

    public function ajaxAutoCompleteClientes()
    {
        $autoCompleteClientes = ClientesControlador::ctrAutoCompleteClientes();
        echo json_encode($autoCompleteClientes);
    }

    public function ajaxDatosCliente()
    {
        $cliente = ClientesControlador::ctrDatosCliente($this->nit_cliente);
        echo json_encode($cliente);
    }

    public function ajaxEliminarCliente()
    {
        $tableClientes = "clientes";
        $id_cliente = $_POST["id_cliente"];
        $nameId = "id_cliente";
        $eliminarCliente = ClientesControlador::ctrEliminarCliente($tableClientes, $id_cliente, $nameId);
        echo json_encode($eliminarCliente, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxEditarCliente($data)
    {
        $tableClientes = "clientes";
        $id = $_POST["nit_cliente"];
        $nameId = "nit_cliente";

        $editarCliente = ClientesControlador::ctrEditarCliente($tableClientes, $data, $id, $nameId);

        echo json_encode($editarCliente);
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 1) {
  
    $registrarCliente = new AjaxClientes();
    $registrarCliente->nit_cliente = $_POST["nit_cliente"];
    $registrarCliente->nombre_cliente = $_POST["nombre_cliente"];
    $registrarCliente->telefono = $_POST["telefono"];
    $registrarCliente->correo_e = $_POST["correo_e"];
    $registrarCliente->direccion = $_POST["direccion"];
    $registrarCliente->notas = $_POST["notas"];
    $registrarCliente->ajaxRegistrarCliente();
    
}else if (isset($_POST["accion"]) && $_POST["accion"] == 2) { //traer listado de productos para el autocompletable del input
    $autoCompleteClientes = new AjaxClientes();
    $autoCompleteClientes->ajaxAutoCompleteClientes();
}else if(isset($_POST['accion'])&& $_POST['accion']==4){//ELIMINAR
    $eliminarCliente = new AjaxClientes();
    $eliminarCliente -> ajaxEliminarCliente();

}else if (isset($_POST["accion"]) && $_POST["accion"] == 3) { //TRAER EL LISTADO DE LOS CLIENTES USANDO EL CLIENTE DESPUES DEL AUTOCOMPLETE
    $DatosCliente = new AjaxClientes();
    $DatosCliente -> nit_cliente = $_POST["nit_cliente"];
    $DatosCliente->ajaxDatosCliente();
}else if (isset($_POST['accion']) && $_POST['accion'] == 5) {//EDITAR

    $editarCliente = new AjaxClientes();

    $data = array(
        "nombre_cliente" => $_POST["nombre_cliente"],
        "numero_tel" => $_POST["telefono"],
        "correo_electronico" => $_POST["correo_e"],
        "direccion" => $_POST["direccion"],
        "notas" => $_POST["notas"]
    );
    $editarCliente->ajaxEditarCliente($data);
 

    
} else {
    $listarClientes = new AjaxClientes();
    $listarClientes->ajaxListarClientes();
}
