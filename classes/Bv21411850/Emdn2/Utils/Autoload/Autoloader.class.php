<?php
namespace Bv21411850\Emdn2\Utils\Autoload;

/**
 * Auto-chargement des classes
 *
 * @class  Autoloader
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Autoloader
{
    /**
     * Constructeur
     *
     * @return void
     */
    public function __construct()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * Fonction d'auto-chargement des classes
     *
     * @param  string $className Nom de la classe à charger.
     * @return Classes chargées.
     */
    private function autoload($className)
    {
        $namespaces = explode('\\', $className);
        $path = implode('/', $namespaces);
        $fullPath = BV_DIR . $path . '.class.php';
        if (is_file($fullPath)) {
            include $fullPath;
        }
        return;
    }
}
