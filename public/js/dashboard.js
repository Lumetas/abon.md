let menuIsOpen = false;
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.overlay');

    toggleBtn.addEventListener('click', function () {
        if (menuIsOpen){
            sidebar.classList.remove('active');
            // overlay.classList.remove('active');
        } else {
            sidebar.classList.add('active');
            // overlay.classList.add('active');
        }
        menuIsOpen = !menuIsOpen;
    });
});