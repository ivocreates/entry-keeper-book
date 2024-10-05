<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Initialize variables for search filters
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
$visitor_type = isset($_GET['visitor_type']) ? $_GET['visitor_type'] : '';
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Base query to get visitor statistics
$query = "SELECT id, name, type, email, phone, department, purpose, checkin_time, checkout_time 
          FROM visitors 
          WHERE 1=1";

// Apply filters based on user input
if (!empty($date_from) && !empty($date_to)) {
    $query .= " AND DATE(checkin_time) BETWEEN '$date_from' AND '$date_to'";
}
if (!empty($visitor_type)) {
    $query .= " AND type = '$visitor_type'";
}
if (!empty($search_query)) {
    $query .= " AND (name LIKE '%$search_query%' OR email LIKE '%$search_query%')";
}

$query .= " ORDER BY checkin_time DESC";
$result = mysqli_query($conn, $query);

// Calculate total visitors and categorize them
$total_visitors = mysqli_num_rows($result);
$total_regular = 0;
$total_irregular = 0;
$checked_in_regular = 0;
$checked_out_regular = 0;
$checked_in_irregular = 0;
$not_checked_out_irregular = 0;

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['type'] === 'regular') {
        $total_regular++;
        if ($row['checkin_time']) {
            $checked_in_regular++;
        }
        if ($row['checkout_time']) {
            $checked_out_regular++;
        }
    } elseif ($row['type'] === 'irregular') {
        $total_irregular++;
        if ($row['checkin_time']) {
            $checked_in_irregular++;
        }
        if (empty($row['checkout_time'])) {
            $not_checked_out_irregular++;
        }
    }
}
?>

<div class="container mt-5">
    <h2>Reports and Analytics</h2>

    <!-- Filter Form -->
    <form method="get" action="" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="date_from" class="form-control" placeholder="From Date" value="<?php echo $date_from; ?>">
            </div>
            <div class="col-md-3">
                <input type="date" name="date_to" class="form-control" placeholder="To Date" value="<?php echo $date_to; ?>">
            </div>
            <div class="col-md-3">
                <select name="visitor_type" class="form-control">
                    <option value="">All Types</option>
                    <option value="regular" <?php if ($visitor_type == 'regular') echo 'selected'; ?>>Regular</option>
                    <option value="irregular" <?php if ($visitor_type == 'irregular') echo 'selected'; ?>>Irregular</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="search_query" class="form-control" placeholder="Search by Name or Email" value="<?php echo $search_query; ?>">
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="export.php?date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>&visitor_type=<?php echo $visitor_type; ?>&search_query=<?php echo $search_query; ?>" class="btn btn-success">Export to CSV</a>
            </div>
        </div>
    </form>

    <!-- Summary Statistics -->
    <div class="alert alert-info">
        <h5>Visitor Summary</h5>
        <p>Total Visitors: <?php echo $total_visitors; ?></p>
        <p>Total Regular Visitors: <?php echo $total_regular; ?></p>
        <p>Total Irregular Visitors: <?php echo $total_irregular; ?></p>
        <p>Regular Visitors Checked In: <?php echo $checked_in_regular; ?></p>
        <p>Regular Visitors Checked Out: <?php echo $checked_out_regular; ?></p>
        <p>Irregular Visitors Checked In: <?php echo $checked_in_irregular; ?></p>
        <p>Irregular Visitors Not Checked Out: <?php echo $not_checked_out_irregular; ?></p>
    </div>

    <!-- Detailed Visitor Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department/Purpose</th>
                <th>Check-in Time</th>
                <th>Check-out Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reset pointer for the result set to fetch data again for the table
            mysqli_data_seek($result, 0);
            if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo ucfirst(htmlspecialchars($row['type'])); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo ($row['type'] === 'regular') ? htmlspecialchars($row['department']) : htmlspecialchars($row['purpose']); ?></td>
                        <td><?php echo htmlspecialchars($row['checkin_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['checkout_time']); ?></td>
                        <td>
                            <?php
                            if ($row['checkout_time']) {
                                echo 'Checked Out';
                            } else {
                                echo 'Checked In';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No visitors found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Additional Charts and Graphs -->
    <div id="chart-container" class="mt-4">
        <h5>Visitor Trends</h5>
        <canvas id="visitorChar
