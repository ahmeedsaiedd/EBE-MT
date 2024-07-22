<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EBE Dashboard</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="admin/assets/css/tailwind.output.css" />
  <script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
  ></script>
  <script src="admin/assets/js/init-alpine.js"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
  />
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
    defer
  ></script>
  <script src="admin/assets/js/charts-lines.js" defer></script>
  <script src="admin/assets/js/charts-pie.js" defer></script>
  
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('modalManager', () => ({
        openModalId: null,
        openModal(id) {
          if (this.openModalId === id) {
            this.openModalId = null;
          } else {
            this.openModalId = id;
          }
        },
        isModalOpen(id) {
          return this.openModalId === id;
        },
      }));
    });
  </script>