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
		 
		 var index = formcreateparty.find("div[class='form-group']:first-child").length ;
		 var prototype = $(formcreateparty.attr('data-prototype').replace(/__name__label__/g, 'party n°' + (index+1)).replace(/__name__/g, index));
		 
		 formcreateparty.append(prototype) ;	
		 // the country will be hidden and so its label : we do not need it , we're on a selected country 
		 formcreateparty.find("#bepselectionbundle_country_parties_"+index+"_country").parent().hide();
	 }

});