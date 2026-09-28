document.addEventListener("DOMContentLoaded", () => {
  initMaps();
  initCounters();
});

/* --- INICIALIZACIÓN DE MAPAS CON LEAFLET --- */
function initMaps() {
  // Coordenadas de Durazno, Uruguay
  const duraznoCoords = [-33.3806, -56.5236];

  // 1. Mapa Hero (Vista General)
  const mapHero = L.map('map-hero', {
    zoomControl: false,
    scrollWheelZoom: false
  }).setView(duraznoCoords, 14);

  L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    maxZoom: 19
  }).addTo(mapHero);

  // Marcadores con íconos personalizados
  addMarker(mapHero, [-33.382, -56.521], "Liceo N.° 1", "refugio");
  addMarker(mapHero, [-33.375, -56.528], "Centro Unión", "refugio");
  addMarker(mapHero, [-33.388, -56.525], "Gimnasio", "refugio");

  // 2. Mapa Completo de Refugios
  const mapRefugios = L.map('map-refugios-full').setView(duraznoCoords, 14);

  L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    maxZoom: 19
  }).addTo(mapRefugios);

  addMarker(mapRefugios, [-33.382, -56.521], "Liceo N.° 1 (Espacio Libre)", "refugio");
  addMarker(mapRefugios, [-33.375, -56.528], "Club Centro Unión (Recibiendo)", "refugio");
}

function addMarker(map, coords, title, type) {
  const customIcon = L.divIcon({
    className: 'custom-map-pin',
    html: `<div style="background:#FF5522; color:white; padding:4px 8px; border-radius:12px; font-weight:bold; font-size:11px; box-shadow:0 2px 6px rgba(0,0,0,0.3); display:flex; align-items:center; gap:4px;"><i class="fa-solid fa-location-dot"></i> ${title}</div>`,
    iconSize: [100, 30]
  });

  L.marker(coords, { icon: customIcon }).addTo(map);
}

/* --- CONTROL DE MODALES --- */
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'grid';
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// Cerrar modal al hacer clic afuera del recuadro
window.onclick = function(event) {
  if (event.target.classList.contains('modal-overlay')) {
    event.target.style.display = 'none';
  }
};

/* --- MANEJO DE FORMULARIOS --- */
function handleFormSubmit(event, message) {
  event.preventDefault();
  alert(message);

  // Actualizador dinámico del contador de pedidos
  const counterPedidos = document.getElementById('counter-pedidos');
  if (counterPedidos) {
    let current = parseInt(counterPedidos.innerText);
    counterPedidos.innerText = current + 1;
  }

  event.target.reset();
  closeModal('modal-ayuda');
  closeModal('modal-donar');
}

/* --- ANIMACIÓN MÍNIMA DE CONTADORES --- */
function initCounters() {
  console.log("Sistema FENIX iniciado correctamente en Durazno.");
}