<?php

namespace src\forms;

use elisdn\compositeForm\CompositeForm;
use src\entities\company\Company;

/**
 * CompanyForm is the model behind the company form.
 */
class CompanyForm extends CompositeForm
{
    public $name;
    public $alias;
    public $h1;
    public $desc;
    public $text;
    public $photo;
    public $message;
    public $vk_group;
    public $fb_group;
    public $max_sum;
    public $max_termin;
    public $age;
    public $time_rewiew;
    public $pay;
    public $stars;
    public $raiting;
    public $href;
    public $checked;
    public $overpayments;
    public $on_main;
    public $recommended;
    public $seo_title;
    public $seo_desc;
    public $seo_keys;

    /**
     * CompanyForm constructor.
     * @param Company|null $company
     * @param array $config
     */
    public function __construct(Company $company = null, array $config = [])
    {
        $this->meta = new SeoForm();
        if($company)
        {
            $this->name = $company->name;
            $this->alias = $company->alias;
            $this->h1 = $company->h1;
            $this->desc = $company->desc;
            $this->text = $company->text;
            $this->photo = $company->photo;
            $this->message = $company->message;
            $this->vk_group = $company->vk_group;
            $this->fb_group = $company->fb_group;
            $this->max_sum = $company->max_sum;
            $this->max_termin = $company->max_termin;
            $this->age = $company->age;
            $this->time_rewiew = $company->time_rewiew;
            $this->pay = $company->pay;
            $this->stars = $company->stars;
            $this->raiting = $company->raiting;
            $this->href = $company->href;
            $this->checked = $company->checked;
            $this->overpayments = $company->overpayments;
            $this->on_main = $company->on_main;
            $this->recommended = $company->recommended;

            $this->meta->seo_title = $company->seo_title;
            $this->meta->seo_desc = $company->seo_desc;
            $this->meta->seo_keys = $company->seo_keys;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'h1'], 'required'],
            [['max_sum', 'max_termin', 'age', 'stars', 'raiting', 'checked', 'overpayments', 'on_main', 'recommended'], 'integer'],
            [['name', 'alias', 'h1', 'desc', 'text','message', 'vk_group', 'fb_group', 'time_rewiew', 'href', 'last_upd', 'seo_title', 'seo_desc', 'seo_keys'], 'string', 'max' => 255],
            ['pay', 'each', 'rule' => ['string']],
            ['photo','file','skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'checkExtensionByMimeType'=>false],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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
            'on_main' => 'На главной',
            'recommended' => 'В блок "Рекомендуемые"',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Description',
            'seo_keys' => 'Seo Keywords',
        ];
    }

    protected function internalForms()
    {
        return ['meta'];
    }

}
