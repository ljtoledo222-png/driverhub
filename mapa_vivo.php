<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa en Vivo - Logística Norte VTC</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Leaflet CSS & JS (Mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Configuración Personalizada Tailwind -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Exo 2', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        vtc: {
                            main: '#1350C2',     // Azul Principal
                            dark: '#0f1115',     // Fondo principal (Gris muy oscuro)
                            panel: '#181b21',    // Fondo Paneles
                            border: '#2a2e35',   // Bordes
                            text: '#e2e8f0',     // Texto claro
                            muted: '#94a3b8',    // Texto secundario
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Scrollbar discreta */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f1115; }
        ::-webkit-scrollbar-thumb { background: #2a2e35; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #1350C2; }

        body { background-color: #0f1115; color: #e2e8f0; }
        
        /* Ajustes Leaflet para modo oscuro */
        .leaflet-container { background: #0f1115; font-family: 'Inter', sans-serif; }
        .leaflet-popup-content-wrapper { background: #181b21; color: #e2e8f0; border: 1px solid #2a2e35; border-radius: 0.5rem; }
        .leaflet-popup-tip { background: #181b21; border: 1px solid #2a2e35; border-top: 0; border-left: 0; }
        .leaflet-bar a { background-color: #181b21; color: #e2e8f0; border-bottom: 1px solid #2a2e35; }
        .leaflet-bar a:hover { background-color: #2a2e35; color: #fff; }
        
        /* Sidebar Nav Item */
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0.75rem;
            border-radius: 0.375rem; transition: all 0.2s; font-size: 0.875rem; color: #94a3b8;
        }
        .nav-item:hover { background-color: #2a2e35; color: white; }
        .nav-item.active { background-color: #1350C2; color: white; }

         /* Animación suave para el dropdown */
         .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease-in-out;
        }

        .group:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden font-sans h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 flex-shrink-0 flex flex-col border-r border-vtc-border bg-vtc-panel z-20 hidden md:flex">
        <!-- Logo -->
        <div class="h-16 flex items-center px-5 border-b border-vtc-border">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-vtc-main/20 flex items-center justify-center border border-vtc-main/30">
                    <img src="https://i.imgur.com/hLucV8D.png" alt="LN Logo" class="w-full h-full object-contain p-0.5">
                </div>
                <h2 class="font-display font-bold text-lg tracking-wide text-white">LN<span class="text-blue-500">VTC</span></h2>
            </div>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-3 py-6 space-y-6 overflow-y-auto">
            <!-- ZONA CONDUCTOR -->
            <div>
                <p class="px-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <i data-lucide="steering-wheel" class="w-3 h-3"></i> Zona Conductor
                </p>
                <div class="space-y-1">
                    <a href="#" class="nav-item">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Mi Panel</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="book" class="w-4 h-4"></i>
                        <span>Mi Bitácora</span>
                    </a>
                    <a href="#" class="nav-item active">
                        <i data-lucide="map" class="w-4 h-4"></i>
                        <span>Mapa en Vivo</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="trophy" class="w-4 h-4"></i>
                        <span>Ranking</span>
                    </a>
                     <a href="#" class="nav-item">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                        <span>Ver Anuncios</span>
                    </a>
                </div>
            </div>

            <!-- ZONA STAFF -->
            <div class="border-t border-vtc-border mx-2"></div>
            <div>
                <p class="px-2 text-[11px] font-bold text-blue-500 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <i data-lucide="shield" class="w-3 h-3"></i> Administración
                </p>
                <div class="space-y-1">
                    <a href="#" class="nav-item">
                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                        <span>Estado Empresa</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Gestión Conductores</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Solicitudes (3)</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="calendar-plus" class="w-4 h-4"></i>
                        <span>Crear Convoys</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        <span>Publicar Anuncio</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Client Status -->
        <div class="p-4 border-t border-vtc-border bg-[#13161a]">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold text-gray-400">LN Client</span>
                <span class="text-[10px] px-1.5 py-0.5 bg-green-900/30 text-green-400 border border-green-900/50 rounded">v2.4</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-xs text-white">Conectado</span>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col min-w-0 bg-vtc-dark relative">
        
        <!-- Header overlaying map or top -->
        <header class="h-16 flex items-center justify-between px-6 border-b border-vtc-border bg-vtc-panel sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-400 hover:text-white"><i data-lucide="menu" class="w-6 h-6"></i></button>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <h1 class="text-sm font-bold text-white uppercase tracking-wide">Monitor de Flota en Tiempo Real</h1>
                </div>
            </div>

             <!-- Right Actions (Consistent with Dashboard) -->
             <div class="flex items-center gap-5">
                <!-- Notifications Bell with Dropdown -->
                <div class="relative group">
                    <button class="relative text-gray-400 hover:text-white p-1 focus:outline-none">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-blue-500 rounded-full border-2 border-vtc-panel animate-pulse"></span>
                    </button>
                    
                    <!-- Dropdown de Anuncios -->
                    <div class="dropdown-menu absolute right-0 top-full mt-2 w-80 bg-[#181b21] border border-vtc-border rounded-lg shadow-2xl z-50 overflow-hidden">
                        <div class="p-3 border-b border-vtc-border bg-[#13161a] flex justify-between items-center">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wide">Notificaciones</h4>
                            <span class="text-[10px] text-blue-400 cursor-pointer hover:underline">Marcar leídas</span>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            <div class="p-4 border-b border-vtc-border bg-blue-900/10 hover:bg-blue-900/20 transition-colors cursor-pointer">
                                <p class="text-xs font-bold text-white mb-1">Convoy Navideño 2024</p>
                                <p class="text-[11px] text-gray-400">Ruta oficial publicada. Revisa el canal de eventos.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-5 w-px bg-vtc-border"></div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-white">Alex Driver</p>
                        <p class="text-xs text-gray-500">Oficial de 1ª</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Alex+Driver&background=1350C2&color=fff" class="w-8 h-8 rounded bg-vtc-border">
                </div>
            </div>
        </header>

        <!-- MAP CONTAINER -->
        <div class="flex-1 relative flex overflow-hidden">
            <!-- Map Div -->
            <div id="map" class="flex-1 bg-[#0f1115] z-0"></div>

            <!-- Right Overlay Panel (Online Drivers) -->
            <div class="w-80 bg-vtc-panel border-l border-vtc-border flex flex-col z-10 shadow-2xl absolute right-0 top-0 bottom-0 transform transition-transform duration-300 translate-x-0" id="onlinePanel">
                <!-- Panel Header -->
                <div class="p-4 border-b border-vtc-border flex justify-between items-center bg-[#1a1d23]">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i data-lucide="radio" class="w-4 h-4 text-green-500"></i>
                        Conductores Online
                    </h3>
                    <span class="text-xs font-mono bg-vtc-dark px-2 py-1 rounded text-gray-400">4 Activos</span>
                </div>

                <!-- Driver List -->
                <div class="flex-1 overflow-y-auto p-2 space-y-2">
                    
                    <!-- Driver 1 (Alex - You) -->
                    <div class="bg-vtc-dark/50 hover:bg-vtc-dark border border-vtc-border rounded p-3 cursor-pointer group transition-colors" onclick="focusDriver(40.4168, -3.7038, 'Alex Driver')">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Alex+Driver&background=1350C2&color=fff" class="w-8 h-8 rounded border border-vtc-border">
                                <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-vtc-panel"></div>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-white group-hover:text-blue-400 transition-colors">Alex Driver (Tú)</p>
                                <p class="text-[10px] text-gray-500">Scania S730 • 84 km/h</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-[10px] text-gray-400 bg-vtc-panel rounded px-2 py-1">
                            <span>Madrid -> Lisboa</span>
                            <span class="text-blue-400">65%</span>
                        </div>
                    </div>

                    <!-- Driver 2 -->
                    <div class="bg-vtc-dark/50 hover:bg-vtc-dark border border-vtc-border rounded p-3 cursor-pointer group transition-colors" onclick="focusDriver(48.8566, 2.3522, 'Marta G.')">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Marta+G&background=random" class="w-8 h-8 rounded border border-vtc-border">
                                <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-vtc-panel"></div>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-white group-hover:text-blue-400 transition-colors">Marta G.</p>
                                <p class="text-[10px] text-gray-500">Volvo FH16 • 90 km/h</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-[10px] text-gray-400 bg-vtc-panel rounded px-2 py-1">
                            <span>Paris -> Calais</span>
                            <span class="text-blue-400">20%</span>
                        </div>
                    </div>

                     <!-- Driver 3 -->
                     <div class="bg-vtc-dark/50 hover:bg-vtc-dark border border-vtc-border rounded p-3 cursor-pointer group transition-colors" onclick="focusDriver(52.5200, 13.4050, 'Juan P.')">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Juan+P&background=random" class="w-8 h-8 rounded border border-vtc-border">
                                <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-yellow-500 rounded-full border-2 border-vtc-panel"></div>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-white group-hover:text-blue-400 transition-colors">Juan P.</p>
                                <p class="text-[10px] text-gray-500">En Pausa</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-[10px] text-gray-400 bg-vtc-panel rounded px-2 py-1">
                            <span>Berlin (Garage)</span>
                            <span class="text-gray-500">--</span>
                        </div>
                    </div>

                </div>
                
                <!-- Toggle Panel Button (Mobile/Desktop) -->
                <button class="absolute top-1/2 -left-6 bg-vtc-panel border border-vtc-border border-r-0 rounded-l p-1 text-gray-400 hover:text-white" onclick="togglePanel()">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

    </main>

    <script>
        lucide.createIcons();

        // 1. Inicializar Mapa (Centrado en Europa)
        const map = L.map('map', {
            zoomControl: false, // Movemos el zoom después
            attributionControl: false
        }).setView([46.5, 2.5], 5); // Centro aprox Francia

        // 2. Capa de Mapa Oscuro (CartoDB Dark Matter)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            subdomains: 'abcd'
        }).addTo(map);

        // Controles de Zoom en posición personalizada
        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // 3. Icono Personalizado para Camiones
        const truckIcon = L.divIcon({
            className: 'custom-div-icon',
            html: `<div class="w-8 h-8 bg-vtc-main rounded-full border-2 border-white shadow-[0_0_15px_rgba(19,80,194,0.6)] flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="16" x="4" y="4" rx="2"/><rect width="4" height="4" x="9" y="9" rx="1"/></svg>
                   </div>`,
            iconSize: [32, 32],
            iconAnchor: [16, 16],
            popupAnchor: [0, -20]
        });
        
        const otherTruckIcon = L.divIcon({
            className: 'custom-div-icon',
            html: `<div class="w-8 h-8 bg-slate-700 rounded-full border-2 border-gray-400 shadow-lg flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="16" x="4" y="4" rx="2"/><rect width="4" height="4" x="9" y="9" rx="1"/></svg>
                   </div>`,
            iconSize: [32, 32],
            iconAnchor: [16, 16],
            popupAnchor: [0, -20]
        });

        // 4. Añadir Conductores (Simulados)
        
        // Driver 1: Madrid
        const marker1 = L.marker([40.4168, -3.7038], {icon: truckIcon}).addTo(map)
            .bindPopup(`
                <div class="font-sans min-w-[150px]">
                    <h4 class="font-bold text-sm text-white mb-1">Alex Driver (Tú)</h4>
                    <div class="text-xs text-gray-300 space-y-1">
                        <p>🚛 Scania S730</p>
                        <p>📦 Electrónica (12t)</p>
                        <p>📍 Madrid -> Lisboa</p>
                        <p class="text-green-400 font-mono">84 km/h</p>
                    </div>
                </div>
            `);

        // Driver 2: Paris
        const marker2 = L.marker([48.8566, 2.3522], {icon: otherTruckIcon}).addTo(map)
            .bindPopup(`
                <div class="font-sans min-w-[150px]">
                    <h4 class="font-bold text-sm text-white mb-1">Marta G.</h4>
                    <div class="text-xs text-gray-300 space-y-1">
                        <p>🚛 Volvo FH16</p>
                        <p>📦 Vacunas (5t)</p>
                        <p>📍 Paris -> Calais</p>
                        <p class="text-green-400 font-mono">90 km/h</p>
                    </div>
                </div>
            `);
            
        // Driver 3: Berlin
         const marker3 = L.marker([52.5200, 13.4050], {icon: otherTruckIcon}).addTo(map)
            .bindPopup(`
                <div class="font-sans min-w-[150px]">
                    <h4 class="font-bold text-sm text-white mb-1">Juan P.</h4>
                    <div class="text-xs text-gray-300 space-y-1">
                        <p>🚛 MAN TGX</p>
                        <p class="text-yellow-500 font-mono">EN PAUSA</p>
                    </div>
                </div>
            `);


        // Función para centrar mapa desde la lista
        function focusDriver(lat, lng, name) {
            map.flyTo([lat, lng], 10, {
                animate: true,
                duration: 1.5
            });
            // Abrir popup correspondiente (Lógica simple para demo)
            if(name.includes('Alex')) marker1.openPopup();
            if(name.includes('Marta')) marker2.openPopup();
            if(name.includes('Juan')) marker3.openPopup();
        }

        // Toggle Panel
        function togglePanel() {
            const panel = document.getElementById('onlinePanel');
            const btnIcon = document.querySelector('#onlinePanel button i');
            
            if (panel.classList.contains('translate-x-full')) {
                panel.classList.remove('translate-x-full'); // Mostrar
                btnIcon.setAttribute('data-lucide', 'chevron-right');
            } else {
                panel.classList.add('translate-x-full'); // Ocultar
                btnIcon.setAttribute('data-lucide', 'chevron-left');
            }
            lucide.createIcons();
        }

        // Ajustar layout responsive
        window.addEventListener('resize', () => {
            if (window.innerWidth < 768) {
                document.getElementById('onlinePanel').classList.add('translate-x-full');
            } else {
                document.getElementById('onlinePanel').classList.remove('translate-x-full');
            }
        });
        // Init state
        if (window.innerWidth < 768) {
             document.getElementById('onlinePanel').classList.add('translate-x-full');
        }

    </script>
</body>
</html>