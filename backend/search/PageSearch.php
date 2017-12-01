<?php

namespace backend\search;

use src\entities\page\Offer;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use src\entities\page\Page;

/**
 * PageSearch represents the model behind the search form about `src\entities\page\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'offer_id', 'folder_id', 'helpfull', 'recommended'], 'integer'],
            [['h1', 'alias', 'short_desc', 'text_1', 'expert_title', 'expert_text', 'text_2', 'seo_title', 'seo_desc', 'seo_keys', 'photo'], 'safe'],
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
    public function search($params, $ids, $free)
    {
        $query = Page::find();

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

        if($ids)
            $d=$ids;
        else if($free)
            $d = $free;
        else
            $d=$this->id;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $d,
            'offer_id' => $this->offer_id,
            'folder_id' => $this->folder_id,
            'helpfull' => $this->helpfull,
            'recommended' => $this->recommended,
        ]);

        $query->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'short_desc', $this->short_desc])
            ->andFilterWhere(['like', 'text_1', $this->text_1])
            ->andFilterWhere(['like', 'expert_title', $this->expert_title])
            ->andFilterWhere(['like', 'expert_text', $this->expert_text])
            ->andFilterWhere(['like', 'text_2', $this->text_2])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_desc', $this->seo_desc])
            ->andFilterWhere(['like', 'seo_keys', $this->seo_keys])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }

    public static function offerList()
    {
        return Offer::find()->select(['name','id'])->indexBy('id')->column();
    }
}
