
<?php
require_once __DIR__ . '/includes/functions.php';

// Obtener parámetros de URL con sanitizado y valores por defecto
$codigoLibro = isset($_GET['libro']) ? strtoupper(trim($_GET['libro'])) : 'JHN';
$numCapitulo = isset($_GET['cap']) ? (int)$_GET['cap'] : 1;

// Cargar datos
$datosLibro = obtenerDatosLibro($codigoLibro);

if (!$datosLibro) {
    die("Error: No se encontró el libro solicitado ($codigoLibro).");
}

$capituloActual = obtenerCapitulo($datosLibro, $numCapitulo);
$tituloPagina = "{$datosLibro['meta']['bookName']} {$capituloActual['chapter']} - {$datosLibro['meta']['version']}";

// Renderizado de vistas
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
require_once __DIR__ . '/includes/offcanvas.php';
?>

<main class="container my-4" style="max-width: 760px;">
  
  <header class="mb-4">
    <div class="text-muted small mb-1">
      <?= htmlspecialchars($datosLibro['meta']['testamentName']) ?> &bull; <?= htmlspecialchars($datosLibro['meta']['versionName']) ?>
    </div>
    <h1 class="display-6 fw-bold"><?= htmlspecialchars($capituloActual['sectionTitle']) ?></h1>

    <!-- Badges de Ideas Clave -->
    <div class="d-flex flex-wrap gap-2 my-3">
      <?php foreach ($capituloActual['ideas'] as $idea): ?>
        <span class="badge text-bg-primary fs-6 fw-normal">#<?= htmlspecialchars($idea) ?></span>
      <?php endforeach; ?>
    </div>
  </header>

  <hr class="my-4">

  <!-- Texto Bíblico -->
  <article class="lh-lg fs-5 bible-text">
    <p class="text-secondary fst-italic">
      Lectura del capítulo <?= $capituloActual['chapter'] ?> de <?= htmlspecialchars($datosLibro['meta']['bookName']) ?>.
    </p>
  </article>

  <!-- Navegación entre Capítulos (Anterior / Siguiente) -->
  <nav class="d-flex justify-content-between my-5">
    <?php if ($capituloActual['chapter'] > 1): ?>
      <a href="?libro=<?= urlencode($codigoLibro) ?>&cap=<?= $capituloActual['chapter'] - 1 ?>" class="btn btn-outline-secondary">
        &laquo; Capítulo <?= $capituloActual['chapter'] - 1 ?>
      </a>
    <?php else: ?>
      <div></div>
    <?php endif; ?>

    <?php if ($capituloActual['chapter'] < $datosLibro['meta']['totalBookChapters']): ?>
      <a href="?libro=<?= urlencode($codigoLibro) ?>&cap=<?= $capituloActual['chapter'] + 1 ?>" class="btn btn-outline-primary">
        Capítulo <?= $capituloActual['chapter'] + 1 ?> &raquo;
      </a>
    <?php endif; ?>
  </nav>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
