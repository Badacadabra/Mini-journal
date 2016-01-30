$( document ).ready(function() {
    $( "#go" ).on("click", search);
});

var search = function(e) {

    e.preventDefault();
    e.stopPropagation();

    var urlFlickr = "https://api.flickr.com/services/rest/";
    var keywords = $( "#imageFlickr" ).val();
    var params =  {
        "method": "flickr.photos.search",
        "api_key": "14d6906508dab0d8cc63498536cf07a8",
        "tags": keywords,
        "license": 2, // Creative Commons
        "format": "json",
    };

    $.ajax({
        url: urlFlickr,
        jsonp: "jsoncallback",
        dataType: "jsonp",
        data: params,
    }).done(parseFlickr);

}

var parseFlickr = function(response) {
    $( "#main" ).append("<div id=\"images-flickr\">");
    for (var i=0; i < response.photos.photo.length; i++) {
        $( "#images-flickr" ).append("<img id=\"" + response.photos.photo[i].id + "\" src=\"https://farm" + response.photos.photo[i].farm + ".staticflickr.com/" + response.photos.photo[i].server + "/" + response.photos.photo[i].id + "_" + response.photos.photo[i].secret + "_q.jpg\" alt=\"\" />");
        $( "#" + response.photos.photo[i].id ).on("click", select);
    }
    // Ajustement ergonomique
    $( "html, body" ).animate({
        scrollTop:$( "#images-flickr" ).offset().top
    }, 'slow');
}

var select = function(e) {

    $( "img" ).not( $( this ) ).fadeOut();

    e.preventDefault();
    e.stopPropagation();

    var urlFlickr = "https://api.flickr.com/services/rest/";
    var idPhoto = $( this ).attr( "id" );
    var params =  {
        "method": "flickr.photos.getInfo",
        "api_key": "14d6906508dab0d8cc63498536cf07a8",
        "photo_id": idPhoto,
        "format": "json",
    };

    $.ajax({
        url: urlFlickr,
        jsonp: "jsoncallback",
        dataType: "jsonp",
        data: params,
    }).done(validerChoix);

}

var validerChoix = function(response) {

    // console.log(response);
    var titre = response.photo.title._content;
    var auteur = response.photo.owner.realname;
    var licence = "Creative Commons";
    var url = "https://farm" + response.photo.farm + ".staticflickr.com/" + response.photo.server + "/" + response.photo.id + "_" + response.photo.secret + "_q.jpg";

    if (titre != "") {
        $( "#titre" ).val( titre );
    } else {
        $( "#titre" ).val( "N/A" );
    }
    if (auteur != "") {
        $( "#auteur" ).val( auteur );
    } else {
        $( "#auteur" ).val( "N/A" );
    }
    if (licence != "") {
        $( "#droits" ).val( licence );
    } else {
        $( "#droits" ).val( "N/A" );
    }

    $( "input[name='urlFichier']" ).val( url );
}
