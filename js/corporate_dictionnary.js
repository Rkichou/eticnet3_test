

function download_dictionnary(prefix){
    var data = new FormData();
    data.append('prefix', prefix);

    var oReq = new XMLHttpRequest();
    var url = "includes/download_dictionary.php";
    oReq.open("POST", url, true);
    oReq.responseType = 'blob'; // Pour traiter la réponse en tant que fichier binaire

    oReq.onload = function (oEvent) {
        if (this.readyState == 4 && this.status == 200) {
            // Créer un URL pour le blob (le fichier reçu)
            var blob = new Blob([oReq.response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            var downloadUrl = window.URL.createObjectURL(blob);

            // Créer un lien de téléchargement
            var a = document.createElement('a');
            a.href = downloadUrl;
            a.download = `dictionnaire_${prefix}_${new Date().toISOString().split('T')[0]}.xlsx`;
            document.body.appendChild(a);
            a.click();

            // Nettoyer après le téléchargement
            window.URL.revokeObjectURL(downloadUrl);
            document.body.removeChild(a);
        } else {
            console.error('Erreur lors du téléchargement du fichier');
        }
    };

    oReq.onerror = function() {
        console.error('Erreur de connexion avec le serveur');
    };
}