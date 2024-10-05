<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];

    $query = "SELECT * FROM visitors WHERE name LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);
}
?>

<div class="container mt-5">
    <h2>Search Visitors</h2>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" class="form-control" name="search_query" placeholder="Search by Name" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php if (isset($result)): ?>
        <h3>Search Results:</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Check-in Time</th>
                    <th>Check-out Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['checkin_time']; ?></td>
                        <td><?php echo $row['checkout_time']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
