<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logística Norte VTC - Acceso Conductores</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <!-- Configuración Personalizada Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Exo 2', 'sans-serif'],
                    },
                    colors: {
                        vtc: {
                            main: '#1350C2',
                            neon: '#0099ff',
                            dark: '#050505',
                            card: '#0f0f0f',
                            input: '#1a1a1a',
                        },
                        discord: '#5865F2',
                    },
                    animation: {
                        'border-spin': 'border-spin 4s linear infinite',
                    },
                    keyframes: {
                        'border-spin': {
                            '0%': { transform: 'rotate(0deg)' },
                            '100%': { transform: 'rotate(360deg)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #000; color: white; overflow: hidden; }
        .neon-border-box { position: relative; overflow: hidden; border-radius: 1rem; z-index: 0; }
        .neon-border-box::before {
            content: ''; position: absolute; z-index: -2; left: -50%; top: -50%; width: 200%; height: 200%;
            background-repeat: no-repeat; background-size: 50% 50%, 50% 50%;
            background-position: 0 0, 100% 0, 100% 100%, 0 100%;
            background-image: conic-gradient(transparent, transparent, transparent, #0099ff, #1350C2);
            animation: border-spin 4s linear infinite;
        }
        .neon-border-box::after {
            content: ''; position: absolute; z-index: -1; left: 2px; top: 2px;
            width: calc(100% - 4px); height: calc(100% - 4px); background: #0f0f0f; border-radius: 0.9rem;
        }
        input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 30px #1a1a1a inset !important;
            -webkit-text-fill-color: white !important;
        }
    </style>
</head>
<body class="h-screen w-full flex items-center justify-center relative">

    <!-- 1. FONDO -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=2070&auto=format&fit=crop" alt="Fondo" class="w-full h-full object-cover blur-[6px] scale-105 opacity-60">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
    </div>

    <!-- 2. TARJETA DE LOGIN -->
    <div class="w-full max-w-md px-4 relative z-10">
        <div class="neon-border-box p-[3px] shadow-2xl shadow-vtc-main/20">
            <div class="relative bg-vtc-card rounded-xl p-8 sm:p-10 flex flex-col gap-6">
                
                <!-- Header -->
                <div class="text-center space-y-2">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-vtc-main/10 border border-vtc-main/30 mb-4 shadow-[0_0_15px_rgba(19,80,194,0.3)] overflow-hidden p-1">
                        <img src="https://i.imgur.com/hLucV8D.png" alt="Logística Norte Logo" class="w-full h-full object-contain">
                    </div>
                    <h1 class="font-display text-2xl font-bold tracking-wider text-white drop-shadow-md">
                        LOGÍSTICA NORTE <span class="text-vtc-neon">VTC</span>
                    </h1>
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-400 uppercase">Acceso de Conductores</p>
                </div>

                <!-- Formulario -->
                <form id="loginForm" class="space-y-5 mt-2">
                    
                    <!-- Mensaje de Estado UI -->
                    <div id="statusMessage" class="hidden p-3 rounded bg-red-500/10 border border-red-500/30 text-red-400 text-sm flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        <span id="statusText">Error message</span>
                    </div>

                    <!-- Inputs -->
                    <div class="group relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 transition-colors duration-300 group-focus-within:text-vtc-neon"><i data-lucide="user" class="w-5 h-5"></i></div>
                        <input type="text" id="username" placeholder="Nombre de Usuario / ID" class="w-full bg-vtc-input text-white pl-12 pr-4 py-3.5 rounded-lg border border-gray-800 outline-none focus:border-vtc-neon focus:ring-1 focus:ring-vtc-neon transition-all duration-300 placeholder-gray-600" autocomplete="off">
                    </div>

                    <div class="group relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 transition-colors duration-300 group-focus-within:text-vtc-neon"><i data-lucide="lock" class="w-5 h-5"></i></div>
                        <input type="password" id="password" placeholder="Contraseña" class="w-full bg-vtc-input text-white pl-12 pr-4 py-3.5 rounded-lg border border-gray-800 outline-none focus:border-vtc-neon focus:ring-1 focus:ring-vtc-neon transition-all duration-300 placeholder-gray-600">
                    </div>

                    <div class="flex justify-between items-center text-xs text-gray-400">
                        <label class="flex items-center gap-2 cursor-pointer hover:text-white transition-colors">
                            <input type="checkbox" class="rounded bg-vtc-input border-gray-700 text-vtc-main focus:ring-0"> Recordarme
                        </label>
                        <a href="#" class="hover:text-vtc-neon transition-colors">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" id="loginBtn" class="w-full bg-vtc-main hover:bg-blue-700 text-white font-bold py-3.5 rounded-lg shadow-[0_4px_14px_0_rgba(19,80,194,0.39)] hover:shadow-[0_6px_20px_rgba(19,80,194,0.23)] hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2 group">
                        <span>INICIAR SESIÓN</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-gray-800"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-500 text-xs uppercase tracking-widest">Conexión Rápida</span>
                    <div class="flex-grow border-t border-gray-800"></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 bg-[#2f3136] hover:bg-discord text-white py-2.5 rounded-lg border border-gray-800 hover:border-discord transition-all duration-300 group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.419-2.1568 2.419zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.419-2.1568 2.419z"/></svg>
                        <span class="text-sm font-medium">Discord</span>
                    </button>
                    <button class="flex items-center justify-center gap-2 bg-[#2f3136] hover:bg-gray-700 text-white py-2.5 rounded-lg border border-gray-800 hover:border-gray-600 transition-all duration-300 group">
                        <i data-lucide="truck" class="w-5 h-5 text-gray-400 group-hover:text-red-500 transition-colors"></i>
                        <span class="text-sm font-medium">TruckersMP</span>
                    </button>
                </div>
                
                <p class="text-center text-[10px] text-gray-600">
                    &copy; 2024 Logística Norte VTC. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>

    <!-- 3. LÓGICA DE BASE DE DATOS (Firebase) -->
    <script type="module">
        // Importar Firebase SDK (Versión Modular v9+)
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-app.js";
        import { getFirestore, collection, query, where, getDocs } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-firestore.js";

        // --- CONFIGURACIÓN ---
        // ¡REEMPLAZA ESTO CON TU CONFIGURACIÓN REAL DE FIREBASE!
        const firebaseConfig = {
            apiKey: "TU_API_KEY",
            authDomain: "tu-proyecto.firebaseapp.com",
            projectId: "tu-proyecto",
            storageBucket: "tu-proyecto.appspot.com",
            messagingSenderId: "123456789",
            appId: "1:123456789:web:abc123456"
        };

        // Inicializar Firebase
        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        // Inicializar Iconos UI
        lucide.createIcons();

        // Elementos del DOM
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const statusMessage = document.getElementById('statusMessage');
        const statusText = document.getElementById('statusText');
        const btnTextSpan = loginBtn.querySelector('span');
        const btnIcon = loginBtn.querySelector('i');

        // Listener del formulario
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // 1. Obtener datos
            const user = usernameInput.value.trim();
            const pass = passwordInput.value.trim();

            // 2. Validaciones básicas
            if (!user || !pass) {
                showStatus('Por favor, completa usuario y contraseña.', 'error');
                return;
            }

            // 3. Estado de carga
            setLoading(true);
            hideStatus();

            try {
                // 4. CONSULTA A LA BASE DE DATOS (Firestore)
                // Buscamos en la colección 'users' donde 'username' coincida
                const q = query(collection(db, "users"), where("username", "==", user));
                const querySnapshot = await getDocs(q);

                if (querySnapshot.empty) {
                    // Usuario no encontrado
                    throw new Error("Usuario no encontrado.");
                }

                // Obtener el primer documento encontrado
                const userDoc = querySnapshot.docs[0].data();

                // 5. Verificar Contraseña (Simulación frontend - En producción usar Auth o Hash)
                if (userDoc.password === pass) {
                    // LOGIN EXITOSO
                    showStatus(`¡Bienvenido, ${userDoc.name || user}!`, 'success');
                    
                    // Guardar sesión (opcional)
                    localStorage.setItem('currentUser', JSON.stringify(userDoc));
                    
                    // Redireccionar (Simulado)
                    setTimeout(() => {
                        window.location.href = '/dashboard.html'; // Cambia esto a tu ruta real
                    }, 1500);

                } else {
                    // Contraseña incorrecta
                    throw new Error("Contraseña incorrecta.");
                }

            } catch (error) {
                // Manejo de errores
                console.error("Error de login:", error);
                showStatus(error.message || "Error al conectar con el servidor.", 'error');
                
                // Efecto de vibración visual
                loginForm.parentElement.classList.add('animate-[pulse_0.2s_ease-in-out_3]');
                setTimeout(() => loginForm.parentElement.classList.remove('animate-[pulse_0.2s_ease-in-out_3]'), 600);
            } finally {
                setLoading(false);
            }
        });

        // --- Funciones de UI ---

        function setLoading(isLoading) {
            if (isLoading) {
                loginBtn.disabled = true;
                loginBtn.classList.add('opacity-80', 'cursor-not-allowed');
                btnTextSpan.textContent = 'VERIFICANDO...';
                btnIcon.setAttribute('data-lucide', 'loader-2');
                btnIcon.classList.add('animate-spin');
            } else {
                loginBtn.disabled = false;
                loginBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                btnTextSpan.textContent = 'INICIAR SESIÓN';
                btnIcon.setAttribute('data-lucide', 'arrow-right');
                btnIcon.classList.remove('animate-spin');
            }
            lucide.createIcons();
        }

        function showStatus(message, type) {
            statusMessage.classList.remove('hidden', 'bg-red-500/10', 'border-red-500/30', 'text-red-400', 'bg-green-500/10', 'border-green-500/30', 'text-green-400');
            const icon = statusMessage.querySelector('i');
            
            statusText.textContent = message;

            if (type === 'error') {
                statusMessage.classList.add('bg-red-500/10', 'border-red-500/30', 'text-red-400');
                icon.setAttribute('data-lucide', 'alert-triangle');
                
                // ALERTA DE NAVEGADOR (Como pediste)
                // alert("Error: " + message); 
            } else {
                statusMessage.classList.add('bg-green-500/10', 'border-green-500/30', 'text-green-400');
                icon.setAttribute('data-lucide', 'check-circle');
            }
            
            statusMessage.classList.remove('hidden');
            lucide.createIcons();
        }

        function hideStatus() {
            statusMessage.classList.add('hidden');
        }
    </script>
</body>
</html>