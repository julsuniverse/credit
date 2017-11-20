<?php

namespace src\entities\company;
use src\entities\User;
use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property integer $company_id
 * @property integer $stars
 * @property string $date
 * @property integer $raiting
 * @property integer $likes
 * @property string $user_ids_like
 * @property string $user_ids_dislike
 * @property integer $ball
 *
 * @property Company $company
 * @property User $user
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    public $color;
    public $strip;

    public function afterFind()
    {
        $arr=[1=>"#f7dcdc",2=>"#f7e9dc",3=>"#f7f7dc",4=>"#ecf7dc",5=>"#dcf7de"];
        $this->color=$arr[$this->stars];

        if($this->ball >= 10 && $this->ball<20)
            $this->strip = "#EB4825";
        else if($this->ball >= 20 && $this->ball < 30)
            $this->strip = "#EF6D21";
        else if($this->ball >= 30 && $this->ball < 40)
            $this->strip = "#F29923";
        else if($this->ball >= 40 && $this->ball < 60)
            $this->strip = "#F3CD2E";
        else if($this->ball >= 60 && $this->ball < 80)
            $this->strip = "#EEE736";
        else if($this->ball >= 80 && $this->ball < 90)
            $this->strip = "#8DC142";
        else if($this->ball >= 90 && $this->ball <= 100)
            $this->strip = "#4CB767";
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'user_id', 'company_id', 'stars', 'date'], 'required'],
            [['user_id', 'company_id', 'stars', 'raiting', 'likes', 'ball'], 'integer'],
            [['text', 'date', 'user_ids_like', 'user_ids_dislike'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'company_id' => 'Company ID',
            'stars' => 'Stars',
            'date' => 'Date',
            'raiting' => 'Raiting',
            'likes' => 'Likes',
            'user_ids_like' => 'User Ids Like',
            'user_ids_dislike' => 'User Ids Dislike',
            'ball' => 'Ball',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
