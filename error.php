<?php
// 1. Capturamos el tipo de error desde la URL
$tipoError = isset($_GET['tipo']) ? $_GET['tipo'] : 'error_general';
$detalle = isset($_GET['detalle']) ? $_GET['detalle'] : '';

// 2. Leemos el archivo JSON de errores (con valores por defecto seguros)
$rutaErrores = __DIR__ . '/data/errores.json';
$errores = [];

if (file_exists($rutaErrores)) {
    $contenido = file_get_contents($rutaErrores);
    $errores = json_decode($contenido, true) ?: [];
}

// 3. Valores por defecto garantizados (nunca será null)
$info = $errores[$tipoError] ?? [
    'titulo' => '⚠️ Error',
    'mensaje' => 'Ha ocurrido un error inesperado.',
    'icono' => '⚠️',
    'color' => '#34495E'
];

// 4. Asegurar que todas las propiedades existan
$titulo = $info['titulo'] ?? 'Error';
$mensaje = $info['mensaje'] ?? 'Ha ocurrido un error.';
$icono = $info['icono'] ?? '⚠️';
$color = $info['color'] ?? '#34495E';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', system-ui, sans-serif; }
        body {
            display: flex; justify-content: center; align-items: center; min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #2d3436;
        }
        .error-card {
            background: white; padding: 3rem; border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center;
            max-width: 500px; width: 90%; border-top: 6px solid <?= $color ?>;
        }
        .icon { font-size: 5rem; margin-bottom: 1.5rem; }
        h1 { font-size: 1.8rem; margin-bottom: 1rem; color: <?= $color ?>; }
        p { font-size: 1.1rem; line-height: 1.6; color: #636e72; margin-bottom: 2rem; }
        .detalle { 
            background: #f8f9fa; padding: 1rem; border-radius: 12px; 
            font-family: monospace; font-size: 0.9rem; color: #e17055; 
            margin-bottom: 2rem; word-break: break-all; border: 1px dashed #dfe6e9;
        }
        .btn {
            display: inline-block; padding: 0.8rem 2.5rem; background: #0984e3;
            color: white; text-decoration: none; border-radius: 50px; font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(9,132,227,0.3); }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="icon"><?= htmlspecialchars($icono) ?></div>
        <h1><?= htmlspecialchars($titulo) ?></h1>
        <p><?= htmlspecialchars($mensaje) ?></p>
        
        <?php if($detalle): ?>
            <div class="detalle">Código buscado: <strong><?= htmlspecialchars($detalle) ?></strong></div>
        <?php endif; ?>
        
        <a href="/" class="btn">← Volver al inicio</a>
    </div>
</body>
</html>
