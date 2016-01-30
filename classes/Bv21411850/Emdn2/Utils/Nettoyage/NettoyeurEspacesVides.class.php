<?php
namespace Bv21411850\Emdn2\Utils\Nettoyage;

/**
 * Nettoyeur d'espaces vides
 *
 * @class  NettoyeurEspacesVides
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class NettoyeurEspacesVides
{
    /**
     * Nettoyer les espaces vides dans un tableau passé en paramètre
     *
     * @param  array $tableau Tableau à traiter.
     * @return array
     */
    public static function nettoyer(& $tableau)
    {
        $data = array();
        foreach ($tableau as $cle => $valeur) {
            $data[$cle] = trim($valeur);
        }
        return $data;
    }
}
