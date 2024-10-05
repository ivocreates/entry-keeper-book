<?php
session_start();
include '../includes/header.php';
include '../includes/dbconnect.php';

// Initialize variables for search filters
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$visitor_type = isset($_GET['visitor_type']) ? $_GET['visitor_type'] : '';
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
$time_from = isset($_GET['time_from']) ? $_GET['time_from'] : '';
$time_to = isset($_GET['time_to']) ? $_GET['time_to'] : '';

// Base query
$query = "SELECT * FROM visitors WHERE 1=1";

// Apply filters
if (!empty($search_name)) {
    $query .= " AND name LIKE '%$search_name%'";
}
if (!empty($visitor_type)) {
    $query .= " AND type = '$visitor_type'";
}
if (!empty($date_from) && !empty($date_to)) {
    $query .= " AND DATE(checkin_time) BETWEEN '$date_from' AND '$date_to'";
}
if (!empty($time_from) && !empty($time_to)) {
    $query .= " AND TIME(checkin_time) BETWEEN '$time_from' AND '$time_to'";
}

$result = mysqli_query($conn, $query);

// Handle CSV and PDF export
if (isset($_POST['export_type'])) {
    $export_type = $_POST['export_type'];
    
    $filename = "visitors_" . date('Ymd') . "." . $export_type;

    // Export as CSV
    if ($export_type == 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Name', 'Type', 'Email', 'Phone', 'Department/Purpose', 'Check-in Time', 'Check-out Time']);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data = [
                $row['id'],
                $row['name'],
                ucfirst($row['type']),
                $row['email'],
                $row['phone'],
                ($row['type'] === 'regular') ? $row['department'] : $row['purpose'],
                $row['checkin_time'],
                $row['checkout_time']
            ];
            fputcsv($output, $data);
        }
        fclose($output);
        exit();
    }

    // Export as PDF
    if ($export_type == 'pdf') {
        require_once('../includes/tcpdf/tcpdf.php'); // Include TCPDF library for PDF generation

        // Create new PDF document
        $pdf = new TCPDF();
        $pdf->AddPage();
        
        // Set title
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Visitor List', 0, 1, 'C');
        $pdf->SetFont('Helvetica', '', 10);

        // Table header
        $html = '<table border="1" cellpadding="4"><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department/Purpose</th>
                    <th>Check-in Time</th>
                    <th>Check-out Time</th>
                </tr>';

        // Table data
        while ($row = mysqli_fetch_assoc($result)) {
            $html .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . ucfirst($row['type']) . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['phone'] . '</td>
                        <td>' . (($row['type'] === 'regular') ? $row['department'] : $row['purpose']) . '</td>
                        <td>' . $row['checkin_time'] . '</td>
                        <td>' . $row['checkout_time'] . '</td>
                    </tr>';
        }
        $html .= '</table>';
        
        // Output PDF
        $pdf->writeHTML($html);
        $pdf->Output($filename, 'D');
        exit();
    }
}
?>

<div class="container mt-5">
    <h2>Visitor List with Filters</h2>

    <!-- Search and Filter Form -->
    <form method="get" action="" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search_name" class="form-control" placeholder="Search by Name" value="<?php echo htmlspecialchars($search_name); ?>">
            </div>
            <div class="col-md-2">
                <select name="visitor_type" class="form-control">
                    <option value="">All Types</option>
                    <option value="regular" <?php if ($visitor_type == 'regular') echo 'selected'; ?>>Regular</option>
                    <option value="irregular" <?php if ($visitor_type == 'irregular') echo 'selected'; ?>>Irregular</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" placeholder="From Date" value="<?php echo $date_from; ?>">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control" placeholder="To Date" value="<?php echo $date_to; ?>">
            </div>
            <div class="col-md-1">
                <input type="time" name="time_from" class="form-control" placeholder="From Time" value="<?php echo $time_from; ?>">
            </div>
            <div class="col-md-1">
                <input type="time" name="time_to" class="form-control" placeholder="To Time" value="<?php echo $time_to; ?>">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Visitor List Table -->
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
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo ucfirst($row['type']); ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo ($row['type'] === 'regular') ? $row['department'] : $row['purpose']; ?></td>
                        <td><?php echo $row['checkin_time']; ?></td>
                        <td><?php echo $row['checkout_time']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No visitors found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <form method="post" action="">
        <button type="submit" name="export_type" value="csv" class="btn btn-success mt-3">Export as CSV</button>
        <button type="submit" name="export_type" value="pdf" class="btn btn-danger mt-3">Export as PDF</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
