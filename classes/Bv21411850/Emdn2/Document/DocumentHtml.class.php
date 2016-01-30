<?php
namespace Bv21411850\Emdn2\Document;

use Bv21411850\Emdn2\Utils\Encodage\EncodeurManager;

/**
 * Affichage formaté (HTML) des documents
 *
 * @class  DocumentHtml
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class DocumentHtml
{
    /**
     * Objet document
     *
     * @var object
     */
    protected $document;
    
    /**
     * Objet encodeur
     *
     * @var object
     */
    protected $encodeur;
    
    /**
     * Constructeur
     *
     * @param Document        $document Objet document.
     * @param EncodeurManager $encodeur Objet encodeur.
     *
     * @return void
     */
    public function __construct(Document $document, EncodeurManager $encodeur)
    {
        $this->document = $document;
        $this->encodeur = $encodeur;
    }
}
