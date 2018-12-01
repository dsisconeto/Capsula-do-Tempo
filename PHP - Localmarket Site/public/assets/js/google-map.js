/**
 * The Google Maps Image Generator Function
 *
 * @param The element ID or Class.
 * @return Image HTML element.
 */
function generateGoogleMapImg(e) {
  $(e).each(function(){

    /** Lets create some settings */
    var address = $(this).data('address');
    var marker = $(this).data('marker');
    var markerSize = $(this).data('marker-size') ? $(this).data('marker-size') : 'normal';
    var markerColor = $(this).data('marker-color') ? $(this).data('marker-color') : 'purple';
    var mapWidth = $(this).data('width') ? $(this).data('width') : 390;
    var mapHeight = $(this).data('height') ? $(this).data('height') : 250;
    var mapZoom = $(this).data('zoom') ? $(this).data('zoom') : 12;
    var mapType = $(this).data('type') ? $(this).data('type') : 'terrain';

    /** If the address is set, generate the map image */
    if(address) {

      /** Create the map URL */
      var url = 'https://maps.googleapis.com/maps/api/staticmap?center=' + address + '&zoom=' + mapZoom + '&size=' + mapWidth + 'x' + mapHeight + '&maptype=' + mapType;

      /** Check for the marker */
      if(marker){
        url += '&markers=size:' + markerSize + '%7Ccolor:' + markerColor + '%7C' + address;
      }

      /** Create the map image */
      $(this).html('<img src="' + url + '">');

    /** If the address is empty remove the map wrapper */
    } else {
      $(this).css("display", "none");
    }
  });
}
