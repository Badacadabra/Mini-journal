<?php

namespace Bv21411850\Emdn2\Syndication;

/**
 * Flux RSS2
 *
 * @class  Rss2
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Rss2 extends Syndication
{
    /**
     * Lecture d'un flux RSS2
     *
     * @param object $sx Objet SimpleXML à parser.
     * @return string
     */
    public static function lireFlux($sx)
    {
        $html = "<div id=\"wrapper-rss\">\n";
        $html .= "<h2 class=\"titresStyles\">{$sx->channel->title}</h2>\n";
        $html .= "<div class=\"contenu-syndication\">\n";

        foreach ($sx->channel->item as $item) {
            $html .= "<a href=\"{$item->link}\" target=\"_blank\">\n";
            $html .= "<div class=\"element-rss syndication\">\n";
            $html .= "<h3>{$item->title}</h3>\n";
            if (isset($item->author)) {
                $html .= "<p>Par : {$item->author}</p>\n";
            }
            $html .= "<div class=\"contenu-element-rss\">\n";
            if (isset($item->enclosure)) {
                $html .= "<img src=\"{$item->enclosure['url']}\" alt=\"\" />\n";
            }
            $html .= "<div>\n";
            $html .= "<p>{$item->description}</p>\n";
            $html .= "</div>\n";
            $html .= "</div>\n";
            $html .= "</div>\n";
            $html .= "</a>\n";
        }

        $html .= "</div>\n";
        $html .= "</div>\n";

        return $html;
    }
}
