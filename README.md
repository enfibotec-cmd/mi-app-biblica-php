
mi-app-biblica-php/
├── assets/
│   ├── css/
│   │   └── styles.css          # Estilos personalizados adicionales
│   └── js/
│       └── app.js              # Lógica del cliente (modo oscuro, interacciones)
├── data/
│   ├── versiones.json          # Lista de versiones disponibles (RVR1960, NVI, NTV)
│   ├── libros.json             # Índice general de los 66 libros (meta, categorías)
│   └── libros/
│       ├── JHN.json            # Metadatos e ideas clave de Juan
│       └── GEN.json            # Metadatos e ideas clave de Génesis
├── includes/
│   ├── header.php              # Head HTML, metas y enlaces a CDN Bootstrap
│   ├── navbar.php              # Barra superior con selector de versión y tema
│   ├── offcanvas.php           # Menú lateral para selección de libros/capítulos
│   ├── functions.php           # Funciones en PHP para leer y procesar JSONs
│   └── footer.php              # Pie de página y Scripts JS de Bootstrap
├── index.php                   # Página principal (Lector Bíblico)
├── .gitignore                  # Archivos excluidos del control de versiones
├── LICENSE                     # Licencia MIT
└── README.md                   # Documentación general del repositorio
