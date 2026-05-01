document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('userMenuBtn');
    const dropdown = document.getElementById('userDropdown');
    if (btn && dropdown) {
        btn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
});