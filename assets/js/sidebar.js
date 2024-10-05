document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarCollapse');
    
    sidebarToggle.addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
    });
});
