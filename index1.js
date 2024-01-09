/*document.getElementById('site').addEventListener('click',function(){
    document.querySelector('.menu').classList.toggle('active');
})
function logout(){
    function deconnexion() {
        // Requête AJAX pour déconnecter côté serveur avec PHP
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Afficher la réponse du serveur (peut être personnalisé)
            alert(xhr.responseText);
}
};
// Définir la méthode et l'URL du script PHP de déconnexion
xhr.open("POST", "logout.php", true);
// Envoyer la requête
xhr.send();
}

// Ajouter un gestionnaire d'événement au bouton
document.getElementById("deconnexion").addEventListener("click", deconnexion);
}
*/
const spans = document.querySelectorAll('.word span');

spans.forEach((span, idx) => {
	span.addEventListener('click', (e) => {
		e.target.classList.add('active');
	});
	span.addEventListener('animationend', (e) => {
		e.target.classList.remove('active');
	});
	setTimeout(() => {
		span.classList.add('active');
	}, 750 * (idx+1))
});