<div>
	<h2>Catalog</h2>
	
	<div class="col-md-12">
		<? foreach($list as $item) : ?>
			<div class="col-md-3 catalog-item">
				<a href="catalog/view/<? print $item['id']; ?>"><? print $item['name']; ?></a>
			</div>
		<? endforeach; ?>
	</div>
	<? //var_dump($list); ?>
</div>