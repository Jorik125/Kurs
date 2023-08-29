<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets_buy".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $card_number
 * @property int $type_tickets_id
 *
 * @property TypeTickets $typeTickets
 */
class TicketsBuy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets_buy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email','card_number'], 'required','message'=>'Данное поле должно быть заполненным'],
            [['type_tickets_id', 'card_number'], 'integer','message'=>'В данном поле принимаются только цифры'],
            [['name'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 100],
            [['type_tickets_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeTickets::class, 'targetAttribute' => ['type_tickets_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Почта',
            'card_number' => 'Номер карты',
            'type_tickets_id' => 'Type Tickets ID',
        ];
    }

    /**
     * Gets query for [[TypeTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTickets()
    {
        return $this->hasOne(TypeTickets::class, ['id' => 'type_tickets_id']);
    }
}
