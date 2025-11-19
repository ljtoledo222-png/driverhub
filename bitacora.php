<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácora - Logística Norte VTC</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

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

        /* Estilo de tarjeta sólido */
        .hub-card {
            background-color: #181b21;
            border: 1px solid #2a2e35;
            border-radius: 0.5rem;
        }

        /* Enlace del sidebar */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0.75rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
            font-size: 0.875rem;
            color: #94a3b8;
        }
        
        .nav-item:hover {
            background-color: #2a2e35;
            color: white;
        }
        
        /* Estado Activo */
        .nav-item.active {
            background-color: #1350C2;
            color: white;
        }

        /* Status Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.125rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-width: 1px;
        }
        .badge-real { background: rgba(16, 185, 129, 0.1); color: #34d399; border-color: rgba(16, 185, 129, 0.2); }
        .badge-race { background: rgba(245, 158, 11, 0.1); color: #fbbf24; border-color: rgba(245, 158, 11, 0.2); }
        .badge-rejected { background: rgba(239, 68, 68, 0.1); color: #f87171; border-color: rgba(239, 68, 68, 0.2); }
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
        
        <!-- Header -->
        <header class="h-16 flex items-center justify-between px-6 border-b border-vtc-border bg-vtc-panel sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-gray-400 hover:text-white"><i data-lucide="menu" class="w-6 h-6"></i></button>
                <h1 class="text-base font-bold text-white flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4 text-vtc-main"></i>
                    Historial de Viajes
                </h1>
            </div>

            <div class="flex items-center gap-5">
                <div class="relative cursor-pointer text-gray-400 hover:text-white">
                    <i data-lucide="bell" class="w-5 h-5"></i>
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
            <div class="max-w-[1600px] mx-auto space-y-6">
                
                <!-- 1. FILTERS TOOLBAR -->
                <div class="hub-card p-4 flex flex-col md:flex-row gap-4 justify-between items-center bg-[#1a1d23]">
                    
                    <!-- Left: Search & Date -->
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="relative group w-full sm:w-64">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-vtc-main transition-colors">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </div>
                            <input type="text" placeholder="Buscar por ciudad, carga..." class="w-full bg-vtc-dark border border-vtc-border text-sm text-gray-200 rounded pl-9 pr-3 py-2 outline-none focus:border-vtc-main transition-colors placeholder-gray-600">
                        </div>

                        <div class="flex items-center bg-vtc-dark border border-vtc-border rounded px-3 py-2 text-sm text-gray-400">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                            <span>Noviembre 2024</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 ml-2 cursor-pointer hover:text-white"></i>
                        </div>
                    </div>

                    <!-- Right: Filters & Export -->
                    <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                        <div class="flex bg-vtc-dark rounded border border-vtc-border p-0.5">
                            <button class="px-3 py-1.5 text-xs font-medium bg-vtc-border text-white rounded shadow-sm">Todos</button>
                            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 hover:text-gray-300">Real</button>
                            <button class="px-3 py-1.5 text-xs font-medium text-gray-500 hover:text-gray-300">Race</button>
                        </div>
                        <div class="h-6 w-px bg-vtc-border"></div>
                        <button class="flex items-center gap-2 text-xs font-bold text-vtc-main hover:text-blue-400 transition-colors">
                            <i data-lucide="download" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Exportar CSV</span>
                        </button>
                    </div>
                </div>

                <!-- 2. LOGBOOK TABLE -->
                <div class="hub-card overflow-hidden flex flex-col">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 uppercase bg-[#13161a] border-b border-vtc-border font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 w-16 text-center">#</th>
                                    <th class="px-6 py-4">Estado</th>
                                    <th class="px-6 py-4">Fecha / Hora</th>
                                    <th class="px-6 py-4">Ruta</th>
                                    <th class="px-6 py-4">Camión / Carga</th>
                                    <th class="px-6 py-4 text-right">Distancia</th>
                                    <th class="px-6 py-4 text-right">Ingreso</th>
                                    <th class="px-6 py-4 text-center">Detalles</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-vtc-border text-gray-300">
                                
                                <!-- Row 1: Valid -->
                                <tr class="group hover:bg-[#20242b] transition-colors">
                                    <td class="px-6 py-4 text-center text-gray-600 font-mono text-xs">4829</td>
                                    <td class="px-6 py-4">
                                        <span class="badge badge-real gap-1">
                                            <i data-lucide="check" class="w-3 h-3"></i> Real
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white">18 Nov</span>
                                            <span class="text-xs text-gray-500 font-mono">14:30 UTC</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col items-end">
                                                <span class="text-white font-medium">Madrid</span>
                                                <span class="text-[10px] text-gray-500 uppercase">ES</span>
                                            </div>
                                            <i data-lucide="arrow-right" class="w-4 h-4 text-gray-600"></i>
                                            <div class="flex flex-col">
                                                <span class="text-white font-medium">Lisboa</span>
                                                <span class="text-[10px] text-gray-500 uppercase">PT</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-400 mb-0.5">Scania S730</span>
                                            <span class="text-sm text-white font-medium">Electrónica <span class="text-gray-500 text-xs">(12t)</span></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-300">640 km</td>
                                    <td class="px-6 py-4 text-right font-mono text-green-400 font-bold">€ 8,450</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 hover:bg-vtc-border rounded-full text-gray-500 hover:text-white transition-colors">
                                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Row 2: Race -->
                                <tr class="group hover:bg-[#20242b] transition-colors">
                                    <td class="px-6 py-4 text-center text-gray-600 font-mono text-xs">4828</td>
                                    <td class="px-6 py-4">
                                        <span class="badge badge-race gap-1">
                                            <i data-lucide="zap" class="w-3 h-3"></i> Race
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white">17 Nov</span>
                                            <span class="text-xs text-gray-500 font-mono">20:15 UTC</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col items-end">
                                                <span class="text-white font-medium">Berlin</span>
                                                <span class="text-[10px] text-gray-500 uppercase">DE</span>
                                            </div>
                                            <i data-lucide="arrow-right" class="w-4 h-4 text-gray-600"></i>
                                            <div class="flex flex-col">
                                                <span class="text-white font-medium">Dresden</span>
                                                <span class="text-[10px] text-gray-500 uppercase">DE</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-400 mb-0.5">Volvo FH16</span>
                                            <span class="text-sm text-white font-medium">Madera <span class="text-gray-500 text-xs">(22t)</span></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-300">180 km</td>
                                    <td class="px-6 py-4 text-right font-mono text-yellow-500 font-bold">€ 2,100</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 hover:bg-vtc-border rounded-full text-gray-500 hover:text-white transition-colors">
                                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Row 3: Rejected/Damaged -->
                                <tr class="group hover:bg-[#20242b] transition-colors border-l-2 border-l-red-500/50">
                                    <td class="px-6 py-4 text-center text-gray-600 font-mono text-xs">4827</td>
                                    <td class="px-6 py-4">
                                        <span class="badge badge-rejected gap-1">
                                            <i data-lucide="x-circle" class="w-3 h-3"></i> Dañado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white">16 Nov</span>
                                            <span class="text-xs text-gray-500 font-mono">10:00 UTC</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col items-end">
                                                <span class="text-white font-medium">Paris</span>
                                                <span class="text-[10px] text-gray-500 uppercase">FR</span>
                                            </div>
                                            <i data-lucide="arrow-right" class="w-4 h-4 text-gray-600"></i>
                                            <div class="flex flex-col">
                                                <span class="text-white font-medium">Calais</span>
                                                <span class="text-[10px] text-gray-500 uppercase">FR</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-400 mb-0.5">Renault T</span>
                                            <span class="text-sm text-white font-medium">Vacunas <span class="text-gray-500 text-xs">(5t)</span></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-300">290 km</td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-500 line-through">€ 3,200</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 hover:bg-vtc-border rounded-full text-gray-500 hover:text-white transition-colors">
                                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>

                                 <!-- Row 4: Valid -->
                                 <tr class="group hover:bg-[#20242b] transition-colors">
                                    <td class="px-6 py-4 text-center text-gray-600 font-mono text-xs">4826</td>
                                    <td class="px-6 py-4">
                                        <span class="badge badge-real gap-1">
                                            <i data-lucide="check" class="w-3 h-3"></i> Real
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white">15 Nov</span>
                                            <span class="text-xs text-gray-500 font-mono">18:45 UTC</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col items-end">
                                                <span class="text-white font-medium">Lyon</span>
                                                <span class="text-[10px] text-gray-500 uppercase">FR</span>
                                            </div>
                                            <i data-lucide="arrow-right" class="w-4 h-4 text-gray-600"></i>
                                            <div class="flex flex-col">
                                                <span class="text-white font-medium">Turin</span>
                                                <span class="text-[10px] text-gray-500 uppercase">IT</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-400 mb-0.5">MAN TGX</span>
                                            <span class="text-sm text-white font-medium">Automóviles <span class="text-gray-500 text-xs">(18t)</span></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-gray-300">310 km</td>
                                    <td class="px-6 py-4 text-right font-mono text-green-400 font-bold">€ 4,150</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="p-2 hover:bg-vtc-border rounded-full text-gray-500 hover:text-white transition-colors">
                                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="p-4 border-t border-vtc-border bg-[#13161a] flex items-center justify-between">
                        <span class="text-xs text-gray-500">Mostrando <span class="text-white font-bold">1-4</span> de <span class="text-white font-bold">128</span> viajes</span>
                        
                        <div class="flex items-center gap-1">
                            <button class="p-1.5 rounded border border-vtc-border text-gray-500 hover:bg-vtc-border hover:text-white disabled:opacity-50" disabled>
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </button>
                            <button class="px-3 py-1 rounded border border-vtc-main bg-vtc-main text-white text-xs font-bold">1</button>
                            <button class="px-3 py-1 rounded border border-vtc-border text-gray-400 hover:bg-vtc-border hover:text-white text-xs transition-colors">2</button>
                            <button class="px-3 py-1 rounded border border-vtc-border text-gray-400 hover:bg-vtc-border hover:text-white text-xs transition-colors">3</button>
                            <span class="px-2 text-gray-600">...</span>
                            <button class="p-1.5 rounded border border-vtc-border text-gray-500 hover:bg-vtc-border hover:text-white">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </button>
                        </div>
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