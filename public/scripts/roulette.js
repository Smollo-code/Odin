document.addEventListener('DOMContentLoaded', function() {
    var table = document.getElementById('roulette-table');

    table.addEventListener('click', function(event) {
        var clickedCell = event.target;

        if (clickedCell.attributes. === '11') {
            console.log('Geklickte Zelle:', clickedCell.textContent, clickedCell.className);
        }
    });
});



function goBack() {
    window.location.replace("http://odin.scam/dashboard");
}

function rotateDegreeNumber() {
    return Math.random() * (9000 - 1000) + 1000
}

