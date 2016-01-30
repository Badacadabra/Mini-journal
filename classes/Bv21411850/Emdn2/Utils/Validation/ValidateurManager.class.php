<?php
namespace Bv21411850\Emdn2\Utils\Validation;

/**
 * Gestionnaire des validateurs de formulaire
 *
 * @class  ValidateurManager
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ValidateurManager
{
    /**
     * Tableau des validateurs
     *
     * @var array
     */
    protected $validateurs;
    
    /**
     * Tableau des erreurs
     *
     * @var array
     */
    protected $erreurs;
    
    /**
     * Constructeur
     *
     * @return void
     */
    public function __construct()
    {
        $this->validateurs = array();
        $this->erreurs = array();
    }
    
    /**
     * Ajouter un validateur au tableau des validateurs
     *
     * @param  string $validateur Nom du validateur.
     * @return void
     */
    public function ajouter($validateur)
    {
        $this->validateurs[] = $validateur;
    }
    
    /**
     * Valider un tableau avec des validateurs sélectionnés au préalable
     *
     * @param  array $tableau Tableau à valider.
     * @return bool
     */
    public function valider($tableau)
    {
        foreach ($this->validateurs as $validateur) {
            $this->erreurs = $validateur::valider($tableau);
        }
        return empty($this->erreurs) ? true : false;
    }
    
    /**
     * Accesseur pour le tableau des erreurs
     *
     * @return array
     */
    public function getErreurs()
    {
        return $this->erreurs;
    }
}
