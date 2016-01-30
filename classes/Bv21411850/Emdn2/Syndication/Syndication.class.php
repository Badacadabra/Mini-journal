<?php
namespace Bv21411850\Emdn2\Syndication;

/**
 * Flux de syndication
 *
 * @class  Syndication
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class Syndication
{
    /**
     * Chargement d'un flux de syndication
     *
     * @param string $flux Flux de syndication à charger.
     * @return object
     */
    public static function chargerFlux($flux)
    {
        $url = $flux;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        $data = curl_exec($curl);
        $sx = simplexml_load_string($data);

        return $sx;
    }
}
