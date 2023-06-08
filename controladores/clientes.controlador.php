<?php


class ClientesControlador
{
    static public function ctrRegistrarCliente($nit_cliente, $nombre_cliente, $telefono, $correo_e, $direccion, $notas) {

        $registrarCliente = ClientesModelo::mdlRegistrarCliente($nit_cliente, $nombre_cliente, $telefono, $correo_e, $direccion, $notas);

        return $registrarCliente;
    }


    static public function ctrListarClientes() {

        $listarClientes = ClientesModelo::mdlListarClientes();

        return $listarClientes;
    }

    
    //LISTAR CLIENTES AUTOCOMPLETE
    static public function ctrAutoCompleteClientes(){
        $autoCompleteClientes = ClientesModelo::mdlAutoCompleteClientes();
       
        return $autoCompleteClientes;
    }

    
    //LISTAR CLIENTES AUTOCOMPLETE
    static public function ctrDatosCliente($nit_cliente){
        $cliente = ClientesModelo::mdlDatosCliente($nit_cliente);
       
        return $cliente;
    }
    //ELIMINAR CLIENTES
    static public function ctrEliminarCliente($tableClientes, $id_cliente, $nameId){
        $eliminarCliente = ClientesModelo::mdlEliminarCliente($tableClientes, $id_cliente, $nameId);
        return $eliminarCliente;
    }
    //EDITAR CLIENTES
    static public function ctrEditarCliente($tableClientes, $data, $id, $nameId) {

        $editarCliente = ClientesModelo::mdlEditarCliente($tableClientes, $data, $id, $nameId);

        return $editarCliente;
    }
}
