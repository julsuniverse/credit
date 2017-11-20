<?php

namespace src\forms\company;

use src\entities\company\Review;
use Yii;
use yii\base\Model;
use yii\helpers\Html;

class ReviewForm extends Model
{
    public $text;
    public $star;
    public $reCaptcha;


    public function rules()
    {
        return [
            [['text', 'star'], 'required'],
            ['text', 'string'],
            ['star', 'integer'],
            ['reCaptcha', 'required', 'message'=>'Подтвердите, что вы не робот']
        ];
    }
    public function attributeLabels()
    {
        return [
            'star' => 'Оценка',
            'text' => 'Текст комментария',
        ];
    }
    public function getCount($count)
    {
        $arr=[0=>-2, 1=>-2, 2=>-1, 3=>1, 4=>2, 5=>3];
        return $arr[$count];

    }
    public function getBall()
    {
        $count=100;
        $friends=Yii::$app->user->identity->friends;
        if($friends<=10)
            $count-=30;
        else if(($friends>10 && $friends<=24) || ($friends>2000 && $friends<=5000))
            $count-=20;
        else if($friends>24 && $friends<=50 || ($friends>=1000 && $friends<=2000))
            $count-=10;
            
        $photos = Yii::$app->user->identity->photos;
        
        if($photos <= 10 || ($photos >= 1000 && $photos < 3000))
            $count -= 10;
        else if($photos > 10 && $photos < 30)
            $count -= 5;
        else if($photos >= 3000 && $photos < 8000)
            $count -= 15;        
        
        $audios = Yii::$app->user->identity->audios;
        if($audios <= 10)
            $count -= 10; 
        else if(($audios > 10 && $audios < 30) || ($audios >= 2000 && $audios < 3000))
            $count -= 5;
        else if($audios > 3000 && $audios < 10000)
            $count -= 15;
        
        $followers = Yii::$app->user->identity->followers;
        
        if($followers <= 10)
            $count -= 30;
        else if(($followers >= 11 && $followers < 24) || ($followers >= 2000 && $followers < 5000))
            $count -= 20;
        else if(($followers >= 25 && $followers < 45) || ($followers >= 1300 && $followers))
            $count -= 10;
            
        return $count;
    }
    public function saveReview($company)
    {
        $review = new Review();
        $review->text=Html::encode($this->text);
        $review->stars=Html::encode($this->star);
        $count=$this->getCount($review->stars);
        $review->user_id=Yii::$app->user->identity->id;
        $review->company_id=$company;
        $review->date=date('U');
        $review->likes=0;
        if(Yii::$app->user->identity->user_id{0}!="f")
            $review->ball=$this->getBall();
        return $review->save();
    }
}
