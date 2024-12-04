<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
    <title>@yield("title")</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-head.tinymce-config/>    
    <!-- <script src="https://cdn.tiny.cloud/1/yeuxhwnb5xizkw9e6zb5ub8iik7493bjx7f5cww8ikjj3h60/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: currentColor;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease-out;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .mobile-menu {
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-r bg-slate-700 min-h-screen text-white">

    <nav class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-indigo-800 dark:text-white transition-colors duration-300">
               Pablo Escobar
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('articles') }}"
                    class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Voir
                    les articles</a>
                @guest
                    <a href="{{ route('register') }}"
                        class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Créer
                        un compte</a>
                    <a href="{{ route('login') }}"
                        class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Login</a>
                @endguest
                @auth
                    <a href="/create/article/redact"
                        class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">rediger
                        un article</a>
                    <a href="/create/article/upload"
                        class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Upload
                        un article</a>
                    <a href="{{ route('profile') }}"
                        class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Votre
                        profil</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <input type="submit" value="Se déconnecter"
                            class="nav-link text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">
                    </form>
                @endauth
            </div>
            <div>
                @include("articles.search")
            </div>
            <!-- Dark Mode Toggle and Mobile Menu Button -->
            <div class="hidden md:flex items-center space-x-4">
                <button id="darkModeToggle"
                    class="text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white focus:outline-none transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton"
                class="md:hidden text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white focus:outline-none transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="mobile-menu md:hidden bg-white dark:bg-gray-800 shadow-lg absolute w-full left-0 transform -translate-y-full opacity-0">
            <div class="container mx-auto px-4 py-4 space-y-4">
                <a href="{{ route('articles') }}"
                    class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Voir
                    les articles</a>
                @guest
                    <a href="{{ route('register') }}"
                        class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Créer
                        un compte</a>
                    <a href="{{ route('login') }}"
                        class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Login</a>
                @endguest
                @auth
                    <a href="/create/article/redact"
                        class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Ajoutez
                        un article</a>
                    <a href="/create/article/upload"
                        class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Upload
                        un article</a>
                    <a href="{{ route('profile') }}"
                        class="block text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">Votre
                        profil</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block w-full">
                        @csrf
                        <input type="submit" value="Se déconnecter"
                            class="block w-full text-gray-700 dark:text-gray-200 hover:text-indigo-800 dark:hover:text-white transition-colors duration-300">
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield("content")

    </main>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        let isDarkMode = false;
        let isMobileMenuOpen = false;

        function toggleDarkMode() {
            isDarkMode = !isDarkMode;
            document.documentElement.classList.toggle('dark');
            updateDarkModeIcon();
        }

        function updateDarkModeIcon() {
            darkModeToggle.innerHTML = isDarkMode
                ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>';
        }

        function toggleMobileMenu() {
            isMobileMenuOpen = !isMobileMenuOpen;
            if (isMobileMenuOpen) {
                mobileMenu.classList.remove('-translate-y-full', 'opacity-0');
                mobileMenu.classList.add('translate-y-0', 'opacity-100');
            } else {
                mobileMenu.classList.remove('translate-y-0', 'opacity-100');
                mobileMenu.classList.add('-translate-y-full', 'opacity-0');
            }
        }

        darkModeToggle.addEventListener('click', toggleDarkMode);
        mobileMenuButton.addEventListener('click', toggleMobileMenu);

        // Add fade-in animation to nav links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach((link, index) => {
            link.classList.add('animate-fade-in');
            link.style.animationDelay = `${index * 0.1}s`;
        });
    </script>
    <script type="module" src="{{ mix('resources/js/app.js') }}"></script>
</body>

</html>