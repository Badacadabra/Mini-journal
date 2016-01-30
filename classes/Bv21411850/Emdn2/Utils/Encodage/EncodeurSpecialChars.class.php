<?php
namespace Bv21411850\Emdn2\Utils\Encodage;

/**
 * Encodeur de caractères spéciaux
 *
 * @class  EncodeurSpecialChars
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class EncodeurSpecialChars
{
    /**
     * Remplacer les caractères spéciaux par des entités HTML
     *
     * @param  string $chaine Chaîne de caractères à traiter.
     * @return string
     */
    public static function encoder(& $chaine)
    {
        $data = htmlspecialchars($chaine, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return $data;
    }
}
