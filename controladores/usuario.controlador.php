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
               //password encriptada abc123....
            $password = crypt($_POST["loginPassword"], '$2y$10$nsEzZoLm/iGBPK0LnWjN7uCkSAXlIQsVUHSGkaAJlOnPQn8dFEnM2');
            /*password 123456 encrip
               $password = crypt($_POST["loginPassword"], '$2a$07$azybxcags23425sdg23sdfhsd$');  */
            $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $password);


//VALIDACION DE LAS CREDENCIALES
            if(count($respuesta)>0){
                $_SESSION["usuario"]= $respuesta[0];

                echo ' 
                <script>
                window.location = "http://192.168.1.11/market-pos-github/"
                </script>';
            }else{
                echo '
                <script>
                fncSweetAlert(
                    "error",
                    "Usuario y/o contraseña inválida",
                    "http://192.168.1.11/market-pos-github/"
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
