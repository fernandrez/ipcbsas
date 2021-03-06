<?php

namespace app\modules\registro\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\registro\models\Registro;

/**
 * RegistroSearch represents the model behind the search form about `app\modules\registro\models\Registro`.
 */
class RegistroSearch extends Registro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['almacen', 'categoria', 'elemento', 'marca', 'descripcion', 'fecha', 'unidad', 'created_at', 'updated_at', 'status'], 'safe'],
            [['cantidad', 'precio', 'precio_unitario'], 'number'],
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
    public function search($params, $query = null, $like = true)
    {
    	if(is_null($query)){
        	$query = Registro::find();
		}
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
		    'pagination' => [
		        'pageSize' => 25,
		    ],
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
            'fecha' => $this->fecha,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'precio_unitario' => $this->precio_unitario,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'almacen', $this->almacen])
            ->andFilterWhere(['like', 'categoria', $this->categoria])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'unidad', $this->unidad])
            ->andFilterWhere(['like', 'status', $this->status]);
		if($like){
			$query->andFilterWhere(['like', 'elemento', $this->elemento]);
		} else {
			$query->andFilterWhere(['elemento' => $this->elemento]);
		}
        return $dataProvider;
    }

    public function searchActive($params)
    {
        $query = Registro::find()->active();
        
        if(!isset($params['sort'])){
            $query = $query->orderBy('fecha DESC, precio_unitario');
        }

        return $this->search($params, $query);
    }

    public function searchOrderByAlmacen($params)
    {
        $query = Registro::find()->orderBy('almacen, fecha desc');

        return $this->search($params, $query, false);
    }
}
