<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "computer".
 *
 * @property integer $id
 * @property string $computer_name
 * @property string $ip_address
 * @property string $login
 * @property string $password
 */
class Computer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'computer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['computer_name', 'ip_address', 'login', 'password'], 'required'],
            [['password'], 'string'],
            [['computer_name', 'ip_address', 'login'], 'string', 'max' => 64],
            [['computer_name'], 'unique'],
            ['ip_address', 'ip']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Computer ID',
            'computer_name' => 'Computer Name',
            'ip_address' => 'Ip Address',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputerApplications()
    {
        return $this->hasMany(ComputerApplication::className(), ['computer_id' => 'id']);
    }

    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['id' => 'application_id'])
            ->viaTable('computer_application', ['computer_id' => 'id']);
    }

}
