<?php
// Iniciar la sesión para poder usar la información del usuario
session_start();

// Conectar a la base de datos
include 'Config/conexion.php';

// Si no hay usuario conectado, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: auth/login.php");
    exit();
}

// Traer todos los productos de la tabla
$resultado = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #5a1111;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 760px;
            margin: 40px auto;
            padding: 24px;
            background: #ffe5e5;
            border: 1px solid #cc9b9b;
            border-radius: 16px;
            color: #3a0a0a;
        }

        h1, h2 {
            margin: 0 0 16px;
            color: #7f1010;
        }

        p {
            margin: 0 0 16px;
        }

        label {
            display: block;
            margin-bottom: 12px;
            color: #6e0f0f;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border: 1px solid #b18181;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #c82333;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th, td {
            border: 1px solid #caa7a7;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f4c5c5;
        }

        a {
            color: #a71d2a;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">

        <h1>Inventario</h1>
        <p>Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
        <p>
            <a href="auth/logout.php">Cerrar sesión</a>
        </p>
        <p>
            <a href="reporte.php" style="display:inline-block;padding:10px 16px;background:#a71d2a;color:#fff;border-radius:10px;text-decoration:none;font-weight:bold;">Generar PDF</a>
        </p>

    
        <h2>Agregar producto</h2>
        <form action="guardar_producto.php" method="POST">
            <label>
                Nombre:
                <input type="text" name="nombre" required>
            </label>

            <label>
                Descripción:
                <textarea name="descripcion" rows="3"></textarea>
            </label>

            <label>
                Cantidad:
                <input type="number" name="cantidad" required>
            </label>

            <label>
                Precio:
                <input type="number" step="0.01" name="precio" required>
            </label>

            <button type="submit">Guardar</button>
        </form>

        <!-- Tabla de productos -->
        <h2>Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                    <td><?php echo $fila['cantidad']; ?></td>
                    <td><?php echo '$' . number_format($fila['precio'], 2); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a> |
                        <a href="eliminar.php?id=<?php echo $fila['id']; ?>">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
