<?php
namespace Bv21411850\Emdn2\Controller;

/**
 * Abstraction des contrôleurs de classe
 *
 * @class  ClassController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class AbstractController
{
    /**
     * Requête HTTP
     *
     * @var object
     */
    protected $request;

    /**
     * Réponse HTTP
     *
     * @var object
     */
    protected $response;

    /**
     * Constructeur
     *
     * @param object $request  Objet requête.
     * @param object $response Objet réponse.
     * @return void
     */
    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
