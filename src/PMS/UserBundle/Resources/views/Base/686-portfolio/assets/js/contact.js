$(document).ready(function() {

	var yourStartLatLng = new google.maps.LatLng(59.3426606750, 18.0736160278);
	$('#map_canvas').gmap({'center': yourStartLatLng});
	$('#map_canvas').gmap('option', 'zoom', 13);
	$('#map_canvas').gmap('addMarker', { /*id:'m_1',*/ 'position': '59.3426606750, 18.0736160278', 'bounds': false } ).click(function() {
                $('#map_canvas').gmap('openInfoWindow', { 'content': 'Your Office Location' }, this);
        });
	
});