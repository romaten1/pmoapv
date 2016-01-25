<?php
namespace app\modules\books\helpers;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd\Imagine;
use Imagine\Image\ImageInterface;
/**
 * Данный класс позволяет обрабатывать фотографии.
 */
class ImageHelper
{
    /**
     * @param $path_from
     * @param $path_to
     * @param $desired_width
     *
     * Обработка рисунка и сохранение
     */
    public static  function makeImage( $path_from, $path_to, $desired_width )
    {
        $imagine       = new Imagine();
        $image         = $imagine->open( $path_from );
        $image_size    = $image->getSize();
        $image_height  = $image_size->getHeight();
        $image_width   = $image_size->getWidth();
        $ratio         = $image_width / $desired_width;
        $resizedHeight = $image_height / $ratio;
        $resizedWidth  = $image_width / $ratio;
        $resized_image = $image->resize( new Box( $resizedWidth, $resizedHeight ) );
        $options       = array(
            'resolution-units' => ImageInterface::RESOLUTION_PIXELSPERINCH,
            'resolution-x'     => 100,
            'resolution-y'     => 200,
            'flatten'          => false
        );
        $resized_image->save( $path_to, $options );
    }
}