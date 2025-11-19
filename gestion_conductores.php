<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Conductores - Logística Norte VTC</title>
    
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

        /* Animación suave para dropdowns y modales */
        .fade-in { animation: fadeIn 0.2s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

        /* Drawer Slide */
        .drawer {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .drawer.open { transform: translateX(0); }
        
        /* Tabs Active State */
        .tab-active { border-bottom: 2px solid #1350C2; color: white; }
        .tab-inactive { color: #94a3b8; border-bottom: 2px solid transparent; }
        .tab-inactive:hover { color: #e2e8f0; border-bottom: 2px solid #2a2e35; }
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
                    <a href="#" class="nav-item active">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Gestión Conductores</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>Solicitudes (Ingreso)</span>
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
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col min-w-0 bg-vtc-dark relative">
        
        <!-- Header -->
        <header class="h-16 flex items-center justify-between px-6 border-b border-vtc-border bg-vtc-panel sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-400 hover:text-white"><i data-lucide="menu" class="w-6 h-6"></i></button>
                <div class="flex items-center gap-2">
                    <i data-lucide="users" class="w-5 h-5 text-blue-400"></i>
                    <h1 class="text-base font-bold text-white uppercase tracking-wide">Gestión de Personal</h1>
                </div>
            </div>

             <!-- Right Actions -->
             <div class="flex items-center gap-5">
                 <button onclick="openInviteModal()" class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-vtc-main hover:bg-blue-600 text-white rounded text-xs font-bold transition-colors shadow-lg shadow-blue-900/20">
                    <i data-lucide="mail-plus" class="w-4 h-4"></i>
                    <span>Invitar Conductor</span>
                </button>
                <div class="h-5 w-px bg-vtc-border hidden md:block"></div>
                <!-- User Profile (Simplified) -->
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
        <div class="flex-1 overflow-y-auto p-4 sm:p-6">
            <div class="max-w-[1600px] mx-auto space-y-6">
                
                <!-- 1. TABS & STATS (INTEGRADOS) -->
                <div class="flex flex-col md:flex-row gap-6 items-end border-b border-vtc-border pb-1">
                    <!-- Tabs -->
                    <div class="flex gap-6">
                        <button onclick="switchTab('active')" id="tab-active-btn" class="tab-active pb-3 px-1 text-sm font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            Plantilla Activa
                            <span class="bg-vtc-border text-gray-300 px-1.5 py-0.5 rounded text-[10px] ml-1">32</span>
                        </button>
                        
                        <!-- CAMBIO AQUÍ: Pestaña Solicitudes -> Ausencias -->
                        <button onclick="switchTab('absence')" id="tab-absence-btn" class="tab-inactive pb-3 px-1 text-sm font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="calendar-off" class="w-4 h-4"></i>
                            Ausencias
                            <span class="bg-yellow-900/30 text-yellow-400 border border-yellow-900/50 px-1.5 py-0.5 rounded text-[10px] ml-1">4</span>
                        </button>

                        <button onclick="switchTab('banned')" id="tab-banned-btn" class="tab-inactive pb-3 px-1 text-sm font-bold flex items-center gap-2 transition-colors">
                            <i data-lucide="ban" class="w-4 h-4"></i>
                            Sancionados
                        </button>
                    </div>
                    
                    <!-- Mini Stats (Right aligned) -->
                    <div class="hidden lg:flex ml-auto gap-4 mb-2">
                        <div class="flex items-center gap-2 px-3 py-1 bg-vtc-panel rounded border border-vtc-border">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            <span class="text-xs text-gray-400">12 Online</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1 bg-vtc-panel rounded border border-vtc-border">
                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                            <span class="text-xs text-gray-400">4 Vacaciones</span>
                        </div>
                    </div>
                </div>

                <!-- 2. TOOLBAR (FILTERS) -->
                <div class="flex flex-col md:flex-row gap-4 justify-between items-center mt-4">
                    <div class="relative group w-full md:w-96">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        <input type="text" placeholder="Buscar conductor por nombre, ID..." class="w-full bg-vtc-panel border border-vtc-border text-sm text-white rounded pl-9 pr-3 py-2 outline-none focus:border-vtc-main transition-colors">
                    </div>
                    <div class="flex gap-2 w-full md:w-auto">
                        <select class="bg-vtc-panel border border-vtc-border rounded px-3 py-2 text-xs text-gray-400 outline-none focus:border-vtc-main w-full md:w-auto">
                            <option>Rango: Todos</option>
                            <option>Staff</option>
                            <option>Veterano</option>
                            <option>Conductor</option>
                            <option>Novato</option>
                        </select>
                        <button class="p-2 bg-vtc-panel border border-vtc-border rounded text-gray-400 hover:text-white transition-colors">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- 3. CONTENT AREA (Switchable) -->
                
                <!-- TAB 1: ACTIVE DRIVERS -->
                <div id="tab-active-content" class="hub-card overflow-hidden fade-in">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-[#13161a] border-b border-vtc-border font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Empleado</th>
                                <th class="px-6 py-4">Rango</th>
                                <th class="px-6 py-4 text-center">Km Totales</th>
                                <th class="px-6 py-4 text-center">Última Conexión</th>
                                <th class="px-6 py-4 text-center">Estado</th>
                                <th class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-vtc-border text-gray-300">
                            <!-- Row 1 -->
                            <tr class="group hover:bg-[#20242b] transition-colors cursor-pointer" onclick="openDrawer('Marta G.', 'Veterano', '42,500')">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <img src="https://ui-avatars.com/api/?name=Marta+G&background=random" class="w-9 h-9 rounded-full border border-vtc-border">
                                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-vtc-panel"></span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-white group-hover:text-blue-400 transition-colors">Marta G.</p>
                                            <p class="text-[10px] text-gray-500 font-mono">ID: #4810</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-purple-900/20 text-purple-400 border border-purple-900/40 text-[10px] font-bold uppercase">
                                        Veterano
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-mono font-bold text-white">42,500</td>
                                <td class="px-6 py-4 text-center text-xs text-green-400">Ahora</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-[10px] bg-green-900/20 text-green-500 px-2 py-0.5 rounded border border-green-900/30">En Ruta</span>
                                </td>
                                <td class="px-6 py-4 text-right relative">
                                    <button onclick="event.stopPropagation(); toggleRowMenu(this)" class="p-1.5 hover:bg-vtc-border rounded text-gray-400 hover:text-white transition-colors">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    <!-- Dropdown Menu (Hidden by default) -->
                                    <div class="hidden absolute right-8 top-0 w-40 bg-vtc-panel border border-vtc-border rounded shadow-xl z-20 text-left overflow-hidden row-menu">
                                        <a href="#" class="block px-4 py-2 text-xs text-gray-300 hover:bg-vtc-dark hover:text-white">Ver Perfil</a>
                                        <a href="#" class="block px-4 py-2 text-xs text-gray-300 hover:bg-vtc-dark hover:text-white">Editar Rango</a>
                                        <a href="#" class="block px-4 py-2 text-xs text-gray-300 hover:bg-vtc-dark hover:text-white">Enviar Mensaje</a>
                                        <div class="border-t border-vtc-border"></div>
                                        <a href="#" class="block px-4 py-2 text-xs text-red-400 hover:bg-red-900/20">Sancionar</a>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Row 2 -->
                            <tr class="group hover:bg-[#20242b] transition-colors cursor-pointer" onclick="openDrawer('Carlos R.', 'Novato', '11,200')">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <img src="https://ui-avatars.com/api/?name=Carlos+R&background=random" class="w-9 h-9 rounded-full border border-vtc-border">
                                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-gray-500 rounded-full border-2 border-vtc-panel"></span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-white group-hover:text-blue-400 transition-colors">Carlos R.</p>
                                            <p class="text-[10px] text-gray-500 font-mono">ID: #4820</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-gray-700 text-gray-300 border border-gray-600 text-[10px] font-bold uppercase">
                                        Novato
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-mono text-gray-300">11,200</td>
                                <td class="px-6 py-4 text-center text-xs text-gray-500">Hace 5d</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-[10px] bg-gray-800 text-gray-400 px-2 py-0.5 rounded border border-gray-700">Inactivo</span>
                                </td>
                                <td class="px-6 py-4 text-right relative">
                                    <button onclick="event.stopPropagation(); toggleRowMenu(this)" class="p-1.5 hover:bg-vtc-border rounded text-gray-400 hover:text-white transition-colors">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="p-4 border-t border-vtc-border bg-[#13161a] flex justify-center">
                        <button class="text-xs text-gray-500 hover:text-white">Cargar más conductores...</button>
                    </div>
                </div>

                <!-- TAB 2: ABSENCE / LEAVE (Reemplaza Solicitudes) -->
                <div id="tab-absence-content" class="hidden fade-in space-y-4">
                    
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold text-white">Conductores en Permiso</h3>
                        <button class="px-3 py-1.5 bg-vtc-panel border border-vtc-border text-xs text-gray-300 rounded hover:text-white transition-colors flex items-center gap-2">
                            <i data-lucide="calendar-plus" class="w-3 h-3"></i> Registrar Ausencia
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Absence Card 1 -->
                        <div class="hub-card p-4 border-l-4 border-l-yellow-500 flex items-start gap-4">
                            <img src="https://ui-avatars.com/api/?name=Luis+M&background=random" class="w-10 h-10 rounded-full border border-vtc-border shrink-0">
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-sm font-bold text-white">Luis M.</h4>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Vacaciones</p>
                                    </div>
                                    <button class="text-gray-500 hover:text-white"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
                                </div>
                                <div class="mt-2 bg-[#13161a] rounded p-2 flex items-center justify-between text-xs">
                                    <span class="text-gray-400">Retorno estimado:</span>
                                    <span class="text-white font-mono">25 Nov</span>
                                </div>
                            </div>
                        </div>

                        <!-- Absence Card 2 -->
                        <div class="hub-card p-4 border-l-4 border-l-red-500 flex items-start gap-4">
                            <img src="https://ui-avatars.com/api/?name=Ana+S&background=random" class="w-10 h-10 rounded-full border border-vtc-border shrink-0">
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-sm font-bold text-white">Ana S.</h4>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Baja Médica</p>
                                    </div>
                                    <button class="text-gray-500 hover:text-white"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
                                </div>
                                <div class="mt-2 bg-[#13161a] rounded p-2 flex items-center justify-between text-xs">
                                    <span class="text-gray-400">Retorno estimado:</span>
                                    <span class="text-white font-mono">Indefinido</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Absence Card 3 -->
                         <div class="hub-card p-4 border-l-4 border-l-gray-500 flex items-start gap-4">
                            <img src="https://ui-avatars.com/api/?name=Roberto+C&background=random" class="w-10 h-10 rounded-full border border-vtc-border shrink-0">
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-sm font-bold text-white">Roberto C.</h4>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Inactividad (>30 días)</p>
                                    </div>
                                    <button class="text-gray-500 hover:text-white"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
                                </div>
                                <div class="mt-2 bg-[#13161a] rounded p-2 flex items-center justify-between text-xs">
                                    <span class="text-gray-400">Estado:</span>
                                    <span class="text-red-400 font-bold">Pendiente Revisión</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: BANNED (Placeholder) -->
                <div id="tab-banned-content" class="hidden fade-in p-8 text-center text-gray-500">
                    <i data-lucide="check-circle" class="w-12 h-12 mx-auto mb-3 opacity-20"></i>
                    <p>No hay conductores sancionados actualmente.</p>
                </div>

            </div>
        </div>
    </main>

    <!-- MODAL: INVITAR CONDUCTOR (Hidden) -->
    <div id="inviteModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeInviteModal()"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-[#181b21] border border-vtc-border rounded-lg shadow-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <i data-lucide="mail" class="w-5 h-5 text-vtc-main"></i> Invitar Conductor
                </h3>
                <button onclick="closeInviteModal()" class="text-gray-500 hover:text-white"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs text-gray-400 mb-1 uppercase font-bold">Email o ID TruckersMP</label>
                    <input type="text" placeholder="ej. usuario@email.com" class="w-full bg-[#0f1115] border border-vtc-border rounded p-3 text-white text-sm outline-none focus:border-vtc-main">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-1 uppercase font-bold">Mensaje Personalizado</label>
                    <textarea rows="3" class="w-full bg-[#0f1115] border border-vtc-border rounded p-3 text-white text-sm outline-none focus:border-vtc-main" placeholder="Hola, te invitamos a unirte a..."></textarea>
                </div>
                <div class="bg-blue-900/20 p-3 rounded border border-blue-900/40 text-xs text-blue-200 flex gap-2">
                    <i data-lucide="info" class="w-4 h-4 shrink-0"></i>
                    El usuario recibirá un enlace válido por 48 horas.
                </div>
                <button onclick="closeInviteModal()" class="w-full py-3 bg-vtc-main hover:bg-blue-600 text-white font-bold rounded transition-colors">Enviar Invitación</button>
            </div>
        </div>
    </div>

    <!-- DRAWER: DETALLE CONDUCTOR (Right Panel) -->
    <div id="driverDrawer" class="fixed inset-y-0 right-0 w-full sm:w-96 bg-[#181b21] border-l border-vtc-border z-40 drawer shadow-2xl flex flex-col">
        <div class="p-6 border-b border-vtc-border flex justify-between items-center bg-[#13161a]">
            <h3 class="text-lg font-bold text-white">Ficha de Empleado</h3>
            <button onclick="closeDrawer()" class="text-gray-400 hover:text-white"><i data-lucide="x" class="w-6 h-6"></i></button>
        </div>
        <div class="flex-1 overflow-y-auto p-6 space-y-6">
            <!-- Profile Header -->
            <div class="text-center">
                <img src="https://ui-avatars.com/api/?name=Marta+G&background=random" id="drawer-avatar" class="w-20 h-20 rounded-full border-4 border-[#13161a] mx-auto mb-3 shadow-lg">
                <h2 class="text-xl font-bold text-white" id="drawer-name">Marta G.</h2>
                <span class="inline-block mt-2 px-3 py-1 rounded-full bg-purple-900/30 text-purple-400 border border-purple-900/50 text-xs font-bold uppercase" id="drawer-rank">VETERANO</span>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-[#0f1115] p-3 rounded border border-vtc-border text-center">
                    <p class="text-[10px] text-gray-500 uppercase">Km Totales</p>
                    <p class="text-lg font-mono text-white font-bold" id="drawer-km">42,500</p>
                </div>
                <div class="bg-[#0f1115] p-3 rounded border border-vtc-border text-center">
                    <p class="text-[10px] text-gray-500 uppercase">Puntos Carnet</p>
                    <p class="text-lg font-mono text-green-400 font-bold">12/12</p>
                </div>
            </div>

            <!-- Info List -->
            <div class="space-y-3">
                <h4 class="text-xs text-gray-500 uppercase font-bold border-b border-vtc-border pb-1">Información</h4>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Camión Asignado</span>
                    <span class="text-white">Volvo FH16 (#VTC-02)</span>
                </div>
                 <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Fecha Ingreso</span>
                    <span class="text-white">12 Ene 2024</span>
                </div>
                 <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Estado</span>
                    <span class="text-green-500 font-bold">Activo</span>
                </div>
            </div>

            <!-- Recent Logs -->
            <div class="space-y-3">
                <h4 class="text-xs text-gray-500 uppercase font-bold border-b border-vtc-border pb-1">Última Actividad</h4>
                <div class="text-xs space-y-2">
                    <p class="text-gray-300"><span class="text-green-400">✓</span> Entregó carga en París (+400km)</p>
                    <p class="text-gray-300"><span class="text-blue-400">ℹ</span> Inició sesión en Tracker</p>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-vtc-border bg-[#13161a] flex gap-3">
            <button class="flex-1 py-2 bg-vtc-main hover:bg-blue-600 text-white rounded text-sm font-bold">Ver Perfil Completo</button>
            <button class="px-3 py-2 bg-[#0f1115] border border-vtc-border text-gray-400 hover:text-white rounded"><i data-lucide="message-square" class="w-5 h-5"></i></button>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Tab Switching Logic
        function switchTab(tabName) {
            // Hide all contents
            document.getElementById('tab-active-content').classList.add('hidden');
            document.getElementById('tab-absence-content').classList.add('hidden');
            document.getElementById('tab-banned-content').classList.add('hidden');

            // Reset buttons
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('tab-inactive');
            });

            // Activate selected
            document.getElementById(`tab-${tabName}-content`).classList.remove('hidden');
            const activeBtn = document.getElementById(`tab-${tabName}-btn`);
            activeBtn.classList.remove('tab-inactive');
            activeBtn.classList.add('tab-active');
        }

        // Modal Logic
        function openInviteModal() {
            document.getElementById('inviteModal').classList.remove('hidden');
        }
        function closeInviteModal() {
            document.getElementById('inviteModal').classList.add('hidden');
        }

        // Drawer Logic
        function openDrawer(name, rank, km) {
            const drawer = document.getElementById('driverDrawer');
            
            // Populate data (Mock)
            document.getElementById('drawer-name').innerText = name;
            document.getElementById('drawer-rank').innerText = rank;
            document.getElementById('drawer-km').innerText = km;
            document.getElementById('drawer-avatar').src = `https://ui-avatars.com/api/?name=${name}&background=random`;

            drawer.classList.add('open');
        }
        function closeDrawer() {
            document.getElementById('driverDrawer').classList.remove('open');
        }

        // Row Menu Dropdown Logic
        function toggleRowMenu(button) {
            // Close any other open menus first
            document.querySelectorAll('.row-menu').forEach(menu => {
                if (menu !== button.nextElementSibling) menu.classList.add('hidden');
            });
            
            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');
        }

        // Close menus when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.closest('button')) {
                 document.querySelectorAll('.row-menu').forEach(menu => menu.classList.add('hidden'));
            }
        });

    </script>
</body>
</html>