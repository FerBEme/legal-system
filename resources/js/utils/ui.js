export const virePassword = (inputId,buttonId,iconId) => {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    const icon = document.getElementById(iconId);
    if(!input || !button) return;
    button.addEventListener('click', () => {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        if(icon){
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    });
};