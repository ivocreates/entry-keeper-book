<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Check if the form is submitted for checking out a visitor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['visitor_id'])) {
    $visitor_id = filter_var($_POST['visitor_id'], FILTER_SANITIZE_NUMBER_INT);
    $checkout_time = date('Y-m-d H:i:s');

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare("UPDATE visitors SET checkout_time = ? WHERE id = ?");
    $stmt->bind_param("si", $checkout_time, $visitor_id);

    if ($stmt->execute()) {
        $success = "Check-out successful!";
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Initialize search term
$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Fetch irregular visitors who are currently checked in, applying the search filter if applicable
$query = "SELECT id, name, checkin_time FROM visitors WHERE type='irregular' AND checkin_time IS NOT NULL AND checkout_time IS NULL";

if (!empty($search)) {
    $query .= " AND name LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);
$has_visitors = mysqli_num_rows($result) > 0;
?>

<div class="container mt-5">
    <h2>Check-out Irregular Visitor</h2>
    
    <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <!-- Search form -->
    <form class="form-inline mb-3" method="get" action="">
        <input class="form-control mr-2" type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by Name">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Display visitors table -->
    <?php if ($has_visitors): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Check-in Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['checkin_time']); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="visitor_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-primary">Check Out</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No irregular visitors are currently checked in.</div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
