<?php

namespace backend\search;

use src\entities\company\Company;
use src\entities\page\Offer;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OfferSearch represents the model behind the search form about `common\models\Offer`.
 */
class OfferSearch extends Offer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'folder'], 'integer'],
            [['name', 'ids'], 'safe'],
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
        $query = Offer::find();

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
        if($ids) 
            $d=$ids; 
        else if($free)
            $d = $free;
        else
            $d=$this->id; 
        $query->andFilterWhere([
            //'id' => $this->id,
            'id' => $d,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ids', $this->ids]);

        return $dataProvider;
    }

    public static function getCompanyAlias($ids)
    {
        return Company::find()->select('alias')->where(['id'=>$ids])->one()->alias;
    }
}
