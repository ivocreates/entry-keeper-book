<div class="wrapper d-flex">
<nav id="sidebar" class="bg-dark">
    <div class="sidebar-header text-center py-4">
        <h4 class="text-white">Entry Keeper</h4>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li>
            <a href="register_regular.php"><i class="fas fa-user-plus"></i> Register Regular Visitor</a>
        </li>
        <li>
            <a href="check_in-out.php"><i class="fas fa-sign-in-out-alt"></i> Check-In/out Regular Visitor</a>
        </li>
        <li>
            <a href="checkin_irregular.php"><i class="fas fa-sign-in-alt"></i> Check-In Irregular Visitor</a>
        </li>
        <li>
            <a href="checkout_irregular.php"><i class="fas fa-sign-out-alt"></i> Check-Out Irregular Visitor</a>
        </li>
        <li>
            <a href="visitor_list.php"><i class="fas fa-list"></i> Visitor List</a>
        </li>
        <li>
            <a href="reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
        </li>
        <li>
            <a href="user_management.php"><i class="fas fa-users-cog"></i> User Management</a>
        </li>
        <li>
            <a href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
        </li>
        <li>
            <a href="help.php"><i class="fas fa-question-circle"></i> Help</a>
        </li>
        <li>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</nav>



<!-- Sidebar toggle functionality script -->
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
