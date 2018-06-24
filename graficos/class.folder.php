<?php
class folder
{
    function crear($path,$modo = 0777,$recursivo = TRUE){
        if(!is_dir($path)){
            if(!@mkdir($path,$modo,$recursivo))
                echo "Se produjo un error al crear el directorio, verifique que la ruta del directorio y el modo sean correctos","Error al crear directorios";
        }
    }
}
?>
