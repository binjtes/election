$( '#createbutton' ).click(function(event) {
	event.preventDefault();
	$('#formhidden').show("slow");
	$( '#createbutton' ).hide();
});	


// country edit : add party button
$( '#createparty' ).click(function(event) {
	 event.preventDefault();
	 var formcreateparty = $( 'div#bepselectionbundle_country_parties');
	 if(formcreateparty != null){
		 // TODO : ne marche pas.
		 var index = formcreateparty.find(':index').length ;
		 var prototype = $(formcreateparty.attr('data-prototype').replace(/__name__label__/g, 'party n°' + (index+1)).replace(/__name__/g, index));
		 // add form
		 formcreateparty.append(prototype) ;
	 
	 }
	 
	 
	 

});