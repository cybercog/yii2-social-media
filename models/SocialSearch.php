<?php

namespace infoweb\social\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SocialSearch extends Social
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'safe'],
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
        $query = Social::find();

        $query->orderBy('id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->name]);

        return $dataProvider;
    }
}
