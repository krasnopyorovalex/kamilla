<?php

namespace frontend\widgets\CreateForm;

use common\models\Form;
use frontend\forms\CheckBookingForm;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class CreateForm extends Widget
{
    public $sysName;

    private static $forms;

    /**
     * @return string
     */
    public function run()
    {

        if( ! self::$forms ) {
            self::$forms = ArrayHelper::index(Form::find()->with(['image'])->asArray()->all(), 'sys_name');
        }

        $form = self::$forms[$this->sysName];
        $checkBookingForm = new CheckBookingForm;
        $checkBookingForm->load(\Yii::$app->request->get());
        
        if(strstr($form['event'],'{page_alias}')){
            $form['event'] = str_replace('{page_alias}',\Yii::$app->request->get('alias'),$form['event']);
        }

        return $this->render('form.twig', [
            'model' => $form,
            'schema' => json_decode($form['json_schema'], true),
            'requestData' => $checkBookingForm
        ]);
    }
}
