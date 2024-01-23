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

function getNumbersFromString(string) {
    let numbers = [];
    for (let char of string) {
        if (char >= '0' && char <= '9') {
            numbers.push(char);
        }
    }
    return parseInt(numbers.join(''));
}

function addMoney(bet) {
    if (setbets) {
        displayCoinImageOnNumber(bet)
        let value = parseInt(bets[bet]);
        let currentMoney = getNumbersFromString(document.getElementById('money').textContent);
        if (currentMoney === 0) {
        } else {
            document.getElementById('money').textContent = 'Geld: ' + (currentMoney - 10);
            bets[bet] = value + 10;
        }
    }
}

function decreaseMoney(bet) {
    removeCoinImageFromNumber(bet)
    let value = parseInt(bets[bet]);
    if (setbets) {
        if (value === 0) {
        } else {
            bets[bet] = value - 10;
            let currentMoney = getNumbersFromString(document.getElementById('money').textContent);
            document.getElementById('money').textContent = 'Geld: ' + (currentMoney + 10);
        }
    }
}

function getNumber(winningNumber) {
    var min = 0;
    var max = 38;
    var x = Math.round(Math.random() * (max - min) + min);
}

//Gewinn Funktion
function prize(winningNumber) {
    let winningAmount = 0;

    // Spezifische Zahl
    for (let number in bets) {
        if (parseInt(number) === winningNumber) {
            winningAmount += bets[number] * 35; // 35:1 Auszahlung
            break;
        }
    }
    //Rot und Schwarz: 1:1 Auszahlung
    if (winningNumber === 0) {
    } else if (isRed(winningNumber)) {
        winningAmount += calculateEvenMoneyWin('RED');
    } else {
        winningAmount += calculateEvenMoneyWin('BLACK');
    }

    // Pair oder Impair
    if (winningNumber % 2 === 0) {
        winningAmount += calculateEvenMoneyWin('PAIR');
    } else {
        winningAmount += calculateEvenMoneyWin('IMPAIR');
    }

    // 1-18 oder 19-36: 1:1 Auszahlung
    if (winningNumber >= 1 && winningNumber <= 18) {
        winningAmount += calculateEvenMoneyWin('1-18');
    } else {
        winningAmount += calculateEvenMoneyWin('19-36');
    }

    // 1-12, 13-24 oder 25-36: 2:1 Auszahlung
    if (winningNumber >= 1 && winningNumber <= 12) {
        winningAmount += calculateTwoToOneWin('1-12');
    } else if (winningNumber >= 13 && winningNumber <= 24) {
        winningAmount += calculateTwoToOneWin('13-24');
    } else if (winningNumber >= 25 && winningNumber <= 36) {
        winningAmount += calculateTwoToOneWin('25-36');
    }

    // Row1, Row2 oder Row3: 2:1 Auszahlung
    if (winningNumber % 3 === 1) {
        winningAmount += calculateTwoToOneWin('row1');
    } else if (winningNumber % 3 === 2) {
        winningAmount += calculateTwoToOneWin('row2');
    } else {
        winningAmount += calculateTwoToOneWin('row3');
    }

    if (winningAmount > 0 ) {
        document.getElementById('audiofile').play();
    }
    console.log(winningAmount);
    let total = winningAmount+getNumbersFromString(document.getElementById('money').textContent);
    ajaxCall(total);
    document.getElementById('money').textContent = 'Geld: ' + total;
}

function isRed(number) {
    const redNumbers = ['1', '3', '5', '7', '9', '12', '14', '16', '18', '19', '21', '23', '25', '27', '30', '32', '34', '36'];
    return redNumbers.includes(number.toString());
}

function calculateTwoToOneWin(betType) {
    let value = parseInt(bets[betType]);

    if (value > 0) {
        return value * 3; // 2:1 Auszahlung
    }
    return 0;
}

function calculateEvenMoneyWin(betType) {
    let value = parseInt(bets[betType]);

    if (value > 0) {
        return value * 2; // 1:1 Auszahlung
    }
    return 0;
}

function displayCoinImageOnNumber(number) {
    var coinImage = document.createElement('div');
    coinImage.className = 'coin-image';
    coinImage.setAttribute('data-number', number);

    var cell = document.getElementById(number.toString());
    var cellRect = cell.getBoundingClientRect();
    coinImage.style.left = cellRect.left + 'px';
    coinImage.style.top = cellRect.top + 'px';

    document.body.appendChild(coinImage);
}

function removeCoinImageFromNumber(number) {
    var specificCoinImage = document.querySelector('.coin-image[data-number="' + number + '"]');
    if (specificCoinImage) {
        specificCoinImage.remove();
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
            decreaseMoney('1-12');;
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
    return Math.random() * (7000 - 5000) + 5000;
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

function resetBets() {
    const keys = Object.keys(bets)
    for (let i = 0; i < Object.keys(bets).length; i++) {
        bets[keys[i]] = '0';
    }
}


async function reset() {
    resetBets();
    setbets = true;
    await pause(2000);
    document.querySelector('.roulette-wheel2').classList.toggle('pausedanimation');
    counter();
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
            let winningnumber = getNumberFromAngle(getRotationAngle(element));
            console.log(winningnumber)
            prize(winningnumber);
        }
        await pause(1000);
    }
    reset()
}

function ajaxCall (data) {
    $.ajax({
        url: '/roulettedb',
        type: 'POST',
        data: {'data': data}
    });

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
        '00': '360, 0'

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

function openCodePopup() {
    document.getElementById('codePopup').showModal();
}

function closeCodePopup() {
    document.getElementById('codePopup').close();
}

function redeemCode() {

    closeCodePopup();
}

let element = document.querySelector('.roulette-wheel2');
element.style.animationDuration = '5s';
element.style.animationIterationCount = 'infinite';
counter();