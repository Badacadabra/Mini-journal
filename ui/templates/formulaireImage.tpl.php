<h2>Ajouter/Modifier une image</h2>
<form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data" id="formulaireImage">
    <label for="image">Image locale</label><input id="image" type="file" name="cheminImage" value="<?php echo $encodeur->encoder($this->document->getCheminImage()); ?>" />
        <div class="erreurs"></div>
    <label for="image">Image Flickr</label><input class="fields" id="imageFlickr" type="text" name="imageFlickr" placeholder="Entrez des mots-clés" />
        <div class="erreurs"></div>
    <button type="button" id="go">Go!</button>
    <label for="titre">Titre</label><input class="fields" id="titre" type="text" name="titre" value="<?php echo $encodeur->encoder($this->document->getTitre()); ?>" />
        <div class="erreurs"></div>
    <label for="auteur">Auteur</label><input class="fields" id="auteur" type="text" name="auteur" value="<?php echo $encodeur->encoder($this->document->getAuteur()); ?>" />
        <div class="erreurs"></div>
    <label for="droits">Droits</label><input class="fields" id="droits" name="droits" value="<?php echo $this->document->getDroits(); ?>" />
        <div class="erreurs"></div><div></div>
    <input type="submit" value="Publier" class="btnForm" />
    <input type="reset" value="Effacer" class="btnForm" />
    <input type="hidden" name="id" value="<?php echo $this->document->getId(); ?>" />
    <input type="hidden" name="idArticle" value="<?php echo $this->document->getIdArticle(); ?>" />
    <input type="hidden" name="urlFichier" value="<?php echo $this->document->getCheminImage(); ?>" />
</form>
