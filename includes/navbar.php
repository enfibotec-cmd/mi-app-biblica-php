<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom sticky-top">
  <div class="container-fluid">
    <!-- Botón abrir menú de capítulos -->
    <button class="btn btn-outline-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCapitulos">
      ☰ Capítulos
    </button>

    <!-- Título de la lectura actual -->
    <span class="navbar-brand fw-bold mb-0 h1">
      <?= htmlspecialchars($datosLibro['meta']['bookName'] ?? '') ?> <?= $capituloActual['chapter'] ?? 1 ?>
    </span>

    <!-- Selector de Versión y Toggle de Modo Oscuro -->
    <div class="d-flex align-items-center gap-2 ms-auto">
      <select class="form-select form-select-sm d-none d-sm-block" id="selectVersion" aria-label="Versión bíblica">
        <option value="RVR1960" selected>RVR1960</option>
        <option value="NVI">NVI</option>
        <option value="NTV">NTV</option>
      </select>
      
      <button class="btn btn-sm btn-outline-secondary" id="btnToggleTheme" type="button" aria-label="Cambiar tema">
        🌙
      </button>
    </div>
  </div>
</nav>
