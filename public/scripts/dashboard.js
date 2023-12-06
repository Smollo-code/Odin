function logout() {
    window.location.replace('/logout');
}

function navigateToPage(page) {
    if (page === 'page1') {
        window.location.replace("http://odin.scam/calc");
    } else if (page === 'page3') {
        window.location.replace("http://odin.scam/emailer");
    } else if (page === 'page2') {
        window.location.replace("/tictactoe");
    }

}

function openAccountSettings() {
    window.location.replace('http://odin.scam/profile')
}