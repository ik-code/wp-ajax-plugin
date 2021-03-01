jQuery(document).ready(function($) {

	$.ajax({
		type: "POST",                 // use $_POST request to submit data
		url: ajax_url,      // URL to "wp-admin/admin-ajax.php"
		data: {
			action     : 'ik_ajax', // wp_ajax_*, wp_ajax_nopriv_*
			first_name : 'Ihor',      // PHP: $_POST['first_name']
			last_name  : 'Khaletskyi',      // PHP: $_POST['last_name']
		},
		success:function( data ) {
			$( '#wp-ajax' ).html( data );
		},
		error: function(){
			console.log(errorThrown); // error
		}
	});

});