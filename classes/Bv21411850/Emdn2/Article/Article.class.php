<?php
namespace Bv21411850\Emdn2\Article;

use Bv21411850\Emdn2\Document\Document;

/**
 * Caractéristiques des articles
 *
 * @class  Article
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Article extends Document
{
    /**
     * Titre de l'article
     *
     * @var string
     */
    protected $titre;

    /**
     * Chapô de l'article
     *
     * @var string
     */
    protected $chapo;

    /**
     * Contenu de l'article
     *
     * @var string
     */
    protected $contenu;

    /**
     * Auteur de l'article
     *
     * @var string
     */
    protected $auteur;

    /**
     * Statut de publication de l'article
     *
     * @var string
     */
    protected $statutPublication;

    /**
     * Date de publication de l'article
     *
     * @var date
     */
    protected $datePublication;

    /**
     * Constructeur
     *
     * @param array $data Tableau des données de l'article.
     *
     * @return void
     */
    protected function __construct($data = array())
    {
        $this->titre = $data['titre'];
        $this->chapo = $data['chapo'];
        $this->contenu = $data['contenu'];
        $this->auteur = $data['auteur'];
        $this->statutPublication = $data['statutPublication'];
        $this->datePublication = $data['datePublication'];
        parent::__construct($data);
    }

    /**
     * Initialisation de l'objet Article (Factory)
     *
     * @param array $rawData Tableau des données de l'article.
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
        $data['titre'] = isset($rawData['titre']) ? $rawData['titre'] : '';
        $data['chapo'] = isset($rawData['chapo']) ? $rawData['chapo'] : '';
        $data['contenu'] = isset($rawData['contenu']) ? $rawData['contenu'] : '';
        $data['auteur'] = isset($rawData['auteur']) ? $rawData['auteur'] : '';
        $data['statutPublication'] = isset($rawData['statutPublication']) ? $rawData['statutPublication'] : '';
        $data['datePublication'] = isset($rawData['datePublication']) ? $rawData['datePublication'] : '';
        if (isset($rawData['dateCreation'])) {
            $data['dateCreation'] = $rawData['dateCreation'];
        } else {
            $data['dateCreation'] = date('');
        }
        return new self($data);
    }

    /**
     * Accesseur pour le titre de l'article
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Mutateur pour le titre de l'article
     *
     * @return void
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Accesseur pour le chapô de l'article
     *
     * @return string
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Mutateur pour le chapô de l'article
     *
     * @return void
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    /**
     * Accesseur pour le contenu de l'article
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Mutateur pour le contenu de l'article
     *
     * @return void
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Accesseur pour l'auteur de l'article
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Mutateur pour l'auteur de l'article
     *
     * @return void
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * Accesseur pour le statut de publication de l'article
     *
     * @return string
     */
    public function getStatutPublication()
    {
        return $this->statutPublication;
    }

    /**
     * Mutateur pour le statut de publication de l'article
     *
     * @return void
     */
    public function setStatutPublication($statutPublication)
    {
        $this->statutPublication = $statutPublication;
    }

    /**
     * Accesseur pour la date de publication de l'article
     *
     * @return date
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Mutateur pour la date de publication de l'article
     *
     * @return void
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }
}
