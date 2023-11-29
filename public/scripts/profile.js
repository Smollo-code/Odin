document.getElementById("changeProfileForm").addEventListener("submit", function(event) {
    event.preventDefault();
    window.location.replace('updatedb.php')

});

function confirmDelete() {
    var confirmation = document.getElementById("confirmDelete").value;
    if (confirmation === "LÖSCHEN") {


        window.location.replace("http://odin.scam/index.php");
    }
}
