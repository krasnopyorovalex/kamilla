<?php

namespace frontend\widgets\OtherRooms;

use common\models\Rooms as Model;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class OtherRooms extends Widget
{
    public $model;

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('rooms.twig', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Model::find()->with(['imagePreview', 'roomsAttributesVias'])->publish()->andWhere(['<>', 'id', $this->model->id])->orderBy('rand()'),
                'pagination' => false
            ])
        ]);
    }
}