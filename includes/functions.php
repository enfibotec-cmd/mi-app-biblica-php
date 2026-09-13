
<?php
/**
 * Lee y decodifica un archivo JSON.
 */
function cargarJSON(string $ruta): ?array {
    if (!file_exists($ruta)) {
        return null;
    }
    $contenido = file_get_contents($ruta);
    return json_decode($contenido, true);
}

/**
 * Obtiene los datos de un libro específico desde data/libros/{CODE}.json
 */
function obtenerDatosLibro(string $codigoLibro): ?array {
    $codigoLimpio = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $codigoLibro));
    $ruta = __DIR__ . "/../data/libros/{$codigoLimpio}.json";
    return cargarJSON($ruta);
}

/**
 * Filtra y devuelve un capítulo específico dentro del arreglo del libro.
 */
function obtenerCapitulo(array $datosLibro, int $numCapitulo): array {
    foreach ($datosLibro['chapters'] as $cap) {
        if ($cap['chapter'] === $numCapitulo) {
            return $cap;
        }
    }
    // Retornar el primer capítulo por defecto si no existe el solicitado
    return $datosLibro['chapters'][0] ?? [];
}
