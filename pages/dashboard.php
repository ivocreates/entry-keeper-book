<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Fetch visitor statistics
$query_total_visitors = "SELECT COUNT(*) as total_visitors FROM visitors";
$result_total_visitors = mysqli_query($conn, $query_total_visitors);
$row_total_visitors = mysqli_fetch_assoc($result_total_visitors);
$total_visitors = $row_total_visitors['total_visitors'];

$query_regular_visitors = "SELECT COUNT(*) as regular_visitors FROM visitors WHERE type='regular'";
$result_regular_visitors = mysqli_query($conn, $query_regular_visitors);
$row_regular_visitors = mysqli_fetch_assoc($result_regular_visitors);
$total_regular_visitors = $row_regular_visitors['regular_visitors'];

$query_irregular_visitors = "SELECT COUNT(*) as irregular_visitors FROM visitors WHERE type='irregular'";
$result_irregular_visitors = mysqli_query($conn, $query_irregular_visitors);
$row_irregular_visitors = mysqli_fetch_assoc($result_irregular_visitors);
$total_irregular_visitors = $row_irregular_visitors['irregular_visitors'];

// Additional statistics can be added as required
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Visitor Management Dashboard</h2>

    <!-- Statistics Section -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Visitors</h5>
                    <p class="card-text" style="font-size: 24px;"><?php echo $total_visitors; ?></p>
                    <a href="visitor_list.php" class="btn btn-light">View All Visitors</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Regular Visitors</h5>
                    <p class="card-text" style="font-size: 24px;"><?php echo $total_regular_visitors; ?></p>
                    <a href="visitor_list.php?type=regular" class="btn btn-light">View Regular Visitors</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Irregular Visitors</h5>
                    <p class="card-text" style="font-size: 24px;"><?php echo $total_irregular_visitors; ?></p>
                    <a href="visitor_list.php?type=irregular" class="btn btn-light">View Irregular Visitors</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards Section -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa fa-user-plus fa-2x mb-3 text-primary"></i>
                    <h5 class="card-title">Register Visitor</h5>
                    <p class="card-text">Register a new regular or irregular visitor for check-in.</p>
                    <a href="checkin.php" class="btn btn-primary">Go to Register</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa fa-search fa-2x mb-3 text-success"></i>
                    <h5 class="card-title">Search Visitors</h5>
                    <p class="card-text">Search and filter visitors by name, date, or type.</p>
                    <a href="search.php" class="btn btn-success">Go to Search</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa fa-chart-bar fa-2x mb-3 text-danger"></i>
                    <h5 class="card-title">Reports</h5>
                    <p class="card-text">View detailed reports and analytics of visitor trends.</p>
                    <a href="reports.php" class="btn btn-danger">View Reports</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa fa-cogs fa-2x mb-3 text-warning"></i>
                    <h5 class="card-title">Settings</h5>
                    <p class="card-text">Manage application settings and user roles.</p>
                    <a href="settings.php" class="btn btn-warning">Go to Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<?php include '../includes/footer.php'; ?>
