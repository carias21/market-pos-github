<?php

class UsuarioControlador
{

    /*---------------------------------------------------------------
    Login de usuario
    ----------------------------------------------------------------*/
    public function login()
    {
        //VD 25 min 22:05
        if (isset($_POST["loginUsuario"])) {
            //---------------------------------------------------------------
            //Realizamos la consulta con los datos del usuario ala base de datos
            //---------------------------------------------------------------
           // $contraseña = $_POST['contraseña'];
            $usuario = $_POST["loginUsuario"];
            //password encriptada abc123....
            //  $password = crypt($_POST["loginPassword"], '$2y$10$tPpAmr2RMlPrMJrcQZATIOw5SmFk2Op3rScHE1N.J4CJi5nUVS0Za');
            //password 123456 encrip
            $contraseña = crypt($_POST["loginPassword"], 'contraseña');
            // $contraseña = password_hash($_POST["loginPassword"], algo:PASSWORD_DEFAULT);
            $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $contraseña);
            


            //VALIDACION DE LAS CREDENCIALES
            if (count($respuesta) > 0) {
                $_SESSION["usuario"] = $respuesta[0];

                echo ' 
                <script>
                window.location = "http://localhost/market-pos-github/"
                </script>';
            } else {
                echo '
                <script>
                fncSweetAlert(
                    "error",
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
}
