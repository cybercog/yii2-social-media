<?php

namespace infoweb\ecommerce\sales\models\customer;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use infoweb\ecommerce\sales\models\customer\Address;

/**
 * This is the model class for table "ecommerce_customers".
 */
class SocialMedia extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ecommerce_customers';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() { return time(); },
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'firstname', 'name', 'address', 'zipcode', 'city', 'email', 'country_id'], 'required'],
            [['group_id', 'country_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['firstname', 'name', 'company', 'address', 'city', 'email', 'password'], 'string', 'max' => 255],
            [['zipcode'], 'string', 'max' => 20],
            [['phone', 'mobile', 'fax'], 'string', 'max' => 25],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }
}
