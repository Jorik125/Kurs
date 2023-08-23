<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_tickets".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $info
 * @property float|null $price
 * @property string|null $img
 *
 * @property TicketsBuy[] $ticketsBuys
 */
class TypeTickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['name'], 'string', 'max' => 45],
            [['info'], 'string', 'max' => 1000],
            [['img'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'info' => 'Info',
            'price' => 'Price',
            'img' => 'Img',
        ];
    }

    /**
     * Gets query for [[TicketsBuys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketsBuys()
    {
        return $this->hasMany(TicketsBuy::class, ['type_tickets_id' => 'id']);
    }
}
