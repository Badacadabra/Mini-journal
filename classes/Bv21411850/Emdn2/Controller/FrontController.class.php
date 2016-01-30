<?php
namespace Bv21411850\Emdn2\Controller;

use Bv21411850\Emdn2\Auth\AuthManager;
use Bv21411850\Emdn2\Auth\AuthHtml;
use Bv21411850\Emdn2\Auth\AuthException;

/**
 * Contrôleur frontal
 *
 * @class  FrontController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class FrontController extends AbstractController
{
    /**
     * Contrôleur de classe
     *
     * @var string
     */
    protected $controllerClass;

    /**
     * Action à exécuter
     *
     * @var string
     */
    protected $action;

    /**
     * Informations d'authentification
     *
     * @var string
     */
    protected $authInfos;

    /**
    * Constructeur
    *
    * @param object $router Objet router.
    */
    public function __construct($router)
    {
        // Contrôle de la connexion
        try {
            // Utilisateur connecté ?
            $auth = AuthManager::getInstance();
            $this->authInfos = AuthHtml::afficherFormulaireConnexion(
                'index.php?t=auth&amp;a=connexion'
            );

            if ($auth->estConnecte()) {
                $this->authInfos = AuthHtml::afficherInformationsConnexion();
            }

            $this->controllerClass = $router->getControllerClass();
            $this->action = $router->getAction();

            // La classe à instancier existe-t-elle ?
            if (!class_exists($this->controllerClass)) {
                throw new \Exception("La classe {$this->controllerClass} n'existe pas.");
            }

            // Y a-t-il une action demandée ?
            if ($this->action == 'defaut') {
                throw new \Exception("Aucune action demandée dans l'URL");
            }

            // L'action demandée existe-t-elle ?
            if (!method_exists($this->controllerClass, $this->action)) {
                throw new \Exception("L'action {$this->action} n'existe pas.");
            }

        } catch (AuthException $e) {
            $html = $e->getMessage();
        }

    }

    /**
    * Méthode pour lancer le contrôleur et exécuter l'action demandée
    *
    * @return La valeur de retour de la fonction appelée
    */
    public function run($request, $response)
    {
        $controller = new $this->controllerClass($request, $response);
        return $controller->{$this->action}();
    }

    /**
     * Accesseur pour les informations d'authentification
     *
     * @return string
     */
    public function getAuthInfos()
    {
        return $this->authInfos;
    }
}
