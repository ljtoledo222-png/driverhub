<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Convoys - Logística Norte VTC</title>
    
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
                            dark: '#0f1115',     // Fondo principal
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
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f1115; }
        ::-webkit-scrollbar-thumb { background: #2a2e35; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #1350C2; }

        body { background-color: #0f1115; color: #e2e8f0; }
        .hub-card { background-color: #181b21; border: 1px solid #2a2e35; border-radius: 0.5rem; transition: all 0.2s ease-in-out; }
        .hub-card:hover { border-color: #3b82f6; transform: translateY(-2px); box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3); }

        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; font-size: 0.875rem; color: #94a3b8; }
        .nav-item:hover { background-color: #2a2e35; color: white; }
        .nav-item.active { background-color: #1350C2; color: white; }

        /* Modal & Drawer Transitions */
        #convoyModal, #attendanceDrawer { transition: all 0.3s ease-in-out; }
        #convoyModal.hidden { opacity: 0; pointer-events: none; transform: scale(0.95); }
        #convoyModal:not(.hidden) { opacity: 1; pointer-events: auto; transform: scale(1); }
        
        .drawer-closed { transform: translateX(100%); }
        .drawer-open { transform: translateX(0); }

        /* DLC Badge Grid */
        .dlc-badge {
            font-size: 0.65rem; padding: 2px 6px; border-radius: 4px;
            background: #1e293b; color: #64748b; border: 1px solid #334155;
        }
        .dlc-badge.required { background: rgba(239, 68, 68, 0.1); color: #f87171; border-color: rgba(239, 68, 68, 0.3); }
        .dlc-badge.optional { background: rgba(59, 130, 246, 0.1); color: #60a5fa; border-color: rgba(59, 130, 246, 0.3); }
    </style>
</head>
<body class="antialiased overflow-x-hidden font-sans h-screen flex">

    <!-- SIDEBAR (Consistente) -->
    <aside class="w-64 flex-shrink-0 flex flex-col border-r border-vtc-border bg-vtc-panel z-20 hidden md:flex">
        <div class="h-16 flex items-center px-5 border-b border-vtc-border">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-vtc-main/20 flex items-center justify-center border border-vtc-main/30">
                    <img src="https://i.imgur.com/hLucV8D.png" alt="LN Logo" class="w-full h-full object-contain p-0.5">
                </div>
                <h2 class="font-display font-bold text-lg tracking-wide text-white">LN<span class="text-blue-500">VTC</span></h2>
            </div>
        </div>

        <nav class="flex-1 px-3 py-6 space-y-6 overflow-y-auto">
            <!-- Zona Conductor -->
            <div>
                <p class="px-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <i data-lucide="steering-wheel" class="w-3 h-3"></i> Zona Conductor
                </p>
                <div class="space-y-1">
                    <a href="#" class="nav-item"><i data-lucide="layout-dashboard" class="w-4 h-4"></i> <span>Mi Panel</span></a>
                    <a href="#" class="nav-item"><i data-lucide="book" class="w-4 h-4"></i> <span>Mi Bitácora</span></a>
                    <a href="#" class="nav-item"><i data-lucide="map" class="w-4 h-4"></i> <span>Mapa en Vivo</span></a>
                </div>
            </div>
            <!-- Zona Staff -->
            <div class="border-t border-vtc-border mx-2"></div>
            <div>
                <p class="px-2 text-[11px] font-bold text-blue-500 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <i data-lucide="shield" class="w-3 h-3"></i> Administración
                </p>
                <div class="space-y-1">
                    <a href="#" class="nav-item"><i data-lucide="bar-chart-3" class="w-4 h-4"></i> <span>Estado Empresa</span></a>
                    <a href="#" class="nav-item"><i data-lucide="users" class="w-4 h-4"></i> <span>Gestión Conductores</span></a>
                    <a href="#" class="nav-item"><i data-lucide="user-plus" class="w-4 h-4"></i> <span>Solicitudes</span></a>
                    <a href="#" class="nav-item active"><i data-lucide="calendar-plus" class="w-4 h-4"></i> <span>Crear Convoys</span></a>
                </div>
            </div>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col min-w-0 bg-vtc-dark relative">
        
        <!-- Header -->
        <header class="h-16 flex items-center justify-between px-6 border-b border-vtc-border bg-vtc-panel sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-400 hover:text-white"><i data-lucide="menu" class="w-6 h-6"></i></button>
                <div class="flex items-center gap-2">
                    <i data-lucide="calendar-days" class="w-5 h-5 text-blue-400"></i>
                    <h1 class="text-base font-bold text-white uppercase tracking-wide">Centro de Eventos</h1>
                </div>
            </div>
             <div class="flex items-center gap-5">
                 <button onclick="openConvoyModal()" class="hidden md:flex items-center gap-2 px-4 py-1.5 bg-vtc-main hover:bg-blue-600 text-white rounded text-xs font-bold transition-colors shadow-lg shadow-blue-900/20">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>Nuevo Evento</span>
                </button>
                <div class="h-5 w-px bg-vtc-border hidden md:block"></div>
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
                
                <!-- 1. FILTERS & TOOLS -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-vtc-border pb-6">
                    <div class="flex gap-3 bg-vtc-panel p-1 rounded-lg border border-vtc-border">
                        <button class="px-4 py-2 bg-vtc-dark text-white text-xs font-bold rounded shadow border border-vtc-border">Próximos (2)</button>
                        <button class="px-4 py-2 text-gray-400 hover:text-white text-xs font-medium rounded transition-colors">Historial</button>
                        <button class="px-4 py-2 text-gray-400 hover:text-white text-xs font-medium rounded transition-colors">Borradores</button>
                    </div>
                    
                    <div class="flex gap-3 w-full md:w-auto">
                         <div class="relative group flex-1 md:w-64">
                            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                            <input type="text" placeholder="Buscar evento..." class="w-full bg-vtc-panel border border-vtc-border text-sm text-white rounded pl-9 pr-3 py-2 outline-none focus:border-vtc-main transition-colors">
                        </div>
                        <button class="px-3 py-2 bg-vtc-panel border border-vtc-border text-gray-300 rounded hover:text-white transition-colors" title="Vista Calendario">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- 2. EVENTS GRID -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    <!-- CARD 1: FEATURED EVENT -->
                    <div class="hub-card flex flex-col overflow-hidden relative group border-l-4 border-l-blue-500">
                        
                        <!-- Map Header -->
                        <div class="h-48 relative bg-[#13161a]">
                            <!-- Background Map Image (Mock) -->
                            <div class="absolute inset-0 bg-[url('https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Openstreetmap_logo.svg/1024px-Openstreetmap_logo.svg.png')] bg-cover opacity-20 grayscale"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#181b21] to-transparent"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 right-4 flex gap-2">
                                <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-wider">Oficial</span>
                                <span class="bg-green-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow-lg flex items-center gap-1"><i data-lucide="server" class="w-3 h-3"></i> Sim 1</span>
                            </div>

                            <!-- Route Visual -->
                            <div class="absolute bottom-4 left-6 right-6 flex items-center justify-between z-10">
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Salida</p>
                                    <h4 class="text-xl font-bold text-white flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-green-500"></i> París</h4>
                                </div>
                                <div class="flex-1 mx-4 h-px bg-gradient-to-r from-green-500 to-red-500 relative top-2 opacity-50"></div>
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Llegada</p>
                                    <h4 class="text-xl font-bold text-white flex items-center gap-2 justify-end">Berlín <i data-lucide="flag" class="w-4 h-4 text-red-500"></i></h4>
                                </div>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-2xl font-display font-bold text-white group-hover:text-blue-400 transition-colors">Gran Convoy Navideño</h3>
                                    <p class="text-xs text-gray-400 mt-1">Ruta especial por carreteras secundarias. Sorteo de DLCs al finalizar.</p>
                                </div>
                                <div class="text-center bg-vtc-dark border border-vtc-border rounded p-2 min-w-[80px]">
                                    <p class="text-xs text-red-400 font-bold uppercase">DIC</p>
                                    <p class="text-xl font-bold text-white">24</p>
                                    <p class="text-xs text-gray-500">20:00 UTC</p>
                                </div>
                            </div>

                            <!-- Requirements Grid -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-vtc-dark p-3 rounded border border-vtc-border">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-2">DLCs Requeridos</p>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="dlc-badge required">Vive la France</span>
                                        <span class="dlc-badge optional">Going East</span>
                                    </div>
                                </div>
                                <div class="bg-vtc-dark p-3 rounded border border-vtc-border">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-2">Datos Técnicos</p>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-400">Distancia:</span>
                                        <span class="text-white font-mono font-bold">1,240 km</span>
                                    </div>
                                     <div class="flex justify-between text-xs mt-1">
                                        <span class="text-gray-400">Tiempo Est:</span>
                                        <span class="text-white font-mono">90 min</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance & Actions -->
                            <div class="mt-auto pt-4 border-t border-vtc-border">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex -space-x-2">
                                        <img class="w-6 h-6 rounded-full border border-vtc-panel" src="https://ui-avatars.com/api/?name=A&background=random">
                                        <img class="w-6 h-6 rounded-full border border-vtc-panel" src="https://ui-avatars.com/api/?name=B&background=random">
                                        <img class="w-6 h-6 rounded-full border border-vtc-panel" src="https://ui-avatars.com/api/?name=C&background=random">
                                        <span class="w-6 h-6 rounded-full border border-vtc-panel bg-vtc-dark text-[9px] flex items-center justify-center text-gray-400">+15</span>
                                    </div>
                                    <span class="text-xs text-green-400 font-bold">18 Confirmados</span>
                                </div>
                                <div class="w-full bg-vtc-dark h-1.5 rounded-full overflow-hidden mb-4">
                                    <div class="bg-green-500 h-full w-[60%]"></div>
                                </div>

                                <div class="flex gap-3">
                                    <button onclick="openAttendanceDrawer()" class="flex-1 py-2.5 bg-vtc-panel border border-vtc-border hover:bg-vtc-border text-white text-xs font-bold rounded flex items-center justify-center gap-2 transition-colors">
                                        <i data-lucide="users" class="w-4 h-4"></i> Gestionar Asistencia
                                    </button>
                                    <button class="px-4 py-2.5 bg-blue-900/20 hover:bg-blue-900/40 border border-blue-900/50 text-blue-400 rounded transition-colors" title="Editar Ruta">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: WEEKLY ROUTE -->
                    <div class="hub-card flex flex-col overflow-hidden relative group border-l-4 border-l-gray-600 opacity-80 hover:opacity-100 transition-opacity">
                        <!-- Map Header -->
                         <div class="h-48 relative bg-[#13161a]">
                             <div class="absolute inset-0 bg-gradient-to-t from-[#181b21] to-transparent"></div>
                            <div class="absolute top-4 right-4 flex gap-2">
                                <span class="bg-gray-700 text-gray-300 text-[10px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-wider">Casual</span>
                            </div>
                            <div class="absolute bottom-4 left-6 right-6 flex items-center justify-between z-10">
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Salida</p>
                                    <h4 class="text-xl font-bold text-white flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-green-500"></i> Milán</h4>
                                </div>
                                <div class="flex-1 mx-4 h-px bg-gray-700 relative top-2"></div>
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Llegada</p>
                                    <h4 class="text-xl font-bold text-white flex items-center gap-2 justify-end">Zurich <i data-lucide="flag" class="w-4 h-4 text-red-500"></i></h4>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                             <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-2xl font-display font-bold text-white group-hover:text-blue-400 transition-colors">Ruta Alpina</h3>
                                    <p class="text-xs text-gray-400 mt-1">Convoy semanal para sumar kilómetros.</p>
                                </div>
                                <div class="text-center bg-vtc-dark border border-vtc-border rounded p-2 min-w-[80px]">
                                    <p class="text-xs text-red-400 font-bold uppercase">NOV</p>
                                    <p class="text-xl font-bold text-white">30</p>
                                    <p class="text-xs text-gray-500">18:00 UTC</p>
                                </div>
                            </div>
                            
                             <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-vtc-dark p-3 rounded border border-vtc-border">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-2">DLCs Requeridos</p>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="dlc-badge required">Italia</span>
                                    </div>
                                </div>
                                <div class="bg-vtc-dark p-3 rounded border border-vtc-border">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-2">Datos Técnicos</p>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-400">Distancia:</span>
                                        <span class="text-white font-mono font-bold">450 km</span>
                                    </div>
                                     <div class="flex justify-between text-xs mt-1">
                                        <span class="text-gray-400">Tiempo Est:</span>
                                        <span class="text-white font-mono">45 min</span>
                                    </div>
                                </div>
                            </div>

                             <div class="mt-auto pt-4 border-t border-vtc-border">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-xs text-gray-500">Sin confirmados aún</span>
                                </div>
                                <button class="w-full py-2.5 bg-vtc-main hover:bg-blue-600 text-white text-xs font-bold rounded transition-colors">
                                    Publicar Evento
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- DRAWER: GESTIÓN DE ASISTENCIA -->
    <div id="attendanceDrawer" class="fixed inset-y-0 right-0 w-full sm:w-96 bg-[#181b21] border-l border-vtc-border z-50 shadow-2xl flex flex-col drawer-closed">
        <div class="p-6 border-b border-vtc-border flex justify-between items-center bg-[#13161a]">
            <h3 class="text-lg font-bold text-white">Gestión de Slots</h3>
            <button onclick="closeAttendanceDrawer()" class="text-gray-400 hover:text-white"><i data-lucide="x" class="w-6 h-6"></i></button>
        </div>
        
        <div class="flex-1 overflow-y-auto p-6">
            <div class="mb-6">
                <h4 class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-3">Resumen</h4>
                <div class="bg-vtc-dark p-4 rounded border border-vtc-border flex justify-between items-center">
                    <div>
                        <p class="text-2xl font-bold text-white">18</p>
                        <p class="text-[10px] text-gray-500 uppercase">Confirmados</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-500">12</p>
                        <p class="text-[10px] text-gray-500 uppercase">Libres</p>
                    </div>
                </div>
            </div>

            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Lista de Pilotos</h4>
            <div class="space-y-2">
                <!-- Pilot 1 -->
                <div class="flex items-center justify-between p-3 bg-vtc-dark border border-vtc-border rounded">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs text-gray-500">01</span>
                        <img src="https://ui-avatars.com/api/?name=Alex+D&background=random" class="w-8 h-8 rounded">
                        <div>
                            <p class="text-xs font-bold text-white">Alex Driver</p>
                            <p class="text-[10px] text-blue-400">Líder de Convoy</p>
                        </div>
                    </div>
                    <i data-lucide="shield" class="w-4 h-4 text-yellow-500"></i>
                </div>
                
                <!-- Pilot 2 -->
                <div class="flex items-center justify-between p-3 bg-vtc-dark border border-vtc-border rounded">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs text-gray-500">02</span>
                        <img src="https://ui-avatars.com/api/?name=Marta+G&background=random" class="w-8 h-8 rounded">
                        <div>
                            <p class="text-xs font-bold text-white">Marta G.</p>
                            <p class="text-[10px] text-gray-500">Escolta</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                         <button class="text-gray-500 hover:text-white"><i data-lucide="move" class="w-4 h-4"></i></button>
                         <button class="text-gray-500 hover:text-red-400"><i data-lucide="x" class="w-4 h-4"></i></button>
                    </div>
                </div>
                 <!-- Pilot 3 -->
                <div class="flex items-center justify-between p-3 bg-vtc-dark border border-vtc-border rounded">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs text-gray-500">03</span>
                        <img src="https://ui-avatars.com/api/?name=Juan+P&background=random" class="w-8 h-8 rounded">
                        <div>
                            <p class="text-xs font-bold text-white">Juan P.</p>
                            <p class="text-[10px] text-gray-500">Conductor</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                         <button class="text-gray-500 hover:text-white"><i data-lucide="move" class="w-4 h-4"></i></button>
                         <button class="text-gray-500 hover:text-red-400"><i data-lucide="x" class="w-4 h-4"></i></button>
                    </div>
                </div>
            </div>
            
            <button class="w-full mt-4 py-2 bg-vtc-panel border border-dashed border-vtc-border text-gray-400 text-xs font-bold rounded hover:bg-vtc-dark hover:text-white transition-colors">
                + Añadir Manualmente
            </button>
        </div>
        
        <div class="p-4 border-t border-vtc-border bg-[#13161a]">
            <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded transition-colors" onclick="closeAttendanceDrawer()">
                Guardar Cambios
            </button>
        </div>
    </div>

    <!-- MODAL: CREAR CONVOY (Improved Wizard) -->
    <div id="convoyModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeConvoyModal()"></div>
        
        <div class="relative bg-[#181b21] w-full max-w-5xl rounded-xl border border-vtc-border shadow-2xl flex flex-col max-h-[95vh] overflow-hidden">
            <div class="p-6 border-b border-vtc-border bg-[#13161a] flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-white">Planificador de Ruta</h3>
                    <p class="text-xs text-gray-500">Configura los detalles técnicos del evento.</p>
                </div>
                <button onclick="closeConvoyModal()" class="text-gray-500 hover:text-white"><i data-lucide="x" class="w-6 h-6"></i></button>
            </div>

            <div class="flex-1 overflow-y-auto p-8 bg-[#0f1115]">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left: Form -->
                    <div class="lg:col-span-2 space-y-6">
                         <div>
                            <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Nombre del Evento</label>
                            <input type="text" class="w-full bg-vtc-panel border border-vtc-border rounded p-3 text-sm text-white focus:border-vtc-main outline-none placeholder-gray-600" placeholder="Ej: Ruta Escandinava">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Origen</label>
                                <div class="relative">
                                    <i data-lucide="map-pin" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-green-500"></i>
                                    <input type="text" class="w-full bg-vtc-panel border border-vtc-border rounded p-3 pl-10 text-sm text-white focus:border-vtc-main outline-none" placeholder="Ciudad de Salida">
                                </div>
                            </div>
                             <div>
                                <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Destino</label>
                                <div class="relative">
                                    <i data-lucide="flag" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-red-500"></i>
                                    <input type="text" class="w-full bg-vtc-panel border border-vtc-border rounded p-3 pl-10 text-sm text-white focus:border-vtc-main outline-none" placeholder="Ciudad de Llegada">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Fecha</label>
                                <input type="date" class="w-full bg-vtc-panel border border-vtc-border rounded p-3 text-sm text-white focus:border-vtc-main outline-none">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Hora UTC</label>
                                <input type="time" class="w-full bg-vtc-panel border border-vtc-border rounded p-3 text-sm text-white focus:border-vtc-main outline-none">
                            </div>
                             <div>
                                <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Servidor</label>
                                <select class="w-full bg-vtc-panel border border-vtc-border rounded p-3 text-sm text-white focus:border-vtc-main outline-none">
                                    <option>Simulación 1</option>
                                    <option>Simulación 2</option>
                                    <option>ProMods</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 mb-2 font-bold uppercase">DLCs Necesarios</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="flex items-center gap-2 p-2 bg-vtc-panel rounded border border-vtc-border cursor-pointer hover:border-vtc-main"><input type="checkbox" class="rounded bg-vtc-dark border-gray-600 text-blue-600 focus:ring-0"> <span class="text-xs text-gray-300">Iberia</span></label>
                                <label class="flex items-center gap-2 p-2 bg-vtc-panel rounded border border-vtc-border cursor-pointer hover:border-vtc-main"><input type="checkbox" class="rounded bg-vtc-dark border-gray-600 text-blue-600 focus:ring-0"> <span class="text-xs text-gray-300">France</span></label>
                                <label class="flex items-center gap-2 p-2 bg-vtc-panel rounded border border-vtc-border cursor-pointer hover:border-vtc-main"><input type="checkbox" class="rounded bg-vtc-dark border-gray-600 text-blue-600 focus:ring-0"> <span class="text-xs text-gray-300">Italia</span></label>
                                <label class="flex items-center gap-2 p-2 bg-vtc-panel rounded border border-vtc-border cursor-pointer hover:border-vtc-main"><input type="checkbox" class="rounded bg-vtc-dark border-gray-600 text-blue-600 focus:ring-0"> <span class="text-xs text-gray-300">Scandinavia</span></label>
                                <label class="flex items-center gap-2 p-2 bg-vtc-panel rounded border border-vtc-border cursor-pointer hover:border-vtc-main"><input type="checkbox" class="rounded bg-vtc-dark border-gray-600 text-blue-600 focus:ring-0"> <span class="text-xs text-gray-300">Baltic Sea</span></label>
                                <label class="flex items-center gap-2 p-2 bg-vtc-panel rounded border border-vtc-border cursor-pointer hover:border-vtc-main"><input type="checkbox" class="rounded bg-vtc-dark border-gray-600 text-blue-600 focus:ring-0"> <span class="text-xs text-gray-300">Black Sea</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Preview & Upload -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1 font-bold uppercase">Mapa de Ruta</label>
                            <div class="border-2 border-dashed border-vtc-border rounded-lg h-48 flex flex-col items-center justify-center text-center cursor-pointer hover:border-vtc-main hover:bg-vtc-panel transition-colors group">
                                <div class="p-4 rounded-full bg-vtc-panel group-hover:bg-vtc-dark mb-3 transition-colors">
                                    <i data-lucide="upload-cloud" class="w-6 h-6 text-blue-400"></i>
                                </div>
                                <p class="text-xs text-white font-bold">Arrastra tu imagen aquí</p>
                                <p class="text-[10px] text-gray-500 mt-1">JPG, PNG (Max 5MB)</p>
                            </div>
                        </div>

                        <div class="bg-blue-900/10 p-4 rounded border border-blue-900/30">
                            <h4 class="text-xs font-bold text-blue-400 mb-2 flex items-center gap-2"><i data-lucide="info" class="w-3 h-3"></i> Notas del Staff</h4>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Recuerda reservar el slot en el servidor de TruckersMP con al menos 48 horas de antelación para eventos oficiales.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-vtc-border bg-[#13161a] flex justify-end gap-3">
                <button onclick="closeConvoyModal()" class="px-6 py-3 text-gray-400 hover:text-white text-sm font-bold transition-colors">Cancelar</button>
                <button class="px-8 py-3 bg-vtc-main hover:bg-blue-600 text-white font-bold rounded transition-colors shadow-lg shadow-blue-900/20">
                    Crear y Publicar
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Modal Functions
        function openConvoyModal() { document.getElementById('convoyModal').classList.remove('hidden'); }
        function closeConvoyModal() { document.getElementById('convoyModal').classList.add('hidden'); }

        // Drawer Functions
        function openAttendanceDrawer() { 
            const drawer = document.getElementById('attendanceDrawer');
            drawer.classList.remove('drawer-closed');
            drawer.classList.add('drawer-open');
        }
        function closeAttendanceDrawer() { 
            const drawer = document.getElementById('attendanceDrawer');
            drawer.classList.remove('drawer-open');
            drawer.classList.add('drawer-closed');
        }
    </script>
</body>
</html>