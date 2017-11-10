<?php
namespace src\services;

use yii\web\UploadedFile;

class Imager
{
    private $path;
    private $randomString;
    
    public function __construct()
    {
        $this->path = \Yii::getAlias('@frontend').'/web/img/';
        $this->randomString = date('U');
    }
    public function setPath($path)
    {
        $this->path=$path;
    }
    
    public function savePhoto($attr, $old, $form)
    {
        $file = UploadedFile::getInstance($form, $attr);
        if($file)
        {
            $res = $this->randomString.$file->baseName.".".$file->extension;
            $file->saveAs($this->path.$res);
            
            return $res;
        }
        else 
             return $old;
    }
    public function savePhotos($attr, $old, $form)
    {
        $files = UploadedFile::getInstances($form, $attr);
        if($files)
        {
            $old = $old ? $old : "";
            foreach ($files as $file) {
                $res = $this->randomString.$file->baseName.".".$file->extension;
                $file->saveAs($this->path.$res);
                $old.=$res."##";
            }
        }
        return $old;
    }
}