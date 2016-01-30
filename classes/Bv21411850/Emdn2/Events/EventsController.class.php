<?php
namespace Bv21411850\Emdn2\Events;

use Bv21411850\Emdn2\Controller\AbstractController;

/**
 * Contrôleur pour les événements de proximité
 *
 * @class  EventsController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class EventsController extends AbstractController
{
    /**
     * Construction de la page d'événements en fonction de la localisation de l'utilisateur
     *
     * @return void
     */
    public function local()
    {
        // On vérifie que la latitude et la longitude existent bien avant de construire la page
        if (isset($_GET['lat'])) {
            $latitude = $_GET['lat'];
        } else {
            $latitude = 0;
        }
        if (isset($_GET['long'])) {
            $longitude = $_GET['long'];
        } else {
            $longitude = 0;
        }
        // Puis on construit l'URL
        $url = 'http://ws.audioscrobbler.com/2.0/?';
        $url .= 'method=geo.getevents&lat=';
        $url .= $latitude;
        $url .= '&long=';
        $url .= $longitude;
        $url .= '&distance=50&api_key=4f104ea442f845a445e09c9d64023e69';
        // Enfin on construit la page normalement
        $sx = Events::chargerService($url);
        $titre = "Les événements proches de chez vous";
        $this->response->setPart('title', $titre);
        $contenu = Events::lireResultatXml($sx);
        $this->response->setPart('content', $contenu);
    }
}
