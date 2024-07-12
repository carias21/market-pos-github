<?php

class UsuarioControlador
{

    /*---------------------------------------------------------------
    Login de usuario
    ----------------------------------------------------------------*/
    public function login()
    {
        if (isset($_POST["loginUsuario"])) {
            $usuario = $_POST["loginUsuario"];
            $contraseña = crypt($_POST["loginPassword"], 'contraseña');
            $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $contraseña);
    
            // VALIDACIÓN DE LAS CREDENCIALES
            if (isset($respuesta['error'])) {
                echo '
                <script>
                toastr.error(
                    "' . $respuesta['error'] . '",
                    "",
                    "http://localhost/market-pos-github/"
                );
                </script>
                ';
            } elseif (count($respuesta) > 0) {
                $_SESSION["usuario1"] = $respuesta[0];
                echo '
                <script>
                window.location = "http://localhost/market-pos-github/"
                </script>';
            } else {
                echo '
                <script>
                toastr.error(
                    "",
                    "Usuario y/o contraseña inválida",
                    "http://localhost/market-pos-github/"
                );
                </script>
                ';
            }
        }
    }
    

    static public function ctrObtenerMenuUsuario($id_usuario)
    {
        $menuUsuario = UsuarioModelo::mdlObtenerMenuUsuario($id_usuario);
        return $menuUsuario;
    }

    static public function ctrObtenerSubMenuUsuario($idMenu,$id_perfil_usuario)
    {
        $subMenuUsuario = UsuarioModelo::mdlObtenerSubMenuUsuario($idMenu,$id_perfil_usuario);
        return $subMenuUsuario;
    }

    static public function  ctrObtenerUsuarios()
    {
        $usuarios = UsuarioModelo::mdlObtenerUsuarios();

        return $usuarios;
    }
    static public function ctrGuardarUsuario($accion, $id_Usuario, $nombre_Usuario, $apellido_Usuario, $usuario, $contraseña, $perfil, $estado_Usuario)
    {
        $guardarUsuario = UsuarioModelo::mdlGuardarUsuario($accion, $id_Usuario, $nombre_Usuario, $apellido_Usuario, $usuario, $contraseña, $perfil, $estado_Usuario);
        return $guardarUsuario;
    }
    static public function ctrEliminarUsuario($tbl_Usuarios, $id_Usuario, $nameId){
        $respuesta = UsuarioModelo::mdlEliminarUsuario($tbl_Usuarios, $id_Usuario, $nameId);
        return $respuesta;
    }


    static public function ctrMostrarOcultarUsuario($dato, $id){
        $mostrarOcultarUsuario = UsuarioModelo::mdlMostrarOcultarUsuario($dato, $id);
        return $mostrarOcultarUsuario;
    }

    
    static public function ctrVerificarEstadoUsuario(){
        $VerificarEstadoUsuario = UsuarioModelo::mdlVerificarEstadoUsuario();
        return $VerificarEstadoUsuario;
    }
}
