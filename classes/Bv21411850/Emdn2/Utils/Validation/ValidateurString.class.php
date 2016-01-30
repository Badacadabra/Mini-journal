<?php
namespace Bv21411850\Emdn2\Utils\Validation;

/**
 * Validateur des chaînes de caractères
 *
 * @class  ValidateurString
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ValidateurString
{
    /**
     * Valider les chaînes de caractères d'un tableau et retourner les erreurs
     *
     * @param  array $tableau Tableau à valider.
     * @return array
     */
    public static function valider($tableau)
    {
        $erreurs = array();
        foreach ($tableau as $cle => $valeur) {
            if (!is_string($valeur) && $cle !== 'id') {
                $erreurs[$cle] = "Le champ \"" . $cle . "\" doit être une chaîne de caractères.";
            }
        }
        return $erreurs;
    }
}
