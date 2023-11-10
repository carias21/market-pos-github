<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores{
    public $id_Proveedores;
    public $nombre;
    public $correo;
    public $telefono;
    public $tipo_producto;
    public $estado;
    public $direccion;

    

    public function ajaxListarProveedores(){

        $proveedores = ProveedoresControlador::ctrListarProveedores();

        echo json_encode($proveedores, JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxGuardarProveedor($accion){
        $guardarProveedor = ProveedoresControlador::ctrGuardarProveedor($accion, $this->id_Proveedores, $this->nombre, 
                                                                        $this->direccion, $this->telefono, $this->correo,
                                                                        $this->tipo_producto, $this->estado);
        echo json_encode($guardarProveedor, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxEliminarProveedor(){
        $tableProveedor = "proveedores";
        $id_Proveedores= $_POST["id_proveedor"];
        $nameId = "id_proveedor";
        $respuesta = ProveedoresControlador::ctrEliminarProveedor($tableProveedor, $id_Proveedores, $nameId);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}

//si es mayor a 0 procede a realizar una edicion
if(isset($_POST['id_Proveedores'])&& $_POST['id_Proveedores'] > 0){//Editar

    $registrarProveedor = new AjaxProveedores();
    $registrarProveedor->id_Proveedores = $_POST['id_Proveedores'];
    $registrarProveedor->nombre = $_POST['nombre'];
    $registrarProveedor->direccion = $_POST['direccion'];
    $registrarProveedor->telefono = $_POST['telefono'];
    $registrarProveedor->correo = $_POST['correo'];
    $registrarProveedor->tipo_producto = $_POST['tipo_producto'];
    $registrarProveedor->estado = $_POST['estado'];
    $registrarProveedor->ajaxGuardarProveedor(0);
//Accion 5, eliminacion
}else if(isset($_POST['accion'])&& $_POST['accion']==3){//ELIMINAR
    $eliminarProveedor = new AjaxProveedores();
    $eliminarProveedor -> ajaxEliminarProveedor();
//cuando el valor es igual a 0 registra
}else if(isset($_POST['id_Proveedores'])&& $_POST['id_Proveedores']==0){//REGISTRAR
    $registrarProveedor = new AjaxProveedores();
    $registrarProveedor->id_Proveedores = $_POST['id_Proveedores'];
    $registrarProveedor->nombre = $_POST['nombre'];
    $registrarProveedor->direccion = $_POST['direccion'];
    $registrarProveedor->telefono = $_POST['telefono'];
    $registrarProveedor->correo = $_POST['correo'];
    $registrarProveedor->tipo_producto = $_POST['tipo_producto'];
    $registrarProveedor->estado = $_POST['estado'];
    $registrarProveedor->ajaxGuardarProveedor(1);

    
 

}else{

$proveedores = new AjaxProveedores();
$proveedores -> ajaxListarProveedores();
}