<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "UserAuthLog".
 *
 * @property integer $id
 * @property integer $date
 * @property boolean $cookieBased
 * @property integer $duration
 * @property string $error
 * @property string $ip
 * @property string $host
 * @property string $url
 * @property string $userAgent
 * @property integer $userId
 *
 * @property User $user
 */
class UserAuthLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UserAuthLog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'duration', 'userId'], 'integer'],
            [['cookieBased'], 'boolean'],
            [['error', 'ip', 'host', 'url', 'userAgent'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => Yii::t('common', 'Date'),
            'cookieBased' => Yii::t('auth', 'Cookie Based'),
            'duration' => Yii::t('auth', 'Duration'),
            'error' => Yii::t('yii', 'Error'),
            'ip' => Yii::t('common', 'IP Address'),
            'host' => Yii::t('common', 'Host'),
            'url' => 'URL',
            'userAgent' => Yii::t('auth', 'UserAgent'),
            'userId' => Yii::t('user', 'User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}