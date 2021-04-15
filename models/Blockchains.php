<?php

namespace app\models;

use Yii;
use app\components\WebApp;

/**
 * This is the model class for table "blockchains".
 *
 * @property int $id
 * @property string $blockchain_denomination
 * @property int $invoice_expiration
 * @property string $smart_contract_address
 * @property string $chain_id
 * @property string $url_block_explorer
 * @property string $smart_contract_abi
 * @property string $smart_contract_bytecode
 * @property string $sealer_address
 * @property string $sealer_private_key
 */
class Blockchains extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blockchains';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blockchain_denomination', 'invoice_expiration', 'smart_contract_address', 'chain_id', 'url_block_explorer', 'smart_contract_abi', 'smart_contract_bytecode', 'sealer_address', 'sealer_private_key'], 'required'],
            [['invoice_expiration'], 'integer'],
            [['blockchain_denomination', 'smart_contract_address', 'url_block_explorer', 'smart_contract_abi', 'smart_contract_bytecode', 'sealer_address', 'sealer_private_key'], 'string', 'max' => 255],
            [['chain_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'blockchain_denomination' => Yii::t('app', 'Blockchain Denomination'),
            'invoice_expiration' => Yii::t('app', 'Invoice Expiration'),
            'smart_contract_address' => Yii::t('app', 'Smart Contract Address'),
            'chain_id' => Yii::t('app', 'Chain ID'),
            'url_block_explorer' => Yii::t('app', 'Url Block Explorer'),
            'smart_contract_abi' => Yii::t('app', 'Smart Contract Abi'),
            'smart_contract_bytecode' => Yii::t('app', 'Smart Contract Bytecode'),
            'sealer_address' => Yii::t('app', 'Sealer Address'),
            'sealer_private_key' => Yii::t('app', 'Sealer Private Key'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BlockchainsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlockchainsQuery(get_called_class());
    }

    public function beforeSave($insert) {
        $this->sealer_private_key = WebApp::encrypt($this->sealer_private_key);

        return parent::beforeSave($insert);
    }
}
