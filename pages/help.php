<?php
session_start();
include '../includes/header.php';
?>

<div class="container mt-5">
    <h2>Help Section</h2>
    <p>This application allows guards to manage visitor check-ins and check-outs efficiently. Below is a guide to help you navigate the application.</p>
    
    <h4>How to Use:</h4>
    <ul>
        <li><strong>Register New Visitors:</strong> Use the "Register" pages to input visitor details.</li>
        <li><strong>Check In and Check Out:</strong> Navigate to the check-in/check-out pages to manage visitor records.</li>
        <li><strong>View Visitor List:</strong> Use the visitor list page to view all registered visitors and their statuses.</li>
        <li><strong>Export Visitor Data:</strong> Utilize the export function to download visitor data in various formats.</li>
    </ul>
    
    <h4>Contact the Creator:</h4>
    <p>If you have any questions or feedback, feel free to reach out:</p>
    <ul>
        <li><strong>Name:</strong> Ivo Pereira</li>
        <li><strong>Email:</strong> ivopereiraix3@gmail.com</li>
        <li><strong>Phone:</strong> +91 9403765835</li>
    </ul>
    <div class="social-buttons">
        <a href="https://wa.me/919403765835" target="_blank" class="btn whatsapp">
            <i class="bi bi-whatsapp"></i> WhatsApp
        </a>
        <a href="https://www.instagram.com/perivo_ix3" target="_blank" class="btn instagram">
            <i class="bi bi-instagram"></i> Instagram
        </a>
        <a href="https://github.com/Perivo" target="_blank" class="btn github">
            <i class="bi bi-github"></i> GitHub
        </a>
        <a href="mailto:ivopereiraix3@gmail.com" class="btn email">
            <i class="bi bi-envelope-fill"></i> Email
        </a>
    </div>
    
    <h4>Troubleshooting:</h4>
    <ul>
        <li><strong>Can't Check In Visitors:</strong> Ensure that all required fields are filled out correctly. Check for any error messages.</li>
        <li><strong>Application Not Responding:</strong> Refresh the page or clear your browser cache. If the issue persists, restart the application server.</li>
        <li><strong>Data Not Saving:</strong> Check your database connection settings and ensure the database is running.</li>
    </ul>

    <h4>Frequently Asked Questions (FAQ):</h4>
    <ul>
        <li><strong>Q: Can I edit visitor details after registration?</strong><br>A: Yes, you can update visitor details in the visitor list.</li>
        <li><strong>Q: Is there a limit to the number of visitors I can register?</strong><br>A: No, you can register as many visitors as needed based on your database capacity.</li>
        <li><strong>Q: How can I reset my application settings?</strong><br>A: You can reset settings from the "Settings" page in the application.</li>
        <li><strong>Q: Who can access the visitor list?</strong><br>A: Only authorized users with the necessary permissions can view the visitor list.</li>
    </ul>
</div>

<?php include '../includes/footer.php'; ?>
