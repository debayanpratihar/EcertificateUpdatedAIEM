<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];

    // Handle uploaded signature
    $signatureFileName = "";
    if ($_FILES["signature"]["error"] === UPLOAD_ERR_OK) {
        $tempName = $_FILES["signature"]["tmp_name"];
        $extension = pathinfo($_FILES["signature"]["name"], PATHINFO_EXTENSION);
        $signatureFileName = "signature_" . time() . "." . $extension;

        // Move the uploaded file to a directory
        move_uploaded_file($tempName, "uploads/" . $signatureFileName);
    }

    // Generate the certificate PDF
    require('fpdf.php'); // You'll need to download the FPDF library

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, "Certificate of Attendance", 0, 1, 'C');

    // Add name and event details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "This is to certify that $name", 0, 1, 'C');
    $pdf->Cell(0, 10, "has attended the $eventName event", 0, 1, 'C');
    $pdf->Cell(0, 10, "held on $eventDate.", 0, 1, 'C');

    // Add uploaded signature
    if ($signatureFileName) {
        $pdf->Image("uploads/" . $signatureFileName, 10, 100, 50);
    }

    // Output the PDF
    $pdf->Output("certificate.pdf", 'D');
} else {
    // Handle invalid access
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
}
?>
