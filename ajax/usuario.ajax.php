
<?php

require_once "../controladores/usuario.controlador.php";
require_once "../modelos/usuario.modelo.php";

//VD 29 MIN 9:00
class AjaxUsuarios
{
    public $id_Usuario;
    public $nombre_Usuario;
    public $apellido_Usuario;
    public $usuario;
    public $contraseña;
    public $perfil;
    public $estado_Usuario;


    public function ajaxObtenerUsuarios()
    {
        $usuarios = UsuarioControlador::ctrObtenerUsuarios();
        echo json_encode($usuarios);
    }
    public function ajaxGuardarUsuario($accion)
    {
        $guardarUsuario = UsuarioControlador::ctrGuardarUsuario(
            $accion,
            $this->id_Usuario,
            $this->nombre_Usuario,
            $this->apellido_Usuario,
            $this->usuario,
            $this->contraseña,
            $this->perfil,
            $this->estado_Usuario
        );
        echo json_encode($guardarUsuario, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxEliminarUsuario()
    {
        $tbl_Usuarios = "usuarios";
        $id_Usuario = $_POST["id_usuario"];
        $nameId = "id_usuario";
        $respuesta = UsuarioControlador::ctrEliminarUsuario($tbl_Usuarios, $id_Usuario, $nameId);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

    
    public function ajaxMostrarOcultarUsuario($dato, $id){
    
        $mostrarOcultarUsuario = UsuarioControlador::ctrMostrarOcultarUsuario($dato, $id);
    
        echo json_encode($mostrarOcultarUsuario);
    
    }


        

    public function ajaxVerificarEstadoUsuario(){
    
        $VerificarEstadoUsuario = UsuarioControlador::ctrVerificarEstadoUsuario();
    
        echo json_encode($VerificarEstadoUsuario);
    
    }
}



if (isset($_POST['accion']) && $_POST['accion'] == 1) {
    $usuarios = new AjaxUsuarios;
    $usuarios->ajaxObtenerUsuarios();
    //si es mayor a 0 procede a realizar una edicion
} else if (isset($_POST['id_Usuario']) && $_POST['id_Usuario'] > 0) { //Editar

    $editarUsuario = new AjaxUsuarios();
    $editarUsuario->id_Usuario = $_POST['id_Usuario'];
    $editarUsuario->nombre_Usuario = $_POST['nombre_Usuario'];
    $editarUsuario->apellido_Usuario = $_POST['apellido_Usuario'];
    $editarUsuario->usuario = $_POST['usuario'];

    if (!empty($_POST['contraseña'])) {

        $editarUsuario->contraseña = crypt($_POST["contraseña"], 'contraseña');
    } else {
        $editarUsuario->contraseña = $_POST['contraseña'];
    }
    $editarUsuario->perfil = $_POST['perfil'];
    $editarUsuario->estado_Usuario = $_POST['estado_Usuario'];
    $editarUsuario->ajaxGuardarUsuario(0);
} else if (isset($_POST['id_Usuario']) && $_POST['id_Usuario'] == 0) { //REGISTRAR

    $registrarUsuario = new AjaxUsuarios();
    $registrarUsuario->id_Usuario = $_POST['id_Usuario'];
    $registrarUsuario->nombre_Usuario = $_POST['nombre_Usuario'];
    $registrarUsuario->apellido_Usuario = $_POST['apellido_Usuario'];
    $registrarUsuario->usuario = $_POST['usuario'];
    // $registrarUsuario->contraseña = $_POST['contraseña'];
    //enviamos la contraseña encriptada
    $registrarUsuario->contraseña = crypt($_POST["contraseña"], 'contraseña');
    $registrarUsuario->perfil = $_POST['perfil'];
    $registrarUsuario->estado_Usuario = $_POST['estado_Usuario'];
    $registrarUsuario->ajaxGuardarUsuario(1);
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) { //ELIMINAR
    $eliminarUsuario = new AjaxUsuarios();
    $eliminarUsuario->ajaxEliminarUsuario();
} else if(isset($_POST['accion']) && $_POST['accion'] == 5){ //HABILITAR O DESHBAILITAR  USUARIO
    $mostrarOcultarPrecio = new AjaxUsuarios();
    $mostrarOcultarPrecio->ajaxMostrarOcultarUsuario($_POST["dato"], $_POST["id"]);

}else if(isset($_POST['accion']) && $_POST['accion'] == 6){ //VERIFICAR EL ESTADO QUE SE MUESTRA O NO EL USUARIO
    $VerificarEstadoUsuario = new AjaxUsuarios();
    $VerificarEstadoUsuario->ajaxVerificarEstadoUsuario();

}else {
    $usuarios = new AjaxUsuarios();
    $usuarios->ajaxObtenerUsuarios();
}
