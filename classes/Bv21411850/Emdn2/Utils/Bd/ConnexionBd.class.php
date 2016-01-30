<?php
namespace Bv21411850\Emdn2\Utils\Bd;

/**
 * Connexion à la base de données (Singleton)
 *
 * @class  ConnexionBd
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ConnexionBd
{
    /**
    * Instance de connexion à la base de données
    *
    * @var object
    */
    private static $instance;

    /**
    * Propriété contenant le lien de connexion à la base de données
    *
    * @var object
    */
    protected $connexion;

    /**
    * Constructeur privé qui initialise la connexion (Singleton)
    *
    * @return void
    */
    private function __construct()
    {
        // Réglages de la connexion
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
        );
        // Création d'un objet PDO avec les constantes définies dans la config
        $this->connexion = new \PDO(PDO_DSN, PDO_USER, PDO_PASSWORD, $options);
    }

    /**
    * Méthode pour accéder à l'unique instance de la classe.
    *
    * @return L'instance du singleton
    */
    public static function getInstance()
    {
        if (! (self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
    * Accesseur pour la connexion
    *
    * @return L'objet PDO à utiliser pour exécuter les requêtes.
    */
    public function getConnexion()
    {
        return $this->connexion;
    }
}
