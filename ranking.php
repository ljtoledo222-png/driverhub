<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking - Logística Norte VTC</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

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
                            gold: '#eab308',     // Oro
                            silver: '#94a3b8',   // Plata
                            bronze: '#d97706',   // Bronce
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
        .hub-card { background-color: #181b21; border: 1px solid #2a2e35; border-radius: 0.5rem; }

        /* Sidebar Nav Item */
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0.75rem;
            border-radius: 0.375rem; transition: all 0.2s; font-size: 0.875rem; color: #94a3b8;
        }
        .nav-item:hover { background-color: #2a2e35; color: white; }
        .nav-item.active { background-color: #1350C2; color: white; }

        /* Efectos de Podio */
        .podium-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .podium-card:hover { transform: translateY(-5px); }
        
        .rank-1 { border-color: rgba(234, 179, 8, 0.5); box-shadow: 0 0 20px rgba(234, 179, 8, 0.1); }
        .rank-2 { border-color: rgba(148, 163, 184, 0.5); box-shadow: 0 0 20px rgba(148, 163, 184, 0.1); }
        .rank-3 { border-color: rgba(217, 119, 6, 0.5); box-shadow: 0 0 20px rgba(217, 119, 6, 0.1); }

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
            
            <!-- ZONA CONDUCTOR (Driver) -->
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
                    <a href="#" class="nav-item">
                        <i data-lucide="map" class="w-4 h-4"></i>
                        <span>Mapa en Vivo</span>
                    </a>
                    <a href="#" class="nav-item active">
                        <i data-lucide="trophy" class="w-4 h-4"></i>
                        <span>Ranking</span>
                    </a>
                     <a href="#" class="nav-item">
                        <i data-lucide="megaphone" class="w-4 h-4"></i>
                        <span>Ver Anuncios</span>
                    </a>
                </div>
            </div>

            <!-- ZONA STAFF (Admin/Gestión) -->
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
                        <span>Solicitudes (Ingreso)</span>
                        <span class="ml-auto px-1.5 py-0.5 text-[10px] font-bold bg-blue-500 text-white rounded-full">3</span>
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
    <main class="flex-1 flex flex-col min-w-0 bg-vtc-dark">
        
        <!-- Header -->
        <header class="h-16 flex items-center justify-between px-6 border-b border-vtc-border bg-vtc-panel sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-400 hover:text-white"><i data-lucide="menu" class="w-6 h-6"></i></button>
                <div class="flex items-center gap-2">
                    <i data-lucide="trophy" class="w-5 h-5 text-yellow-500"></i>
                    <h1 class="text-base font-bold text-white uppercase tracking-wide">Ranking Mensual</h1>
                </div>
            </div>

             <!-- Right Actions -->
             <div class="flex items-center gap-5">
                <!-- Notifications -->
                <div class="relative group">
                    <button class="relative text-gray-400 hover:text-white p-1 focus:outline-none">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-blue-500 rounded-full border-2 border-vtc-panel animate-pulse"></span>
                    </button>
                    
                    <!-- Dropdown -->
                    <div class="dropdown-menu absolute right-0 top-full mt-2 w-80 bg-[#181b21] border border-vtc-border rounded-lg shadow-2xl z-50 overflow-hidden">
                        <div class="p-3 border-b border-vtc-border bg-[#13161a] flex justify-between items-center">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wide">Notificaciones</h4>
                            <span class="text-[10px] text-blue-400 cursor-pointer hover:underline">Marcar leídas</span>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            <div class="p-4 border-b border-vtc-border bg-blue-900/10 hover:bg-blue-900/20 transition-colors cursor-pointer">
                                <p class="text-xs font-bold text-white mb-1">Convoy Navideño 2024</p>
                                <p class="text-[11px] text-gray-400">Ruta oficial publicada.</p>
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

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6">
            <div class="max-w-[1600px] mx-auto space-y-8">
                
                <!-- 1. FILTERS & TABS -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex bg-vtc-panel rounded-lg p-1 border border-vtc-border">
                        <button class="px-4 py-2 rounded-md bg-vtc-border text-white text-xs font-bold shadow-sm transition-all">Distancia (km)</button>
                        <button class="px-4 py-2 rounded-md text-gray-400 hover:text-white text-xs font-medium transition-all">Ingresos (€)</button>
                        <button class="px-4 py-2 rounded-md text-gray-400 hover:text-white text-xs font-medium transition-all">Cargas</button>
                    </div>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Periodo:</span>
                        <select class="bg-vtc-panel border border-vtc-border rounded px-2 py-1 text-white outline-none focus:border-vtc-main">
                            <option>Noviembre 2024</option>
                            <option>Octubre 2024</option>
                            <option>Año 2024</option>
                        </select>
                    </div>
                </div>

                <!-- 2. TOP 3 PODIUM -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end mb-8">
                    
                    <!-- 2nd Place -->
                    <div class="order-2 md:order-1 hub-card podium-card rank-2 p-6 flex flex-col items-center text-center relative">
                        <div class="absolute top-0 left-0 bg-vtc-silver/20 text-vtc-silver px-3 py-1 rounded-br-lg text-xs font-bold border-b border-r border-vtc-silver/30">#2</div>
                        <div class="w-20 h-20 rounded-full p-1 border-2 border-vtc-silver mb-4 relative">
                            <img src="https://ui-avatars.com/api/?name=Juan+P&background=random" class="w-full h-full rounded-full">
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-vtc-silver text-black text-[10px] font-bold px-2 py-0.5 rounded-full">PLATA</div>
                        </div>
                        <h3 class="text-lg font-bold text-white">Juan P.</h3>
                        <p class="text-xs text-gray-500 mb-3">Maestro Camionero</p>
                        <div class="w-full bg-vtc-dark/50 rounded p-2 border border-vtc-border">
                            <p class="text-xl font-mono font-bold text-vtc-silver">38,200 km</p>
                            <p class="text-[10px] text-gray-500">42 Viajes</p>
                        </div>
                    </div>

                    <!-- 1st Place (Highlighted) -->
                    <div class="order-1 md:order-2 hub-card podium-card rank-1 p-8 flex flex-col items-center text-center relative transform md:-translate-y-4 z-10 bg-[#1a1d23] border-vtc-gold/30">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                             <i data-lucide="crown" class="w-10 h-10 text-vtc-gold fill-current"></i>
                        </div>
                        <div class="w-24 h-24 rounded-full p-1 border-4 border-vtc-gold mb-4 relative shadow-[0_0_20px_rgba(234,179,8,0.3)]">
                            <img src="https://ui-avatars.com/api/?name=Marta+G&background=random" class="w-full h-full rounded-full">
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-vtc-gold text-black text-xs font-bold px-3 py-0.5 rounded-full">ORO</div>
                        </div>
                        <h3 class="text-xl font-bold text-white">Marta G.</h3>
                        <p class="text-sm text-gray-400 mb-4">Leyenda del Asfalto</p>
                        <div class="w-full bg-vtc-dark/50 rounded p-3 border border-vtc-border">
                            <p class="text-2xl font-mono font-bold text-vtc-gold">42,500 km</p>
                            <p class="text-xs text-gray-500">58 Viajes</p>
                        </div>
                    </div>

                    <!-- 3rd Place -->
                    <div class="order-3 hub-card podium-card rank-3 p-6 flex flex-col items-center text-center relative">
                        <div class="absolute top-0 right-0 bg-vtc-bronze/20 text-vtc-bronze px-3 py-1 rounded-bl-lg text-xs font-bold border-b border-l border-vtc-bronze/30">#3</div>
                         <div class="w-20 h-20 rounded-full p-1 border-2 border-vtc-bronze mb-4 relative">
                            <img src="https://ui-avatars.com/api/?name=Pedro+S&background=random" class="w-full h-full rounded-full">
                             <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-vtc-bronze text-black text-[10px] font-bold px-2 py-0.5 rounded-full">BRONCE</div>
                        </div>
                        <h3 class="text-lg font-bold text-white">Pedro S.</h3>
                        <p class="text-xs text-gray-500 mb-3">Veterano</p>
                        <div class="w-full bg-vtc-dark/50 rounded p-2 border border-vtc-border">
                            <p class="text-xl font-mono font-bold text-vtc-bronze">31,000 km</p>
                            <p class="text-[10px] text-gray-500">35 Viajes</p>
                        </div>
                    </div>
                </div>

                <!-- 3. FULL RANKING TABLE -->
                <div class="hub-card overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-vtc-border bg-vtc-panel flex justify-between items-center">
                        <h3 class="text-sm font-bold text-white">Tabla General</h3>
                        <div class="relative">
                             <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                             <input type="text" placeholder="Buscar conductor..." class="bg-vtc-dark border border-vtc-border rounded pl-9 pr-3 py-1.5 text-xs text-white outline-none focus:border-vtc-main">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs text-gray-500 uppercase bg-[#13161a] border-b border-vtc-border font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 text-center w-16">#</th>
                                    <th class="px-6 py-4">Conductor</th>
                                    <th class="px-6 py-4">Rango</th>
                                    <th class="px-6 py-4 text-right">Distancia</th>
                                    <th class="px-6 py-4 text-right">Trabajos</th>
                                    <th class="px-6 py-4 text-right">Media / Viaje</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-vtc-border">
                                <!-- Row 4 -->
                                <tr class="hover:bg-vtc-border/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-gray-500">4</td>
                                    <td class="px-6 py-4 flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Luisa+M&background=random" class="w-8 h-8 rounded bg-vtc-panel">
                                        <span class="font-bold text-white">Luisa M.</span>
                                    </td>
                                    <td class="px-6 py-4"><span class="text-xs bg-vtc-dark px-2 py-1 rounded border border-vtc-border text-gray-400">Oficial</span></td>
                                    <td class="px-6 py-4 text-right font-mono text-white">28,450 km</td>
                                    <td class="px-6 py-4 text-right font-mono">30</td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-500">948 km</td>
                                </tr>
                                
                                <!-- ... Rows 5 to 11 skipped for brevity ... -->
                                <tr class="hover:bg-vtc-border/30 transition-colors">
                                     <td class="px-6 py-4 text-center font-bold text-gray-500">...</td>
                                     <td colspan="5" class="px-6 py-4 text-center text-xs text-gray-600">...</td>
                                </tr>

                                <!-- Row 12 (YOU) - Highlighted -->
                                <tr class="bg-vtc-main/10 border-l-4 border-l-vtc-main hover:bg-vtc-main/20 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-vtc-main">12</td>
                                    <td class="px-6 py-4 flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Alex+Driver&background=1350C2&color=fff" class="w-8 h-8 rounded border border-vtc-main/50">
                                        <div>
                                            <span class="font-bold text-white">Alex Driver (Tú)</span>
                                            <span class="text-[10px] block text-blue-400 font-bold uppercase">Subiendo 🔥</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4"><span class="text-xs bg-vtc-main/20 px-2 py-1 rounded border border-vtc-main/30 text-blue-300">Oficial de 1ª</span></td>
                                    <td class="px-6 py-4 text-right font-mono text-white font-bold">12,450 km</td>
                                    <td class="px-6 py-4 text-right font-mono text-white">28</td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-400">444 km</td>
                                </tr>

                                <!-- Row 13 -->
                                <tr class="hover:bg-vtc-border/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-gray-500">13</td>
                                    <td class="px-6 py-4 flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Carlos+R&background=random" class="w-8 h-8 rounded bg-vtc-panel">
                                        <span class="font-bold text-gray-400">Carlos R.</span>
                                    </td>
                                    <td class="px-6 py-4"><span class="text-xs bg-vtc-dark px-2 py-1 rounded border border-vtc-border text-gray-400">Novato</span></td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-400">11,200 km</td>
                                    <td class="px-6 py-4 text-right font-mono">15</td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-500">746 km</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="p-4 border-t border-vtc-border bg-vtc-panel flex items-center justify-center">
                        <button class="text-xs text-vtc-main font-bold hover:text-white transition-colors">Ver Ranking Completo</button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>