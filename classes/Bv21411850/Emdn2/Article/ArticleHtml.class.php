<?php
namespace Bv21411850\Emdn2\Article;

use Bv21411850\Emdn2\Utils\Encodage\EncodeurManager;
use Bv21411850\Emdn2\Document\DocumentHtml;

/**
 * Affichage formaté (HTML) des articles
 *
 * @class  ArticleHtml
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ArticleHtml extends DocumentHtml
{
    /**
     * Constructeur
     *
     * @param Article         $article  Objet article.
     * @param EncodeurManager $encodeur Objet encodeur.
     *
     * @return void
     */
    public function __construct(Article $article, EncodeurManager $encodeur)
    {
        parent::__construct($article, $encodeur);
    }

    /**
     * Affichage de la liste des documents
     *
     * @return string
     */
    public function afficherListe()
    {
        $html = "<div class=\"item\">\n";
        $html .= "<a href=\"index.php?id={$this->document->getId()}&amp;";
        $html .= "t=article&amp;a=voirDetails\">\n";
        $html .= "<h3>" . $this->encodeur->encoder($this->document->getTitre());
        $html .= "</h3></a>\n";
        $html .= "</div>\n";
        return $html;
    }

    /**
     * Affichage des détails d'un document
     *
     * @return string
     */
    public function afficherDetails()
    {
        $html = "<h2>" . $this->encodeur->encoder($this->document->getTitre()) . "</h2>\n";
        $html .= "<div class=\"auteurs\">\n";
        $html .= "<p>Auteur : " . $this->encodeur->encoder($this->document->getAuteur());
        $html .= "</p></div>\n";
        $html .= "<a href=\"index.php?t=article&amp;a=acheter\" class=\"highlightLink\">";
        $html .= "Acheter l'article ?</a><hr/>\n";
        $html .= "<div class=\"chapos\">{$this->document->getChapo()}</div>\n";
        $html .= "<div class=\"contenus\">{$this->document->getContenu()}</div>\n";
        $html .= "<a class=\"highlightLink\" href=\"index.php?t=article&amp;a=voirListe\">";
        $html .= "&lt; Retour à la liste des articles</a><br/>\n";
        return $html;
    }

    /**
     * Affichage des options (privilèges)
     *
     * @return string
     */
    public function afficherOptions()
    {
        $html = "<div class=\"options\">\n";
        $html .= "<a class=\"more\" href=\"index.php?";
        $html .= "id={$this->document->getId()}&amp;t=article&amp;a=modifier\">Modifier</a> - ";
        $html .= "<a class=\"more\" href=\"index.php?";
        $html .= "id={$this->document->getId()}&amp;t=article&amp;a=supprimer\"";
        $html .= " onclick=\"return confirmerSuppression()\">Supprimer</a> - ";
        $html .= "<a class=\"more\" href=\"index.php?";
        $html .= "id={$this->document->getId()}&amp;t=image&amp;a=ajouter\">Ajouter une image</a>\n";
        $html .= "</div>\n";
        return $html;
    }
}
