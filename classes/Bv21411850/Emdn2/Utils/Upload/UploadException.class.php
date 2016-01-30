<?php
namespace Bv21411850\Emdn2\Utils\Upload;

/**
 * Gestion des exceptions pour l'upload
 *
 * @class  UploadException
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

final class UploadException extends \Exception
{
    /**
     * Message d'erreur
     *
     * @var string
     */
    protected $message;

    /**
     * Code d'erreur
     *
     * @var int
     */
    protected $code;

    /**
     * Constructeur
     *
     * @param string $message Message d'erreur.
     * @param int    $code    Code d'erreur.
     * @return void
     */
    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * Redéfinition de l'affichage des erreurs
     *
     * @return string
     */
    public function __toString()
    {
        $string = "<strong>" . $this->getCode() . "</strong>\n";
        $string .= "<em>" . $this->getMessage() . "</em>";
        return $string;
    }
}
