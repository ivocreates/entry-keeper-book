<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Initialize messages
$success = '';
$error = '';

// Handle check-in and check-out
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_id = filter_var($_POST['visitor_id'], FILTER_SANITIZE_NUMBER_INT);
    $action = $_POST['action'];

    // Fetch the visitor's details
    $visitor_query = "SELECT name, email, phone, checkin_time, checkout_time FROM visitors WHERE id = '$visitor_id' LIMIT 1";
    $visitor_result = mysqli_query($conn, $visitor_query);
    $visitor = mysqli_fetch_assoc($visitor_result);

    if ($visitor) {
        $visitor_name = htmlspecialchars($visitor['name']);
        $checkin_time = $visitor['checkin_time'];
        $checkout_time = $visitor['checkout_time'];
        $current_time = date('Y-m-d H:i:s');

        if ($action == 'checkin') {
            // Validate check-in
            if ($checkin_time && (strtotime($current_time) - strtotime($checkin_time) < 3600)) {
                $error = "You can't check in again until one hour has passed since your last check-in.";
            } else {
                // Update check-in time
                $query = "UPDATE visitors SET checkin_time = '$current_time' WHERE id = '$visitor_id'";
                if (mysqli_query($conn, $query)) {
                    $success = "Check-in successful for $visitor_name!";
                } else {
                    $error = "Error: " . mysqli_error($conn);
                }
            }
        } elseif ($action == 'checkout') {
            // Validate check-out
            if ($checkout_time && (strtotime($current_time) - strtotime($checkout_time) < 3600)) {
                $error = "You can't check out again until one hour has passed since your last check-out.";
            } else {
                // Update check-out time
                $query = "UPDATE visitors SET checkout_time = '$current_time' WHERE id = '$visitor_id'";
                if (mysqli_query($conn, $query)) {
                    $success = "Check-out successful for $visitor_name!";
                } else {
                    $error = "Error: " . mysqli_error($conn);
                }
            }
        }
    } else {
        $error = "Visitor not found.";
    }
}

// Fetch regular visitors
$search = '';
$status = '';

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if (isset($_GET['status'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
}

$searchQuery = "SELECT id, name, checkin_time, checkout_time FROM visitors WHERE type='regular'";

// Apply filters for search and status
if (!empty($search)) {
    $searchQuery .= " AND name LIKE '%$search%'";
}

if ($status == 'checkedin') {
    $searchQuery .= " AND checkin_time IS NOT NULL AND checkout_time IS NULL";
} elseif ($status == 'checkedout') {
    $searchQuery .= " AND checkout_time IS NOT NULL";
}

$result = mysqli_query($conn, $searchQuery);
?>

<div class="container mt-5">
    <h2>Check-in/Check-out Regular Visitors</h2>

    <?php if (!empty($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <!-- Search and filter form -->
    <form class="form-inline mb-3" method="get" action="">
        <input class="form-control mr-2" type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by Name">
        <select class="form-control mr-2" name="status">
            <option value="">All Status</option>
            <option value="checkedin" <?php if ($status == 'checkedin') echo 'selected'; ?>>Checked In</option>
            <option value="checkedout" <?php if ($status == 'checkedout') echo 'selected'; ?>>Checked Out</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Display the visitors table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Check-in Time</th>
                <th>Check-out Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['checkin_time'] ? $row['checkin_time'] : '-'; ?></td>
                    <td><?php echo $row['checkout_time'] ? $row['checkout_time'] : '-'; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="visitor_id" value="<?php echo $row['id']; ?>">
                            <?php if (!$row['checkin_time'] || $row['checkout_time']): ?>
                                <button type="submit" name="action" value="checkin" class="btn btn-success">Check In</button>
                            <?php else: ?>
                                <button type="submit" name="action" value="checkout" class="btn btn-danger">Check Out</button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
