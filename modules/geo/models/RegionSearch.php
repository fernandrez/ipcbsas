<?php

namespace app\modules\geo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\geo\models\Region;

/**
 * RegionSearch represents the model behind the search form about `frontend\models\Region`.
 */
class RegionSearch extends Region
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pais_id', 'created_by', 'updated_by'], 'integer'],
            [['pais_cd', 'region_cd', 'nombre', 'created_at', 'updated_at', 'status'], 'safe'],
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
        $query = Region::find();

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
            'pais_id' => $this->pais_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'pais_cd', $this->pais_cd])
            ->andFilterWhere(['like', 'region_cd', $this->region_cd])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
