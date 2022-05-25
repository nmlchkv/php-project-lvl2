<?php

namespace Src\Differ;

function genDiff($firstFile, $secondFile)
{
    $json1 = json_decode(file_get_contents($firstFile), true);
    $json2 = json_decode(file_get_contents($secondFile), true); 
    $result = [];
    foreach ($json1 as $key => $value) {
    
        if (array_key_exists($key, $json2) && $value === $json2[$key]) {
          $result[$key] = $value;
        } if (array_key_exists($key, $json2) && $value !== $json2[$key]) {
          $result[$key] = $json2[$key];
          
        } if (!array_key_exists($key, $json2)) {
          $result[$key] = $value;
          
        }
      }
      foreach ($json2 as $key => $value) {
        if (array_key_exists($key, $json1) && $value === $json1[$key]) {
          $result2[$key] = $value;
        } if (array_key_exists($key, $json1) && $value !== $json1[$key]) {
          $result2[$key] = $json1[$key];
        } if (!array_key_exists($key, $json1)) {
          $result2[$key] = $value;
        } 
      } 
      $merge = (array_merge($result, $result2));
      return ($merge);
}