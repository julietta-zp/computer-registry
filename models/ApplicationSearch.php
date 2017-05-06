<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Application;

/**
 * ApplicationSearch represents the model behind the search form about `app\models\Application`.
 */
class ApplicationSearch extends Application
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'license_required'], 'integer'],
            [['app_name', 'vendor_name'], 'safe'],
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
        $query = Application::find();

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
            'license_required' => $this->license_required,
        ]);

        $query->andFilterWhere(['like', 'app_name', $this->app_name])
            ->andFilterWhere(['like', 'vendor_name', $this->vendor_name]);

        return $dataProvider;
    }
}
