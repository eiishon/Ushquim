<?php

/**
 * Clase para realizar validaciones en el modelo
 * Es utilizada para realizar validaciones en el modelo de nuestras clases.
 *
 */
class Validacion
{
    
    protected $_atributos;
    
    protected $_error;
    
    public $mensaje;
    
    /**
     * Metodo para indicar la regla de validacion
     * El método retorna un valor verdadero si la validación es correcta, de lo contrario retorna el objeto
     * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
     */
    public function rules($rule = array(), $data)
    {
        
        if (! is_array($rule)) {
            $this->mensaje = "las reglas deben de estar en formato de arreglo";
            return $this;
        }
        foreach ($rule as $key => $rules) {
            $reglas = explode(',', $rules['regla']);
            if (array_key_exists($rules['name'], $data)) {
                foreach ($data as $indice => $valor) {
                    if ($indice === $rules['name']) {
                        foreach ($reglas as $clave => $valores) {
                            $validator = $this->_getInflectedName($valores);
                            if (! is_callable(array(
                                $this,
                                $validator
                            ))) {
      //                          throw new BadMethodCallException("No se encontro el metodo $valores");
                            }
   //                         $respuesta = $this->$validator($rules['name'], $valor);
                        }
                        break;
                    }
                }
            } else {
                
                $this->mensaje[$rules['name']] = "el campo {$rules['name']} no esta dentro de la regla de validación o en el formulario";
            }
        }
        if (!empty($this->mensaje)) {
            return $this;
        } else {
            return true;
        }
    }
    
    /*
     * Metodo inflector de la clase
     * por medio de este metodo llamamos a las reglas de validacion que se generen
     */
    private function _getInflectedName($text)
    {
        $validator = "";
        $_validator = preg_replace('/[^A-Za-z0-9]+/', ' ', $text);
        $arrayValidator = explode(' ', $_validator);
        if (count($arrayValidator) > 1) {
            foreach ($arrayValidator as $key => $value) {
                if ($key == 0) {
                    $validator .= "_" . $value;
                } else {
                    $validator .= ucwords($value);
                }
            }
        } else {
            $validator = "_" . $_validator;
        }
        
        return $validator;
    }
    
    /**
     * Metodo de verificacion de que el dato no este vacio o NULL
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _noEmpty($campo, $valor)
    {
        if (isset($valor) && ! empty($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe de estar lleno";
            return false;
        }
    }
    
    /**
     * Metodo de verificacion de tipo numerico
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _numeric($campo, $valor)
    {
        if (is_numeric($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe de ser numerico";
            return false;
        }
    } 
    
    /**
     * Metodo de verificacion de tipo email
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _email($campo, $valor)
    {
        if (filter_var($valor,FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe estar en el formato de email usuario@servidor.com";
            return false;
        }
    }
}

function recoge($var)
{
    if (isset($_REQUEST[$var]))
        $tmp=strip_tags(sinEspacios($_REQUEST[$var]));
        else
            $tmp= "";
            
            return $tmp;
}

function sinEspacios($frase) {
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}


function cFile($nombre, $ruta, $extensionesValidas, &$errores)
{
    if ($_FILES[$nombre]['error'] != 0) {
        switch ($_FILES[$nombre]['error']) {
            case 1:
                $errores[] = "UPLOAD_ERR_INI_SIZE";
                $errores[] = "Fichero demasiado grande";
                break;
            case 2:
                $errores[] = "UPLOAD_ERR_FORM_SIZE";
                $errores[] = 'El fichero es demasiado grande';
                break;
            case 3:
                $errores[] = "UPLOAD_ERR_PARTIAL";
                $errores[] = 'El fichero no se ha podido subir entero';
                break;
            case 4:
                $errores[] = "UPLOAD_ERR_NO_FILE";
                $errores[] = 'No se ha podido subir el fichero';
                break;
            case 6:
                $errores[] = "UPLOAD_ERR_NO_TMP_DIR";
                $errores[] = "Falta carpeta temporal";
                break;
            case 7:
                $errores[] = "UPLOAD_ERR_CANT_WRITE";
                $errores[] = "No se ha podido escribir en el disco";
                break;
                
            default:
                $errores[] = 'Error indeterminado.';
        }
        return false;
    } else {
      /*  // Guardamos el nombre original del fichero
        $nombreArchivo = $user;
        // Guardamos nombre del fichero en el servidor
        $directorioTemp = $_FILES[$nombre]['tmp_name']; */
        $extension = $_FILES[$nombre]['type'];
        // Comprobamos la extension del archivo dentro de la lista que hemos definido al principio
        if (! in_array($extension, $extensionesValidas)) {
            $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
            return false;
        }
        
        /*// Almacenamos el archivo en ubicacion definitiva
        // Añadimos time() al nombre del fichero, asi lo haremos unico y si tuviera doble extension
        
        if (is_file($ruta . $nombreArchivo)) {
            
            // Podemos utilizar microtime() para paginas con mucho trafico
            $nombreArchivo = time() . $nombreArchivo;
        }
        // Movemos el fichero a la ubicacion definitiva
        if (move_uploaded_file($directorioTemp, $ruta . $nombreArchivo)) {
            // En este caso devolvemos solo el nombre del fichero sin la ruta
            return $nombreArchivo;
        } else {
            $errores[] = "Error: No se puede mover el fichero a su destino";
            // return false; 
        }*/
    }
}

function recogeArray($var)
{
    if (!empty($_REQUEST[$var])){
        $array=$_REQUEST[$var];
        foreach ($array as $value){
            $tmp[]=strip_tags(sinEspacios($value));
        }
    }else
        $tmp= "";
        
        
        return $tmp;
}
function cText($text, &$errores, $max = 50, $min = 1)
{
    $valido = true;
    if ((mb_strlen($text) > $max) || (mb_strlen($text) < $min)) {
        $errores[] = "$text no es válido. Debe tener entre $min y $max letras";
        $valido = false;
    }
    if (! preg_match("/^[A-Za-zñÑ]+$/", sinTildes($text))) {
        $errores[] = "$text no es válido. Sólo debe tener letras";
        $valido = false;
    }
    
    return $valido;
}

function cName($text, &$errores, $max = 20, $min = 1)
{
    $valido = true;
    if ((mb_strlen($text) > $max) || (mb_strlen($text) < $min)) {
        $errores[] = "$text no es válido. Debe tener entre $min y $max letras";
        $valido = false;
    }
    if (! preg_match("/^[A-Za-zñÑ]+$/", sinTildes($text))) {
        $errores[] = "$text no es válido. Sólo debe tener letras";
        $valido = false;
    }
    
    return $valido;
}

//VALIDAR PATRÓN
function validoPatron($pattern, $text, &$errores, $max = 15, $min=1){
        $valido = true;
        if(!preg_match($pattern, $text)){
            $valido = false;
            $errores[] ="$text no es válido. Sólo debe incluir letras, números, *, _, -, $, &, /, \ o +.";
        }
        if((mb_strlen($text) > $max) || (mb_strlen($text) < $min)){
            $errores[] ="$text no es válido. Debe ser menor de 15 caracteres";
            $valido = false;
        }
        return $valido;
    
} 


function validoEmail($email, &$errores){
    $valido = true;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $valido = false;
        $errores[] = "$email no es válido.";
    }
    return $valido;
}


/*
 * Ejemplo de uso de la clase, es muy sencillo.
 */

/*$datos['campo1'] = "d";
$datos['campo2'] = "usuario@gmail.com";

$validacion = new Validacion();
$regla = array(
    array(
        'name' => 'campo2',
        'regla' => 'no-empty,email'
    ),
    array(
        'name' => 'campo1',
        'regla' => 'no-empty,numeric'
    )
    
);
$validaciones = $validacion->rules($regla, $datos);
print_r($validaciones); */

?>