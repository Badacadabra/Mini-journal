<?php
namespace Bv21411850\Emdn2\Image;

use Bv21411850\Emdn2\Document\Document;

/**
 * Caractéristiques des images
 *
 * @class  Image
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Image extends Document
{
    /**
     * Id de l'article
     *
     * @var int
     */
    protected $idArticle;

    /**
     * Chemin de l'image
     *
     * @var string
     */
    protected $cheminImage;

    /**
     * Titre de l'image
     *
     * @var string
     */
    protected $titre;

    /**
     * Auteur de l'image
     *
     * @var string
     */
    protected $auteur;

    /**
     * Droits de l'image
     *
     * @var string
     */
    protected $droits;

    /**
     * Constructeur
     *
     * @param array $data Tableau des données de l'image.
     *
     * @return void
     */
    protected function __construct($data = array())
    {
        $this->idArticle = (int) $data['idArticle'];
        $this->cheminImage = $data['cheminImage'];
        $this->titre = $data['titre'];
        $this->auteur = $data['auteur'];
        $this->droits = $data['droits'];
        parent::__construct($data);
    }

    /**
     * Initialisation de l'objet Image (Factory)
     *
     * @param array $rawData Tableau des données de l'image.
     *
     * @return object
     */
    public static function initialize($rawData = array())
    {
        $data = array();
        if (isset($rawData['id']) && (trim($rawData['id']) != '')) {
            $data['id'] =  (int) $rawData['id'];
        } else {
            $data['id'] = null;
        }
        $data['idArticle'] = isset($rawData['idArticle']) ? $rawData['idArticle'] : '';
        $data['cheminImage'] = isset($rawData['cheminImage']) ? $rawData['cheminImage'] : '';
        $data['titre'] = isset($rawData['titre']) ? trim($rawData['titre']) : '';
        $data['auteur'] = isset($rawData['auteur']) ? trim($rawData['auteur']) : '';
        $data['droits'] = isset($rawData['droits']) ? trim($rawData['droits']) : 'Domaine Public';
        if (isset($rawData['dateCreation'])) {
            $data['dateCreation'] = $rawData['dateCreation'];
        } else {
            $data['dateCreation'] = date('');
        }
        return new self($data);
    }

    /**
     * Accesseur pour l'Id de l'article
     *
     * @return int
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

     /**
     * Mutateur pour l'Id de l'article
     *
     * @return void
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }

    /**
     * Accesseur pour le chemin de l'image
     *
     * @return int
     */
    public function getCheminImage()
    {
        return $this->cheminImage;
    }

     /**
     * Mutateur pour le chemin de l'image
     *
     * @return void
     */
    public function setCheminImage($cheminImage)
    {
        $this->cheminImage = $cheminImage;
    }

    /**
     * Accesseur pour le titre de l'image
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Mutateur pour le titre de l'image
     *
     * @return void
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Accesseur pour l'auteur de l'image
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Mutateur pour l'auteur de l'image
     *
     * @return void
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * Accesseur pour les droits de l'image
     *
     * @return string
     */
    public function getDroits()
    {
        return $this->droits;
    }

    /**
     * Mutateur pour les droits de l'image
     *
     * @return void
     */
    public function setDroits($droits)
    {
        $this->droits = $droits;
    }
}
