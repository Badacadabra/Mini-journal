<?php
namespace Bv21411850\Emdn2\Events;

/**
 * Événements de proximité
 *
 * @class  Events
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class Events
{
    /**
     * Chargement du service web
     *
     * @return object
     */
    public static function chargerService($service)
    {
        $url = $service;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        $data = curl_exec($curl);
        $sx = simplexml_load_string($data);

        return $sx;
    }

    /**
     * Lecture du fichier XML renvoyé
     *
     * @return object
     */
    public static function lireResultatXml($sx)
    {
        $html = "";
        $html .= "<h2 class=\"titresStyles\">Événements</h2>\n";
        $html .= "<div id=\"container-evenements\">\n";

        foreach ($sx->events->event as $event) {
            $html .= "<a href=\"{$event->venue->website}\" target=\"_blank\">\n";
            $html .= "<div class=\"evenements\">\n";
            $html .= "<h3>{$event->title}</h3>\n";
            $html .= "<div class=\"contenu-evenements\">";
            $html .= "<p><img src=\"{$event->image[2]}\" alt=\"{$event->artists->artist}\" /></p>\n";
            $html .= "<address>\n";
            $html .= "<strong>Salle</strong> : {$event->venue->name}<br/>\n";
            $html .= "<strong>Ville</strong> : {$event->venue->location->city}<br/>\n";
            $html .= "<strong>Rue</strong> : {$event->venue->location->street}<br/>\n";
            $html .= "<strong>Code Postal</strong> : {$event->venue->location->postalcode}<br/>\n";
            $html .= "</address>\n";
            $html .= "</div></div></a>\n";
        }

        $html .= "</div>";

        return $html;
    }
}
