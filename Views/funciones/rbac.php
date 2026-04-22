<?php
/**
 * Funciones de validación de permisos basados en roles
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const ROLE_ADMIN = 1;
const ROLE_CLIENTE = 2;

/**
 * Obtener el rol actual del usuario
 * @return int|null ID del rol del usuario actual o null
 */
function ObtenerRolActual()
{
    return $_SESSION['usuario_rol'] ?? null;
}

/**
 * Verificar si el usuario es administrador
 * @return bool true si es administrador
 */
function EsAdmin()
{
    return ObtenerRolActual() === ROLE_ADMIN;
}

/**
 * Verificar si el usuario es cliente
 * @return bool true si es cliente
 */
function EsCliente()
{
    return ObtenerRolActual() === ROLE_CLIENTE;
}

/**
 * Verificar si el usuario tiene un rol específico
 * @param int $rolId ID del rol a verificar
 * @return bool true si tiene ese rol
 */
function TieneRol($rolId)
{
    return ObtenerRolActual() === $rolId;
}

/**
 * Requerir que el usuario sea administrador, sino redirige
 * @param string $urlRedireccion URL a la que redirigir si no es admin
 */
function RequiereAdmin($urlRedireccion = '/G4_AmbienteWeb-main/Views/Home/home.php')
{
    if (!EsAdmin()) {
        http_response_code(403);
        $_SESSION['error_acceso'] = 'No tienes permiso para acceder a esta sección.';
        header("Location: $urlRedireccion");
        exit;
    }
}

/**
 * Requerir que el usuario sea cliente, sino redirige
 * @param string $urlRedireccion URL a la que redirigir si no es cliente
 */
function RequiereCliente($urlRedireccion = '/G4_AmbienteWeb-main/Views/Home/home.php')
{
    if (!EsCliente()) {
        http_response_code(403);
        $_SESSION['error_acceso'] = 'No tienes permiso para acceder a esta sección.';
        header("Location: $urlRedireccion");
        exit;
    }
}

/**
 * Requerir un rol específico, sino redirige
 * @param int $rolId ID del rol requerido
 * @param string $urlRedireccion URL a la que redirigir si no tiene el rol
 */
function RequiereRol($rolId, $urlRedireccion = '/G4_AmbienteWeb-main/Views/Home/home.php')
{
    if (!TieneRol($rolId)) {
        http_response_code(403);
        $_SESSION['error_acceso'] = 'No tienes permiso para acceder a esta sección.';
        header("Location: $urlRedireccion");
        exit;
    }
}

/**
 * Mostrar contenido solo si el usuario tiene un rol específico
 * @param int $rolId ID del rol
 * @return bool true si tiene ese rol
 */
function SiEsRol($rolId)
{
    return ObtenerRolActual() === $rolId;
}
