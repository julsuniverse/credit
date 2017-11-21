<?php

namespace backend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use src\entities\company\Company;

/**
 * CompanySearch represents the model behind the search form about `src\entities\company\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'max_sum', 'max_termin', 'age', 'stars', 'raiting', 'checked', 'overpayments', 'on_main', 'recommended'], 'integer'],
            [['name', 'alias', 'h1', 'desc', 'text', 'photo', 'message', 'vk_group', 'fb_group', 'time_review', 'pay', 'href', 'last_upd', 'seo_title', 'seo_desc', 'seo_keys'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $active)
    {
        $query = Company::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'max_sum' => $this->max_sum,
            'max_termin' => $this->max_termin,
            'age' => $this->age,
            'stars' => $this->stars,
            'raiting' => $this->raiting,
            'checked' => $this->checked,
            'overpayments' => $this->overpayments,
            'on_main' => $this->on_main,
            'recommended' => $this->recommended,
        ]);

        if($active){
            $query->andWhere(['!=', 'href', '']);
        }
        else{
            $query->andFilterWhere(['like', 'href', $this->href]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'vk_group', $this->vk_group])
            ->andFilterWhere(['like', 'fb_group', $this->fb_group])
            ->andFilterWhere(['like', 'time_review', $this->time_review])
            ->andFilterWhere(['like', 'pay', $this->pay])
            ->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'last_upd', $this->last_upd])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_desc', $this->seo_desc])
            ->andFilterWhere(['like', 'seo_keys', $this->seo_keys]);

        return $dataProvider;
    }
}
