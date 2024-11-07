<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Cambios en el Inventario de Vacunas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Historial de Cambios en el Inventario de Vacunas</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Vacuna</th>
            <th>Cantidad Disponible</th>
            <th>Cantidad Cambiada</th>
            <th>Tipo de Operación</th>
            <th>Observaciones</th>
            <th>Fecha de Registro</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($historial as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo $item->nombre_vacuna; ?></td>
            <td><?php echo $item->cantidad_disponible; ?></td>
            <td><?php echo $item->cantidad_cambiada; ?></td>
            <td><?php echo $item->tipo_operacion; ?></td>
            <td><?php echo $item->observaciones; ?></td>
            <td><?php echo $item->created_at; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="{{ route('inventario.index') }}" class="btn btn-secondary">Volver al Inventario</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
