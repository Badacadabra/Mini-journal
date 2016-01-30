<?php
namespace Bv21411850\Emdn2\Article;

use Bv21411850\Emdn2\Document\DocumentForm;

/**
 * Formulaire pour l'ajout et la modification d'articles
 *
 * @class  ArticleForm
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ArticleForm extends DocumentForm
{
    /**
     * Constructeur
     *
     * @param Article $article Objet article.
     * @return void
     */
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }
}
