<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isAdmin(): bool
{
    return isset($_SESSION['usuario_rol']) && (int)$_SESSION['usuario_rol'] === 1;
}

function isCliente(): bool
{
    return isset($_SESSION['usuario_rol']) && (int)$_SESSION['usuario_rol'] === 2;
}

function requireAdmin(): void
{
    if (!isAdmin()) {
        header('Location: /G4_AmbienteWeb/Views/Home/home.php?error=forbidden');
        exit;
    }
}

function requireCliente(): void
{
    if (!isCliente()) {
        header('Location: /G4_AmbienteWeb/Views/Home/home.php?error=forbidden');
        exit;
    }
}

