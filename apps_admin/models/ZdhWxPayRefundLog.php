<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_wx_pay_refund_log".
 *
 * @property integer $id
 * @property integer $acid
 * @property string $return_code
 * @property string $return_msg
 * @property string $appid
 * @property string $mch_id
 * @property string $nonce_str
 * @property string $sign
 * @property string $result_code
 * @property string $transaction_id
 * @property string $out_trade_no
 * @property string $out_refund_no
 * @property string $refund_id
 * @property string $refund_channel
 * @property string $refund_fee
 */
class ZdhWxPayRefundLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_wx_pay_refund_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acid'], 'integer'],
            [['return_code', 'return_msg', 'appid', 'mch_id', 'nonce_str', 'sign', 'result_code', 'transaction_id', 'out_trade_no', 'out_refund_no', 'refund_id', 'refund_channel', 'refund_fee'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acid' => 'Acid',
            'return_code' => 'Return Code',
            'return_msg' => 'Return Msg',
            'appid' => 'Appid',
            'mch_id' => 'Mch ID',
            'nonce_str' => 'Nonce Str',
            'sign' => 'Sign',
            'result_code' => 'Result Code',
            'transaction_id' => 'Transaction ID',
            'out_trade_no' => 'Out Trade No',
            'out_refund_no' => 'Out Refund No',
            'refund_id' => 'Refund ID',
            'refund_channel' => 'Refund Channel',
            'refund_fee' => 'Refund Fee',
        ];
    }
}
