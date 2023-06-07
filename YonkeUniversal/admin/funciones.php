<?php
    //Como redimensionar una imagen con php
    function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){  
        $ext = explode(".", $nombreimg);  
        $ext = $ext[count($ext)-1];  
      
        if($ext == "jpg" || $ext == "jpeg")  
            $imagen = imagecreatefromjpeg($rutaimg);  
        elseif($ext == "png")  
            $imagen = imagecreatefrompng($rutaimg);  
        elseif($ext == "gif")  
            $imagen = imagecreatefromgif($rutaimg);  
        
        $x = imagesx($imagen);  
        $y = imagesy($imagen); 
        
        $marcaDeAgua = imagecreatefrompng("images/YonkeMarcaAgua.png");
        $marcaX = imagesx($marcaDeAgua);
        $marcaY = imagesy($marcaDeAgua);
          
        if($x <= $xmax && $y <= $ymax){
            
            imagecopy($imagen, $marcaDeAgua, $x - $marcaX, $y - $marcaY, 0, 0, $marcaX, $marcaY);
            return $imagen;
        }
      
        if($x >= $y) {  
            $nuevax = $xmax;  
            $nuevay = $nuevax * $y / $x;  
        }  
        else {  
            $nuevay = $ymax;  
            $nuevax = $x / $y * $nuevay;  
        }  
          
        $img2 = imagecreatetruecolor($nuevax, $nuevay);  
        imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);  
        
        imagecopy($img2, $marcaDeAgua, $nuevax - $marcaX, $nuevay - $marcaY, 0, 0, $marcaX, $marcaY);
        
        return $img2;
    }

    function filtrado($datos){
        $datos = trim($datos); // Elimina espacios antes y después de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
        return $datos;
    }

    function eliminarFoto($archivo){
        if(file_exists($archivo)){
            unlink($archivo);
        }
    }

    function crearCarpeta($carpeta){
        if(!file_exists($carpeta)){
            mkdir($carpeta,0777);
        }
    }
    
    function verificar($numero,$numeros,$nombres,$id){
        $foto = in_array($numero,$numeros);

        if(file_exists("../img/autos/$id/".$nombres[$numero-1])){
            return "../img/autos/$id/".$nombres[$numero-1];
        }
    }
?>