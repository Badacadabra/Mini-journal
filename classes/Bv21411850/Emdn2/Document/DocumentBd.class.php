<?php
namespace Bv21411850\Emdn2\Document;

use Bv21411850\Emdn2\Utils\Bd\ConnexionBd as ConnexionBd;
use Bv21411850\Emdn2\Article\Article;
use Bv21411850\Emdn2\Image\Image;

/**
 * Requêtes SQL génériques sur la base de données
 *
 * @class  DocumentBd
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class DocumentBd
{
    /**
     * Lecture d'un document
     *
     * @param  int $id Id du document à lire.
     * @return Document
     */
    public static function lireDocument($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ?';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (static::TABLE_NAME == 'articles') {
            $article = Article::initialize($data);
            return $article;
        }
        if (static::TABLE_NAME == 'images') {
            $image = Image::initialize($data);
            return $image;
        }
    }

    /**
     * Lecture de la liste des documents
     *
     * @return array
     */
    public static function lireListeDocuments($idArticle = null)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        if (static::TABLE_NAME == 'articles') {
            $requete   = 'SELECT * FROM ' . static::TABLE_NAME;
            $stmt      = $connexion->query($requete);
        }
        if (static::TABLE_NAME == 'images') {
            $requete   = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE idArticle = ?';
            $stmt      = $connexion->prepare($requete);
            $stmt->bindValue(1, $idArticle);
            $stmt->execute();
        }
        $liste = array();
        while (($ligne = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            if (static::TABLE_NAME == 'articles') {
                $liste[] = Article::initialize($ligne);
            }
            if (static::TABLE_NAME == 'images') {
                $liste[] = Image::initialize($ligne);
            }
        }
        return $liste;
    }

    /**
     * Ajouter un document
     *
     * @param  Document $document Un objet document.
     * @return void
     */
    public static function ajouterDocument(Document $document)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'INSERT INTO ' . static::TABLE_NAME . static::getRequete();
        $stmt      = $connexion->prepare($requete);
        static::bind($stmt, $document);
        $stmt->execute();
    }

    /**
     * Modifier un document
     *
     * @param  Document $document Id de l'document.
     * @return void
     */
    public static function modifierDocument(Document $document)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'UPDATE ' . static::TABLE_NAME . static::getRequete() . ' WHERE id = :id';
        $stmt      = $connexion->prepare($requete);
        $stmt->bindValue(':id', $document->getId());
        static::bind($stmt, $document);
        $stmt->execute();
    }

    /**
     * Supprimer un document
     *
     * @param  int $id Id de l'document.
     * @return void
     */
    public static function supprimerDocument($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'DELETE FROM ' . static::TABLE_NAME . ' WHERE id = ?';
        $stmt      = $connexion->prepare($requete);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    /**
     * Gestion de la contrainte d'intégrité quand on supprime un article avec images
     * (On aurait pu aussi gérer ce cas avec une cascade MySQL.)
     *
     * @return void
     */
    public static function resetImages($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'DELETE FROM ' . static::TABLE_NAME . ' WHERE idArticle = ?';
        $stmt      = $connexion->prepare($requete);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
