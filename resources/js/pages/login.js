import { login,getUser } from "../services/auth";
import { virePassword } from "../utils/ui";
document.addEventListener('DOMContentLoaded', () => {
    virePassword('password','viewPassword','iconEye');
    const form = document.getElementById('loginForm');
    const errorBox = document.getElementById('errorBox');
    const btn = document.getElementById('loginBtn');
    const btnText = document.getElementById('btnText');
    form.addEventListener('submit',async (e) => {
        e.preventDefault();
        errorBox.classList.add('hidden');
        btn.disabled = true;
        btnText.innerText = 'Ingresando...';
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        try {
            await login(email,password);
            const user = await getUser();
            if (user.role === 'admin') window.location.href = '/admin/dashboard';                
            else window.location.href = '/lawyer/users';
        } catch (error) {
            errorBox.innerText = 'Credenciales incorrectas';
            errorBox.classList.remove('hidden');
        } finally {
            btn.disabled = false;
            btnText.innerText = 'Ingresar';
        }
    });
});