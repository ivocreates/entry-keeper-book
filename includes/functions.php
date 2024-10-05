<?php

// Function to export data to CSV
function exportToCSV($filename, $data) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    
    $output = fopen('php://output', 'w');

    // Add headers
    fputcsv($output, array('ID', 'Name', 'Email', 'Phone', 'Check-In Time', 'Check-Out Time', 'Type'));
    
    // Add data rows
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit(); // Ensure no other output is sent
}

// Function to export data to PDF (requires TCPDF library)
function exportToPDF($filename, $data) {
    // Ensure TCPDF library is included
    require_once('tcpdf/tcpdf.php');
    
    // Create new PDF document
    $pdf = new TCPDF();
    
    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Entry Keeper');
    $pdf->SetTitle($filename);
    $pdf->SetSubject('Visitor Report');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // Add a page
    $pdf->AddPage();
    
    // Write content
    $pdf->SetFont('Helvetica', '', 12);
    $html = '<h1>Visitor Report</h1>';
    $html .= '<table border="1" cellpadding="5">';
    $html .= '<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Check-In Time</th><th>Check-Out Time</th><th>Type</th></tr>';

    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $column) {
            $html .= '<td>' . htmlspecialchars($column) . '</td>'; // Prevent XSS
        }
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output($filename, 'D'); // Change to 'I' to view in browser, 'D' for download
    exit(); // Ensure no other output is sent
}

?>
