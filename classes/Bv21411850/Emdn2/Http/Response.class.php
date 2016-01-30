<?php
namespace Bv21411850\Emdn2\Http;

/**
 * Réponse HTTP
 *
 * @class  Response
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Response
{
    /**
     * Parties de HTML qui pourront être utilisées
     *
     * @var array
     */
    protected $parts;

    /**
     * Constructeur
     *
     * @param array $parts Parties de HTML qui pourront être utilisées.
     * @return void
     */
    public function __construct($parts = array())
    {
        $this->parts = $parts;
    }

    /**
    * Méthode pour ajouter une partie
    *
    * @param string $key     Clé de la nouvelle partie dans le tableau des parties.
    * @param string $content Contenu de la nouvelle partie dans le tableau des parties.
    * @return void
    */
    public function setPart($key, $content)
    {
        $this->parts[$key] = $content;
    }

    /**
     * Méthode pour récupérer une partie
     *
     * @param string $key Clé de la partie dans le tableau des parties.
     * @return void
     */
    public function getPart($key)
    {
        if (isset($this->parts[$key])) {
            return $this->parts[$key];
        } else {
            throw new \Exception("Partie {$key} non existante");
        }
    }
}
