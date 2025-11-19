<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos - Logística Norte VTC</title>
    
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

        /* Badge Styles */
        .badge {
            display: inline-flex; align-items: center; padding: 0.25rem 0.75rem;
            border-radius: 9999px; font-size: 0.7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.05em; border-width: 1px;
        }
        .badge-event { background: rgba(59, 130, 246, 0.1); color: #60a5fa; border-color: rgba(59, 130, 246, 0.2); }
        .badge-important { background: rgba(239, 68, 68, 0.1); color: #f87171; border-color: rgba(239, 68, 68, 0.2); }
        .badge-info { background: rgba(107, 114, 128, 0.1); color: #9ca3af; border-color: rgba(107, 114, 128, 0.2); }
        
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
                    <a href="#" class="nav-item">
                        <i data-lucide="map" class="w-4 h-4"></i>
                        <span>Mapa en Vivo</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="trophy" class="w-4 h-4"></i>
                        <span>Ranking</span>
                    </a>
                     <a href="#" class="nav-item active">
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
                    <i data-lucide="megaphone" class="w-5 h-5 text-blue-400"></i>
                    <h1 class="text-base font-bold text-white uppercase tracking-wide">Tablón de Anuncios</h1>
                </div>
            </div>

             <!-- Right Actions -->
             <div class="flex items-center gap-5">
                
                <!-- Admin Action (Solo visible si es staff, simulado) -->
                <button class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-vtc-main hover:bg-blue-600 text-white rounded text-xs font-bold transition-colors">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Publicar</span>
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
        <div class="flex-1 overflow-y-auto p-4 sm:p-8">
            <div class="max-w-5xl mx-auto space-y-8">
                
                <!-- 1. FILTROS -->
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 rounded-full bg-vtc-border text-white text-xs font-bold border border-transparent hover:border-vtc-main transition-colors">Todos</button>
                    <button class="px-4 py-2 rounded-full bg-[#181b21] text-gray-400 hover:text-white text-xs font-medium border border-vtc-border hover:border-blue-500 transition-colors flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Eventos
                    </button>
                    <button class="px-4 py-2 rounded-full bg-[#181b21] text-gray-400 hover:text-white text-xs font-medium border border-vtc-border hover:border-red-500 transition-colors flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span> Importante
                    </button>
                    <button class="px-4 py-2 rounded-full bg-[#181b21] text-gray-400 hover:text-white text-xs font-medium border border-vtc-border hover:border-gray-400 transition-colors flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gray-500"></span> General
                    </button>
                </div>

                <!-- 2. AVISO DESTACADO (HERO) -->
                <div class="hub-card overflow-hidden relative group">
                    <!-- Background Image with Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0f172a] via-[#0f172a]/90 to-transparent z-10"></div>
                    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-40 group-hover:scale-105 transition-transform duration-700 ease-out"></div>
                    
                    <div class="relative z-20 p-8 md:p-10 flex flex-col md:flex-row items-start gap-6">
                        <div class="flex-1">
                            <div class="mb-4 flex items-center gap-3">
                                <span class="badge badge-event bg-blue-500/20 text-blue-400 border-blue-500/30">Evento Oficial</span>
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3 h-3"></i> 24 Dic, 20:00 UTC
                                </span>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-3 drop-shadow-lg">Gran Convoy Navideño 2024</h2>
                            <p class="text-gray-300 text-sm md:text-base leading-relaxed max-w-2xl mb-6">
                                Prepárate para el evento más grande del año. Cruzaremos Europa desde París hasta Berlín con cargas especiales de regalos. 
                                Se requiere pintura navideña y estar en el canal de voz "Eventos" de Discord. Habrá sorteos de DLCs al finalizar.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button class="px-5 py-2.5 bg-vtc-main hover:bg-blue-600 text-white text-sm font-bold rounded flex items-center gap-2 transition-colors shadow-lg shadow-blue-900/20">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    Confirmar Asistencia
                                </button>
                                <button class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white border border-white/10 text-sm font-bold rounded flex items-center gap-2 transition-colors backdrop-blur-sm">
                                    <i data-lucide="map" class="w-4 h-4"></i>
                                    Ver Ruta Detallada
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. LISTA DE AVISOS (FEED) -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider px-1">Anteriores</h3>
                    
                    <!-- Item 1: Normativa (Importante) -->
                    <div class="hub-card p-5 flex flex-col sm:flex-row gap-5 hover:border-red-500/30 transition-colors border-l-4 border-l-red-500">
                        <div class="flex-shrink-0">
                             <div class="w-12 h-12 rounded-lg bg-red-900/20 flex items-center justify-center text-red-400 border border-red-500/20">
                                 <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                             </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="text-lg font-bold text-white">Actualización de Normativa: Velocidad en MP</h4>
                                <span class="text-xs text-gray-500">Hace 2 días</span>
                            </div>
                            <p class="text-sm text-gray-400 mb-3">
                                Debido a las recientes sanciones en TruckersMP, hemos ajustado el límite de velocidad máximo para convoyes oficiales a <strong>90 km/h</strong>. El incumplimiento reiterado conllevará advertencias internas.
                            </p>
                            <div class="flex items-center gap-3 text-xs">
                                <span class="badge badge-important">Normativa</span>
                                <span class="text-gray-500">Publicado por: Admin</span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Mantenimiento (Info) -->
                    <div class="hub-card p-5 flex flex-col sm:flex-row gap-5 hover:border-gray-500/50 transition-colors">
                        <div class="flex-shrink-0">
                             <div class="w-12 h-12 rounded-lg bg-gray-800 flex items-center justify-center text-gray-400 border border-gray-700">
                                 <i data-lucide="server" class="w-6 h-6"></i>
                             </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="text-lg font-bold text-white">Mantenimiento Programado del Tracker</h4>
                                <span class="text-xs text-gray-500">15 Nov</span>
                            </div>
                            <p class="text-sm text-gray-400 mb-3">
                                El sistema de bitácora estará inactivo este domingo de 03:00 a 05:00 UTC por tareas de optimización de la base de datos. Los viajes realizados en ese horario se sincronizarán después.
                            </p>
                            <div class="flex items-center gap-3 text-xs">
                                <span class="badge badge-info">Sistema</span>
                                <span class="text-gray-500">Estado: <span class="text-green-500">Completado</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Bienvenida (General) -->
                    <div class="hub-card p-5 flex flex-col sm:flex-row gap-5 hover:border-blue-500/30 transition-colors">
                        <div class="flex-shrink-0">
                             <div class="w-12 h-12 rounded-lg bg-blue-900/20 flex items-center justify-center text-blue-400 border border-blue-500/20">
                                 <i data-lucide="users" class="w-6 h-6"></i>
                             </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="text-lg font-bold text-white">¡Bienvenidos nuevos conductores!</h4>
                                <span class="text-xs text-gray-500">10 Nov</span>
                            </div>
                            <p class="text-sm text-gray-400 mb-3">
                                Queremos dar una cálida bienvenida a los 5 nuevos integrantes que se unieron a la flota esta semana. Recordad revisar el canal #guia-inicio en Discord para configurar el cliente VTC.
                            </p>
                            <div class="flex items-center gap-3 text-xs">
                                <span class="badge badge-info text-blue-400 border-blue-500/20 bg-blue-500/10">Comunidad</span>
                                <div class="flex -space-x-2">
                                    <img class="w-5 h-5 rounded-full border border-[#181b21]" src="https://ui-avatars.com/api/?name=A&background=random">
                                    <img class="w-5 h-5 rounded-full border border-[#181b21]" src="https://ui-avatars.com/api/?name=B&background=random">
                                    <img class="w-5 h-5 rounded-full border border-[#181b21]" src="https://ui-avatars.com/api/?name=C&background=random">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Paginación -->
                <div class="flex justify-center pt-4">
                    <button class="text-xs text-gray-500 hover:text-white flex items-center gap-2 transition-colors">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        Cargar más avisos
                    </button>
                </div>

            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>