document.getElementById("changeProfileForm").addEventListener("submit", function(event) {
    event.preventDefault();
    // Maxi mach mal Code

});

function confirmDelete() {
    var confirmation = document.getElementById("confirmDelete").value;
    if (confirmation === "LÖSCHEN") {


        window.location.replace("http://odin.scam/index.php");
    }
}
