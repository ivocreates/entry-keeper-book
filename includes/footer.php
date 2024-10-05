</div>
    </div> <!-- End of content -->

    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
        <span>&copy; <?php echo date('Y'); ?> Your Company. All rights reserved.</span>
    </div>
</footer>
</div> <!-- End of wrapper -->

<!-- JS Scripts -->
<!-- Chart.js CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        // Dark mode toggle functionality
        $('#darkModeToggle').on('click', function () {
            $('body').toggleClass('dark-mode');
            $('#sidebar').toggleClass('dark-mode');
            $('.footer').toggleClass('dark-mode');
            $('#content').toggleClass('dark-mode');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>
</html>