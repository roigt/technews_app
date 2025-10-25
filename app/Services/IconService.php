<?php

namespace App\Services;
class IconService
{
    public static function resolveIcon(string $input): string
    {
        $clean = trim($input);

        // Si l'utilisateur a déjà mis une classe complète (fab fa-xxx)
        if (str_starts_with($clean, 'fab fa-')) {
            return $clean;
        }

        // Sinon on complète automatiquement
        return 'fab fa-' . strtolower($clean);
    }

}
