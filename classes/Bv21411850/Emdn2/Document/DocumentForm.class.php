<?php
namespace Bv21411850\Emdn2\Document;

/**
 * Formulaire pour l'ajout et la modification de documents
 *
 * @class  DocumentForm
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

abstract class DocumentForm
{
    /**
     * Objet document
     *
     * @var object
     */
    protected $document;

    /**
     * Constructeur
     *
     * @param Document $document Objet document.
     * @return void
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Construction du formulaire pour ajout et modification du document
     *
     * @param string $type     Type de document sollicité.
     * @param string $action   Action à effectuer après publication.
     * @param string $encodeur Encodeur à utiliser pour les données.
     * @return string
     */
    public function construireFormulaire($type, $action, $encodeur)
    {
        $template = "ui/templates/formulaire" . ucfirst($type) . ".tpl.php";
        ob_start();
        require_once $template;
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}
