// Toggle dark mode
const toggleDarkMode = () => {
    document.body.classList.toggle('dark-mode');
    const sidebarLinks = document.querySelectorAll('#sidebar ul li a');
    sidebarLinks.forEach(link => link.classList.toggle('dark-mode'));
    const footer = document.querySelector('.footer');
    footer.classList.toggle('dark-mode');
};

// Event listener for dark mode toggle button
document.getElementById('darkModeToggle').addEventListener('click', toggleDarkMode);
