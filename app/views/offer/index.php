<div>
	<h2>Products</h2>
	<div class="col-md-12">
		<? foreach($list as $item): ?>
		<div class="col-md-3 offer-item">
			<div class="image-holder"><img src="<? print $this->root; ?>public/images/offers/<? print $item['id']; ?>/<? print $item['photoname']; ?>"></div>
			<p><a href="<? print $this->root; ?>offer/view/<? print $item['id']; ?>"><? print $item['name']; ?></a></p>
			<p><? echo (intval($item['price'])/100); ?> $.</p>
		</div>
		<? endforeach; ?>
	</div>
</div>