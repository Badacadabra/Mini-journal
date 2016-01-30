<?php
namespace Bv21411850\Emdn2\Auth;

use Bv21411850\Emdn2\Controller\AbstractController;

/**
 * Contrôleur d'authentification
 *
 * @class  AuthController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class AuthController extends AbstractController
{
    /**
     * Déconnecter l'utilisateur
     *
     * @return void
     */
    public function quitter()
    {
        AuthManager::getInstance()->quitter();
        // HTML
        $titre = "Déconnexion réussie";
        $contenu = "<p>Vous êtes maintenant déconnecté !</p>";
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Connecter l'utilisateur
     *
     * @return void
     */
    public function connexion()
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        // On vérifie la connexion
        AuthManager::getInstance()->verifierAuthentification($login, $pass);
        // HTML
        $titre = "Connexion réussie";
        $contenu = "<p>Vous êtes maintenant connecté !</p>";
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }
}
