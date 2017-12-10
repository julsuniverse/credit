<?php
namespace src\forms;
use Yii;
use yii\base\Model;
class CreditForm extends Model
{
    public $sum;
    public $termin;

    public function rules()
    {
        return [
            ['sum', 'required'],
            ['termin', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }
}