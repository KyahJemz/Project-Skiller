<?php
class PDF {
    static function createPdf($params) {
        require(__DIR__."./../fpdf/fpdf186/fpdf.php");

        if (!isset($params['certName'])) {
            return ['error' => 'Invalid Parameters'];
        }

        date_default_timezone_set('Asia/Manila');
        $philippine_time = date('F j, Y h:i A');

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $w = $pdf->GetPageWidth();
        $h = $pdf->GetPageHeight();

        $pdf->Image(__DIR__.'./../fpdf/E-Certificate.png', 0, 0, $w, $h);

        $pdf->SetTextColor(255, 255, 255);
        $pdf->AddFont('GreatVibes', 'B', 'GreatVibes.php'); 

        $pdf->SetY(85);
        $certName = $params['certName'];
        $pdf->SetFont('GreatVibes', 'B', 40);
        $certNameWidth = $pdf->GetStringWidth($certName);
        $x = ($w - $certNameWidth) / 2;
        $pdf->Cell(0, 10, $certName, 0, 1, 'C');

        $pdf->SetY($pdf->GetY() + 20);
        $certDate = $philippine_time;
        $pdf->SetFont('Times', '', 20);
        $certDateWidth = $pdf->GetStringWidth($certDate);
        $x = ($w - $certDateWidth) / 2;
        $pdf->Cell(0, 10, $certDate, 0, 1, 'C');

        $filename = __DIR__."./../public/certificates/certificate_" . date("YmdHis") . ".pdf";
        $pdf->Output($filename, 'F');

        echo "Created";

        return ['success' => 'Certificate generated and saved as: ' . $filename];
    }
}
?>