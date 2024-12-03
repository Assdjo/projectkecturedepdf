@extends('layouts.Master')

@section('title')
    Login
@endsection

@section('content')
<div class="flex font-poppins items-center justify-center">
    <div class="h-screen w-screen flex justify-center items-center dark:bg-gray-900">
        <div class="grid gap-8">
            <div id="back-div" class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-[26px] m-4">
                <div class="border-[20px] border-transparent rounded-[20px] dark:bg-gray-900 bg-white shadow-lg xl:p-10 2xl:p-10 lg:p-10 md:p-10 sm:p-2 m-2">
                    <h1 class="pt-8 pb-6 font-bold dark:text-gray-400 text-5xl text-center cursor-default">
                        Log in
                    </h1>

                    <!-- Formulaire de connexion -->
                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Champ Email -->
                        <div>
                            <label for="email" class="mb-2 dark:text-gray-400 text-lg">Email</label>
                            <input
                                id="email"
                                name="email"
                                class="border p-3 dark:bg-indigo-700 dark:text-gray-300 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                                type="email"
                                placeholder="Email"
                                required
                                value="{{ old('email') }}"
                            />
                            <!-- Affichage des erreurs d'email -->
                            @error('email')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champ Mot de passe -->
                        <div>
                            <label for="password" class="mb-2 dark:text-gray-400 text-lg">Password</label>
                            <input
                                id="password"
                                name="password"
                                class="border p-3 shadow-md dark:bg-indigo-700 dark:text-gray-300 dark:border-gray-700 placeholder:text-base focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                                type="password"
                                placeholder="Password"
                                required
                            />
                            <!-- Affichage des erreurs de mot de passe -->
                            @error('password')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lien pour mot de passe oublié -->
                        <a class="group text-blue-400 transition-all duration-100 ease-in-out" href="#">
                            <span class="bg-left-bottom bg-gradient-to-r text-sm from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                                Forget your password?
                            </span>
                        </a>

                        <!-- Bouton de connexion -->
                        <button class="bg-gradient-to-r dark:text-gray-300 from-blue-500 to-purple-500 shadow-lg mt-6 p-2 text-white rounded-lg w-full hover:scale-105 hover:from-purple-500 hover:to-blue-500 transition duration-300 ease-in-out" type="submit">
                            LOG IN
                        </button>
                    </form>

                    <!-- Lien vers l'inscription -->
                    <div class="flex flex-col mt-4 items-center justify-center text-sm">
                        <h3 class="dark:text-gray-300">
                            Don't have an account?
                            <a class="group text-blue-400 transition-all duration-100 ease-in-out" href="{{ route('register') }}">
                                <span class="bg-left-bottom bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                                    Sign Up
                                </span>
                            </a>
                        </h3>
                    </div>

                    <!-- Third Party Authentication Options -->
                    <div id="third-party-auth" class="flex items-center justify-center mt-5 flex-wrap">
                        <!-- Intégration des options de login via réseaux sociaux -->
                        <button class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1">
                            <img class="max-w-[25px]" src="https://ucarecdn.com/8f25a2ba-bdcf-4ff1-b596-088f330416ef/" alt="Google">
                        </button>
                        <button class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1">
                            <img class="max-w-[25px]" src="https://ucarecdn.com/95eebb9c-85cf-4d12-942f-3c40d7044dc6/" alt="Linkedin">
                        </button>
                        <button class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1">
                            <img class="max-w-[25px] filter dark:invert" src="https://ucarecdn.com/be5b0ffd-85e8-4639-83a6-5162dfa15a16/" alt="Github">
                        </button>
                    </div>

                    <!-- Termes et Conditions -->
                    <div class="text-gray-500 flex text-center flex-col mt-4 items-center text-sm">
                        <p class="cursor-default">
                            By signing in, you agree to our
                            <a class="group text-blue-400 transition-all duration-100 ease-in-out" href="#">
                                <span class="cursor-pointer bg-left-bottom bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                                    Terms
                                </span>
                            </a> and
                            <a class="group text-blue-400 transition-all duration-100 ease-in-out" href="#">
                                <span class="cursor-pointer bg-left-bottom bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                                    Privacy Policy
                                </span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
