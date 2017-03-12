<?php

namespace app\modules\registro\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\registro\models\Almacen;

/**
 * AlmacenSearch represents the model behind the search form about `app\modules\registro\models\Almacen`.
 */
class AlmacenSearch extends Almacen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cadena_id', 'created_by', 'updated_by'], 'integer'],
            [['identificador', 'created_at', 'updated_at', 'status'], 'safe'],
            [['latitud', 'longitud'], 'number'],
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
        $query = Almacen::find();

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
            'cadena_id' => $this->cadena_id,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'identificador', $this->identificador])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
