<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado Empresa - Logística Norte VTC</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

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
                    <a href="#" class="nav-item active">
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
                    <i data-lucide="bar-chart-3" class="w-5 h-5 text-blue-400"></i>
                    <h1 class="text-base font-bold text-white uppercase tracking-wide">Panel de Administración</h1>
                </div>
            </div>

             <!-- Right Actions -->
             <div class="flex items-center gap-5">
                
                 <!-- Botón Rápido Staff -->
                 <button class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white rounded text-xs font-bold transition-colors">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    <span>Configuración VTC</span>
                </button>

                <div class="h-5 w-px bg-vtc-border hidden md:block"></div>

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
                                <p class="text-xs font-bold text-white mb-1">Solicitud de Ingreso</p>
                                <p class="text-[11px] text-gray-400">Usuario "TruckerX" ha solicitado unirse.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-5 w-px bg-vtc-border"></div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-white">Admin User</p>
                        <p class="text-xs text-gray-500">Gerente General</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=1350C2&color=fff" class="w-8 h-8 rounded bg-vtc-border">
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-8">
            <div class="max-w-[1600px] mx-auto space-y-8">
                
                <!-- 1. FINANCIAL & OPERATIONAL OVERVIEW -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Balance -->
                    <div class="hub-card p-5 border-l-4 border-l-green-500">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Balance Total</p>
                                <h3 class="text-2xl font-bold text-white mt-1 font-mono">€ 14,250,400</h3>
                            </div>
                            <div class="p-2 bg-green-500/10 rounded-lg text-green-500">
                                <i data-lucide="dollar-sign" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <p class="text-xs text-green-400 flex items-center gap-1">
                            <i data-lucide="arrow-up-right" class="w-3 h-3"></i> +2.4% esta semana
                        </p>
                    </div>

                    <!-- Conductores -->
                    <div class="hub-card p-5 border-l-4 border-l-blue-500">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Plantilla</p>
                                <h3 class="text-2xl font-bold text-white mt-1 font-mono">32 <span class="text-sm text-gray-500 font-sans">/ 50</span></h3>
                            </div>
                            <div class="p-2 bg-blue-500/10 rounded-lg text-blue-500">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">3 solicitudes pendientes</p>
                    </div>

                    <!-- CAMBIO AQUÍ: Flota -> Trabajos Realizados -->
                    <div class="hub-card p-5 border-l-4 border-l-purple-500">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Trabajos Realizados</p>
                                <h3 class="text-2xl font-bold text-white mt-1 font-mono">1,248</h3>
                            </div>
                            <div class="p-2 bg-purple-500/10 rounded-lg text-purple-500">
                                <i data-lucide="briefcase" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <span class="text-[10px] bg-green-900/30 text-green-400 px-1.5 rounded border border-green-900/50">+56 Hoy</span>
                            <span class="text-[10px] bg-blue-900/30 text-blue-400 px-1.5 rounded border border-blue-900/50">+320 Mes</span>
                        </div>
                    </div>

                    <!-- Score/Reputación -->
                    <div class="hub-card p-5 border-l-4 border-l-yellow-500">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Reputación VTC</p>
                                <h3 class="text-2xl font-bold text-white mt-1 font-mono">98.5%</h3>
                            </div>
                            <div class="p-2 bg-yellow-500/10 rounded-lg text-yellow-500">
                                <i data-lucide="star" class="w-5 h-5"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">Basado en validación de rutas</p>
                    </div>
                </div>

                <!-- 2. MAIN CHARTS SECTION -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Financial Chart (2/3 width) -->
                    <div class="lg:col-span-2 hub-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                                <i data-lucide="trending-up" class="w-4 h-4 text-vtc-main"></i>
                                Flujo de Caja (Últimos 6 Meses)
                            </h3>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 text-xs font-medium bg-vtc-main text-white rounded">Ingresos</button>
                                <button class="px-3 py-1 text-xs font-medium text-gray-400 hover:text-white hover:bg-vtc-border rounded transition-colors">Gastos</button>
                            </div>
                        </div>
                        <div class="h-[300px] w-full">
                            <canvas id="financeChart"></canvas>
                        </div>
                    </div>

                    <!-- CAMBIO AQUÍ: Actividad de Conductores -->
                    <div class="hub-card p-6 flex flex-col">
                        <h3 class="text-sm font-bold text-white mb-6 flex items-center gap-2">
                            <i data-lucide="activity" class="w-4 h-4 text-purple-500"></i>
                            Actividad Actual (Conductores)
                        </h3>
                        <div class="relative flex-1 flex items-center justify-center">
                            <canvas id="fleetChart"></canvas>
                            <!-- Center Text -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span class="text-2xl font-bold text-white">32</span>
                                <span class="text-[10px] text-gray-500 uppercase">Total</span>
                            </div>
                        </div>
                        <div class="mt-6 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-green-500"></span> Conduciendo (En Ruta)</span>
                                <span class="text-white font-mono">12</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Libres (Online)</span>
                                <span class="text-white font-mono">8</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-400 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-gray-600"></span> Offline</span>
                                <span class="text-white font-mono">12</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. GOALS & RECENT ACTIONS -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <!-- Metas de Empresa -->
                    <div class="hub-card p-6">
                        <h3 class="text-sm font-bold text-white mb-6 flex items-center justify-between">
                            <span class="flex items-center gap-2"><i data-lucide="target" class="w-4 h-4 text-red-500"></i> Objetivos Mensuales</span>
                            <span class="text-[10px] text-gray-500 uppercase">Noviembre</span>
                        </h3>
                        
                        <div class="space-y-6">
                            <!-- Goal 1 -->
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-white font-medium">Distancia Total (1M km)</span>
                                    <span class="text-blue-400 font-bold">85%</span>
                                </div>
                                <div class="w-full bg-[#13161a] h-2 rounded-full overflow-hidden border border-vtc-border">
                                    <div class="bg-blue-500 h-full w-[85%] shadow-[0_0_10px_rgba(59,130,246,0.5)]"></div>
                                </div>
                                <p class="text-[10px] text-gray-500 mt-1 text-right">Faltan 150,000 km</p>
                            </div>

                            <!-- Goal 2 -->
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-white font-medium">Beneficio Neto (€ 500k)</span>
                                    <span class="text-green-400 font-bold">62%</span>
                                </div>
                                <div class="w-full bg-[#13161a] h-2 rounded-full overflow-hidden border border-vtc-border">
                                    <div class="bg-green-500 h-full w-[62%] shadow-[0_0_10px_rgba(34,197,94,0.5)]"></div>
                                </div>
                                <p class="text-[10px] text-gray-500 mt-1 text-right">Faltan € 190,000</p>
                            </div>

                            <!-- Goal 3 -->
                            <div>
                                <div class="flex justify-between text-xs mb-2">
                                    <span class="text-white font-medium">Reclutamiento (5 nuevos)</span>
                                    <span class="text-yellow-500 font-bold">100%</span>
                                </div>
                                <div class="w-full bg-[#13161a] h-2 rounded-full overflow-hidden border border-vtc-border">
                                    <div class="bg-yellow-500 h-full w-full shadow-[0_0_10px_rgba(234,179,8,0.5)]"></div>
                                </div>
                                <p class="text-[10px] text-green-500 mt-1 text-right flex items-center justify-end gap-1"><i data-lucide="check" class="w-3 h-3"></i> Completado</p>
                            </div>
                        </div>
                    </div>

                    <!-- Log de Acciones Staff -->
                    <div class="hub-card p-0 overflow-hidden flex flex-col">
                        <div class="p-4 border-b border-vtc-border bg-[#1a1d23] flex justify-between items-center">
                            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                                <i data-lucide="clipboard-list" class="w-4 h-4 text-gray-400"></i>
                                Actividad Reciente
                            </h3>
                            <button class="text-[10px] text-blue-400 hover:underline">Ver Log Completo</button>
                        </div>
                        <div class="flex-1 overflow-y-auto p-0">
                            <table class="w-full text-xs text-left text-gray-400">
                                <tbody class="divide-y divide-vtc-border">
                                    <tr class="hover:bg-vtc-border/30 transition-colors">
                                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">Hace 2h</td>
                                        <td class="px-4 py-3 text-white"><strong>Admin User</strong> publicó un anuncio.</td>
                                        <td class="px-4 py-3 text-right"><span class="px-1.5 py-0.5 rounded bg-blue-900/30 text-blue-400 border border-blue-900/50">Anuncio</span></td>
                                    </tr>
                                    <tr class="hover:bg-vtc-border/30 transition-colors">
                                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">Hace 5h</td>
                                        <td class="px-4 py-3 text-white"><strong>Admin User</strong> aceptó a <strong>Trucker88</strong>.</td>
                                        <td class="px-4 py-3 text-right"><span class="px-1.5 py-0.5 rounded bg-green-900/30 text-green-400 border border-green-900/50">RRHH</span></td>
                                    </tr>
                                    <tr class="hover:bg-vtc-border/30 transition-colors">
                                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">Ayer</td>
                                        <td class="px-4 py-3 text-white">Sistema: Mantenimiento semanal completado.</td>
                                        <td class="px-4 py-3 text-right"><span class="px-1.5 py-0.5 rounded bg-gray-700 text-gray-300 border border-gray-600">Sistema</span></td>
                                    </tr>
                                     <tr class="hover:bg-vtc-border/30 transition-colors">
                                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">Ayer</td>
                                        <td class="px-4 py-3 text-white"><strong>Staff 2</strong> validó 15 viajes pendientes.</td>
                                        <td class="px-4 py-3 text-right"><span class="px-1.5 py-0.5 rounded bg-purple-900/30 text-purple-400 border border-purple-900/50">Logbook</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        // 1. Finance Chart (Area Chart)
        const ctxFinance = document.getElementById('financeChart').getContext('2d');
        const gradientFinance = ctxFinance.createLinearGradient(0, 0, 0, 300);
        gradientFinance.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); // Green
        gradientFinance.addColorStop(1, 'rgba(16, 185, 129, 0)');

        new Chart(ctxFinance, {
            type: 'line',
            data: {
                labels: ['Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov'],
                datasets: [{
                    label: 'Ingresos (€)',
                    data: [42000, 45000, 41000, 52000, 49000, 58000],
                    borderColor: '#10b981',
                    backgroundColor: gradientFinance,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#181b21',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#2a2e35' },
                        ticks: { color: '#6b7280' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280' }
                    }
                }
            }
        });

        // 2. Drivers Activity Chart (Doughnut)
        const ctxFleet = document.getElementById('fleetChart').getContext('2d');
        new Chart(ctxFleet, {
            type: 'doughnut',
            data: {
                labels: ['En Ruta', 'Libres (Online)', 'Offline'],
                datasets: [{
                    data: [12, 8, 12], // Total 32
                    backgroundColor: [
                        '#10b981', // Green
                        '#3b82f6', // Blue
                        '#4b5563'  // Gray
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>