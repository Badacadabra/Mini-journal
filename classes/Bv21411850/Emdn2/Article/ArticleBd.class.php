<?php
namespace Bv21411850\Emdn2\Article;

use Bv21411850\Emdn2\Document\DocumentBd;

/**
 * Requêtes SQL sur la base de données, spécifiques aux articles
 *
 * @class  ArticleBd
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ArticleBd extends DocumentBd
{
    /**
     * Nom de la table dans la base de données
     */
    const TABLE_NAME = "articles";

    /**
     * Méthode renvoyant la requête à exécuter
     *
     * @return string
     */
    public static function getRequete()
    {
        $requete = ' SET titre = :titre,
                         chapo = :chapo,
                         contenu = :contenu,
                         auteur = :auteur,
                         statutPublication = :statutPublication,
                         dateCreation = NOW(),
                         datePublication = NOW()';
        return $requete;
    }

    /**
     * Méthode attribuant les bonnes valeurs aux tokens de la requête
     *
     * @return void
     */
    public static function bind($stmt, $document)
    {
        $stmt->bindValue(':titre', $document->getTitre());
        $stmt->bindValue(':chapo', $document->getChapo());
        $stmt->bindValue(':contenu', $document->getContenu());
        $stmt->bindValue(':auteur', $document->getAuteur());
        $stmt->bindValue(':statutPublication', $document->getStatutPublication());
    }
}
