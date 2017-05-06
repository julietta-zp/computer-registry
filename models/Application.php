<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property string $app_name
 * @property string $vendor_name
 * @property integer $license_required
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_name', 'vendor_name'], 'required'],
            [['license_required'], 'integer'],
            [['app_name', 'vendor_name'], 'string', 'max' => 64],
            [['app_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'App ID',
            'app_name' => 'App Name',
            'vendor_name' => 'Vendor Name',
            'license_required' => 'License Required',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getComputerApplications()
    {
        return $this->hasMany(ComputerApplication::className(), ['application_id' => 'id']);
    }

    public function getComputers()
    {
        return $this->hasMany(Computer::className(), ['id' => 'computer_id'])
            ->viaTable('computer_application', ['application_id' => 'id']);
    }

}
