<?php

use app\models\TicketsBuy;

$this->title = 'Купленные билеты';

?>

<table class="table">
  <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th>Имя покупателя</th>
        <th>Почта</th>
        <th>Номер карты</th>
        <th>Тип билета</th>
        <th>Цена</th>
        <th>Дата покупки</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($model as $bilet) { $bilet = TicketsBuy::findOne($bilet['id']); $typeBilet = $bilet->getTypeTickets()->asArray()->all();?>
    <tr>
        <th scope="row"><?= $bilet['id'] ?></th>
        <td><?= $bilet['name'] ?></td>
        <td><?= $bilet['email'] ?></td>
        <td><?= $bilet['card_number'] ?></td>
        <td><?= $typeBilet[0]['name']?></td>
        <td><?= $typeBilet[0]['price']?></td>
        <td><?= $bilet['date_buy'] ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
