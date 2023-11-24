function submitForm() {
	var form = document.getElementById('searchForm');
	form.submit();
}
function checkInteraction() {
	console.log("ville interaction")
}
function testerDate() {
	// Récupérez la valeur du champ de date
	let datePickerValue = document.getElementById("datePicker_datedebut").value;

	
	// Vérifiez si une date a été sélectionnée
	if (datePickerValue) {
		alert("Une date a été sélectionnée : " + datePickerValue);
	} else {
		alert("Aucune date sélectionnée." + console.log(datePickerValue));
	}
}
function handleKeyPress(event) {
	// Vérifiez si la touche appuyée est "Enter"
	if (event.key === "Enter") {
		// Exécutez votre code ici
		alert("Touche Entrée pressée !");
	}
}
//console.log("test recherche js");