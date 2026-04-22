<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/Seguridad/role_guard.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/SeguridadController.php";

requireAdmin();

if (session_status() === PHP_SESSION_NONE) session_start();
$miId = (int)($_SESSION["usuario_id"] ?? 0);

$usuarios = ListarUsuarios();

$mensaje = $_SESSION["mensaje"] ?? null;
$tipoMensaje = $_SESSION["tipo_mensaje"] ?? 'success';
unset($_SESSION["mensaje"], $_SESSION["tipo_mensaje"]);
?>
<!DOCTYPE html>
<html lang="es">
<?php MostrarCSS(); ?>
<body>
<?php MostrarNav(); ?>

<main class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1"><i class="lni lni-users me-2 text-success"></i>Gestión de Usuarios</h3>
      <p class="text-muted mb-0">Lista de usuarios y cambio de rol (CLIENTE / ADMIN).</p>
    </div>
  </div>

  <?php if (!empty($mensaje)): ?>
    <div class="alert alert-<?php echo $tipoMensaje === 'danger' ? 'danger' : 'success'; ?> shadow-sm">
      <?php echo htmlspecialchars($mensaje); ?>
    </div>
  <?php endif; ?>

  <div class="table-responsive shadow-sm rounded border bg-white p-3">
    <table id="tablaUsuarios" class="table table-hover align-middle mb-0">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Estado</th>
          <th style="width:220px;">Rol</th>
          <th class="text-center" style="width:140px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($usuarios)): ?>
          <tr><td colspan="6" class="text-center py-5 text-muted">No hay usuarios para mostrar.</td></tr>
        <?php else: ?>
          <?php foreach ($usuarios as $u):
            $id = (int)($u['id_usuario'] ?? 0);
            $rol = (int)($u['id_rol'] ?? 0);
            $isSelf = ($id === $miId);
          ?>
          <tr>
            <td class="fw-bold text-success">#<?php echo $id; ?></td>
            <td><?php echo htmlspecialchars($u['nombre'] ?? ''); ?><?php echo $isSelf ? ' <span class="badge bg-info text-dark ms-2">Tú</span>' : ''; ?></td>
            <td class="text-muted"><?php echo htmlspecialchars($u['correo'] ?? ''); ?></td>
            <td>
              <?php $estado = strtolower(trim((string)($u['estado'] ?? ''))); ?>
              <span class="badge <?php echo $estado === 'activo' ? 'bg-success' : 'bg-secondary'; ?>">
                <?php echo strtoupper($estado ?: 'N/A'); ?>
              </span>
            </td>
            <td>
              <form method="POST" action="/G4_AmbienteWeb/Controllers/SeguridadController.php" class="d-flex gap-2">
                <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
                <select name="id_rol" class="form-select form-select-sm" <?php echo $isSelf ? 'disabled' : ''; ?>>
                  <option value="2" <?php echo $rol === 2 ? 'selected' : ''; ?>>CLIENTE</option>
                  <option value="1" <?php echo $rol === 1 ? 'selected' : ''; ?>>ADMIN</option>
                </select>
                <?php if ($isSelf): ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary" disabled>No editable</button>
                <?php else: ?>
                  <button type="submit" name="btnActualizarRol" class="btn btn-sm btn-success">Guardar</button>
                <?php endif; ?>
              </form>
              <?php if ($isSelf): ?>
                <small class="text-muted">No puedes cambiar tu propio rol.</small>
              <?php endif; ?>
            </td>
            <td class="text-center">
              <?php if ($isSelf): ?>
                <span class="text-muted">—</span>
              <?php else: ?>
                <span class="text-muted small">Cambiar rol</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>
<script>
  try {
    new DataTable('#tablaUsuarios');
  } catch(e) {}
</script>
</body>
</html>

