<?php

namespace backend\search;

use src\entities\company\Company;
use src\entities\company\Review;
use src\entities\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * ReviewSearch represents the model behind the search form about `common\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'company_id', 'stars', 'raiting', 'likes'], 'integer'],
            [['text', 'date', 'user_ids_like', 'user_ids_dislike'], 'safe'],
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
    public function search($params)
    {
        $query = Review::find();

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
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'stars' => $this->stars,
            'raiting' => $this->raiting,
            'likes' => $this->likes,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'user_ids_like', $this->user_ids_like])
            ->andFilterWhere(['like', 'user_ids_dislike', $this->user_ids_dislike])
            ->orderBy('id DESC');

        return $dataProvider;
    }

    public static function usersList()
    {
        return User::find()->select(['name','id'])->where(['!=', 'username', 'admin'])->indexBy('id')->column();
    }

    public static function companyList()
    {
        return Company::find()->select(['name','id'])->indexBy('id')->column();
    }
}
