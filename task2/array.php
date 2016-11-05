<?php

$max = mt_rand(2, 1000000);
$arr = range(1, $max);
$arr[] = rand(1, $max);
shuffle($arr);



function one(array $array)
{
    $dublicat = 0;
    if ($array) {
        $tmp = array_count_values($array);

        foreach ($tmp as $k => $v) {
            if ($v > 1) {
                $dublicat = $k;
                break;
            }
        }
        unset($tmp);
        return $dublicat;
    }

    return false;
}

function two(array $array)
{
    $dublicat = 0;
    $match = false;
    if ($array) {
        $result = [];
        foreach ($array as $key => $value) {

            if (array_key_exists($value, $result)) {
                $dublicat = $value;
                $match = true;
                unset($result);
                break;
            }

            if (!$match) $result[$value] = $key;
        }
        return $dublicat;
    }

    return false;
}

echo "Первый вариант:<hr>";

$start = microtime(true);

$duplicate = one($arr);

$finish = microtime(true);
echo 'дубликат: ' . $duplicate . '<br>';;
echo 'Время выполнения скрипта: ' . ($finish - $start) . ' sec.<br>';
echo 'размер массива: ' . count($arr);

echo "<hr>";

echo "Второй вариант:<hr>";

$start = microtime(true);

$duplicate = two($arr);

$finish = microtime(true);
echo 'дубликат: ' . $duplicate . '<br>';;
echo 'Время выполнения скрипта: ' . ($finish - $start) . ' sec.<br>';
echo 'размер массива: ' . count($arr);

echo "<hr>";

echo "Оба варианта показали примерно одинаковую производительность, разница времени исполнения на уровне погрешности.";
