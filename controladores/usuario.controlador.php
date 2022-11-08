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
          //  $password = crypt($_POST["loginPassword"], '$2y$10$tPpAmr2RMlPrMJrcQZATIOw5SmFk2Op3rScHE1N.J4CJi5nUVS0Za');
            //password 123456 encrip
               $password = crypt($_POST["loginPassword"], '$2y$10$mhJ8K96kTn19ODyVSKr.mOV4JrDvhonQ6d6ex75yC3VRDMjSz5/j2');  
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
