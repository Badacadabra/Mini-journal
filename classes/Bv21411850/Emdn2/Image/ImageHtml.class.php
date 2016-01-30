<?php
namespace Bv21411850\Emdn2\Image;

use Bv21411850\Emdn2\Utils\Encodage\EncodeurManager;
use Bv21411850\Emdn2\Document\DocumentHtml;

/**
 * Affichage formaté (HTML) des images
 *
 * @class  ImageHtml
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ImageHtml extends DocumentHtml
{
    /**
     * Constructeur
     *
     * @param Image $image Objet image.
     * @param EncodeurManager $encodeur Objet encodeur.
     *
     * @return void
     */
    public function __construct(Image $image, EncodeurManager $encodeur)
    {
        parent::__construct($image, $encodeur);
    }

    /**
     * Afficher une image en HTML
     *
     * @return string
     */
    public function afficherImage($auth)
    {
        $html = "<div class=\"container-image\">\n";
        if ($auth->estConnecte()) {
            $html .= "<a class=\"options-image\" href=\"index.php?";
            $html .= "id={$this->document->getId()}&amp;t=image&amp;a=modifier\" title=\"Modifier\">";
            $html .= "<img src=\"ui/images/icone_modifier.png\" alt=\"\" /></a> ";
            $html .= "<a class=\"options-image\" href=\"index.php?";
            $html .= "id={$this->document->getId()}&amp;t=image&amp;a=supprimer\"";
            $html .= " onclick=\"return confirmerSuppression()\" title=\"Supprimer\">";
            $html .= "<img src=\"ui/images/icone_supprimer.png\" alt=\"\" /></a>\n";
        }
        $html .= "<figure>\n";
        $html .= "<img src=\"{$this->document->getCheminImage()}\" alt=\"{$this->document->getTitre()}\" />\n";
        $html .= "<figcaption>{$this->document->getTitre()}</figcaption>\n";
        $html .= "</figure>\n";
        $html .= "<div class=\"infos\">\n";
        $html .= "<p>Auteur : {$this->document->getAuteur()}</p>\n";
        $html .= "<p>Droits : {$this->document->getDroits()}</p>\n";
        $html .= "</div>\n";
        $html .= "</div>\n";
        return $html;
    }
}
