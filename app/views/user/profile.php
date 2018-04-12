<div>
	<? //var_dump($orders); ?>
	<? foreach($orders as $item) : ?>
		<div class="col-md-12 order-item">
			<div class="col-md-3">
				<p><a href="<? print $this->root; ?>offer/view/<? print $item['offer']; ?>" target="_blank"><? print $item['offername']; ?></a></p>
				<p> Кількість: <? print $item['amount']; ?></p>
				<p> Ціна: <? print intval($item['price'])/100; ?> грн.</p>
				
			</div>
			<div class="col-md-3">
				<p>замовник: <b><? print $item['name']; ?></b></p>
				<p>статус доставки: <b><? print $item['delivery']; ?></b></p>
				<p>статус оплати:  <b><? print $item['payment']; ?></b> </p>
			</div>
			<div class="col-md-3">
				<p><? print $item['client_mail']; ?></p>
				<p><? print $item['client_phone']; ?></p>
			</div>
			<div class="col-md-3">
				<? if($allow_change): ?>
					<p> <a class="btn btn-info" href="<? print $this->root; ?>order/edit/<? print $item['id']; ?>">Редагувати Статус</a> </p>
				<? endif; ?>
			</div>
		</div>
	<? endforeach; ?>
</div>