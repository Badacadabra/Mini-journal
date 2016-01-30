<?php
namespace Bv21411850\Emdn2\Utils\Upload;

use Bv21411850\Emdn2\Image\Image;

/**
 * Gestionnaire d'upload
 *
 * @class  UploadManager
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class UploadManager
{
    /**
     * Gestionnaire d'upload
     *
     * @param array $data $_POST.
     * @param array $file $_FILES.
     * @return object
     */
    public static function upload($data, $file)
    {
        try {
            // Récupération du type MIME du fichier
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
                $mime = $finfo->file($file['tmp_name']);
            } else {
                $mime = "";
            }

            // Gestion des différents types de fichiers
            switch ($mime) {
                case 'image/jpeg':
                case 'image/png':
                case 'image/gif':
                    $donnees = array('idArticle' => $data['idArticle'],
                                     'cheminImage' => $file['tmp_name'],
                                     'titre' => $data['titre'],
                                     'auteur' => $data['auteur'],
                                     'droits' => $data['droits']
                                    );
                    $image = Image::initialize($donnees);
                    return $image;
                /* case 'video/mpeg':
                case 'video/mp4':
                case 'video/webm':
                    $video = new Video(
                        "",
                        $data['idArticle'],
                        $_FILES['cheminVideo']['tmp_name'],
                        $data['titre'],
                        $data['auteur'],
                        $data['droits'],
                        ""
                    );
                    return $video;
                case 'application/pdf':
                case 'application/vnd.oasis.opendocument.text':
                    $document = new Document(
                        "",
                        $data['idArticle'],
                        $_FILES['cheminDocument']['tmp_name'],
                        $data['titre'],
                        $data['auteur'],
                        $data['droits'],
                        ""
                    );
                    return $document;*/
                default:
                    throw new UploadException("Type de fichier non accepté", 42);
            }
        } catch (UploadException $e) {
            $e->getMessage();
        }
    }
}
