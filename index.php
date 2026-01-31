<?php
/**
 * Archivo de entrada principal de la aplicación
 * Front Controller para el patrón MVC
 */

// Configuración de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir constantes de la aplicación
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

// Rutas principales
define('CONTROLLER_PATH', ROOT . DS . 'Controller' . DS);
define('MODEL_PATH', ROOT . DS . 'Model' . DS);
define('VIEW_PATH', ROOT . DS . 'View' . DS);

// Iniciar sesión
session_start();

// Obtener el controlador y la acción desde la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Construir el nombre del archivo del controlador
$controllerFile = CONTROLLER_PATH . ucfirst($controller) . 'Controller.php';

// Verificar si existe el archivo del controlador
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Crear instancia del controlador
    $controllerClass = ucfirst($controller) . 'Controller';
    
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        
        // Verificar si existe el método (acción)
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            die("Error: La acción '$action' no existe en el controlador '$controller'");
        }
    } else {
        die("Error: La clase del controlador '$controllerClass' no existe");
    }
} else {
    die("Error: El controlador '$controller' no existe");
}
?>
