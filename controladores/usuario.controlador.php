<?php

class UsuarioControlador{
 
    /*---------------------------------------------------------------
    Login de usuario
    ----------------------------------------------------------------*/
    public function login(){
        if(isset($_POST["loginUsuario"])){
            //---------------------------------------------------------------
            //Realizamos la consulta con los datos del usuario ala base de datos
            //---------------------------------------------------------------

            $usuario = $_POST["loginUsuario"];
            $password = crypt($_POST["loginPassword"], '$2a$07$azybxcags23425sdg23sdfhsd$');
            $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $password);


//VALIDACION DE LAS CREDENCIALES
            if(count($respuesta)>0){
                $_SESSION["usuario"]= $respuesta[0];

                echo ' 
                <script>
                window.location = "http://localhost/market-pos-github/"
                </script>';
            }else{
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

    static public function ctrObtenerMenuUsuario($id_usuario){
        $menuUsuario = UsuarioModelo::mdlObtenerMenuUsuario($id_usuario);
        return $menuUsuario;
    }

    static public function ctrObtenerSubMenuUsuario($idMenu){
        $subMenuUsuario = UsuarioModelo::mdlObtenerSubMenuUsuario($idMenu);
        return $subMenuUsuario;
    }
}
