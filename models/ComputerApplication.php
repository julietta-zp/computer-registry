<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "computer_application".
 *
 * @property integer $id
 * @property integer $computer_id
 * @property integer $application_id
 *
 * @property Application $application
 * @property Computer $computer
 */
class ComputerApplication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'computer_application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['computer_id', 'application_id'], 'required'],
            [['computer_id', 'application_id'], 'integer'],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
            [['computer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Computer::className(), 'targetAttribute' => ['computer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'computer_id' => 'Computer ID',
            'application_id' => 'Application ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputer()
    {
        return $this->hasOne(Computer::className(), ['id' => 'computer_id']);
    }
}
