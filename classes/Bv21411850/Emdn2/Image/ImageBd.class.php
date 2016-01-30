<?php
namespace Bv21411850\Emdn2\Image;

use Bv21411850\Emdn2\Document\DocumentBd;

/**
 * Requêtes SQL sur la base de données, spécifiques aux images
 *
 * @class  ImageBd
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ImageBd extends DocumentBd
{
    /**
     * Nom de la table dans la base de données
     */
    const TABLE_NAME = "images";

    /**
     * Méthode renvoyant la requête à exécuter
     *
     * @return string
     */
    public static function getRequete()
    {
        $requete   = ' SET idArticle = :idArticle,
                           cheminImage = :cheminImage,
                           titre = :titre,
                           auteur = :auteur,
                           droits = :droits,
                           dateCreation = NOW()';
        return $requete;
    }

    /**
     * Méthode attribuant les bonnes valeurs aux tokens de la requête
     *
     * @return void
     */
    public static function bind($stmt, $document)
    {
        $stmt->bindValue(':idArticle', $document->getIdArticle());
        $stmt->bindValue(':cheminImage', $document->getCheminImage());
        $stmt->bindValue(':titre', $document->getTitre());
        $stmt->bindValue(':auteur', $document->getAuteur());
        $stmt->bindValue(':droits', $document->getDroits());
    }
}
