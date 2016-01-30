<?php
namespace Bv21411850\Emdn2\Utils\Validation;

/**
 * Validateur des valeurs non vides
 *
 * @class  ValidateurEmpty
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ValidateurEmpty
{
    /**
     * Valider les valeurs non vides d'un tableau et retourner les erreurs
     *
     * @param  array $tableau Tableau à valider.
     * @return array
     */
    public static function valider($tableau)
    {
        $erreurs = array();
        foreach ($tableau as $cle => $valeur) {
            if (empty($valeur)
            && $cle !== 'chapo'
            && $cle !== 'id'
            && $cle !== 'imageFlickr'
            && $cle !== 'urlFichier') {
                $erreurs[$cle] = "Le champ \"" . $cle . "\" ne doit pas être vide.";
            }
        }
        return $erreurs;
    }
}
