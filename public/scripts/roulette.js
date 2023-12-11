let bets = {
    '0': '0',
    'PAIR': '0',
    'IMPAIR': '0',
    'RED': '0',
    'BLACK': '0',
    '1-18': '0',
    '1-12': '0',
    '13-24': '0',
    '25-36': '0',
    '19-36': '0',
    '1': '0',
    '2': '0',
    '3': '0',
    '4': '0',
    '5': '0',
    '6': '0',
    '7': '0',
    '8': '0',
    '9': '0',
    '10': '0',
    '11': '0',
    '12': '0',
    '13': '0',
    '14': '0',
    '15': '0',
    '16': '0',
    '17': '0',
    '18': '0',
    '19': '0',
    '20': '0',
    '21': '0',
    '22': '0',
    '23': '0',
    '24': '0',
    '25': '0',
    '26': '0',
    '27': '0',
    '28': '0',
    '29': '0',
    '30': '0',
    '31': '0',
    '32': '0',
    '33': '0',
    '34': '0',
    '35': '0',
    '36': '0',
    'row1': '0',
    'row2': '0',
    'row3': '0',
};
let setbets = true;

function addMoney(bet) {
    if (setbets) {
        let value = parseInt(bets[bet]);
        bets[bet] = value + 10;
    }
}

function decreaseMoney(bet) {
    let value = parseInt(bets[bet]);
    if (setbets) {
        if (value === 0) {
        } else {
            bets[bet] = value - 10;
        }
    }
}


document.getElementById('roulette-table').addEventListener('contextmenu', function (event) {
    event.preventDefault();

});


document.addEventListener('DOMContentLoaded', function () {
    var table = document.getElementById('roulette-table');

    //linksclick
    table.addEventListener('click', function (event) {
        var clickedCell = event.target;

        var cellValue = parseInt(clickedCell.textContent);

        if (clickedCell.attributes.id.nodeValue === 'PAIR') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('PAIR');
        } else if (clickedCell.attributes.id.nodeValue === 'IMPAIR') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('IMPAIR');
        } else if (clickedCell.attributes.id.nodeValue === '1-12') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('1-12');
        } else if (clickedCell.attributes.id.nodeValue === '1-18') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('1-18');
        } else if (clickedCell.attributes.id.nodeValue === '13-24') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('13-24');
        } else if (clickedCell.attributes.id.nodeValue === 'RED') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('RED');
        } else if (clickedCell.attributes.id.nodeValue === 'BLACK') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('BLACK');
        } else if (clickedCell.attributes.id.nodeValue === '25-36') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('25-36');
        } else if (clickedCell.attributes.id.nodeValue === '19-36') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('19-36');
        } else if (clickedCell.attributes.id.nodeValue === 'row1') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('row1');
        } else if (clickedCell.attributes.id.nodeValue === 'row2') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('row2');
        } else if (clickedCell.attributes.id.nodeValue === 'row3') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            addMoney('row3');
        } else if (!isNaN(cellValue)) {
            console.log('Number:', cellValue);
            addMoney(cellValue);
        }
        console.log(bets);
    });
    //rechtsklick
    table.addEventListener('contextmenu', function (event) {
        event.preventDefault();
        var clickedCell = event.target;

        var cellValue = parseInt(clickedCell.textContent);

        if (clickedCell.attributes.id.nodeValue === 'PAIR') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('PAIR');
        } else if (clickedCell.attributes.id.nodeValue === 'IMPAIR') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('IMPAIR');
        } else if (clickedCell.attributes.id.nodeValue === '1-12') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('1-12');
        } else if (clickedCell.attributes.id.nodeValue === '1-18') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('1-18');
        } else if (clickedCell.attributes.id.nodeValue === '13-24') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('13-24');
        } else if (clickedCell.attributes.id.nodeValue === 'RED') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('RED');
        } else if (clickedCell.attributes.id.nodeValue === 'BLACK') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('BLACK');
        } else if (clickedCell.attributes.id.nodeValue === '25-36') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('25-36');
        } else if (clickedCell.attributes.id.nodeValue === '19-36') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('19-36');
        } else if (clickedCell.attributes.id.nodeValue === 'row1') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('row1');
        } else if (clickedCell.attributes.id.nodeValue === 'row2') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('row2');
        } else if (clickedCell.attributes.id.nodeValue === 'row3') {
            console.log('Value:', clickedCell.attributes.id.nodeValue);
            decreaseMoney('row3');
        } else if (!isNaN(cellValue)) {
            console.log('Number:', cellValue);
            decreaseMoney(cellValue);
        }
        console.log(bets);
    });
});

function goBack() {
    window.location.replace("http://odin.scam/dashboard");
}

function lastRotatetime() {
    return Math.random() * (1500 - 5000) + 5000;
}

function pause(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function berechneUnterschied(num1, num2) {
    return Math.abs(num1 - num2);
}

function findeNaechstenSchluessel(ziel, objekt) {
    let naechsterSchluessel = null;
    let kleinsterUnterschied = Infinity;

    for (let schluessel in objekt) {
        let aktuellerWert = parseFloat(objekt[schluessel]);
        let aktuellerUnterschied = berechneUnterschied(ziel, aktuellerWert);
        if (aktuellerUnterschied < kleinsterUnterschied) {
            kleinsterUnterschied = aktuellerUnterschied;
            naechsterSchluessel = schluessel;
        }
    }

    return naechsterSchluessel;
}


async function counter() {
    let element = document.getElementById('roulette-wheel2');
    for (let i = 1; i <= 30; i++) {
        document.getElementById('counter').textContent = 30 - i;
        if (i === 30) {
            setbets = false;
            document.getElementById('counter').textContent = '';
            await pause(lastRotatetime());
            document.querySelector('.roulette-wheel2').classList.toggle('pausedanimation');
            let zahl =getNumberFromAngle(getRotationAngle(element));
            console.log(zahl)
            return true;
        }
        await pause(1000);
    }
}

function getNumberFromAngle(angle) {
    let angleNumbers = {
        '1': '9.47',
        '13': '18.94',
        '36': '28.41',
        '24': '37.88',
        '3': '47.35',
        '15': '56.82',
        '34': '66.29',
        '22': '75.76',
        '5': '85.23',
        '17': '94.7',
        '32': '104.17',
        '20': '113.64',
        '7': '123.11',
        '11': '132.58',
        '30': '142.05',
        '26': '151.52',
        '9': '160.99',
        '28': '170.46',
        '0': '180',
        '2': '189.4',
        '14': '198.87',
        '35': '208.34',
        '23': '217.81',
        '4': '227.28',
        '16': '236.75',
        '33': '246.22',
        '21': '255.69',
        '6': '265.16',
        '18': '274.63',
        '31': '284.1',
        '19': '293.57',
        '8': '303.04',
        '12': '312.51',
        '29': '321.98',
        '25': '331.45',
        '10': '340.92',
        '27': '350.39',
        '00': '360'

    }
    if (angle < 0) {
        angle = angle + 360;
    }
    return findeNaechstenSchluessel(angle, angleNumbers);
}

function getRotationAngle(element) {
    const style = window.getComputedStyle(element);
    const matrix = new WebKitCSSMatrix(style.transform);
    return Math.atan2(matrix.m21, matrix.m11) * (180 / Math.PI);
}

let element = document.querySelector('.roulette-wheel2');
element.style.animationDuration = '5s';
element.style.animationIterationCount = 'infinite';
counter();



function openCodePopup() {
    document.getElementById('codePopup').showModal();
}

function closeCodePopup() {
    document.getElementById('codePopup').close();
}

function redeemCode() {

    closeCodePopup();
}

function goBack() {
    window.location.replace("http://odin.scam/dashboard");
}
