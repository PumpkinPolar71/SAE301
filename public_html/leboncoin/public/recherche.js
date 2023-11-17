function recherche(){
	var t = document.getElementsByClassName("typeahead")[0].value; //le[0] permet de voir tous les élemnts de la liste
	var tb = document.getElementsByClassName("ulaffiche")[0].children ;
	var text = "default";

	


	for(i=0; i<tb.length;i++){
		if (t.toUpperCase()!= null && t.toUpperCase() != ""  && tb[i].textContent.toUpperCase().indexOf(t.toUpperCase()) == -1){
		}
		text = 'SELECT titreannonce FROM annonce'
		console.log(text);
	}
	console.log(t);
	console.log(tb);
};

console.log("test recherche js");

