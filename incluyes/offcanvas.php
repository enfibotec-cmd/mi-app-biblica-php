
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCapitulos" aria-labelledby="offcanvasLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="offcanvasLabel">
      <?= htmlspecialchars($datosLibro['meta']['bookName'] ?? 'Libro') ?> 
      <small class="text-muted"> (<?= $datosLibro['meta']['totalBookChapters'] ?? 0 ?> caps)</small>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  
  <div class="offcanvas-body p-0">
    <div class="list-group list-group-flush">
      <?php if (!empty($datosLibro['chapters'])): ?>
        <?php foreach ($datosLibro['chapters'] as $c): ?>
          <a href="?libro=<?= urlencode($codigoLibro) ?>&cap=<?= $c['chapter'] ?>" 
             class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $c['chapter'] === $capituloActual['chapter'] ? 'active' : '' ?>">
            <span>Capítulo <?= $c['chapter'] ?></span>
            <span class="badge bg-secondary rounded-pill"><?= $c['totalVerses'] ?> vers.</span>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
