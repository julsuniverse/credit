<?php

namespace src\entities\company;

use src\helpers\Aliaser;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $h1
 * @property string $desc
 * @property string $text
 * @property string $photo
 * @property string $message
 * @property string $vk_group
 * @property string $fb_group
 * @property integer $max_sum
 * @property integer $max_termin
 * @property integer $age
 * @property string $time_rewiew
 * @property string $pay
 * @property integer $stars
 * @property integer $raiting
 * @property string $href
 * @property integer $checked
 * @property integer $overpayments
 * @property string $last_upd
 * @property integer $on_main
 * @property integer $recommended
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keys
 */
class Company extends ActiveRecord
{
    public static function create($name, $h1)
    {
        $company = new self();
        $company->name = $name;
        $company->alias = Aliaser::alias($name);
        $company->h1 = $h1;

        return $company;
    }

    public function setSeo($form)
    {
        $this->seo_title = $form->seo_title;
        $this->seo_desc = $form->seo_desc;
        $this->seo_keys = $form->seo_keys;
    }

    public function setFields($form)
    {
        $this->desc = $form->desc;
        $this->text = $form->text;
        $this->message = $form->message;
        $this->vk_group = $form->vk_group;
        $this->fb_group = $form->fb_group;
        $this->max_sum = $form->max_sum;
        $this->max_termin = $form->max_termin;
        $this->age = $form->age;
        $this->time_rewiew = $form->time_rewiew;
        $this->pay = $form->pay;
        $this->stars = $form->stars;
        $this->raiting = $form->raiting;
        $this->href = $form->href;
        $this->checked = $form->checked;
        $this->overpayments = $form->overpayments;
        $this->on_main = $form->on_main;
        $this->recommended = $form->recommended;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'h1'], 'required'],
            [['max_sum', 'max_termin', 'age', 'stars', 'raiting', 'checked', 'overpayments', 'on_main', 'recommended'], 'integer'],
            [['name', 'alias', 'h1', 'desc', 'text', 'photo', 'message', 'vk_group', 'fb_group', 'time_rewiew', 'pay', 'href', 'last_upd', 'seo_title', 'seo_desc', 'seo_keys'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'alias' => 'url',
            'h1' => 'H1',
            'desc' => 'Краткое описание',
            'text' => 'Текст',
            'photo' => 'Лого',
            'message' => 'Месседж',
            'vk_group' => 'Группа в Vk',
            'fb_group' => 'Группа в Fb',
            'max_sum' => 'Максимальная сумма кредита',
            'max_termin' => 'Максимальный срок кредита (в днях)',
            'age' => 'Возраст заемщика',
            'time_rewiew' => 'Время рассмотрения',
            'pay' => 'Способы выплат',
            'stars' => 'Звезд',
            'raiting' => 'Рейтинг',
            'href' => 'Ссылка',
            'checked' => 'Проверена',
            'overpayments' => 'Переплата',
            'last_upd' => 'Last Upd',
            'on_main' => 'На главной',
            'recommended' => 'В блок "Рекомендуемые"',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Description',
            'seo_keys' => 'Seo Keywords',
        ];
    }
}
