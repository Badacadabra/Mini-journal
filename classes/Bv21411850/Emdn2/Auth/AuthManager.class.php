<?php
namespace Bv21411850\Emdn2\Auth;

use Bv21411850\Emdn2\Utils\Bd\ConnexionBd as ConnexionBd;

/**
 * Gestionnaire d'authentification
 *
 * @class  AuthManager
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class AuthManager
{
    /**
     * Mot-clé associé à l'identifiant
     */
    const LOGIN_KEYWORD = 'login';

    /**
     * Mot-clé associé au mot de passe
     */
    const PWD_KEYWORD = 'pass';

    /**
     * Porteur de l'instance d'authentification
     *
     * @var object
     */
    protected static $auth = null;

    /**
     * Tableau contenant les informations d'authentification
     *
     * @var array
     */
    protected $infosAuthentification = array();

    /**
     * Constructeur privé (Singleton)
     */
    private function __construct()
    {
        if (isset($_SESSION['infosAuthentification'])) {
            $this->infosAuthentification = $_SESSION['infosAuthentification'];
        } else {
            $this->infosAuthentification = array();
        }
    }

    /**
    * Méthode pour accéder à l'unique instance de la classe.
    *
    * @return object
    */
    public static function getInstance()
    {
        if (null === self::$auth) {
            self::$auth = new self();
        }
        return self::$auth;
    }

    /**
     * Méthode pour tester si l'utilisateur est connecté ou non
     *
     * @return bool
     */
    public function estConnecte()
    {
        return !empty($this->infosAuthentification);
    }

    /**
    * Vérification de l'authentification
    * Le couple login / mot de passe existe-t-il ? Est-il correct ?
    *
    * @param string $login Login de l'utilisateur.
    * @param string $pass  Mot de passe de l'utilisateur.
    * @return void
    */
    public function verifierAuthentification($login, $pass)
    {
        if (!empty($login) && !empty($pass)) {
            $connexion = ConnexionBd::getInstance()->getConnexion();
            $requete = 'SELECT * FROM user WHERE login = :login AND pass = :pass';
            $stmt = $connexion->prepare($requete);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':pass', $pass);
            $stmt->execute();
            // Y a-t-il des résultats (login et mot de passe) ?
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($data === false) {
                throw new AuthException('Login ou mot de passe erroné');
            }
            $this->infosAuthentification = $data;
            $this->synchroniser();
        }
    }

    /**
    * Déconnexion de l'utilisateur
    *
    * @return void
    */
    public function quitter()
    {
        $this->infosAuthentification = array();
        $this->synchroniser();
    }

    /**
    * Synchronisation des infos de $this->infosAuthentification avec $_SESSION
    *
    * @return void
    */
    public function synchroniser()
    {
        $_SESSION['infosAuthentification'] = $this->infosAuthentification;
    }

    /**
     * Accesseur pour les informations d'authentification
     *
     * @return array
     */
    public function getInfosAuthentification()
    {
        return $this->infosAuthentification;
    }

    /**
    * Mutateur pour les informations d'authentification
    *
    * @return void
    */
    public function setInfosAuthentification($infosAuthentification)
    {
        $this->infosAuthentification = $infosAuthentification;
    }

    /**
    * Accesseur pour l'id de l'utilisateur
    *
    * @return int
    */
    public function getId()
    {
        return $this->infosAuthentification['id'];
    }

    /**
    * Accesseur pour le login de l'utilisateur
    *
    * @return string
    */
    public function getLogin()
    {
        return $this->infosAuthentification['login'];
    }

    /**
    * Accesseur pour le nom de l'utilisateur
    *
    * @return string
    */
    public function getNom()
    {
        return $this->infosAuthentification['nom'];
    }

    /**
    * Accesseur pour le prénom de l'utilisateur
    *
    * @return string
    */
    public function getPrenom()
    {
        return $this->infosAuthentification['prenom'];
    }

    /**
    * Accesseur pour le statut de l'utilisateur
    *
    * @return string
    */
    public function getStatut()
    {
        return isset($this->infosAuthentification['statut']) ? $this->infosAuthentification['statut'] : '';
    }
}
