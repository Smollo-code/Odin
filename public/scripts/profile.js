function confirmDelete() {
    var confirmation = document.getElementById("confirmDelete").value;
    if (confirmation === "LÖSCHEN") {


        window.location.replace("http://odin.scam/index");
    }
}
function goBack() {
    window.location.replace("http://odin.scam/dashboard");
}