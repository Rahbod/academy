<?php

namespace App;

use Appnegar\Cms\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class GatewayTransaction extends Model
{
    use ModelTrait;
    protected $fillable=['port','price','ref_id','tracking_code','card_number','status','ip','payment_dat'];

    public function transaction_log()
    {
        return $this->hasOne('App\GatewayTransactionsLog');
    }

    public static function mainFields(){
        return [
            'name' => static ::getTableName(),
            'items' => [
                [
                    'name' => 'id',
                    'type' => 'numeric',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_sub_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'port',
                    'type' => 'select',
                    'input_type' => 'select',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true,
                    'options'=>[
                        ['id'=>'MELLAT','text'=>'MELLAT'],
                        ['id'=>'SADAD','text'=>'SADAD'],
                        ['id'=>'ZARINPAL','text'=>'ZARINPAL'],
                        ['id'=>'PAYLINE','text'=>'PAYLINE'],
                        ['id'=>'JAHANPAY','text'=>'JAHANPAY'],
                        ['id'=>'PARSIAN','text'=>'PARSIAN'],
                        ['id'=>'PASARGAD','text'=>'PASARGAD'],
                        ['id'=>'SAMAN','text'=>'SAMAN'],
                        ['id'=>'ASANPARDAKHT','text'=>'ASANPARDAKHT'],
                        ['id'=>'PAYPAL','text'=>'PAYPAL'],
                        ['id'=>'PAYIR','text'=>'PAYIR'],
                    ]
                ],
                [
                    'name' => 'price',
                    'type' => 'numeric',
                    'input_type' => 'type',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => true,
                    'show_in_form' => true
                ],
                [
                    'name' => 'tracking_code',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'card_number',
                    'type' => 'string',
                    'input_type' => 'text',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true
                ],
                [
                    'name' => 'status',
                    'type' => 'select',
                    'input_type' => 'radio',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                    'options' => [['id' => 'INIT', 'text' => 'INIT'],['id' => 'SUCCEED', 'text' => 'SUCCEED'], ['id' => 'FAILED', 'text' => 'FAILED']]
                ],
                [
                    'name' => 'ip',
                    'type' => 'string',
                    'input_type' => 'hidden',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'payment_date',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => true,
                ],
                [
                    'name' => 'created_at',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false,
                ],
                [
                    'name' => 'updated_at',
                    'type' => 'date',
                    'input_type' => 'date',
                    'orderable' => true,
                    'searchable' => true,
                    'show_in_table' => false,
                    'show_in_form' => false,
                ],
            ]
        ];
    }



    public static function  relatedFields(){
        return [
            [
                'name' => 'transaction_log',
                'table' => GatewayTransactionsLog::getTableName(),
                'show_in_form' => false,
                'show_in_table' => true,
                'items' => GatewayTransactionsLog::getSubFields()
            ]
        ];
    }

//    public function getPaymentDateAttribute($date)
//    {
//        if($date)
//        {
//            $dateTime =\jDate::forge($date)->format('H:i - Y/m/d ');
//            $dateTime=\Morilog\Jalali\jDateTime::convertNumbers($dateTime);
//            return $dateTime;
//        }
//        return null;
//
//    }
}
