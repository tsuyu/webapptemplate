<?php
$session = new SecureSession;

if (isset($_SESSION['logged']) && $_SESSION['logged'] == TRUE) {
    if ($session->AnalyseFingerPrint($Analysis) === true) {
        echo "content here";
    } else {
        $session->Destroy();
        Util::redirect("index.php?com=login");
    }
}else{
    Util::redirect("index.php?com=login");
}
?>