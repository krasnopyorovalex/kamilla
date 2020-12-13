<?php
namespace backend\components;

use common\models\Files;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Class FilesBehavior
 * @package backend\components
 */
class FilesBehavior extends Behavior
{
    public $path;
    public $column;
    public $field;

    private $_attribute;

    /**
     * @param \yii\base\Component $owner
     */
    public function attach($owner)
    {
        parent::attach($owner);
        $owner->on(ActiveRecord::EVENT_BEFORE_INSERT, [$this, 'onBeforeSave']);
        $owner->on(ActiveRecord::EVENT_BEFORE_UPDATE, [$this, 'onBeforeSave']);
        $owner->on(ActiveRecord::EVENT_BEFORE_DELETE, [$this, 'onBeforeDelete']);
    }

    /**
     * @throws \Exception
     * @throws \yii\base\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function onBeforeSave()
    {
        $makePath = $this->getFileDir();

        if (!file_exists($makePath)) { FileHelper::createDirectory($makePath, 0777, true); }
        if($this->_attribute = UploadedFile::getInstance($this->owner, $this->field)){
            $file = md5(microtime() . $this->_attribute->baseName) . '.' . $this->_attribute->extension;
            $this->_attribute->saveAs($makePath.$file);

            if($this->owner->{$this->column}){
                $this->clearFile($this->owner->{$this->column});
            }

            $this->owner->{$this->column} = $this->saveToDBFile($file);
        }

        if( ! $this->owner->isNewRecord && ($meta = $this->owner->metaImage) && isset($meta[$this->field]) ) {
            $column = $this->owner->{$this->column};
            $metaImage = $meta[$this->field];

            $file = Files::findOne($column);
            $file->alt = $metaImage['alt'];
            $file->title = $metaImage['title'];
            $file->update();
        }
    }

    /**
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function onBeforeDelete()
    {
        if($this->owner->{$this->column}){
            $this->clearFile($this->owner->{$this->column});
        }
    }

    /**
     * @return bool|string
     */
    private function getFileDir()
    {
        return Yii::getAlias('@userfiles' . $this->path);
    }

    /**
     * @param $file
     * @return int
     */
    private function saveToDbFile($file)
    {
        /**
         * @var $newFile Files
         */
        $newFile = new Files();
        $newFile->path = Yii::getAlias('@userfilesFrontend') . $this->path . $file;
        $newFile->save();

        return $newFile->id;
    }

    /**
     * @param $id
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    private function clearFile($id)
    {
       if($file = Files::findOne($id)){
           @unlink(Yii::getAlias('@frontend/web') . $file->path);
       }
        $file->delete();
    }

}