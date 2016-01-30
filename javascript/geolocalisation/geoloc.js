function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}
function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var url = "index.php?t=events&a=local&lat=" + latitude + "&long=" + longitude;
    window.location.assign(url);
}
