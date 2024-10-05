<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php'; // Ensure dbconnect.php is included to establish the connection

// Initialize variables
$username = $email = $password = '';
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim and sanitize inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Check if the username or email already exists
    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($query);  // Use $conn as the connection variable
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Username or email already exists.";
        }
    }

    // If no errors, proceed to insert the new user
    if (empty($errors)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);  // Use $conn as the connection variable
        $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($insert_stmt->execute()) {
            $_SESSION['success_message'] = "Registration successful! You can now log in.";
            header('Location: login.php');
            exit();
        } else {
            $errors[] = "Error during registration. Please try again.";
        }
    }
}
?>

<!-- HTML for signup form -->
<div class="container mt-5">
    <h2>Sign Up</h2>
    <?php
    // Display errors if any
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }

    // Display success message if any
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">';
        echo "<p>" . $_SESSION['success_message'] . "</p>";
        echo '</div>';
        unset($_SESSION['success_message']);
    }
    ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
    <p class="mt-3">Already have an account? <a href="login.php">Log in here</a>.</p>
</div>

<?php include '../includes/footer.php'; ?>
