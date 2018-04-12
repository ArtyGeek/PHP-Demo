<div>
	<h2>Корзина</h2>
	<div class="col-md-12">
		<? if(isset($result)) :?>
		<? foreach($result as $key=>$item) : ?>
			<div class="col-md-12">
				<div class="col-md-4 basket-item">
					<img src="<? print $this->root; ?>public/images/offers/<? print $item['id']; ?>/<? print $item['photoname']; ?>" />
				</div>
				<div class="col-md-4">
					<? print $item['name']; ?>
				</div>
				<?
					$count=1;
					foreach($data as $bitem){
						if(intval($bitem['id'])==intval($item['id'])){
							$count=intval($bitem['amount']);
							break;
						}
					}
				?>
				<div class="col-md-4">
					<a href="<? print $this->root; ?>basket/remove/<? print $item['id']; ?>"><button type="button" class="close delete-offer-basket" aria-label="Close" ><span aria-hidden="true">&times;</span></button></a>
					quantity: <b><? print $count; ?></b>
					total: <b><? echo $count*intval($item['price'])/100; ?> $.</b>
					<p><a href="<? print $this->root; ?>order/complite?offer=<? print $item['id']; ?>&count=<? print $count; ?>" class="btn btn-success">Place Order</a></p>
				</div>
			</div>
		<? endforeach; ?>
		<? endif; ?>
	</div>
</div>