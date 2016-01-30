<?php
namespace Bv21411850\Emdn2\Utils\Acces;

use Bv21411850\Emdn2\Auth\AuthManager;

/**
 * Gestion des droits
 *
 * @class  AccessControl
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class AccessControl
{
    public static function verifierStatut($tableau)
    {
        $statut = AuthManager::getInstance()->getStatut();
        if (in_array($statut, $tableau)) {
            return true;
        } else {
            return false;
        }
    }
}
