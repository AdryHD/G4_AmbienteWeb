# 🎯 GUÍA RÁPIDA DE USO - Panel Admin y RBAC

## 📍 ACCEDER AL PANEL ADMINISTRATIVO

### Paso 1: Login como Administrador
```
Email:    admin@powerzone.com
Contraseña: 123456
```

### Paso 2: Ubicar Panel Admin
Después de iniciar sesión, en la esquina superior derecha:
1. Click en tu nombre + rol (dropdown)
2. Busca: **🔐 Panel Administrativo**
3. Click para acceder a `/Views/Admin/usuarios.php`

### Paso 3: Gestión de Usuarios
En el panel verás una tabla con:
- Nombre del usuario
- Email
- Rol actual (ADMIN/CLIENTE)
- Botón "⚙️ Cambiar Rol"

---

## 🔄 CAMBIAR ROL DE UN USUARIO

### Caso 1: Convertir CLIENTE → ADMIN
1. Encuentra al usuario en la tabla
2. Click en botón "⚙️ Cambiar Rol"
3. Se abre modal de confirmación
4. Selecciona "🔐 Administrador" 
5. Click "✓ Cambiar Rol"
6. ✅ El usuario ahora es ADMIN

### Caso 2: Convertir ADMIN → CLIENTE  
1. Mismo proceso anterior
2. Selecciona "👤 Cliente"
3. Confirma cambio

### ⚠️ RESTRICCIÓN ESPECIAL
**NO PUEDES cambiar tu PROPIO rol**
- Si eres ADMIN, el botón está deshabilitado para ti
- Esto previene que te bloquees a ti mismo del panel

---

## 🚫 RESTRICCIONES POR ROL

### ADMINISTRADOR (id_rol = 1)
✅ **PUEDE**:
- Acceder a Panel Administrativo
- Gestionar usuarios (cambiar roles)
- Gestionar Productos (CRUD)
- Ver todos los Pedidos
- Cambiar su perfil y contraseña

❌ **NO PUEDE**:
- Acceder a la Tienda de Productos
- Agregar productos al Carrito
- Hacer compras

### CLIENTE (id_rol = 2)
✅ **PUEDE**:
- Ver y comprar en la Tienda
- Usar el Carrito
- Hacer Pedidos
- Ver su historial de compras
- Cambiar su perfil y contraseña

❌ **NO PUEDE**:
- Acceder al Panel Administrativo
- Gestionar Productos
- Ver/Gestionar todos los Pedidos

---

## 🔐 SEGURIDAD DE CONTRASEÑAS

### Nuevas Contraseñas
Todas las **nuevas contraseñas** están protegidas con **bcrypt hash**:
- Algoritmo: bcrypt
- Cost: 12 (muy seguro)
- Longitud de hash: 60 caracteres

### Contraseñas Antiguas
Las contraseñas **existentes** (ej: "123456") aún funcionan:
- El sistema es compatible hacia atrás
- Se hashearán cuando cambies tu contraseña

### Mejorar Seguridad
Para cambiar tu contraseña:
1. Login
2. Click en tu nombre (dropdown)
3. "🔐 Cambiar Contraseña"
4. Ingresa nueva contraseña
5. Se guarda con hash automáticamente

---

## 📱 NAVBAR DINÁMICO (según rol)

### Navegación para CLIENTE:
```
[Inicio] [Productos] [Ofertas] [Pedidos] [Carrito] [Perfil]
```

### Navegación para ADMIN:
```
[Inicio] [Perfil]
(Sin acceso a Tienda, Ofertas, Carrito)
```

---

## 🧪 PRUEBAS RÁPIDAS

### Test 1: Panel Admin
```
1. Login como: admin@powerzone.com / 123456
2. Verifica que ves el botón "Panel Administrativo"
3. Haz click
4. Deberías ver la tabla de usuarios
```

### Test 2: Cambiar Rol  
```
1. En Panel Admin
2. Busca usuario: "Daniel Suaréz" (cliente)
3. Haz click en "⚙️ Cambiar Rol"
4. Cambia a ADMIN
5. Verifica que aparece badge rojo "administrador"
```

### Test 3: Protección de Rol
```
1. Como ADMIN, intenta ir a /Views/Producto/tienda.php
2. Deberías ser redirigido a home
3. Como CLIENTE, intenta ir a /Views/Admin/usuarios.php  
4. Deberías ser redirigido a home
```

### Test 4: Carrito (Solo Cliente)
```
1. Login como CLIENTE
2. Ve a Tienda
3. Agrega producto al carrito
4. Botón de carrito debe mostrar cantidad
5. Como ADMIN, no deberías poder acceder a /carrito.php
```

---

## 🐛 RESOLUCIÓN DE PROBLEMAS

### Problema: No veo el Panel Admin
**Solución:**
- Verifica que tu usuario tenga `id_rol = 1`
- Recarga la página (F5)
- Cierra sesión y login nuevamente

### Problema: Error 403 "No tienes permiso"
**Solución:**
- Intentas acceder a una sección con rol equivocado
- Usa Panel Admin para cambiar tu rol

### Problema: Cambio de rol no funciona
**Solución:**
- Recarga la página para ver cambios
- Cierra sesión e inicia nuevamente
- Verifica que seleccionaste un rol diferente al actual

### Problema: Contraseña rechazada  
**Solución:**
- Asegurate de escribir exactamente: `123456`
- Si cambias la contraseña, usa la nueva
- Las contraseñas son CASE-SENSITIVE

---

## 📊 ESTADO DEL PROYECTO

| Componente | Estado |
|-----------|--------|
| Seguridad de contraseñas | ✅ Activo |
| RBAC (Control por Rol) | ✅ Activo |
| Panel Admin | ✅ Activo |
| Protección de vistas | ✅ Activo |

---

## 📞 AYUDA

Si tienes problemas:
1. Revisa este documento completo
2. Verifica `IMPLEMENTACION_SEGURIDAD.md`
3. Comprueba que importaste el Database.sql actualizado

---

**¡Listo para usar!** 🚀
