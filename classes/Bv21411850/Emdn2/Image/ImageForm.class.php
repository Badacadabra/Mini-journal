<?php
namespace Bv21411850\Emdn2\Image;

use Bv21411850\Emdn2\Document\DocumentForm;

/**
 * Formulaire pour l'ajout et la modification d'images
 *
 * @class  ImageForm
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ImageForm extends DocumentForm
{
    /**
     * Constructeur
     *
     * @param Image $image Objet image.
     * @return void
     */
    public function __construct(Image $image)
    {
        parent::__construct($image);
    }
}
