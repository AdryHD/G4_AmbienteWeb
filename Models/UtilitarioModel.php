<?php

function OpenDatabase()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $cfgPath = dirname(__DIR__) . '/db_config.php';
    if (!is_file($cfgPath)) {
        throw new RuntimeException(
            "Falta el archivo `db_config.php` en la raíz del proyecto. Copia `db_config.example.php` a `db_config.php` y configura usuario/contraseña/puerto."
        );
    }

    $cfg = require $cfgPath;
    $host = $cfg['host'] ?? '127.0.0.1';
    $port = (int)($cfg['port'] ?? 3306);
    $user = $cfg['user'] ?? 'root';
    $pass = $cfg['pass'] ?? '';
    $name = $cfg['name'] ?? 'power_zone';
    return mysqli_connect($host, $user, $pass, $name, $port);
}

function CloseDatabase($context)
{
    mysqli_close($context);
}




