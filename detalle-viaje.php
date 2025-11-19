<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Viaje #4829 - Logística Norte VTC</title>
    
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

        /* Timeline Connector */
        .timeline-line {
            position: absolute;
            left: 1.25rem; /* 20px aprox, mitad del icono */
            top: 2rem;
            bottom: 0;
            width: 2px;
            background-color: #2a2e35;
            z-index: 0;
        }

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
                    <a href="#" class="nav-item active">
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
        
        <!-- Header & Breadcrumbs -->
        <header class="h-16 flex items-center justify-between px-6 border-b border-vtc-border bg-vtc-panel sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-400 hover:text-white"><i data-lucide="menu" class="w-6 h-6"></i></button>
                <div class="flex items-center gap-2 text-sm">
                    <a href="#" class="text-gray-500 hover:text-gray-300 transition-colors">Bitácora</a>
                    <span class="text-gray-600">/</span>
                    <span class="text-white font-bold flex items-center gap-2">
                        Viaje #4829
                        <span class="px-2 py-0.5 rounded bg-green-900/30 text-green-400 border border-green-900/50 text-[10px] uppercase tracking-wider">Aprobado</span>
                    </span>
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

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6">
            <div class="max-w-[1600px] mx-auto space-y-6">

                <!-- 1. RESUMEN VISUAL (MAPA + RUTA) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Mapa (Izquierda) -->
                    <div class="lg:col-span-2 hub-card h-64 relative overflow-hidden group">
                        <!-- Imagen de Mapa Placeholder (Estilo Oscuro) -->
                        <div class="absolute inset-0 bg-[#0f1115] flex items-center justify-center">
                             <div style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Openstreetmap_logo.svg/1024px-Openstreetmap_logo.svg.png'); background-size: cover; filter: grayscale(100%) invert(90%) opacity(0.3);" class="w-full h-full absolute inset-0"></div>
                             <div class="z-10 flex flex-col items-center">
                                <i data-lucide="map-pin" class="w-8 h-8 text-vtc-main mb-2 animate-bounce"></i>
                                <span class="text-xs text-gray-500">Visualización de Ruta GPS</span>
                             </div>
                        </div>
                        <!-- Overlay Info -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 to-transparent p-6 flex justify-between items-end">
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Conductor</p>
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Alex+Driver&background=1350C2&color=fff" class="w-8 h-8 rounded border border-vtc-border">
                                    <span class="text-white font-bold">Alex Driver</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Vehículo</p>
                                <p class="text-white font-bold font-mono">Scania S730 V8</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Ruta (Derecha) -->
                    <div class="hub-card p-6 relative">
                        <h3 class="text-sm font-bold text-white mb-6 flex items-center gap-2">
                            <i data-lucide="navigation" class="w-4 h-4 text-vtc-main"></i>
                            Itinerario
                        </h3>
                        
                        <div class="relative pl-2">
                            <div class="timeline-line"></div>
                            
                            <!-- Origen -->
                            <div class="relative flex gap-4 mb-8 z-10">
                                <div class="w-10 h-10 rounded-full bg-[#13161a] border-2 border-vtc-border flex items-center justify-center shrink-0">
                                    <span class="text-xs font-bold text-gray-400">A</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Origen</p>
                                    <h4 class="text-lg font-bold text-white">Madrid, ES</h4>
                                    <p class="text-xs text-gray-400 font-mono mt-0.5">Empresa: Tradeaux</p>
                                    <p class="text-[10px] text-gray-600 mt-1">18 Nov, 14:30</p>
                                </div>
                            </div>

                            <!-- Destino -->
                            <div class="relative flex gap-4 z-10">
                                <div class="w-10 h-10 rounded-full bg-vtc-main border-2 border-blue-400 flex items-center justify-center shrink-0 shadow-[0_0_10px_rgba(19,80,194,0.5)]">
                                    <span class="text-xs font-bold text-white">B</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Destino</p>
                                    <h4 class="text-lg font-bold text-white">Lisboa, PT</h4>
                                    <p class="text-xs text-gray-400 font-mono mt-0.5">Empresa: Logística Atlántica</p>
                                    <p class="text-[10px] text-gray-600 mt-1">18 Nov, 19:45</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-vtc-border grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase">Tiempo Cond.</p>
                                <p class="text-sm font-mono text-white">5h 15m</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase">Distancia</p>
                                <p class="text-sm font-mono text-white">642 km</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. ESTADÍSTICAS TÉCNICAS (3 COLUMNAS) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Card: Carga y Daños -->
                    <div class="hub-card p-5">
                        <h3 class="text-xs font-bold text-gray-500 uppercase mb-4 tracking-wider">Detalles de Carga</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Mercancía</span>
                                <span class="text-sm text-white font-medium">Componentes Electrónicos</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Peso</span>
                                <span class="text-sm text-white font-mono">12,450 kg</span>
                            </div>
                            <div class="h-px bg-vtc-border"></div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Daño Carga</span>
                                <span class="text-sm text-green-400 font-bold font-mono">0%</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Daño Camión</span>
                                <span class="text-sm text-yellow-500 font-bold font-mono">2%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Economía -->
                    <div class="hub-card p-5">
                        <h3 class="text-xs font-bold text-gray-500 uppercase mb-4 tracking-wider">Balance Económico</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Ingreso Base</span>
                                <span class="text-sm text-white font-mono">€ 9,200</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Bono Distancia</span>
                                <span class="text-sm text-green-400 font-mono">+ € 450</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Gastos (Fuel/Peaje)</span>
                                <span class="text-sm text-red-400 font-mono">- € 1,200</span>
                            </div>
                            <div class="h-px bg-vtc-border my-2"></div>
                            <div class="flex justify-between items-center pt-1">
                                <span class="text-sm font-bold text-white">Beneficio Neto</span>
                                <span class="text-lg text-green-400 font-bold font-mono">€ 8,450</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Validación -->
                    <div class="hub-card p-5 flex flex-col">
                        <h3 class="text-xs font-bold text-gray-500 uppercase mb-4 tracking-wider">Validación VTC</h3>
                        
                        <!-- Estado Principal -->
                        <div class="flex-1 flex flex-col items-center justify-center mb-4">
                            <div class="w-16 h-16 rounded-full bg-green-900/20 border-2 border-green-500/30 flex items-center justify-center mb-2">
                                <i data-lucide="check" class="w-8 h-8 text-green-500"></i>
                            </div>
                            <p class="text-lg font-bold text-green-400">Modo Realista</p>
                            <p class="text-xs text-gray-500">Aprobado automáticamente</p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-center">
                            <div class="bg-[#13161a] p-2 rounded border border-vtc-border">
                                <p class="text-[10px] text-gray-500 uppercase">Max Vel</p>
                                <p class="text-sm font-mono text-white">89 km/h</p>
                            </div>
                            <div class="bg-[#13161a] p-2 rounded border border-vtc-border">
                                <p class="text-[10px] text-gray-500 uppercase">Consumo</p>
                                <p class="text-sm font-mono text-white">29.2 L</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. GRÁFICA DE TELEMETRÍA (VELOCIDAD) -->
                <div class="hub-card p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-white flex items-center gap-2">
                            <i data-lucide="activity" class="w-4 h-4 text-vtc-main"></i>
                            Registro de Velocidad
                        </h3>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="w-2 h-2 bg-red-500/50 rounded-full"></span> Límite Race (100 km/h)
                            <span class="w-2 h-2 bg-blue-500 rounded-full ml-2"></span> Velocidad Camión
                        </div>
                    </div>
                    <div class="h-[300px] w-full">
                        <canvas id="speedChart"></canvas>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <script>
        lucide.createIcons();

        // Configuración Gráfica de Velocidad
        const ctx = document.getElementById('speedChart').getContext('2d');
        
        // Gradiente para la línea de velocidad
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(19, 80, 194, 0.3)');
        gradient.addColorStop(1, 'rgba(19, 80, 194, 0)');

        // Generar datos falsos para la curva
        const labels = Array.from({length: 20}, (_, i) => i * 5 + ' min');
        const dataSpeed = [0, 30, 50, 80, 85, 88, 90, 85, 82, 60, 40, 65, 80, 89, 90, 90, 70, 50, 20, 0];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Velocidad (km/h)',
                        data: dataSpeed,
                        borderColor: '#1350C2',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Límite Race',
                        data: Array(20).fill(100),
                        borderColor: 'rgba(239, 68, 68, 0.5)', // Rojo
                        borderWidth: 1,
                        borderDash: [5, 5],
                        pointRadius: 0,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#181b21',
                        borderColor: '#2a2e35',
                        borderWidth: 1,
                        titleColor: '#fff',
                        bodyColor: '#ccc'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 120,
                        grid: { color: '#2a2e35' },
                        ticks: { color: '#6b7280', font: { family: 'JetBrains Mono' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280', maxTicksLimit: 10 }
                    }
                }
            }
        });
    </script>
</body>
</html>