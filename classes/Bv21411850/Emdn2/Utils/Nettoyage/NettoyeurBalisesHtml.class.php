<?php
namespace Bv21411850\Emdn2\Utils\Nettoyage;

/**
 * Nettoyeur de balises HTML
 *
 * @class  NettoyeurBalisesHtml
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class NettoyeurBalisesHtml
{
    /**
     * Nettoyer les balises HTML dans un tableau passé en paramètre
     *
     * @param  array $tableau Tableau à traiter.
     * @return array
     */
    public static function nettoyer(& $tableau)
    {
        $data = array();
        foreach ($tableau as $cle => $valeur) {
            if ($cle !== "chapo" && $cle !== "contenu") {
                $data[$cle] = strip_tags($valeur);
            } else {
                $data[$cle] = strip_tags($valeur, '<p><a><em><strong>');
            }
        }
        return $data;
    }
}
