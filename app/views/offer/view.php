<div>
	<h2><? print $data['offer']['name']; ?></h2>
	<div class="col-md-12">
		<? foreach($data['images'] as $item): ?>
		<div class="col-md-3 offer-item">
			<div class="image-holder"><img src="<? print $this->root; ?>public/images/offers/<? print $data['offer']['id']; ?>/<? print $item['name']; ?>"></div>
		</div>
		<? endforeach; ?>
		<? $amount=intval($data['offer']['amount'])-intval($data['offer']['oreders']); ?>
		<div class="col-md-12"><p><div class="price-block"><font size="+1" color="#966"><? echo (intval($data['offer']['price'])/100); ?></font> $. </div> 
		<? if($amount>0): ?>
			<button class="btn <? echo  $amount<3?'btn-warning':'btn-success'; ?>" onclick="showFormAddToBasket('<? print $this->root; ?>public/images/offers/<? print $data['offer']['id']; ?>/<? print $data['images'][0]['name']; ?>','<? echo str_replace('"',' ',$data['offer']['name']); ?>',<? print $data['offer']['id']; ?>,<? echo (intval($data['offer']['price'])/100); ?>,<? print $amount; ?>)">Order</button></p></div>
		<?  else : ?>
			<button class="btn btn-danger" disabled="disabled"> not available  </button>
		<? endif; ?>
		
		<div class="col-md-12"><p><? print  $data['offer']['description'];?></p></div>
		<? //var_dump($data); ?>
	</div>
</div>