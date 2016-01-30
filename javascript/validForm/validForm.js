$( document ).ready(function() {

    // Validation du formulaire d'article
    var champsArticle = ["titre", "auteur", "contenu"];

    $( "#formulaireArticle" ).submit(function(ev) {
        tinyMCE.triggerSave();
        valider( ev, "#titre" );
        valider( ev, "#auteur" );
        valider( ev, "#contenu" );
    });

    for (var i = 0; i < champsArticle.length; i++) {
        $( "#" + champsArticle[i] ).keyup(function(ev) {
            $( this ).next( ".erreurs" ).text( "" );
        });
    }

    // Validation du formulaire d'image
    var champsImage = ["titre", "auteur", "droits"];

    $( "#formulaireImage" ).submit(function(ev) {
        valider( ev, "#titre" );
        valider( ev, "#auteur" );
        valider( ev, "#droits" );
    });

    for (var i = 0; i < champsImage.length; i++) {
        $( "#" + champsImage[i] ).keyup(function(ev) {
            $( this ).next( ".erreurs" ).text( "" );
        });
    }

});

function valider(ev, id) {
    if ( $( id ).val() == "" ) {
        ev.preventDefault();
        $( id ).next( ".erreurs" ).text( "Ce champ ne doit pas être vide" );
    } else {
        $( id ).next( ".erreurs" ).text( "" );
    }
}
