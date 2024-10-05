<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_id = $_POST['visitor_id'];
    $checkout_time = date('Y-m-d H:i:s');

    $query = "UPDATE visitors SET checkout_time = '$checkout_time' WHERE id = '$visitor_id'";
    if (mysqli_query($conn, $query)) {
        $success = "Check-out successful!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Fetch regular visitors for selection
$query = "SELECT id, name FROM visitors WHERE type='regular' AND checkin_time IS NOT NULL";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h2>Check-out Regular Visitor</h2>
    <?php if(isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="visitor_id">Select Visitor</label>
            <select name="visitor_id" class="form-control" required>
                <option value="">--Select Visitor--</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Check Out</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
