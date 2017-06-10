<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proc".
 *
 * @property string $db
 * @property string $name
 * @property string $type
 * @property string $specific_name
 * @property string $language
 * @property string $sql_data_access
 * @property string $is_deterministic
 * @property string $security_type
 * @property resource $param_list
 * @property resource $returns
 * @property resource $body
 * @property string $definer
 * @property string $created
 * @property string $modified
 * @property string $sql_mode
 * @property string $comment
 * @property string $character_set_client
 * @property string $collation_connection
 * @property string $db_collation
 * @property resource $body_utf8
 */
class ProcMysqlProdTecnoglass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proc';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMysqlProductivoTecnoglass');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['db', 'name', 'type', 'param_list', 'returns', 'body', 'comment'], 'required'],
            [['type', 'language', 'sql_data_access', 'is_deterministic', 'security_type', 'param_list', 'returns', 'body', 'sql_mode', 'comment', 'body_utf8'], 'string'],
            [['created', 'modified'], 'safe'],
            [['db', 'name', 'specific_name'], 'string', 'max' => 64],
            [['definer'], 'string', 'max' => 77],
            [['character_set_client', 'collation_connection', 'db_collation'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'db' => 'Db',
            'name' => 'Name',
            'type' => 'Type',
            'specific_name' => 'Specific Name',
            'language' => 'Language',
            'sql_data_access' => 'Sql Data Access',
            'is_deterministic' => 'Is Deterministic',
            'security_type' => 'Security Type',
            'param_list' => 'Param List',
            'returns' => 'Returns',
            'body' => 'Body',
            'definer' => 'Definer',
            'created' => 'Created',
            'modified' => 'Modified',
            'sql_mode' => 'Sql Mode',
            'comment' => 'Comment',
            'character_set_client' => 'Character Set Client',
            'collation_connection' => 'Collation Connection',
            'db_collation' => 'Db Collation',
            'body_utf8' => 'Body Utf8',
        ];
    }
}
