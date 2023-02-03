<?php
$files = glob(realpath("").'/data/*'); //obtenemos todos los nombres de los ficheros
foreach($files as $file){
    echo basename($file)."</br> </br>";
    if(is_file($file))
        unlink($file); //elimino el fichero
}
echo "eliminado correctamente";