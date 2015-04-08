<?php
namespace app\helpers;

use Yii;
/**
 * Данный класс позволяет переводить строку с крилицы на латынь.
 */
class FileHelper
{
        public static function Size2Str($size) 
		{ 
		    $kb = 1024; 
		    $mb = 1024 * $kb; 
		    $gb = 1024 * $mb; 
		    $tb = 1024 * $gb; 
		  
		    if ($size < $kb) { 
		        return $size.' байт'; 
		    } else if ($size < $mb) { 
		        return round($size / $kb, 2).' Кб'; 
		    } else if ($size < $gb) {   
		        return round($size / $mb, 2).' Мб'; 
		    } else if ($size < $tb) { 
		        return round($size / $gb, 2).' Гб'; 
		    } else { 
		        return round($size / $tb, 2).' Тб'; 
		    } 
		}
}