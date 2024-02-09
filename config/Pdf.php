<?php
    class PDF {
        static function createPdf($params){
            require(__DIR__."./../fpdf/fpdf186/fpdf.php");
        
            $pdf = new FPDF();
        
            $pdf->AddPage('L');
        
            $w = $pdf->GetPageWidth();
            $h = $pdf->GetPageHeight();
        
            $pdf->Image(__DIR__.'./../fpdf/E-Certificate.jpg', 0, 0, $w, $h);
        
            $pdf->SetFont('Arial', 'B', 16);
        
            $text = $params['Name'];
            $textWidth = $pdf->GetStringWidth($text);
            $x = ($w - $textWidth) / 2; 
            $pdf->Cell($textWidth, 10, $text, 0, 1, 'C');
        
            $filename = __DIR__."./../public/images/certificates/certificate_" . date("YmdHis") . ".pdf";
        
            $pdf->Output($filename, 'F');
        
            echo "Certificate generated and saved as: $filename";
        }
    }
?>