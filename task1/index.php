<?php
/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 11/5/16
 * Time: 4:36 AM
 */

if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    $url = $_SERVER['HTTP_REFERER'];
    $referer = parse_url($url, PHP_URL_HOST);
    $referer = preg_replace('|^(www\.)?|i', '', $referer);
    setcookie('referrer', $referer, time() + 365 * 24 * 60 * 60, '/', "", false, true);
}

$file = 'file.exe';

if (!file_exists($file)) {
    echo "ОШИБКА: данного файла не существует.";
    exit;
};

if (ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . basename($file) . "\";");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($file));
readfile("$file");
exit();