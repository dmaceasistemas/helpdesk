 <?php
/*
Script: class.archivos.php
    Clase para manejo de archivos

Author:
    Freddy

Class: archivos
    Clase estática (no se instancia) para manipular archivos
*/
class archivos
{
    /*
    Method: crear
        crea un archivo en una ruta feterminada, si no existe la carpeta que lo va a contener, la crea
    
    Parameteres:
        $path - ruta del futuro archivo
        $archivo - nombre del archivo
        $modo - modo de la ruta
    
    See Also:
      <folder>
    */
    function crear($path,$archivo,$modo = 0777){
        if (!class_exists('folder')) {
           include 'clases/core/class.folder.php';
        }
        
        if(!is_dir($path))
            folder::crear($path,$modo);
        //creo el archivo y lo cierro (sino no puedo abrirlo luego)
        if($arch = @fopen($path.$archivo, "w")){
            fclose($arch);
        }else
            echo "Se produjo un error al crear el archivo ".$archivo,"Error al crear archivo";
    }
    
    /*
    Method: abrir
        abre el archivo, si no existe traba de crearlo
    
    Parameteres:
        $path - ruta del futuro archivo
        $archivo - nombre del archivo
    
    Returns:
        vuelve el identificador del archivo
    */
    function abrir($path,$archivo){
        if(is_file($path.$archivo)){
        	// a
            if($arch = @fopen($path.$archivo, "w"))
                return $arch;
            else
                echo "Se produjo un error al crear el archivo ".$archivo,"Error al crear archivo";
        }else{
            archivos::crear($path,$archivo);
            return archivos::abrir($path,$archivo);
        }
    }
    
    function editable($arch){
        return is_writable($arch);
    }
    
    /*
    Method: escribir
        abre un archivo y escribe en el. Si no existe intenta crearlo
    
    Parameteres:
        $path - ruta del futuro archivo
        $archivo - nombre del archivo
        $msj - mensaje a escribir en el archivo
        
    Example:
        (start code)
            archivos::escribir("archivos/txt/,"textos.txt","Habia una vez...");
        (end)
    */
    function escribir($path,$archivo,$msj){
        $arch = archivos::abrir($path,$archivo);
        if (fwrite($arch, $msj) === FALSE)
            echo "No se puede escribir en el archivo ".$archivo,"Error con archivos";
        archivos::cerrar($arch);
    }
    
    /*
    Method: cerrar
        Cierra un archivo
    
    Parameteres:
        $arch - identificador del archivo
    */
    function cerrar($arch){
        @fclose($arch);
    }
}
?>