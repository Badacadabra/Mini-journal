<?php
namespace Bv21411850\Emdn2\Syndication;

use Bv21411850\Emdn2\Controller\AbstractController;

/**
 * Contrôleur de flux de syndication
 *
 * @class  SyndicationController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class SyndicationController extends AbstractController
{
    /**
     * Construction de la page avec flux RSS intégré
     *
     * @return void
     */
    public function rss()
    {
        $sx = Rss2::chargerFlux('http://www.lemonde.fr/paris/rss_full.xml');
        $titre = "Flux RSS";
        $this->response->setPart('title', $titre);
        $contenu = Rss2::lireFlux($sx);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Construction de la page avec flux Atom intégré
     *
     * @return void
     */
    public function atom()
    {
        $sx = Atom::chargerFlux('http://www.w3.org/blog/news/feed/atom');
        $titre = "Flux Atom";
        $this->response->setPart('title', $titre);
        $contenu = Atom::lireFlux($sx);
        $this->response->setPart('content', $contenu);
    }
}
