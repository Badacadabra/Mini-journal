<h2>Ajouter/Modifier un article</h2>
<form method="POST" action="<?php echo $action; ?>" id="formulaireArticle">
    <fieldset>
        <label for="titre">Titre</label><input class="fields" id="titre" type="text" name="titre" value="<?php echo $encodeur->encoder($this->document->getTitre()); ?>" />
            <div class="erreurs"></div>
        <label for="auteur">Auteur</label><input class="fields" id="auteur" type="text" name="auteur" value="<?php echo $encodeur->encoder($this->document->getAuteur()); ?>" />
            <div class="erreurs"></div>
        <label for="chapo">Chapo</label><textarea class="fields" id="chapo" name="chapo"><?php echo $this->document->getChapo(); ?></textarea>
        <label for="contenu">Contenu</label><textarea class="fields" id="contenu" name="contenu"><?php echo $this->document->getContenu(); ?></textarea>
            <div class="erreurs"></div>
    </fieldset>
    <input type="submit" value="Publier" class="btnForm" />
    <input type="reset" value="Effacer" class="btnForm" />
    <input type="hidden" name="id" value="<?php echo $this->document->getId(); ?>" />
</form>
