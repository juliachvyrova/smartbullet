<?php

class Image{
    
    static function newName($file){
        $name=  substr(md5(microtime()), 0, 10);
        $name.=strrchr($file, ".");
        return $name;
    }
    
    static function saveImg($file){
        print_r($file);
    echo $file->tempName;
        $name=self::newName($file->name);
        $location=Yii::app()->basePath."../images/avatars/".$name;
        echo $name;
        if(move_uploaded_file($file->tempName, $location)){
            echo "yes";
            return $name;
        }
        else{
                        echo "no";
            return false;
        }
    }
}