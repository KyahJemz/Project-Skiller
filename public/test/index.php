<?php
    include(__DIR__ . './../../config/Pdf.php');
    include(__DIR__ . './../../config/Email.php');
    // sendMail([
    //     'ReceiverName' => 'stephen BCASH',
    //     'ReceiverEmail' => 'jameslayson.0@gmail.com'
    // ])

    PDF::createPdf(['Name'=>'Stephen Regan James Layson']);
?>