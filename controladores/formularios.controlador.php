<?php
class ControladorFormularios
{
    /*
    REGISTRATE
    */
    static public function crtRegistro()
    {
        if (isset($_POST["registerName"])) {
            /*return $_POST["registerName"] . "<br>" . $_POST["registerEmail"] . "<br>" .$_POST["registerPassword"] . "<br>";*/
            $tabla = "registros_BOCF_wedding";

            $datos = array(
                "nombre" => $_POST["registerName"],
                "email" => $_POST["registerEmail"],
                "password" => $_POST["registerPassword"]
            );
            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
            return $respuesta;
        }
    }
    /**
     * Selecion De Registros
     */
    static public function ctrSeleccionarRegistros($item, $valor)
    {
        if ($item == null && $valor == null) {
            $tabla =  "registros_BOCF_wedding";

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, null, null);

            return $respuesta;
        } else {
            $tabla = "registros_BOCF_wedding";

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            return $respuesta;
        }

    }
    /**
     * Ingresate
     */
    public function ctrIngreso()
    {
        if (isset($_POST["ingresoEmail"])) {
            $tabla = "registros_BOCF_wedding";
            $item = "email";
            $valor = $_POST["ingresoEmail"];

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            if (is_array($respuesta)) {
                if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $_POST["ingresoPassword"]) {

                    $_SESSION["validarIngreso"] = "ok";

                    echo "fuistes ingresado";

                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        setTimeout(function(){
                            window.location.href = "index.php?pagina=inicio";
                        }, 2000); // Redirecciona después de 2 segundos (ajusta el tiempo según tus preferencias)
                    </script>';
                } else {
                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>';
                    echo '<div class="alert alert-danger">Error al entrar en el sistema</div>';
                }
            } else {
                echo '<script>
                    if (window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>';
                echo '<div class="alert alert-danger">Error en este sistema ';
            }
        }

    }

    static public function ctrActualizarRegistro()
    {


        if (isset($_POST["updateName"])) {
            if ($_POST["updatePassword"] != "") {
                $password = $_POST["updatePassword"];
            } else {
                $password = $_POST["passwordActual"];
            }
            $tabla = "registros_BOCF_wedding";

            $datos = array(
                "id" => $_POST["id"],
                "nombre" => $_POST["updateName"],
                "email" => $_POST["updateEmail"],
                "password" => $password
            );

            $actualizar = ModeloFormularios::mdlActualizarRegistros($tabla, $datos);

            return $actualizar;
        }


    }

    public function ctrEliminarRegistro()
    {
        if (isset($_POST["deleteRegistro"])) {

            $tabla = "registros_BOCF_wedding";
            $valor = $_POST["deleteRegistro"];


            $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);

            if ($respuesta == "ok") {
                echo '<script>
                if (window.history.replaceState){
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>    ';
                echo '<div class="alert-success"> El usuario esta Eliminado</div>
                    <script>
                    setTimeout(function(){
                    window.location = "index.php?pagina=inicio";
                    },3000);
                    </script>
                    ';
            }
        }
    }

}

?>

