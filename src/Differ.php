<?php

namespace Src\Differ;

function genDiff($firstFile, $secondFile)
{
    $json1 = json_decode(file_get_contents($firstFile), true);
    $json2 = json_decode(file_get_contents($secondFile), true);
    $result = [];
    $result2 = [];
    $result3 = [];
    $result4 = [];
    foreach ($json1 as $key => $value) {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } if (array_key_exists($key, $json2) && $value === $json2[$key]) {
            $result[$key] = $value;
        } if (array_key_exists($key, $json2) && $value !== $json2[$key]) {
            $result[$key] = $value;
        } if (!array_key_exists($key, $json2)) {
            $result[$key ] = $value;
        }
    }
    foreach ($json2 as $key => $value) {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } if (array_key_exists($key, $json1) && $value === $json1[$key]) {
            $result2[$key] = $value;
        } if (array_key_exists($key, $json1) && $value !== $json1[$key]) {
            $result2[$key] = $value;
        } if (!array_key_exists($key, $json1)) {
            $result2[$key] = $value;
        }
    }
      ksort($result);
      ksort($result2);
    foreach ($result as $key => $value) {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } if (array_key_exists($key, $json2) && $value === $json2[$key]) {
            $result3[$key] = $value;
        } if (array_key_exists($key, $json2) && $value !== $json2[$key]) {
            $result3['- ' . $key] = $value;
        } if (!array_key_exists($key, $json2)) {
            $result3['- ' . $key ] = $value;
        }
    }
    foreach ($result2 as $key => $value) {
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } if (array_key_exists($key, $json1) && $value !== $json1[$key]) {
            $result4['+ ' . $key] = $value;
        } if (!array_key_exists($key, $json1)) {
            $result4['+ ' . $key] = $value;
        }
    }
      $merge = (array_merge($result3, $result4));
      $jsonNew = (json_encode($merge));
    return ($jsonNew);
}
