<?php
namespace Bv21411850\Emdn2\Article;

use Bv21411850\Emdn2\Controller\AbstractController;
use Bv21411850\Emdn2\Utils\Nettoyage\NettoyeurManager;
use Bv21411850\Emdn2\Utils\Encodage\EncodeurManager;
use Bv21411850\Emdn2\Utils\Validation\ValidateurManager;
use Bv21411850\Emdn2\Image\Image;
use Bv21411850\Emdn2\Image\ImageBd;
use Bv21411850\Emdn2\Image\ImageHtml;
use Bv21411850\Emdn2\Auth\AuthManager;
use Bv21411850\Emdn2\Utils\Acces\AccessControl;

/**
 * Contrôleur d'article
 *
 * @class  ArticleController
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class ArticleController extends AbstractController
{
    /**
     * Afficher la list des articles
     *
     * @return void
     */
    public function voirListe()
    {
        $contenu = '';
        $liste = ArticleBd::lireListeDocuments();
        foreach ($liste as $article) {
            // Encodage des caractères
            $encodeur = new EncodeurManager();
            $encodeur->ajouter('Bv21411850\Emdn2\Utils\Encodage\EncodeurSpecialChars');
            // HTML
            $titre = "Liste des articles";
            $this->response->setPart('title', $titre);
            $afficheur = new ArticleHtml($article, $encodeur);
            $contenu .= $afficheur->afficherListe();
            // L'utilisateur est-il connecté ?
            $auth = AuthManager::getInstance();
            if ($auth->estConnecte()) {
                $contenu .= $afficheur->afficherOptions();
            }
        }
        $this->response->setPart('content', $contenu);
    }

    /**
     * Afficher les détails d'un article
     *
     * @return void
     */
    public function voirDetails()
    {
        $contenu = '';
        $id = (int) $this->request->getGetParam('id');
        $article = ArticleBd::lireDocument($id);
        $images = ImageBd::lireListeDocuments($id);
        // Encodage des caractères
        $encodeur = new EncodeurManager();
        $encodeur->ajouter('Bv21411850\Emdn2\Utils\Encodage\EncodeurSpecialChars');
        // HTML
        $afficheurArticle = new ArticleHtml($article, $encodeur);
        $this->response->setPart('title', $article->getTitre());
        // L'utilisateur est-il connecté ?
        $auth = AuthManager::getInstance();
        if ($auth->estConnecte()) {
            $contenu .= $afficheurArticle->afficherOptions();
        }
        $contenu .= $afficheurArticle->afficherDetails();
        $contenu .= "<div id=\"images-article\">\n";
        foreach ($images as $image) {
            $afficheurImages = new ImageHtml($image, $encodeur);
            $contenu .= $afficheurImages->afficherImage($auth);
        }
        $contenu .= "</div>\n";
        $this->response->setPart('content', $contenu);
    }

    /**
     * Ajouter un article
     *
     * @return void
     */
    public function ajouter()
    {
        $titre = "Ajouter un article";
        if (AccessControl::verifierStatut(array('admin', 'rédacteur'))) {
            $article = Article::initialize();
            $formulaire = new ArticleForm($article);
            // Encodage des caractères
            $encodeur = new EncodeurManager();
            $encodeur->ajouter('Bv21411850\Emdn2\Utils\Encodage\EncodeurSpecialChars');
            // L'utilisateur est-il connecté ?
            $auth = AuthManager::getInstance();
            $contenu = $formulaire->construireFormulaire('article', 'index.php?t=article&amp;a=enregistrer', $encodeur);
        } else {
            $contenu = "<p>Vous n'êtes pas autorisé à ajouter un article.</p>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Enregistrer un article en base de données
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
        // Reconstruction de l'article avec des données propres
        $article = Article::initialize($data);
        // Validation des données
        $validateur = new ValidateurManager();
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurString');
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurEmpty');
        if ($validateur->valider($data)) {
            ArticleBd::ajouterDocument($article);
            $titre = "Article enregistré";
            $contenu = "<p>Votre article a bien été enregistré.</p>";
        } else {
            $titre = "Article pas enregistré";
            $contenu = "<p>Votre ajout a été ignoré car :</p>";
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
     * Modifier un article
     *
     * @return void
     */
    public function modifier()
    {
        $titre = "Modifier un article";
        if (AccessControl::verifierStatut(array('admin', 'rédacteur'))) {
            $id = (int) $this->request->getGetParam('id');
            $article = ArticleBd::lireDocument($id);
            $formulaire = new ArticleForm($article);
            // Encodage des caractères
            $encodeur = new EncodeurManager();
            $encodeur->ajouter('Bv21411850\Emdn2\Utils\Encodage\EncodeurSpecialChars');
            $contenu = $formulaire->construireFormulaire(
                'article',
                'index.php?t=article&amp;a=enregistrerModif',
                $encodeur
            );
        } else {
            $contenu = "<p>Vous n'êtes pas autorisé à modifier un article.</p>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Enregistrer la modification d'un article
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
        // Reconstruction de l'article avec des données propres
        $article = Article::initialize($data);
        // Validation des données
        $validateur = new ValidateurManager();
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurString');
        $validateur->ajouter('Bv21411850\Emdn2\Utils\Validation\ValidateurEmpty');
        if ($validateur->valider($data)) {
            ArticleBd::modifierDocument($article);
            $titre = "Modification enregistrée";
            $contenu = "<p>Votre modification a bien été enregistrée.</p>";
        } else {
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
     * Supprimer un article
     *
     * @return void
     */
    public function supprimer()
    {
        if (AccessControl::verifierStatut(array('admin', 'rédacteur'))) {
            $id = (int) $this->request->getGetParam('id');
            ImageBd::resetImages($id);
            ArticleBd::supprimerDocument($id);
            // HTML
            $titre = "Article supprimé";
            $contenu = "<p>Votre article a été supprimé.</p>";
        } else {
            $titre = "Suppression d'article non permise";
            $contenu = "<p>Vous n'êtes pas autorisé à supprimer un article.</p>";
        }
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Acheter un article (requête)
     *
     * @return void
     */
    public function acheter()
    {
        // Préparation paiement
        $merchantId = '013044876511111';
        $montant = 200;
        $pathfile = '/users/21411850/www-dev/journal/eTransactions/param/pathfile';
        $normalReturnUrl = 'https://dev-21411850.users.info.unicaen.fr/journal/';
        $normalReturnUrl .= 'index.php?t=article&a=retourBoutique';
        $cancelReturnUrl = 'https://dev-21411850.users.info.unicaen.fr/journal/';
        $cancelReturnUrl .= 'index.php?t=article&a=annulerPaiement';
        $automaticResponseUrl = 'https://dev-21411850.users.info.unicaen.fr/journal/';
        $automaticResponseUrl .= 'index.php?t=article&a=reponsePaiement';
        $caddie = 42;

        $donnees = array(
            'merchant_id' => $merchantId,
            'amount' => $montant,
            'pathfile' => $pathfile,
            'normal_return_url' => $normalReturnUrl,
            'cancel_return_url' => $cancelReturnUrl,
            'automatic_response_url' => $automaticResponseUrl,
            'caddie' => $caddie
        );

        $params = "";
        foreach ($donnees as $cle => $val) {
            $params .= $cle . "=" . $val . " ";
        }
        $chemin = '/users/21411850/www-dev/journal/eTransactions/bin/request';
        $resultat = exec($chemin . " " . $params);
        $res = explode("!", $resultat);
        if ($res[1] == 0) {
            $contenu = $res[3];
        } else {
            $contenu = "<p>Module de paiement non disponible</p>";
        }
        // HTML
        $titre = "Achat d'article";
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Retour boutique
     *
     * @return void
     */
    public function retourBoutique()
    {
        // HTML
        $titre = "Retour boutique";
        $contenu = "Re-bienvenue à vous !";
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Annulation du paiement
     *
     * @return void
     */
    public function annulerPaiement()
    {
        // HTML
        $titre = "Annulation de paiement";
        $contenu = "Paiement annulé !";
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }

    /**
     * Réponse de la banque
     *
     * @return void
     */
    public function reponsePaiement()
    {
        $post = $_POST['DATA'];
        $pathfile = '/users/21411850/www-dev/journal/eTransactions/param/pathfile';
        $chemin = '/users/21411850/www-dev/journal/eTransactions/bin/response';
        $contenu = exec($chemin . " message={$post} pathfile={$pathfile}");
        // HTML
        $titre = "Réponse de la banque";
        $this->response->setPart('title', $titre);
        $this->response->setPart('content', $contenu);
    }
}
