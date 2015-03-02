<?php

namespace infoweb\social\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "social_media_lang".
 */
class Lang extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_media_lang';
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
            // Required
            [['language'], 'required'],
            // Only required for existing records
            [['node_id'], 'required', 'when' => function($model) {
                return !$model->isNewRecord;
            }],
            // Only required for the app language
            [['title'], 'required', 'when' => function($model) {
                return $model->language == Yii::$app->language;
            }],
            // Trim
            [['title'], 'trim'],
            // Types
            [['node_id', 'created_at', 'updated_at'], 'integer'],
            [['language'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['node_id', 'language'], 'unique', 'targetAttribute' => ['node_id', 'language'], 'message' => Yii::t('app', 'The combination of Node ID and Language has already been taken.')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('infoweb/social', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(Social::className(), ['id' => 'node_id']);
    }
}
