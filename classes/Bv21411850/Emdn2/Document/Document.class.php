<?php
namespace Bv21411850\Emdn2\Document;

/**
 * Caractéristiques des documents
 *
 * @class  Document
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class Document implements DocumentInterface
{
    /**
     * Id du document
     *
     * @var int
     */
    protected $id;

    /**
     * Date de création du document
     *
     * @var date
     */
    protected $dateCreation;

    /**
     * Constructeur
     *
     * @param array $data Tableau de données du document.
     *
     * @return void
     */
    protected function __construct($data = array())
    {
        $this->id = (int) $data['id'];
        $this->dateCreation = $data['dateCreation'];
    }

    /**
     * Accesseur pour l'Id du document
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * Mutateur pour l'Id du document
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Accesseur pour la date de création du document
     *
     * @return date
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Mutateur pour la date de création du document
     *
     * @return void
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }
}
