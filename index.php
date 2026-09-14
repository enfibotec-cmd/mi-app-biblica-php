<?php
require_once __DIR__ . '/includes/functions.php';

// 1. Obtener parámetros (forzando minúsculas para coincidir con jhn.json)
$codigoLibro = isset($_GET['libro']) ? strtolower(trim($_GET['libro'])) : 'jhn';
$numCapitulo = isset($_GET['cap']) ? (int)$_GET['cap'] : 1;

// 2. Cargar datos y validar existencia
$datosLibro = obtenerDatosLibro($codigoLibro);

if (!$datosLibro) {
    header("Location: /error.php?tipo=libro_no_encontrado&detalle=" . urlencode($codigoLibro));
    exit;
}

$capituloActual = obtenerCapitulo($datosLibro, $numCapitulo);
$tituloPagina = "{$datosLibro['meta']['bookName']} {$capituloActual['chapter']} - {$datosLibro['meta']['version']}";

// 3. Renderizar estructura
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

    <div class="d-flex flex-wrap gap-2 my-3">
      <?php if (!empty($capituloActual['ideas'])): ?>
        <?php foreach ($capituloActual['ideas'] as $idea): ?>
          <span class="badge text-bg-primary fs-6 fw-normal">#<?= htmlspecialchars($idea) ?></span>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </header>

  <hr class="my-4">

  <article class="lh-lg fs-5 bible-text mb-5">
    <p class="text-secondary fst-italic mb-3">
      Lectura del capítulo <?= $capituloActual['chapter'] ?> de <?= htmlspecialchars($datosLibro['meta']['bookName']) ?>.
    </p>
    <?php if (isset($capituloActual['text'])): ?>
      <?= nl2br(htmlspecialchars($capituloActual['text'])) ?>
    <?php endif; ?>
  </article>

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
