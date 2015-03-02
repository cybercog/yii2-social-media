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
            'id' => Yii::t('ecommerce', 'ID'),
            'group_id' => Yii::t('ecommerce', 'Group'),
            'firstname' => Yii::t('ecommerce', 'Firstname'),
            'name' => Yii::t('ecommerce', 'Name'),
            'company' => Yii::t('ecommerce', 'Company'),
            'address' => Yii::t('ecommerce', 'Address'),
            'zipcode' => Yii::t('ecommerce', 'Zipcode'),
            'city' => Yii::t('ecommerce', 'City'),
            'email' => Yii::t('ecommerce', 'Email'),
            'phone' => Yii::t('ecommerce', 'Phone'),
            'mobile' => Yii::t('ecommerce', 'Mobile'),
            'fax' => Yii::t('ecommerce', 'Fax'),
            'country_id' => Yii::t('ecommerce', 'Country'),
            'password' => Yii::t('ecommerce', 'Password'),
            'active' => Yii::t('ecommerce', 'Active'),
            'created_at' => Yii::t('ecommerce', 'Created At'),
            'updated_at' => Yii::t('ecommerce', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['customer_id' => 'id']);
    }
    
    /**
     * Returns the customers' addresses, formatted for usage
     * in the kartik\widgets\DepDrop widget
     * 
     * @return  array
     */
    public function getAddressesForDepDropdown()
    {
        $addresses = [];
        
        foreach ($this->addresses as $address) {
            $addresses[$address->id] = "{$address->firstname} {$address->name}, {$address->address}, {$address->zipcode} {$address->city}";    
        }
        
        return $addresses;
    }
}
