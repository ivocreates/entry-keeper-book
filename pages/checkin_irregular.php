<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $purpose = $_POST['purpose'];
    $checkin_time = date('Y-m-d H:i:s');

    $query = "INSERT INTO visitors (name, email, phone, purpose, checkin_time, type) VALUES ('$name', '$email', '$phone', '$purpose', '$checkin_time', 'irregular')";
    if (mysqli_query($conn, $query)) {
        $success = "Check-in successful!";
    } else {
        $error = "Error: " . mysqli_error($connection);
    }
}
?>

<div class="container mt-5">
    <h2>Check-in Irregular Visitor</h2>
    <?php if(isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
    <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="form-group">
            <label for="purpose">Purpose of Visit</label>
            <input type="text" class="form-control" name="purpose" required>
        </div>
        <button type="submit" class="btn btn-primary">Check In</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
