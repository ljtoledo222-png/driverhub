<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Hub - Logística Norte VTC</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track { background: #0f1115; }
        ::-webkit-scrollbar-thumb { background: #2a2e35; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #1350C2; }

        body {
            background-color: #0f1115;
            color: #e2e8f0;
        }

        /* Estilo de tarjeta sólido y limpio */
        .hub-card {
            background-color: #181b21;
            border: 1px solid #2a2e35;
            border-radius: 0.5rem; /* rounded-lg, no xl */
        }
        
        /* Enlace del sidebar */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0.75rem;
            border-radius: 0.375rem; /* rounded-md */
            transition: all 0.2s;
            font-size: 0.875rem;
            color: #94a3b8;
        }
        
        .nav-item:hover {
            background-color: #2a2e35;
            color: white;
        }
        
        .nav-item.active {
            background-color: #1350C2;
            color: white;
        }

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
    <aside class="w-64 flex-shrink-0 flex flex-col border-r border-vtc-border bg-vtc-panel z-20">
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
                    <a href="#" class="nav-item active">
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

            <!-- ZONA STAFF (Admin/Gestión) -->
            <!-- Separador visual -->
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
            <!-- Left -->
            <div>
                <h1 class="text-base font-bold text-white">Dashboard</h1>
            </div>

            <!-- Right -->
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
                            <!-- Notificación Principal (Anuncio) -->
                            <div class="p-4 border-b border-vtc-border bg-blue-900/10 hover:bg-blue-900/20 transition-colors cursor-pointer group/item">
                                <div class="flex gap-3">
                                    <div class="mt-1 min-w-[1.5rem]">
                                        <i data-lucide="megaphone" class="w-4 h-4 text-blue-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-white mb-1 group-hover/item:text-blue-300 transition-colors">Convoy Navideño 2024</p>
                                        <p class="text-[11px] text-gray-400 leading-snug">Se ha publicado la ruta oficial. París -> Berlín este sábado a las 20:00 UTC.</p>
                                        <p class="text-[10px] text-gray-500 mt-2">Hace 2 horas</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Notificación Secundaria -->
                            <div class="p-4 hover:bg-vtc-border/20 transition-colors cursor-pointer">
                                <div class="flex gap-3">
                                    <div class="mt-1 min-w-[1.5rem]">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-300 mb-1">Entrega Aprobada</p>
                                        <p class="text-[11px] text-gray-500">Tu viaje desde Madrid (#9482) ha sido validado correctamente.</p>
                                        <p class="text-[10px] text-gray-600 mt-2">Ayer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 text-center bg-[#13161a] border-t border-vtc-border">
                            <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-white">Ver historial completo</a>
                        </div>
                    </div>
                </div>

                <div class="h-5 w-px bg-vtc-border"></div>

                <!-- User -->
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-white">Alex Driver</p>
                        <p class="text-xs text-gray-500">Oficial de 1ª</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Alex+Driver&background=1350C2&color=fff" class="w-8 h-8 rounded bg-vtc-border">
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <div class="max-w-6xl mx-auto space-y-6">
                
                <!-- 1. AVISO PRINCIPAL (Diseño más limpio) -->
                <div class="bg-[#1350C2]/10 border border-[#1350C2]/30 rounded-lg p-4 flex items-start gap-4">
                    <div class="p-2 bg-[#1350C2]/20 rounded text-blue-400 shrink-0">
                        <i data-lucide="info" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Convoy Navideño 2024</h3>
                        <p class="text-xs text-gray-300 mt-1 leading-relaxed">
                            El convoy oficial saldrá este sábado a las 20:00 UTC desde París. Recuerda tener el DLC de pintura navideña activado si es posible.
                        </p>
                    </div>
                    <button class="ml-auto text-xs text-blue-400 hover:text-white font-medium whitespace-nowrap">Ver Info</button>
                </div>

                <!-- 2. STATS (Con fuente técnica en números) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Stat 1 -->
                    <div class="hub-card p-4">
                        <div class="flex items-center gap-3 mb-2 text-gray-400">
                            <i data-lucide="gauge" class="w-4 h-4"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Kilómetros</span>
                        </div>
                        <p class="text-2xl font-bold text-white font-mono">12,450 <span class="text-sm text-gray-500">km</span></p>
                        <div class="mt-2 text-xs text-green-500 flex items-center gap-1">
                            <i data-lucide="trending-up" class="w-3 h-3"></i> +850 esta semana
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="hub-card p-4">
                        <div class="flex items-center gap-3 mb-2 text-gray-400">
                            <i data-lucide="wallet" class="w-4 h-4"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Ingresos</span>
                        </div>
                        <p class="text-2xl font-bold text-white font-mono">€ 342,100</p>
                        <div class="mt-2 text-xs text-gray-500">Total histórico</div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="hub-card p-4">
                        <div class="flex items-center gap-3 mb-2 text-gray-400">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Entregas</span>
                        </div>
                        <p class="text-2xl font-bold text-white font-mono">28</p>
                        <div class="mt-2 text-xs text-blue-400">98% Efectividad</div>
                    </div>

                    <!-- Stat 4 -->
                    <div class="hub-card p-4 relative overflow-hidden">
                        <div class="flex items-center gap-3 mb-2 text-gray-400">
                            <i data-lucide="star" class="w-4 h-4"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Rango</span>
                        </div>
                        <p class="text-lg font-bold text-white font-display uppercase text-blue-400">Oficial de 1ª</p>
                        <div class="w-full bg-vtc-border h-1.5 rounded-full mt-3">
                            <div class="bg-yellow-500 h-full w-[70%] rounded-full"></div>
                        </div>
                        <p class="text-[10px] text-gray-500 mt-1 text-right">300 XP para ascenso</p>
                    </div>
                </div>

                <!-- 3. CONTENT AREA -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Main Chart -->
                    <div class="lg:col-span-2 hub-card p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-white">Rendimiento Semanal</h3>
                            <select class="bg-vtc-dark border border-vtc-border text-xs text-gray-300 rounded px-2 py-1 outline-none focus:border-vtc-main">
                                <option>Kilómetros</option>
                                <option>Ingresos</option>
                            </select>
                        </div>
                        <div class="h-[250px] w-full">
                            <canvas id="driverChart"></canvas>
                        </div>
                    </div>

                    <!-- Mini Ranking -->
                    <div class="hub-card p-0 overflow-hidden flex flex-col">
                        <div class="p-4 border-b border-vtc-border bg-[#1a1d23]">
                            <h3 class="text-sm font-bold text-white flex items-center justify-between">
                                Top Conductores
                                <span class="text-[10px] bg-vtc-main text-white px-1.5 py-0.5 rounded">MES</span>
                            </h3>
                        </div>
                        <div class="flex-1 overflow-y-auto p-2 space-y-1">
                            
                            <!-- Driver 1 -->
                            <div class="flex items-center gap-3 p-2 rounded hover:bg-vtc-border/50 transition-colors">
                                <div class="w-6 text-center font-mono text-yellow-500 font-bold text-sm">1</div>
                                <img src="https://ui-avatars.com/api/?name=Marta+G&background=random" class="w-6 h-6 rounded">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-white truncate">Marta G.</p>
                                </div>
                                <span class="text-xs font-mono text-gray-400">42k</span>
                            </div>

                            <!-- Driver 2 -->
                            <div class="flex items-center gap-3 p-2 rounded hover:bg-vtc-border/50 transition-colors">
                                <div class="w-6 text-center font-mono text-gray-400 font-bold text-sm">2</div>
                                <img src="https://ui-avatars.com/api/?name=Juan+P&background=random" class="w-6 h-6 rounded">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-gray-300 truncate">Juan P.</p>
                                </div>
                                <span class="text-xs font-mono text-gray-500">38k</span>
                            </div>

                             <!-- Driver 3 -->
                             <div class="flex items-center gap-3 p-2 rounded hover:bg-vtc-border/50 transition-colors">
                                <div class="w-6 text-center font-mono text-orange-700 font-bold text-sm">3</div>
                                <img src="https://ui-avatars.com/api/?name=Pedro+S&background=random" class="w-6 h-6 rounded">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-gray-300 truncate">Pedro S.</p>
                                </div>
                                <span class="text-xs font-mono text-gray-500">31k</span>
                            </div>

                            <div class="my-2 border-t border-vtc-border"></div>

                            <!-- You -->
                            <div class="flex items-center gap-3 p-2 rounded bg-vtc-main/10 border border-vtc-main/20">
                                <div class="w-6 text-center font-mono text-blue-400 font-bold text-sm">12</div>
                                <img src="https://ui-avatars.com/api/?name=Alex+D&background=1350C2&color=fff" class="w-6 h-6 rounded">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-white truncate">Tú</p>
                                </div>
                                <span class="text-xs font-mono text-white">12.4k</span>
                            </div>

                        </div>
                        <div class="p-3 border-t border-vtc-border text-center">
                            <a href="#" class="text-xs text-blue-400 hover:text-white transition-colors">Ver Tabla Completa</a>
                        </div>
                    </div>
                </div>

                <!-- 4. BITÁCORA RECIENTE (Tabla técnica) -->
                <div class="hub-card overflow-hidden">
                    <div class="p-4 border-b border-vtc-border bg-[#1a1d23] flex justify-between items-center">
                        <h3 class="text-sm font-bold text-white">Mis Últimos Viajes</h3>
                        <button class="text-xs bg-vtc-dark border border-vtc-border hover:bg-vtc-border text-gray-300 px-3 py-1 rounded transition-colors">Ver Todo</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs text-gray-500 uppercase bg-vtc-dark border-b border-vtc-border">
                                <tr>
                                    <th class="px-4 py-3 font-medium w-32">Fecha</th>
                                    <th class="px-4 py-3 font-medium">Ruta</th>
                                    <th class="px-4 py-3 font-medium">Carga</th>
                                    <th class="px-4 py-3 font-medium text-right">Distancia</th>
                                    <th class="px-4 py-3 font-medium text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-vtc-border">
                                <tr class="hover:bg-vtc-border/30 transition-colors">
                                    <td class="px-4 py-3 font-mono text-xs">18 Nov 14:30</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2 text-gray-300 font-medium text-xs">
                                            <span>Madrid</span>
                                            <i data-lucide="arrow-right" class="w-3 h-3 text-gray-600"></i>
                                            <span>Lisboa</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs">Electrónica</td>
                                    <td class="px-4 py-3 font-mono text-xs text-right">640 km</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded bg-green-900/20 text-green-400 border border-green-900/30 text-[10px] font-bold uppercase">Válido</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-vtc-border/30 transition-colors">
                                    <td class="px-4 py-3 font-mono text-xs">17 Nov 20:15</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2 text-gray-300 font-medium text-xs">
                                            <span>Barcelona</span>
                                            <i data-lucide="arrow-right" class="w-3 h-3 text-gray-600"></i>
                                            <span>Montpellier</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs">Fruta</td>
                                    <td class="px-4 py-3 font-mono text-xs text-right">340 km</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded bg-green-900/20 text-green-400 border border-green-900/30 text-[10px] font-bold uppercase">Válido</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-vtc-border/30 transition-colors">
                                    <td class="px-4 py-3 font-mono text-xs">16 Nov 10:00</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2 text-gray-300 font-medium text-xs">
                                            <span>Berlin</span>
                                            <i data-lucide="arrow-right" class="w-3 h-3 text-gray-600"></i>
                                            <span>Dresden</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs">Maquinaria</td>
                                    <td class="px-4 py-3 font-mono text-xs text-right">180 km</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded bg-orange-900/20 text-orange-400 border border-orange-900/30 text-[10px] font-bold uppercase">Race</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <script>
        lucide.createIcons();

        // Chart Config (Simple y directo)
        const ctx = document.getElementById('driverChart').getContext('2d');
        
        // Gradiente simple
        const gradient = ctx.createLinearGradient(0, 0, 0, 250);
        gradient.addColorStop(0, 'rgba(19, 80, 194, 0.4)');
        gradient.addColorStop(1, 'rgba(19, 80, 194, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'],
                datasets: [{
                    label: 'Kilómetros',
                    data: [150, 400, 250, 50, 850, 1100, 600],
                    borderColor: '#1350C2',
                    borderWidth: 2,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.3, // Curva ligera
                    pointBackgroundColor: '#181b21',
                    pointBorderColor: '#1350C2',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#181b21',
                        borderColor: '#2a2e35',
                        borderWidth: 1,
                        titleColor: '#fff',
                        bodyColor: '#ccc',
                        padding: 10,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#2a2e35' },
                        ticks: { color: '#6b7280', font: { family: 'JetBrains Mono', size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280', font: { size: 11 } }
                    }
                }
            }
        });
    </script>
</body>
</html>