<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclutamiento - Logística Norte VTC</title>
    
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
        .hub-card:hover { border-color: #3b82f6; transform: translateY(-2px); box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5); }

        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; font-size: 0.875rem; color: #94a3b8; }
        .nav-item:hover { background-color: #2a2e35; color: white; }
        .nav-item.active { background-color: #1350C2; color: white; }

        .dlc-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 0.5rem; }
        .dlc-item { font-size: 0.65rem; padding: 4px; text-align: center; border-radius: 4px; background: #13161a; color: #6b7280; border: 1px solid #2a2e35; opacity: 0.6; }
        .dlc-item.owned { background: rgba(16, 185, 129, 0.1); color: #34d399; border-color: rgba(16, 185, 129, 0.3); opacity: 1; font-weight: bold; }
        
        .score-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem; border: 3px solid; }
        .score-high { border-color: #10b981; color: #10b981; background: rgba(16, 185, 129, 0.1); }
        .score-med { border-color: #eab308; color: #eab308; background: rgba(234, 179, 8, 0.1); }
        .score-low { border-color: #ef4444; color: #ef4444; background: rgba(239, 68, 68, 0.1); }

        /* Modal Transitions */
        #reviewModal { transition: opacity 0.2s ease-in-out; }
        #reviewModal.hidden { opacity: 0; pointer-events: none; }
        #reviewModal:not(.hidden) { opacity: 1; pointer-events: auto; }

        /* Tab Styling inside Modal */
        .modal-tab { border-bottom: 2px solid transparent; color: #94a3b8; transition: all 0.2s; }
        .modal-tab:hover { color: white; }
        .modal-tab.active { border-bottom-color: #1350C2; color: white; }
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
                    <a href="#" class="nav-item active">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Solicitudes (Ingreso)</span>
                        <span class="ml-auto px-1.5 py-0.5 text-[10px] font-bold bg-blue-500 text-white rounded-full">3</span>
                    </a>
                    <a href="#" class="nav-item"><i data-lucide="calendar-plus" class="w-4 h-4"></i> <span>Crear Convoys</span></a>
                </div>
            </div>
        </nav>

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
                    <i data-lucide="user-plus" class="w-5 h-5 text-blue-400"></i>
                    <h1 class="text-base font-bold text-white uppercase tracking-wide">Centro de Reclutamiento</h1>
                </div>
            </div>
             <div class="flex items-center gap-5">
                 <div class="hidden md:flex items-center gap-4 text-xs text-gray-400 bg-[#13161a] px-3 py-1.5 rounded border border-vtc-border">
                    <span class="flex items-center gap-2"><span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></span> 3 Pendientes</span>
                    <div class="w-px h-3 bg-vtc-border"></div>
                    <span class="flex items-center gap-2"><span class="w-2 h-2 bg-green-500 rounded-full"></span> 5 Aprobadas (Mes)</span>
                 </div>
                <div class="flex items-center gap-3 pl-5 border-l border-vtc-border">
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
                
                <!-- 1. HEADER & FILTERS -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-vtc-border pb-6">
                    <div class="w-full md:w-auto">
                        <h2 class="text-xl font-display font-bold text-white">Bandeja de Entrada</h2>
                        <p class="text-sm text-gray-500 mt-1">Candidatos ordenados por fecha de solicitud.</p>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <div class="flex bg-vtc-panel rounded-lg p-1 border border-vtc-border">
                             <button class="p-2 rounded hover:bg-vtc-dark text-white transition-colors" title="Vista Tarjetas"><i data-lucide="layout-grid" class="w-4 h-4"></i></button>
                             <button class="p-2 rounded hover:bg-vtc-dark text-gray-500 hover:text-white transition-colors" title="Vista Lista"><i data-lucide="list" class="w-4 h-4"></i></button>
                        </div>
                         <div class="relative group flex-1 md:w-64">
                            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                            <input type="text" placeholder="Buscar candidato..." class="w-full bg-vtc-panel border border-vtc-border text-sm text-white rounded pl-9 pr-3 py-2 outline-none focus:border-vtc-main transition-colors">
                        </div>
                        <button class="px-4 py-2 bg-vtc-panel border border-vtc-border text-gray-300 text-sm rounded hover:text-white hover:border-gray-500 transition-colors flex items-center gap-2">
                            <i data-lucide="history" class="w-4 h-4"></i> Historial
                        </button>
                    </div>
                </div>

                <!-- 2. KANBAN / CARD LIST -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    <!-- CARD 1: TRUCKER X (Excellent Profile) -->
                    <div class="hub-card p-0 relative overflow-hidden group" id="card-truckerx">
                        <div class="h-1 w-full bg-gradient-to-r from-green-500 to-emerald-400"></div>
                        <div class="p-6">
                            <!-- Header Card -->
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex gap-4">
                                    <div class="relative">
                                        <img src="https://ui-avatars.com/api/?name=Trucker+X&background=random&size=128" class="w-16 h-16 rounded-lg border border-vtc-border shadow-lg">
                                        <div class="absolute -top-2 -right-2 bg-blue-500 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-md animate-bounce">NUEVO</div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white hover:text-vtc-main cursor-pointer transition-colors">TruckerX</h3>
                                        <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                            <i data-lucide="map-pin" class="w-3 h-3"></i> Argentina • 24 años
                                        </p>
                                        <div class="flex gap-2 mt-2">
                                            <span class="px-2 py-0.5 bg-vtc-dark border border-vtc-border rounded text-[10px] text-gray-400 flex items-center gap-1" title="Verificado"><i data-lucide="mic" class="w-3 h-3 text-green-400"></i> Micrófono</span>
                                            <span class="px-2 py-0.5 bg-vtc-dark border border-vtc-border rounded text-[10px] text-gray-400 flex items-center gap-1"><i data-lucide="gamepad-2" class="w-3 h-3 text-blue-400"></i> Volante</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Score Badge -->
                                <div class="flex flex-col items-center gap-1">
                                    <div class="score-circle score-high">95</div>
                                    <span class="text-[10px] text-gray-500 uppercase font-bold">Score</span>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <div class="bg-vtc-dark p-2 rounded border border-vtc-border text-center">
                                    <p class="text-[10px] text-gray-500 uppercase">Horas ETS2</p>
                                    <p class="text-sm font-mono text-white font-bold">1,250h</p>
                                </div>
                                <div class="bg-vtc-dark p-2 rounded border border-vtc-border text-center">
                                    <p class="text-[10px] text-gray-500 uppercase">Bans TMP</p>
                                    <p class="text-sm font-mono text-green-400 font-bold">0</p>
                                </div>
                                <div class="bg-vtc-dark p-2 rounded border border-vtc-border text-center">
                                    <p class="text-[10px] text-gray-500 uppercase">VTC Previas</p>
                                    <p class="text-sm font-mono text-white font-bold">2</p>
                                </div>
                            </div>

                            <!-- Maps Preview -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold">Mapas DLC</p>
                                    <span class="text-[10px] text-green-400 flex items-center gap-1"><i data-lucide="check" class="w-3 h-3"></i> Compatible Convoys</span>
                                </div>
                                <div class="dlc-grid">
                                    <div class="dlc-item owned">Going East</div>
                                    <div class="dlc-item owned">Scandinavia</div>
                                    <div class="dlc-item owned">France</div>
                                    <div class="dlc-item owned">Italia</div>
                                    <div class="dlc-item owned">Baltic</div>
                                    <div class="dlc-item owned">Black Sea</div>
                                    <div class="dlc-item owned">Iberia</div>
                                    <div class="dlc-item">West Balkans</div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3 border-t border-vtc-border pt-4">
                                <button onclick="openReviewModal('TruckerX', 95, 'high')" class="flex-1 py-2.5 bg-vtc-main hover:bg-blue-600 text-white text-xs font-bold rounded flex items-center justify-center gap-2 transition-all shadow-lg shadow-blue-900/20 group-hover:shadow-blue-900/40">
                                    <i data-lucide="folder-search" class="w-4 h-4"></i> Abrir Expediente
                                </button>
                                <button class="px-3 py-2.5 bg-vtc-dark border border-vtc-border hover:border-red-500/50 hover:text-red-400 text-gray-400 rounded transition-colors" title="Rechazo Rápido">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: SPEEDY G (Warning Profile) -->
                    <div class="hub-card p-0 relative overflow-hidden group" id="card-speedyg">
                        <div class="h-1 w-full bg-gradient-to-r from-yellow-500 to-orange-500"></div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex gap-4">
                                    <div class="relative">
                                        <img src="https://ui-avatars.com/api/?name=Speedy+G&background=random&size=128" class="w-16 h-16 rounded-lg border border-vtc-border shadow-lg">
                                        <div class="absolute -top-2 -right-2 bg-yellow-600 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-md">RIESGO</div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white">SpeedyG</h3>
                                        <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                            <i data-lucide="map-pin" class="w-3 h-3"></i> España • 16 años
                                        </p>
                                        <div class="flex gap-2 mt-2">
                                            <span class="px-2 py-0.5 bg-vtc-dark border border-vtc-border rounded text-[10px] text-red-400 flex items-center gap-1"><i data-lucide="mic-off" class="w-3 h-3"></i> No Mic</span>
                                            <span class="px-2 py-0.5 bg-vtc-dark border border-vtc-border rounded text-[10px] text-gray-400 flex items-center gap-1"><i data-lucide="keyboard" class="w-3 h-3 text-gray-500"></i> Teclado</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center gap-1">
                                    <div class="score-circle score-low">45</div>
                                    <span class="text-[10px] text-gray-500 uppercase font-bold">Score</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <div class="bg-vtc-dark p-2 rounded border border-vtc-border text-center">
                                    <p class="text-[10px] text-gray-500 uppercase">Horas ETS2</p>
                                    <p class="text-sm font-mono text-white font-bold">450h</p>
                                </div>
                                <div class="bg-vtc-dark p-2 rounded border border-vtc-border text-center bg-red-900/10 border-red-900/30">
                                    <p class="text-[10px] text-gray-500 uppercase">Bans TMP</p>
                                    <p class="text-sm font-mono text-red-400 font-bold">2 Activos</p>
                                </div>
                                <div class="bg-vtc-dark p-2 rounded border border-vtc-border text-center">
                                    <p class="text-[10px] text-gray-500 uppercase">VTC Previas</p>
                                    <p class="text-sm font-mono text-gray-500">0</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold">Mapas DLC</p>
                                    <span class="text-[10px] text-yellow-500 flex items-center gap-1"><i data-lucide="alert-triangle" class="w-3 h-3"></i> Faltan Mapas</span>
                                </div>
                                <div class="dlc-grid">
                                    <div class="dlc-item owned">Going East</div>
                                    <div class="dlc-item">Scandinavia</div>
                                    <div class="dlc-item">France</div>
                                    <div class="dlc-item">Italia</div>
                                    <div class="dlc-item">Baltic</div>
                                    <div class="dlc-item">Black Sea</div>
                                    <div class="dlc-item">Iberia</div>
                                    <div class="dlc-item">West Balkans</div>
                                </div>
                            </div>

                            <div class="flex gap-3 border-t border-vtc-border pt-4">
                                <button onclick="openReviewModal('SpeedyG', 45, 'low')" class="flex-1 py-2.5 bg-vtc-panel border border-vtc-border hover:bg-vtc-border text-white text-xs font-bold rounded flex items-center justify-center gap-2 transition-all">
                                    <i data-lucide="folder-search" class="w-4 h-4"></i> Abrir Expediente
                                </button>
                                <button class="px-3 py-2.5 bg-red-900/20 border border-red-900/30 hover:bg-red-900/40 text-red-400 rounded transition-colors" title="Rechazar Rápido">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- REVIEW MODAL (EXPEDIENTE DE INVESTIGACIÓN) -->
    <div id="reviewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeReviewModal()"></div>
        
        <div class="relative bg-[#181b21] w-full max-w-3xl rounded-xl border border-vtc-border shadow-2xl flex flex-col max-h-[90vh] transform transition-all duration-300 scale-100">
            
            <!-- Header con Pestañas -->
            <div class="p-0 border-b border-vtc-border bg-[#13161a] rounded-t-xl">
                <div class="p-6 flex justify-between items-center pb-0">
                    <div class="flex items-center gap-4 pb-6">
                        <img id="modalAvatar" src="" class="w-14 h-14 rounded-lg border border-vtc-border shadow-lg">
                        <div>
                            <h3 class="text-2xl font-display font-bold text-white leading-none" id="modalName">Nombre Candidato</h3>
                            <p class="text-sm text-gray-500 mt-1 flex items-center gap-2">
                                <span class="bg-blue-900/30 text-blue-400 text-[10px] px-2 py-0.5 rounded border border-blue-900/50 font-bold">PENDIENTE</span>
                                • Solicitud #9821 • Recibida hace 2 horas
                            </p>
                        </div>
                    </div>
                    <button onclick="closeReviewModal()" class="text-gray-500 hover:text-white mb-6"><i data-lucide="x" class="w-6 h-6"></i></button>
                </div>
                
                <!-- Tabs Navigation -->
                <div class="flex px-6 gap-6">
                    <button class="modal-tab active pb-3 text-sm font-bold flex items-center gap-2" onclick="switchModalTab(this, 'tab-general')">
                        <i data-lucide="file-text" class="w-4 h-4"></i> Resumen
                    </button>
                    <button class="modal-tab pb-3 text-sm font-bold flex items-center gap-2" onclick="switchModalTab(this, 'tab-history')">
                        <i data-lucide="history" class="w-4 h-4"></i> Historial TMP
                    </button>
                    <button class="modal-tab pb-3 text-sm font-bold flex items-center gap-2" onclick="switchModalTab(this, 'tab-notes')">
                        <i data-lucide="clipboard-list" class="w-4 h-4"></i> Evaluación Staff
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="flex-1 overflow-y-auto p-6 bg-[#0f1115]">
                
                <!-- TAB 1: RESUMEN -->
                <div id="tab-general" class="space-y-6">
                    <div class="bg-vtc-panel p-5 rounded-lg border border-vtc-border">
                        <h4 class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-3">Formulario de Ingreso</h4>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 font-bold mb-1">¿Por qué quieres unirte a Logística Norte?</p>
                                <div class="bg-vtc-dark p-3 rounded border border-vtc-border">
                                    <p class="text-sm text-gray-300 italic leading-relaxed">"Busco una VTC seria donde se respeten las normas de simulación. Vengo de una empresa que cerró (Transportes Iberia) y me gusta hacer convoys los fines de semana. Tengo experiencia liderando rutas."</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 font-bold mb-1">Disponibilidad</p>
                                    <p class="text-sm text-white">Fines de semana, tardes</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-bold mb-1">Experiencia en Convoys</p>
                                    <p class="text-sm text-white">Alta (Ex-Staff)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: HISTORIAL (Simulado) -->
                <div id="tab-history" class="space-y-6 hidden">
                     <div class="bg-vtc-panel p-5 rounded-lg border border-vtc-border">
                        <h4 class="text-xs font-bold text-orange-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i> Registro de Sanciones (TruckersMP)
                        </h4>
                        <div class="space-y-2">
                            <!-- Ban Item -->
                            <div class="flex items-start gap-3 p-3 bg-vtc-dark rounded border border-vtc-border opacity-60">
                                <div class="mt-1"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i></div>
                                <div>
                                    <p class="text-sm font-bold text-gray-400 line-through">Ban #19284 - Reckless Driving</p>
                                    <p class="text-xs text-gray-600">Expirado hace 2 años • Duración: 3 días</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center py-4">
                                <span class="text-xs text-green-500 font-bold flex items-center gap-2"><i data-lucide="shield-check" class="w-4 h-4"></i> Historial Limpio (Últimos 12 meses)</span>
                            </div>
                        </div>
                     </div>
                     
                     <div class="bg-vtc-panel p-5 rounded-lg border border-vtc-border">
                        <h4 class="text-xs font-bold text-purple-400 uppercase tracking-wider mb-3">Historial de VTCs</h4>
                        <table class="w-full text-xs text-left text-gray-400">
                            <thead>
                                <tr class="border-b border-vtc-border"><th class="pb-2">Empresa</th><th class="pb-2">Rol</th><th class="pb-2">Periodo</th></tr>
                            </thead>
                            <tbody class="divide-y divide-vtc-border">
                                <tr><td class="py-2 text-white">Transportes Iberia</td><td class="py-2">Convoy Leader</td><td class="py-2">2022 - 2023</td></tr>
                                <tr><td class="py-2 text-white">EuroLogistics</td><td class="py-2">Driver</td><td class="py-2">2021</td></tr>
                            </tbody>
                        </table>
                     </div>
                </div>

                <!-- TAB 3: EVALUACIÓN -->
                <div id="tab-notes" class="space-y-6 hidden">
                    <div class="bg-vtc-panel p-5 rounded-lg border border-vtc-border">
                        <h4 class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-3">Checklist de Seguridad</h4>
                        <div class="grid grid-cols-1 gap-2">
                             <label class="flex items-center gap-3 p-2 rounded hover:bg-vtc-dark transition-colors cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 bg-transparent border-gray-500 rounded text-blue-600 focus:ring-0">
                                <span class="text-sm text-gray-300">Perfil Steam Público</span>
                            </label>
                            <label class="flex items-center gap-3 p-2 rounded hover:bg-vtc-dark transition-colors cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 bg-transparent border-gray-500 rounded text-blue-600 focus:ring-0">
                                <span class="text-sm text-gray-300">Sin Bans Activos</span>
                            </label>
                            <label class="flex items-center gap-3 p-2 rounded hover:bg-vtc-dark transition-colors cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 bg-transparent border-gray-500 rounded text-blue-600 focus:ring-0">
                                <span class="text-sm text-gray-300">Discord Vinculado</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Notas del Entrevistador</h4>
                        <textarea class="w-full bg-vtc-dark border border-vtc-border rounded p-3 text-sm text-white outline-none focus:border-vtc-main min-h-[100px]" placeholder="Añade observaciones sobre la entrevista o el perfil..."></textarea>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-vtc-border bg-[#13161a] rounded-b-xl flex gap-3 justify-end">
                <button class="px-4 py-2 text-gray-400 hover:text-white text-sm font-medium transition-colors" onclick="closeReviewModal()">Cancelar</button>
                <div class="h-8 w-px bg-vtc-border mx-2"></div>
                <button class="px-6 py-2 bg-red-900/20 hover:bg-red-900/40 border border-red-900/50 text-red-400 font-bold rounded transition-colors text-sm">
                    Rechazar
                </button>
                 <button class="px-6 py-2 bg-[#2f3136] hover:bg-[#5865F2] text-white font-bold rounded transition-colors text-sm flex items-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i> Citar Entrevista
                </button>
                <button class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded transition-colors text-sm flex justify-center items-center gap-2 shadow-lg shadow-green-900/20" onclick="processAction(this, 'accepted')">
                    <i data-lucide="check-circle" class="w-4 h-4"></i> Aprobar Ingreso
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openReviewModal(name, score, type) {
            const modal = document.getElementById('reviewModal');
            const avatar = document.getElementById('modalAvatar');
            const nameTitle = document.getElementById('modalName');
            
            nameTitle.innerText = name;
            avatar.src = `https://ui-avatars.com/api/?name=${name}&background=random&size=128`;
            
            // Reset Tabs
            switchModalTab(document.querySelector('.modal-tab'), 'tab-general');
            
            modal.classList.remove('hidden');
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
        }
        
        function switchModalTab(btn, tabId) {
            // Hide all tabs
            document.getElementById('tab-general').classList.add('hidden');
            document.getElementById('tab-history').classList.add('hidden');
            document.getElementById('tab-notes').classList.add('hidden');
            
            // Show selected
            document.getElementById(tabId).classList.remove('hidden');
            
            // Update buttons
            document.querySelectorAll('.modal-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        function processAction(btn, type) {
            const originalText = btn.innerHTML;
            btn.innerHTML = `<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>`;
            lucide.createIcons();
            
            setTimeout(() => {
                if (type === 'accepted') {
                    btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                    btn.classList.add('bg-green-500', 'cursor-not-allowed');
                    btn.innerHTML = `<i data-lucide="check" class="w-4 h-4"></i> ¡Aceptado!`;
                    lucide.createIcons();
                    setTimeout(() => closeReviewModal(), 1000);
                }
            }, 1000);
        }
    </script>
</body>
</html>