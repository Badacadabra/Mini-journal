<?php
namespace Bv21411850\Emdn2\Http;

/**
 * Requête HTTP
 *
 * @class  Request
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Request
{
    /**
     * Paramètres de la requête
     *
     * @var array
     */
    protected $params;

    /**
     * Constructeur
     *
     * @param array $get $_GET.
     * @return void
     */
    public function __construct($get)
    {
        $this->params = $get;
    }

    /**
     * Méthode pour définir un paramètre dans l'URL
     *
     * @param string $key   Clé du paramètre dans le tableau de paramètres.
     * @param string $value Valeur du paramètre dans le tableau de paramètres.
     * @return object
     */
    public function setGetParam($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * Méthode pour récupérer un seul paramètre dans l'URL
     *
     * @param string $key Clé du paramètre dans le tableau de paramètres.
     * @return string
     */
    public function getGetParam($key)
    {
        if (!isset($this->params[$key])) {
            throw new \Exception("Le paramètre '{$key}' n'existe pas.");
        }
        return $this->params[$key];
    }

    /**
     * Méthode pour récupérer tous les paramètres dans l'URL
     *
     * @return array
     */
    public function getAllGetParams()
    {
        return $this->params;
    }
}
