<?php
namespace Bv21411850\Emdn2\Routing;

/**
 * Router
 *
 * @class  Router
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Router
{
    /**
     * Contrôleur de classe sollicité
     *
     * @var string
     */
    protected $controllerClass;

    /**
     * Action demandée
     *
     * @var string
     */
    protected $action;

    /**
     * Analyse de la requête
     *
     * @param object $request Requête HTTP.
     * @return void
     */
    public function parseRequest($request)
    {
        // Contrôle du type de contenu + action
        $typeContenu = $request->getGetParam('t');
        $this->action = $request->getGetParam('a');

        // Récupération du contrôleur demandé
        $this->controllerClass = 'Bv21411850\Emdn2\\';
        $this->controllerClass .= ucfirst($typeContenu);
        $this->controllerClass .= '\\';
        $this->controllerClass .= ucfirst($typeContenu);
        $this->controllerClass .= 'Controller';
    }

    /**
     * Accesseur pour le contrôleur de classe sollicité
     *
     * @return string
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    /**
     * Accesseur pour l'action à exécuter
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}
