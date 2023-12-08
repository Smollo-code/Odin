document.addEventListener('DOMContentLoaded', function () {
    var table = document.getElementById('roulette-table');

    table.addEventListener('click', function (event) {
        var clickedCell = event.target;

        var cellValue = parseInt(clickedCell.textContent)

        if (clickedCell.attributes.id.nodeValue === 'PAIR') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === 'IMPAIR') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === '1-12') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === '1-18') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === '13-24') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === 'RED') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === 'BLACK') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === '25-36') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (clickedCell.attributes.id.nodeValue === '19-36') {
            console.log('Value:', clickedCell.attributes.id.nodeValue)
        } else if (!isNaN(cellValue)) {
            console.log('Number:', cellValue)
        }
    });
});


function goBack() {
    window.location.replace("http://odin.scam/dashboard");
}

function lastRotatetime() {
    return Math.random() * (15 - 3) + 3
}

function pause(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}

async function counter() {
    for (let i = 1; i <= 30; i++) {
        document.getElementById('counter').textContent = 30 - i;
        await pause(1000);
    }
}

counter();