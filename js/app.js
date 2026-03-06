// Utilidades simples
const qs = (sel, ctx = document) => ctx.querySelector(sel);
const qsa = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

document.addEventListener('DOMContentLoaded', () => {
  // Año en footer
  const yearEl = qs('#footer-year');
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());

  // Navegación principal (scroll + estado activo)
  const navLinks = qsa('[data-nav-link]');
  navLinks.forEach(link => {
    link.addEventListener('click', evt => {
      evt.preventDefault();
      const targetId = link.getAttribute('href')?.replace('#', '');
      if (!targetId) return;

      const section = qs(`#${targetId}`);
      if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        navLinks.forEach(l => l.classList.remove('is-active'));
        link.classList.add('is-active');
      }
    });
  });

  // Burger / menú móvil
  const burger = qs('.ga-header__burger');
  const nav = qs('.ga-header__nav');
  if (burger && nav) {
    burger.addEventListener('click', () => {
      const open = nav.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // ----- Mock de datos de novedades -----
  const mockNews = [
    {
      id: 1,
      titulo: 'Nueva rotación Zárate – Norte de Europa',
      subtitulo: 'Actualización de frecuencias y puertos de escala',
      tipo: 'operativo',
      fecha: '2026-02-10',
      trimestre: 'Q1 2026',
      esRevista: false,
    },
    {
      id: 2,
      titulo: 'Revista GAA | 4° trimestre 2025',
      subtitulo: 'Tendencias, casos de éxito y notas de equipo',
      tipo: 'revista',
      fecha: '2025-12-15',
      trimestre: 'Q4 2025',
      esRevista: true,
    },
    {
      id: 3,
      titulo: 'Optimización en procesos documentales',
      subtitulo: 'Mejoras en tiempos de respuesta al cliente',
      tipo: 'comercial',
      fecha: '2025-11-03',
      trimestre: 'Q4 2025',
      esRevista: false,
    },
    {
      id: 4,
      titulo: 'Operación récord de carga proyecto',
      subtitulo: 'Coordinación conjunta para piezas sobredimensionadas',
      tipo: 'operativo',
      fecha: '2025-09-21',
      trimestre: 'Q3 2025',
      esRevista: false,
    },
    {
      id: 5,
      titulo: 'Revista GAA | 3° trimestre 2025',
      subtitulo: 'Casos destacados y enfoque en seguridad',
      tipo: 'revista',
      fecha: '2025-09-05',
      trimestre: 'Q3 2025',
      esRevista: true,
    },
  ];

  // Render de novedades en la vista pública
  const newsContainer = qs('#news-list');
  const archiveList = qs('#news-archive-list');
  const chipGroup = qs('[data-news-filter-group]');
  const pageLabel = qs('[data-page-label]');
  const btnPrev = qs('[data-page-prev]');
  const btnNext = qs('[data-page-next]');

  let currentFilter = 'all';
  let currentPage = 1;
  const pageSize = 6;

  const getFilteredNews = () =>
    mockNews.filter(n => currentFilter === 'all' || n.tipo === currentFilter);

  const renderNews = () => {
    if (!newsContainer) return;
    const filtered = getFilteredNews();
    const totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
    if (currentPage > totalPages) currentPage = totalPages;
    const start = (currentPage - 1) * pageSize;
    const pageItems = filtered.slice(start, start + pageSize);

    newsContainer.innerHTML = '';
    pageItems.forEach(item => {
      const card = document.createElement('article');
      card.className = 'ga-news-card';
      card.innerHTML = `
        <div class="ga-news-card__badge">${item.tipo === 'revista' ? 'Revista' : 'Novedad'}</div>
        <h3 class="ga-news-card__title">${item.titulo}</h3>
        <p class="ga-news-card__subtitle">${item.subtitulo}</p>
        <div class="ga-news-card__meta">
          <span>${new Date(item.fecha).toLocaleDateString('es-AR', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
          })}</span>
          <span>${item.esRevista ? 'Ver edición' : 'Más detalles'}</span>
        </div>
      `;
      newsContainer.appendChild(card);
    });

    if (pageLabel) pageLabel.textContent = `Página ${currentPage} de ${totalPages}`;
    if (btnPrev) btnPrev.disabled = currentPage === 1;
    if (btnNext) btnNext.disabled = currentPage === totalPages;
  };

  const renderArchive = () => {
    if (!archiveList) return;
    const groups = {};
    mockNews.forEach(n => {
      groups[n.trimestre] ??= [];
      groups[n.trimestre].push(n);
    });
    archiveList.innerHTML = '';
    Object.entries(groups).forEach(([quarter, items]) => {
      const li = document.createElement('li');
      li.innerHTML = `<button type="button">${quarter} · ${items.length} items</button>`;
      archiveList.appendChild(li);
    });
  };

  if (chipGroup) {
    chipGroup.addEventListener('click', evt => {
      const chip = evt.target.closest('.ga-chip');
      if (!chip) return;
      currentFilter = chip.getAttribute('data-filter') || 'all';
      currentPage = 1;
      qsa('.ga-chip', chipGroup).forEach(c => c.classList.remove('is-active'));
      chip.classList.add('is-active');
      renderNews();
    });
  }

  if (btnPrev && btnNext) {
    btnPrev.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage -= 1;
        renderNews();
      }
    });
    btnNext.addEventListener('click', () => {
      const totalPages = Math.max(1, Math.ceil(getFilteredNews().length / pageSize));
      if (currentPage < totalPages) {
        currentPage += 1;
        renderNews();
      }
    });
  }

  renderNews();
  renderArchive();
});

