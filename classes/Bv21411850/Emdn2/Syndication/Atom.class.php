<?php

namespace Bv21411850\Emdn2\Syndication;

/**
 * Flux Atom
 *
 * @class  Atom
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class Atom extends Syndication
{
    /**
     * Lecture d'un flux Atom
     *
     * @param object $sx Objet SimpleXML à parser.
     * @return string
     */
    public static function lireFlux($sx)
    {
        $html = "<div id=\"wrapper-atom\">\n";
        $html .= "<h2 class=\"titresStyles\">{$sx->title}</h2>\n";
        $html .= "<div class=\"contenu-syndication\">\n";

        foreach ($sx->entry as $entry) {
            $html .= "<a href=\"" . htmlspecialchars($entry->link['href']) . "\" target=\"_blank\">\n";
            $html .= "<div class=\"element-atom syndication\">\n";
            $html .= "<h3>{$entry->title}</h3>\n";
            $html .= "<div class=\"contenu-element-atom\">\n";
            if (isset($entry->author)) {
                $html .= "<p><strong>Auteur</strong> : {$entry->author->name}</p>\n";
            }
            $html .= "<p><strong>Description</strong> : {$entry->summary}</p>\n";
            $html .= "</div>\n";
            $html .= "</div>\n";
            $html .= "</a>\n";
        }

        $html .= "</div>\n";
        $html .= "</div>\n";

        return $html;
    }
}
