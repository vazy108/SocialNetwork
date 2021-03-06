<?php
use inc\Autoloader;
use core\Files\Images\Images;
use app\Table\Images\ImagesModel;

/*
 * To display posted images
 */
if(isset($_GET['imgname']) && isset($_GET['p']) && isset($_GET['u']))
{
    //#todo ajouter des sécurités au niveau des images
    require_once '../Autoloader.php';
    Autoloader::register();

    $img =      new Images(false, $_GET['u']);
    $imgModel = new ImagesModel();

    $postFolder =   $img->getPostDirFromIdpost($_GET['p']);
    $imageName =    'thumb_w475_' . $imgModel->getImagesNameFromSlugAndPostId($_GET['imgname'], $_GET['p']);
    $img =  $postFolder . $imageName;
    //die($img);

    $extension = explode('.', $imageName)[1];
    $image = '';

    if($extension == 'jpg' || $extension == 'jpeg')
    {
        header ("Content-type: image/jpeg");
        $image = imagecreatefromjpeg($img);
        imagejpeg($image);
    }
    if($extension == 'png')
    {
        header ("Content-type: image/png");
        $image = imagecreatefrompng($img);
        imagepng($image);
    }
    if($extension == 'gif')
    {
        header ("Content-type: image/gif");
        $image = imagecreatefromgif($img);
        imagegif($image);
    }
}
else{
    die('ok');
}