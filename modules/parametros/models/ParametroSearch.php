<?php

namespace app\modules\parametros\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\parametros\models\Parametro;

/**
 * ParametroSearch represents the model behind the search form about `frontend\models\Parametro`.
 */
class ParametroSearch extends Parametro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['nombre', 'valor', 'fecha_inicio', 'fecha_fin', 'created_at', 'updated_at', 'status'], 'safe'],
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
        $query = Parametro::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
	
    public function searchActive($params)
    {
        $query = Parametro::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by
        ]);
		
		$query->andFilterWhere(['is','fecha_inicio',null]);
		
        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
