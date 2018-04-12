function showFormAddToBasket(imgsrc,name,id,price,amount){
	var htmloffer='<div class="col-md-12 offer-item">'+
			'<img src="'+imgsrc+'">'+
			'<p>'+name+'</p>'+'</div>';
	$('#form_basket_add_offer>.basket_up').html(htmloffer);
	$('#price_value').data('price',price);
	var str_price=price+' грн.';
	$('#count_offers_form').data('max',amount);
	$('#count_offers_form').data('inc',id);
	$('#price_value').html(str_price);
	$('#form_basket_add_offer').removeClass('hidden-form');
}

function hiddenFormBasket(){
	$('#form_basket_add_offer').addClass('hidden-form');
}

function upCountOffer(){
	var value=$('#count_offers_form')[0].value;
	var max=parseInt($('#count_offers_form').data('max'));
	var UP=parseInt(value)+1;
	if(UP<=max){
		var price=$('#price_value').data('price');
		price=price*UP;
		var str_price=price+' грн.';
		$('#price_value').html(str_price);
		$('#count_offers_form')[0].value=UP;
	}
}

function downCountOffer(){
	var value=$('#count_offers_form')[0].value;
	var DOWN=parseInt(value)-1;
	if(DOWN>=1){
		$('#count_offers_form')[0].value=DOWN;
		var price=$('#price_value').data('price');
		price=price*DOWN;
		var str_price=price+' грн.';
		$('#price_value').html(str_price);
	}
}

function addToBasket(_url){
	var count=$('#count_offers_form')[0].value;
	var id=$('#count_offers_form').data('inc');
	var _data={"id":id,"value":count};
	$.ajax({
		url:_url,
		type: "POST",
		async:true,
		data:_data,
		success:function(response){
			alert('Товар додано до Корзини');
			hiddenFormBasket();
			location.reload();
		}
	});
}
