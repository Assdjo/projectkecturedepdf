<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCsrfToken
{
    /**
     * Liste des URI qui doivent être exemptées de la protection CSRF.
     *
     * @var array
     */
    protected $except = [
        // Ajouter ici des routes à exclure de la vérification CSRF, si nécessaire
    ];

    /**
     * Gère la requête entrante.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Si la requête est de type POST, PUT, PATCH ou DELETE, vérifie le token CSRF
        if ($this->isCsrfProtectionRequired($request) && !$this->tokensMatch($request)) {
            // Retourne une erreur 419 si le token CSRF est manquant ou invalide
            return response()->json(['message' => 'CSRF token mismatch'], 419); // 419 est le code d'erreur pour CSRF
        }

        return $next($request);
    }

    /**
     * Vérifie si la protection CSRF est requise pour cette requête.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function isCsrfProtectionRequired(Request $request)
    {
        // On applique la protection CSRF uniquement sur certaines méthodes (POST, PUT, PATCH, DELETE)
        return in_array($request->getMethod(), ['POST', 'PUT', 'PATCH', 'DELETE']);
    }

    /**
     * Vérifie si le token CSRF correspond.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function tokensMatch(Request $request)
    {
        // Vérifie si le token CSRF dans l'en-tête ou dans le corps de la requête correspond à celui stocké dans la session
        $token = $request->header('X-XSRF-TOKEN') ?? $request->input('_token');
        return $token && hash_equals($request->session()->token(), $token);
    }
}
