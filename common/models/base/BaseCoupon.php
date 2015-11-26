<?php
namespace common\models\base;
use Yii;
/**
 * This is the model class for table "coupon".
 *
 * @property string $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property string $discount
 * @property integer $uses_total
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CouponHistory[] $couponHistories
 */
 class BaseCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [['name', 'code', 'discount', 'uses_total'], 'required'],
                [['type', 'status'], 'string'],
                [['discount'], 'number'],
                [['uses_total'], 'integer'],
                [['created_at', 'updated_at','end_date'], 'safe'],
                [['name'], 'string', 'max' => 128],
                [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                'id'         => 'ID',
                'name'       => 'Name',
                'code'       => 'Code',
                'type'       => 'Type',
                'discount'   => 'Discount',
                'uses_total' => 'Uses Total',
                'status'     => 'Status',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'end_date'   => 'End Date'    
            ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponHistories()
    {
        return $this->hasMany(CouponHistory::className(), ['coupon_id' => 'id']);
    }
}
