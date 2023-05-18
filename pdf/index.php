<?php
require __DIR__ . '/vendor/autoload.php';

use Spatie\Browsershot\Browsershot;

$iId       = isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;
$iTime     = isset($_REQUEST['t']) ? (int) $_REQUEST['t'] : 0;
$sPassword = isset($_REQUEST['p']) ? (string) $_REQUEST['p'] : '';

//$iInstructionId = 1; // id инструкции
//$iTime = time();
//$sLink = 'https://pdf.creatory.pro/index.php'
//    . '?id=' . $iInstructionId
//    . '&t=' . $iTime
//    . '&p=' . md5('X35hFBS{TW0TFzN!' . $iTime)
//;

switch (true) {
    case empty($iId):
        echo 'id not found';
        break;
    case empty($sPassword):
        echo 'password required';
        break;
    case $iTime < time() - 30:
        echo 'time expired';
        break;
    case $sPassword != md5('X35hFBS{TW0TFzN!' . $iTime):
        echo 'check password';
        break;
    default:
        $sFileName = time() . '.pdf';
        $sPath     = '/var/www/html/' .$sFileName;
        Browsershot::url('https://creatory.pro/instruction/pdf/' . $iId . '?id=' . $iId . '&t=' . $iTime . '&p=' . $sPassword)
            ->noSandbox() // Needed to run dockerized puppeteer.
            ->fullPage()
            ->savePdf($sPath);

        ob_get_clean();
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=" . $sFileName);
        echo file_get_contents($sPath);
        unlink($sPath);
        exit;
        break;
}
