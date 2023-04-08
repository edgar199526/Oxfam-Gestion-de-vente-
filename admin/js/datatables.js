// Call the dataTables jQuery plugin
$(document).ready( function () {
	$('#dataTable').DataTable( {
		responsive: true,
		"iDisplayLength": 25,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
		}
	});		
});
