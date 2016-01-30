<?php

namespace app\modules\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DireccionParametro;

/**
 * DireccionParametroSearch represents the model behind the search form about `frontend\models\DireccionParametro`.
 */
class DireccionParametroSearch extends DireccionParametro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tipo', 'codigo', 'titulo', 'descripcion', 'status'], 'safe'],
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
        $query = DireccionParametro::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
