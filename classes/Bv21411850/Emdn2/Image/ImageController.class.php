<?php
namespace Bv21411850\Emdn2\Image;

use Bv21411850\Emdn2\Controller\AbstractController;
use Bv21411850\Emdn2\Utils\Nettoyage\NettoyeurManager;
use Bv21411850\Emdn2\Utils\Encodage\EncodeurManager;
use Bv21411850\Emdn2\Utils\Validation\ValidateurManager;
use Bv21411850\Emdn2\Utils\Upload\UploadManager;
use Bv21411850\Emdn2\Utils\Upload\UploadException;
use Bv21411850\Emdn2\Utils\Acces\AccessControl;

/**
 * Contrôleur d'image
 *
 * @class  ImageController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ImageController extends AbstractController
{
    /**
     * Ajouter une image
     *
     * @return void
     */
    public function ajouter()
    {
        $titre = "Ajouter une image";
        if (AccessControl::verifierStatut(array('admin', 'rédacteur'))) {
            $idArticle = (int) $this->request->getGetParam('id');
            $image = Image::initialize(array('idArticle' => $idArticle));
            $formulaire = new ImageForm($image);
            // Encodage des caractères
            $encodeur = new EncodeurManager();
            $encodeur->ajouter('Bv21411850\Emdn2\Utils\Encodage\EncodeurSpecialChars');
            $contenu = $formulaire->construireFormulaire('image', 'index.php?t=image&amp;a=enregistrer', $encodeur);
        } else {
            $contenu = "<p>Vous n'êtes pas autorisé à ajouter une image.</p>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Enregistrer une image en base de données
     *
     * @return void
     */
    public function enregistrer()
    {
        // Nettoyage de la saisie
        $nettoyeur = new NettoyeurManager();
        $nettoyeur->ajouter('Bv21411850\Emdn2\Utils\Nettoyage\NettoyeurBalisesHtml');
        $nettoyeur->ajouter('Bv21411850\Emdn2\Utils\Nettoyage\NettoyeurEspacesVides');
        $data = $nettoyeur->nettoyer($_POST);
        // L'utilisateur choisit de télécharger une image locale
        if (isset($_FILES['cheminImage'])
            && !empty($_FILES['cheminImage'])
            && empty($data['urlFichier'])
        ) {
            $image = UploadManager::upload($data, $_FILES['cheminImage']);
            // Déplacement de l'image dans le dossier "upload"
            $repertoire = "/users/21411850/www-dev/journal/";
            $nomFichier = "upload/" . uniqid();
            $nomComplet = $repertoire . $nomFichier;
            if (! move_uploaded_file($_FILES['cheminImage']['tmp_name'], $nomComplet)
                && !isset($data['urlFichier'])) {
                echo "Problème de copie de fichier";
            } else {
                $image->setCheminImage($nomFichier);
            }
        } else {
            // L'utilisateur choisit une image Flickr
            $data['cheminImage'] = $data['urlFichier'];
            $image = Image::initialize($data);
        }
        // Validation des données
        $validateur = new ValidateurManager();
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurString');
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurEmpty');
        if ($validateur->valider($data)) {
            ImageBd::ajouterDocument($image);
            // HTML
            $titre = "Image enregistrée";
            $contenu = "<p>Votre image a bien été enregistrée.</p>";
        } else {
            // HTML
            $titre = "Image pas enregistrée";
            $contenu = "<p>Votre image n'a pas été enregistrée car :</p>";
            $contenu .= "<ul>";
            foreach ($validateur->getErreurs() as $valeur) {
                $contenu .= "<li>" . $valeur . "</li>";
            }
            $contenu .= "</ul>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Modifier une image
     *
     * @return void
     */
    public function modifier()
    {
        $titre = "Modifier une image";
        if (AccessControl::verifierStatut(array('admin', 'rédacteur'))) {
            $id = (int) $this->request->getGetParam('id');
            $image = ImageBd::lireDocument($id);
            $formulaire = new ImageForm($image);
            // Encodage des caractères
            $encodeur = new EncodeurManager();
            $encodeur->ajouter('Bv21411850\Emdn2\Utils\Encodage\EncodeurSpecialChars');
            $action = 'index.php?t=image&amp;a=enregistrerModif';
            $contenu = $formulaire->construireFormulaire('image', $action, $encodeur);
        } else {
            $contenu = "<p>Vous n'êtes pas autorisé à modifier une image.</p>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Enregistrer la modification d'une image
     *
     * @return void
     */
    public function enregistrerModif()
    {
        // Nettoyage de la saisie
        $nettoyeur = new NettoyeurManager();
        $nettoyeur->ajouter('Bv21411850\Emdn2\Utils\Nettoyage\NettoyeurBalisesHtml');
        $nettoyeur->ajouter('Bv21411850\Emdn2\Utils\Nettoyage\NettoyeurEspacesVides');
        $data = $nettoyeur->nettoyer($_POST);
        // L'utilisateur choisit de modifier une image locale
        if (isset($data['urlFichier']) && preg_match('#upload#', $data['urlFichier'])) {
            $image = UploadManager::upload($data, $_FILES['cheminImage']);
        }
        // L'utilisateur choisit de modifier une image Flickr
        if (isset($data['urlFichier']) && preg_match('#https#', $data['urlFichier'])) {
            $data['cheminImage'] = $data['urlFichier'];
            $image = Image::initialize($data);
        }
        // Validation des données
        $validateur = new ValidateurManager();
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurString');
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurEmpty');
        if ($validateur->valider($data)) {
            ImageBd::modifierDocument($image);
            // HTML
            $titre = "Modification enregistrée";
            $contenu = "<p>Votre modification a bien été enregistrée.</p>";
        } else {
            // HTML
            $titre = "Modification pas enregistrée";
            $contenu = "<p>Votre modification a été ignorée car :</p>";
            $contenu .= "<ul>";
            foreach ($validateur->getErreurs() as $valeur) {
                $contenu .= "<li>" . $valeur . "</li>";
            }
            $contenu .= "</ul>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Supprimer une image
     *
     * @return void
     */
    public function supprimer()
    {
        if (AccessControl::verifierStatut(array('admin', 'rédacteur'))) {
            $id = (int) $this->request->getGetParam('id');
            ImageBd::supprimerDocument($id);
            // HTML
            $titre = "Image supprimée";
            $contenu = "<p>Votre image a été supprimée.</p>";
        } else {
            $titre = "Suppression d'image non permise";
            $contenu = "<p>Vous n'êtes pas autorisé à supprimer une image.</p>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }
}
