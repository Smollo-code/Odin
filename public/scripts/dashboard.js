function logout() {
    window.location.replace('http://odin.scam/logout.php');
}

function navigateToPage(page) {
    if (page === 'page1') {
        window.location.replace("http://odin.scam/calc.php");
    } else if (page === 'page3') {
        window.location.replace("https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley");
    } else if (page === 'page2') {
        window.location.replace("tictactoe.php");
    }

}

function openAccountSettings() {
    window.location.replace('http://odin.scam/profile.php')
}