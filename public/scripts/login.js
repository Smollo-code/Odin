function toggleForm() {
    const loginForm = document.querySelector('.form-container:nth-child(1)');
    const registerForm = document.querySelector('.form-container:nth-child(2)');

    loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
    registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';
}