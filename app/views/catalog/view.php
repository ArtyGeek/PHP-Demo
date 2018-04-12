<div>
	<h2><? print $data['catalog']['name']; ?></h2>
	
	<div class="col-md-12">
		<? foreach($data['offers'] as $item): ?>
		<div class="col-md-3 offer-item">
			<img src="<? print $this->root; ?>public/images/offers/<? print $item['id']; ?>/<? print $item['photoname']; ?>">
			<p><a href="<? print $this->root; ?>offer/view/<? print $item['id']; ?>"><? print $item['name']; ?></a></p>
			<p><? echo (intval($item['price'])/100); ?> грн.</p>
		</div>
		<? endforeach; ?>
	</div>
	<? ?>
</div>