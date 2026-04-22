<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/AdminController.php";

// Verificar que es administrador
ValidarAccesoAdmin();

// Obtener lista de usuarios
$usuarios = ListarUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Gestión de Usuarios | PowerZone</title>
    <link rel="stylesheet" href="/G4_AmbienteWeb/Views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/G4_AmbienteWeb/Views/assets/css/style.css">
    <style>
        .admin-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8c 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .card-user {
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }
        .card-user:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .badge-admin {
            background: #dc3545;
            color: white;
        }
        .badge-cliente {
            background: #28a745;
            color: white;
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        .btn-cambiar-rol {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        .modal-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8c 100%);
            color: white;
        }
        .table thead {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8c 100%);
            color: white;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php"; ?>

    <!-- Admin Header -->
    <div class="admin-header text-center">
        <h1>🔐 Panel Administrativo</h1>
        <p class="mb-0">Gestión de Usuarios y Roles</p>
    </div>

    <!-- Main Content -->
    <main class="container flex-grow-1 mb-5">
        
        <!-- Mensajes de confirmación/error -->
        <?php if (!empty($_POST["Mensaje"])): ?>
            <div class="alert alert-<?php echo ($_POST["TipoMensaje"] ?? "danger") === "success" ? "success" : "danger"; ?>" role="alert">
                <strong><?php echo $_POST["TipoMensaje"] === "success" ? "✓ Éxito" : "✗ Error"; ?></strong>
                <?php echo htmlspecialchars($_POST["Mensaje"]); ?>
            </div>
        <?php endif; ?>

        <!-- Sección de Usuarios -->
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">👥 Lista de Usuarios del Sistema</h4>
            </div>
            <div class="card-body">
                <?php if ($usuarios && count($usuarios) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Cédula</th>
                                    <th>Rol Actual</th>
                                    <th>Estado</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><strong>#<?php echo intval($usuario["id_usuario"]); ?></strong></td>
                                        <td><?php echo htmlspecialchars($usuario["nombre"]); ?></td>
                                        <td><small><?php echo htmlspecialchars($usuario["correo"]); ?></small></td>
                                        <td><?php echo htmlspecialchars($usuario["cedula"] ?? "N/A"); ?></td>
                                        <td>
                                            <span class="badge <?php echo $usuario["id_rol"] == 1 ? "badge-admin" : "badge-cliente"; ?>">
                                                <?php echo htmlspecialchars($usuario["nombre_rol"]); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $usuario["estado"] === "activo" ? "bg-success" : "bg-danger"; ?>">
                                                <?php echo htmlspecialchars($usuario["estado"]); ?>
                                            </span>
                                        </td>
                                        <td><small><?php echo date("d/m/Y", strtotime($usuario["fecha_registro"])); ?></small></td>
                                        <td>
                                            <?php if ($usuario["id_usuario"] != $_SESSION["usuario_id"]): ?>
                                                <!-- Botón para cambiar rol -->
                                                <button 
                                                    class="btn btn-sm btn-warning btn-cambiar-rol"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalCambiarRol"
                                                    data-id-usuario="<?php echo intval($usuario["id_usuario"]); ?>"
                                                    data-nombre-usuario="<?php echo htmlspecialchars($usuario["nombre"]); ?>"
                                                    data-rol-actual="<?php echo htmlspecialchars($usuario["nombre_rol"]); ?>"
                                                    data-id-rol-actual="<?php echo intval($usuario["id_rol"]); ?>"
                                                    title="Cambiar rol de este usuario">
                                                    ⚙️ Cambiar Rol
                                                </button>
                                            <?php else: ?>
                                                <!-- Si es el mismo usuario actual, mostrar etiqueta -->
                                                <span class="badge bg-info">👤 (Tú)</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 text-muted">
                        <small>Total de usuarios: <strong><?php echo count($usuarios); ?></strong></small>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        No hay usuarios registrados en el sistema.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Información importante -->
        <div class="card border-left-warning mb-4">
            <div class="card-body">
                <h5 class="card-title text-warning">⚠️ Información Importante</h5>
                <ul class="mb-0">
                    <li><strong>Administrador:</strong> Acceso completo al panel admin, gestión de pedidos</li>
                    <li><strong>Cliente:</strong> Acceso a tienda, carrito, compras, perfil personal</li>
                    <li>No puedes cambiar tu propio rol de administrador</li>
                    <li>Los cambios de rol se aplican inmediatamente</li>
                </ul>
            </div>
        </div>

    </main>

    <!-- Modal - Cambiar Rol -->
    <div class="modal fade" id="modalCambiarRol" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Rol de Usuario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            ⚠️ Cambiar el rol de un usuario afectará sus permisos inmediatamente
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><strong>Usuario</strong></label>
                            <p class="form-control-plaintext" id="nombreUsuarioModal"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Rol Actual</strong></label>
                            <p class="form-control-plaintext" id="rolActualModal"></p>
                        </div>

                        <div class="mb-3">
                            <label for="selectRol" class="form-label"><strong>Nuevo Rol</strong></label>
                            <select 
                                class="form-select form-select-lg" 
                                id="selectRol" 
                                name="nuevo_rol" 
                                required>
                                <option value="">-- Selecciona un rol --</option>
                                <option value="1">🔐 Administrador</option>
                                <option value="2">👤 Cliente</option>
                            </select>
                        </div>

                        <input type="hidden" id="inputIdUsuario" name="id_usuario">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button 
                            type="submit" 
                            class="btn btn-warning" 
                            name="btnCambiarRol"
                            onclick="return confirm('¿Estás seguro de que deseas cambiar el rol de este usuario?')">
                            ✓ Cambiar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php"; ?>

    <script src="/G4_AmbienteWeb/Views/assets/jss/bootstrap.bundle.min.js"></script>
    <script>
        // Llenar datos del modal cuando se abre
        document.getElementById('modalCambiarRol').addEventListener('show.bs.modal', function (e) {
            const button = e.relatedTarget;
            const idUsuario = button.getAttribute('data-id-usuario');
            const nombreUsuario = button.getAttribute('data-nombre-usuario');
            const rolActual = button.getAttribute('data-rol-actual');
            const idRolActual = button.getAttribute('data-id-rol-actual');

            document.getElementById('inputIdUsuario').value = idUsuario;
            document.getElementById('nombreUsuarioModal').textContent = nombreUsuario;
            document.getElementById('rolActualModal').innerHTML = `<span class="badge ${idRolActual == 1 ? 'bg-danger' : 'bg-success'}">${rolActual}</span>`;
            
            // Establecer el select al rol opuesto
            document.getElementById('selectRol').value = idRolActual == 1 ? 2 : 1;
        });
    </script>
</body>
</html>
