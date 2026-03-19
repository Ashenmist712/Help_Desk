document.addEventListener('DOMContentLoaded', function () {
    
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const parent = this.parentElement;
            const menu = parent.querySelector('.dropdown-menu');

            
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.style.display = 'none';
            });

            const isVisible = window.getComputedStyle(menu).display === 'block';
            menu.style.display = isVisible ? 'none' : 'block';
        });
    });

    document.addEventListener('click', function () {
        document.querySelectorAll('.dropdown-menu').forEach(m => {
            m.style.display = 'none';
        });
    });
});