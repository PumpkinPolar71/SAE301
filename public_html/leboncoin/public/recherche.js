function recherche(){
	var t = document.getElementsByClassName("typeahead")[0].value; //le[0] permet de voir tous les élemnts de la liste
	var tb = document.getElementsByClassName("ulaffiche")[0].children ;
	
	for(i=0; i<tb.length;i++){
	if (tb[i].textContent.toUpperCase() != t.toUpperCase() && t.toUpperCase()!= null && t.toUpperCase() != "" ){
		$(tb[i]).hide();
	}
	else $(tb[i]).show();
	}
	
};

console.log("test recherche js");