<?php

namespace src\forms;

use yii\base\Model;

class LoadFileForm extends Model
{
    public $file;
    public $ololo = 0;
    public function rules()
    {
        return [
            ['file', 'file'],
        ];
    }    
}