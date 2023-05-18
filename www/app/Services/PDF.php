<?php
namespace App\Services;

use Exception;

/**
 * Class PDF
 * @package App\Services
 */
class PDF
{
    /** @var string  */
    const PASSWORD = 'X35hFBS{TW0TFzN!';

    /**
     * Получение ссылки на скачивание
     * @param int $iId
     *
     * @return string
     */
    public static function getPdfLink(int $iId)
    {
        $iTime = time();
        return 'https://pdf.creatory.pro/index.php'
            . '?id=' . $iId
            . '&t=' . $iTime
            . '&p=' . md5(self::PASSWORD . $iTime)
        ;
    }

    /**
     * Проверяет корректность ссылки и возвращает
     * @param $iId
     * @param $iTime
     * @param $sPassword
     * @throws Exception
     */
    public static function checkLink($iId, $iTime, $sPassword)
    {
        switch (true) {
            case empty($iId):
                throw new Exception('id not found');
                break;
            case empty($sPassword):
                throw new Exception('password required');
                break;
            case $iTime < time() - 30:
                throw new Exception('time expired');
                break;
            case $sPassword != md5(self::PASSWORD . $iTime):
                throw new Exception('check password');
                break;
        }
    }
}
