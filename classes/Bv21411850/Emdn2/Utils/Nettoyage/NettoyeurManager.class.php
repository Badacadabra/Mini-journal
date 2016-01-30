<?php
namespace Bv21411850\Emdn2\Utils\Nettoyage;

/**
 * Gestionnaire des nettoyeurs de formulaire
 *
 * @class  NettoyeurManager
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class NettoyeurManager
{
    /**
     * Tableau des nettoyeurs
     *
     * @var array
     */
    protected $nettoyeurs;
    
    /**
     * Constructeur
     *
     * @return void
     */
    public function __construct()
    {
        $this->nettoyeurs = array();
    }
    
    /**
     * Ajouter un nettoyeur au tableau des nettoyeurs
     *
     * @param  string $nettoyeur Nom du nettoyeur.
     * @return void
     */
    public function ajouter($nettoyeur)
    {
        $this->nettoyeurs[] = $nettoyeur;
    }
    
    /**
     * Nettoyer une chaîne de caractères avec des nettoyeurs sélectionnés au préalable
     *
     * @param  array $tableau Tableau à nettoyer.
     * @return array
     */
    public function nettoyer($tableau)
    {
        $data = $tableau;
        foreach ($this->nettoyeurs as $nettoyeur) {
            $data = $nettoyeur::nettoyer($data);
        }
        return $data;
    }
}
