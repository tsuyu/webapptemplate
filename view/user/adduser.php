<?php

$session = new SecureSession;

if (isset($_SESSION['logged_in'])) {
    if ($session->AnalyseFingerPrint($Analysis) === true) {
        
    } else {
        $session->Destroy();
        Util::redirect("index.php?com=login");
    }
}
?>