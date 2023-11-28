document.getElementById("changeProfileForm").addEventListener("submit", function(event) {
    event.preventDefault();
    // Hier kann der Code für die Aktualisierung der Benutzerinformationen geschrieben werden

});

function confirmDelete() {
    var confirmation = document.getElementById("confirmDelete").value;
    if (confirmation === "LÖSCHEN") {
        // Hier kann der Code für das Löschen des Kontos geschrieben werden

        alert("Konto erfolgreich gelöscht!");
    } else {
        alert("Falsche Bestätigung. Konto wurde nicht gelöscht.");
    }
}
