function recherche(){
	// var t = document.getElementsByClassName("")[0].value; //le[0] permet de voir tous les élemnts de la liste
	// var tb = document.getElementsByClassName("ulaffiche")[0].children ;
	var t = document.getElementById("Annonce")[0].value;
	
	for(i=0; i<tb.length;i++){
		if (t.toUpperCase()!= null && t.toUpperCase() != ""  && tb[i].textContent.toUpperCase().indexOf(t.toUpperCase()) == -1){
		}
		
	else $(tb[i]).show();
	}
	
};

console.log("test recherche js");