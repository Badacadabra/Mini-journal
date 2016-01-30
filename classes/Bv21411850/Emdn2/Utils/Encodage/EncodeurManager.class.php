<?php
namespace Bv21411850\Emdn2\Utils\Encodage;

/**
 * Gestionnaire des encodeurs
 *
 * @class  EncodeurManager
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class EncodeurManager
{
    /**
     * Tableau des encodeurs
     *
     * @var array
     */
    protected $encodeurs;
    
    /**
     * Constructeur
     *
     * @return void
     */
    public function __construct()
    {
        $this->encodeurs = array();
    }
    
    /**
     * Ajouter un encodeur au tableau des encodeurs
     *
     * @param  string $encodeur Nom de l'encodeur.
     * @return void
     */
    public function ajouter($encodeur)
    {
        $this->encodeurs[] = $encodeur;
    }
    
    /**
     * Encoder une chaîne de caractères avec des encodeurs sélectionnés au préalable
     *
     * @param  string $chaine Chaîne de caractères à valider.
     * @return string
     */
    public function encoder($chaine)
    {
        $data = $chaine;
        foreach ($this->encodeurs as $encodeur) {
            $data = $encodeur::encoder($data);
        }
        return $data;
    }
}
