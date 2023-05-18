<?php
if (isset($link)) {
    ob_get_clean();
    header("Content-type:application/pdf");
    header("Content-Disposition:attachment;filename=" . time() . ".pdf");
    echo file_get_contents($link);
    exit;
}
