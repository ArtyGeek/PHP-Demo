<div>
	<h2>Order</h2>
	<hr/>
	<? //var_dump($order); 
		//$user=$this->auth;
	?>
	<div class="col-md-12">
		<p><font size="+2"><b><? print $order['offername']; ?></b></font></p>
		<p>кількість: <font size="+1"><b><? print $order['amount']; ?></b></font></p>
		<p>вартість: <font size="+1"><b><? print intval($order['price'])/100; ?></b></font> грн.</p>
		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label class="col-sm-2 control-label">Статус доставки:</label>
				<div class="col-sm-10">
				  <select class="form-control"  name="status_delivery">
					<option value="1" <? echo intval($order['status_delivery'])==1?'selected':''; ?>>Нове Замовлення</option>
					<option value="4" <? echo intval($order['status_delivery'])==4?'selected':''; ?>>Підтвреджено</option>
					<option value="5" <? echo intval($order['status_delivery'])==5?'selected':''; ?>>Вдіслано замовнику</option>
					<option value="6" <? echo intval($order['status_delivery'])==6?'selected':''; ?>>Отримано замовником</option>
				  </select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Статус оплати:</label>
				<div class="col-sm-10">
				  <select class="form-control"  name="status_payment">
					<option value="2" <? echo intval($order['status_payment'])==2?'selected':''; ?>>Не оплачене</option>
					<option value="3" <? echo intval($order['status_payment'])==3?'selected':''; ?>>Частково оплачене</option>
					<option value="7" <? echo intval($order['status_payment'])==7?'selected':''; ?>>Оплачене</option>
				  </select>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Зберегти</button>
			</div>
		</form>
	</div>
</div>