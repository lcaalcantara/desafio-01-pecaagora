<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Funcionarios;

/**
 * FuncionariosSearch represents the model behind the search form of `app\models\Funcionarios`.
 */
class FuncionariosSearch extends Funcionarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numero', 'cargo_id'], 'integer'],
            [['nome', 'cpf', 'logradouro', 'cep', 'cidade', 'estado', 'complemento'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Funcionarios::find();

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
            'numero' => $this->numero,
            'cargo_id' => $this->cargo_id,
        ]);

        $query->andFilterWhere(['ilike', 'nome', $this->nome])
            ->andFilterWhere(['ilike', 'cpf', $this->cpf])
            ->andFilterWhere(['ilike', 'logradouro', $this->logradouro])
            ->andFilterWhere(['ilike', 'cep', $this->cep])
            ->andFilterWhere(['ilike', 'cidade', $this->cidade])
            ->andFilterWhere(['ilike', 'estado', $this->estado])
            ->andFilterWhere(['ilike', 'complemento', $this->complemento]);

        return $dataProvider;
    }
}
