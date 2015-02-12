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

// country edit : remove a party
var $parties = $("div[class='existing_party']");
$parties.each(function() {
   console.log('in');
	addDeleteLink($(this));
  });

function addDeleteLink($prototype) {
    // Create the link
    $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

    // add the link
    $prototype.append($deleteLink);

    // Add a listener onclick
    $deleteLink.click(function(e) {
      $prototype.remove();
      // warn the user 
      addflashMessage("success" , "Removing a party :" , " please update the country to commit this change")
      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      return false;
    });
    
    
    
function addflashMessage(typeofAlert , title , message ){
	// always on top on div class election_template
	var $electemplat = $("div[class='election-template']");
	$electemplat.prepend('<div class="alert alert-'+typeofAlert+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>'+title+'</strong>'+message+'</div>'); 
//	var newdiv = document.createElement("div");
//	newdiv.setAttribute("class", "alert alert-"+typeofAlert+" alert-dismissible");
//	newdiv.setAttribute("role","alert")
//	var butt = document.createElement("button");
//	butt.setAttribute("type","button").
//	butt.setAttribute("class","close" ) ;
//	butt.setAttribute("data-dismiss","alert" ) ; 
//	
//	var newspan = document.createElement("span");
//	newspan.setAttribute("aria-hidden","true");
//	newspan.nodeValue = 'x' ;
//	var newspan2 = document.createElement("span");
//	newspan2.setAttribute("class", "sr-only" );
//	newspan2.nodeValue = "Close" ;
//	
//	var newstrong = document.createElement("strong");
//	newstrong.nodeValue= message 
//	newdiv.appendChild(butt) ;
//	butt.appendChild(newspan) ;
//	butt.appendChild(newspan2) ;
//	newdiv.appendChild(newstrong);
//	$electemplat.append(newdiv) 
//	console.log(newdiv)
}    
    
}   