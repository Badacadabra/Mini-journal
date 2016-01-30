<?php
namespace Bv21411850\Emdn2\Auth;

/**
 * Affichage formaté (HTML) des informations relatives à l'authentification
 *
 * @class  AuthHtml
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class AuthHtml
{
    /**
    * Afficher les informations de connexion (avec un lien pour quitter)
    *
    * @return string
    */
    public static function afficherInformationsConnexion()
    {
        $auth = AuthManager::getInstance();
        $authInfos = "<div id=\"boxMembre\">\n";
        $authInfos .= "<div id=\"infosConnexion\">\n";
        $authInfos .= "{$auth->getPrenom()} {$auth->getNom()}<br />\n";
        $authInfos .= "Vous êtes {$auth->getStatut()}\n";
        $authInfos .= "</div>\n";
        $authInfos .= "<div id=\"quitter\">\n";
        $authInfos .= "<a href=\"index.php?t=auth&amp;a=quitter\">Quitter</a>\n";
        $authInfos .= "</div>\n";
        $authInfos .= "</div>\n";
        return $authInfos;
    }

    /**
    * Afficher le formulaire de connexion
    *
    * @param string $urlAction URL de l'action.
    * @return string
    */
    public static function afficherFormulaireConnexion($urlAction)
    {
        $nameLogin = AuthManager::LOGIN_KEYWORD;
        $namePwd = AuthManager::PWD_KEYWORD;

        $authInfos = <<<EOT
        <form id="login" action="{$urlAction}" method="post">
        <div>
        <input type="text" id="authlogin" name="{$nameLogin}" value="" size="8" placeholder="Login" /><br />
        <input type="password" id="authpwd" name="{$namePwd}" value="" size="8" placeholder="Mot de passe" /><br />
        <input type="submit" name="envoi" value="Login" />
        </div>
        </form>
EOT;

        return $authInfos;
    }
}
