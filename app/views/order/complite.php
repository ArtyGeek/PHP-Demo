<div>
	<h2>Order</h2>
	<hr/>
	<? //var_dump($offer); 
		//$user=$this->auth;
	?>
	<div class="col-md-12">
		<div align="center" class="col-md-6">
			<img style="max-width:100%; max-height:200px;" src="<? print $this->root; ?>public/images/offers/<? print $offer['id']; ?>/<? print $offer['photoname']; ?>">
		</div>
		<div class="col-md-6">
			<p><font size="+2"><strong><? print $offer['name']; ?></strong></font></p>
			<p> Кількість: <font size="+1" ><b><? print $count; ?></b></font> </p>
			<p> Сума замовлення: <font size="+2" color="green"><b><? echo $count*$offer['price']/100; ?></b></font> грн. </p>
		</div>
		<div class="col-md-12">
			<form class="form-horizontal order-form" action="<? print $this->root; ?>order/save" method="post" style="margin-top:20px; border-top: solid 1px #CCC; padding:10px;">
				<input type="hidden" name="offer" value="<? print $offer['id']; ?>" />
				<input type="hidden" name="price" value="<? echo $count*$offer['price']; ?>" />
				<input type="hidden" name="amount" value="<? print $count; ?>" />
				<? if(!$this->auth)  : ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
					  <input type="text" name="client_name" class="form-control" required placeholder="Ваше Імя">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">E-mail</label>
					<div class="col-sm-10">
					  <input type="text" name="client_mail" class="form-control" required placeholder="Ваше E-mail">
					</div>
				</div>
				<? endif; ?>
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="client_phone" placeholder="Ваше Телефон">
					</div>
				</div>
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Оформити замовлення</button>
				</div>
			</form>
		</div>
	</div>
</div>