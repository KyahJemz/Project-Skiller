<?php
    require(__DIR__."/fpdf186/fpdf.php");

    $pdf = new FPDF();

    $pdf->AddPage('L');

    $w = $pdf->GetPageWidth();
    $h = $pdf->GetPageHeight();

    $pdf->Image('E-Certificate.jpg', 0, 0, $w, $h);

    $pdf->SetFont('Arial', 'B', 16);

    $text = 'Hello World!';
    $textWidth = $pdf->GetStringWidth($text);
    $x = ($w - $textWidth) / 2; // Center horizontally
    $pdf->Cell($textWidth, 10, $text, 0, 1, 'C');

    $filename = "./../public/images/certificates/certificate_" . date("YmdHis") . ".pdf";

    // Output the PDF
    $pdf->Output($filename, 'F');

    echo "Certificate generated and saved as: $filename";
?>
