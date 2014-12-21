<?php
namespace app\helpers;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use app\helpers\TransliterateHelper;
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
		
        public static function createImage($model, $module, $attribute = 'image_id' )
		{
		// Получаем массив данных по загружамых файлах
            $image_id = UploadedFile::getInstance($model, $attribute);
            $filename = $image_id->name;
            $ext = end((explode(".", $image_id->name)));
            // Генерируем уникальное имя файла
            $model->title_en =  TransliterateHelper::cyrillicToLatin($model->title);
            $model->image_id = $attribute . '-'. 
            					substr($model->title_en, 0, 6) . '-' . 
            					//Yii::$app->getSecurity()->generateRandomString(5). '.'.$ext;
            					'abcde.'.$ext;
            $image_name = $model->image_id;
            // Путь к папке где будет хранится файл
            $path = \Yii::$app->basePath . '/uploads/'.$module.'/' . $model->image_id;
            
            if($model->save()){
                
                // Сохраняем рисунок
                $image_id->saveAs($path);

                $image_full = \Yii::$app->image->load($path);
                $full_path = \Yii::$app->basePath . '/uploads/'.$module.'/' . $image_name;
                $image_full->resize('600', '400');
                $image_full->save($full_path);
                // Обработка загруженного изображения и создание thumbs
                $image_less = \Yii::$app->image->load($path);
                $less_path = \Yii::$app->basePath . '/uploads/'.$module.'/' .' thumbs/thumb_' . $image_name;
                $image_less->resize('50', '50');
                $image_less->save($less_path);
				return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                throw new NotFoundHttpException('Не удалось загрузить данные');
            }  
        }   
}