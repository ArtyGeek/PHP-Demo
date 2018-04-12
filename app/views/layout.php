<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<? print $this->root; ?>public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="<? print $this->root; ?>public/css/style.css"/>
		<script type="text/javascript" src="<? print $this->root; ?>public/js/application.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	</head>
	<body>
		<div class="content">
			<div id="header">
				<div class="login-block">
					<div class="container">
					<? if($this->auth): ?>
						<div style="float:right;"> <a href="<? print $this->root; ?>user/profile">Особистий кабінет</a> &nbsp; <a href="<? print $this->root; ?>user/logout">Вийти</a> </div>
					<? else : ?>
						<div style="float:right;"> <a href="<? print $this->root; ?>user/login">Вхід</a> &nbsp; <a href="<? print $this->root; ?>user/registration">Реєестрація</a> </div>
					<? endif; ?>
					</div>
				</div>
				<div class="container">
					<div class="menu">
						<nav>
							<ul>
								<li><a href="<? print $this->root; ?>offer/">Всі товари</a></li>
								<li><a href="<? print $this->root; ?>catalog">Каталоги</a></li>
								<li><a href="<? print $this->root; ?>user/profile">Особистий кабінет</a></li>
							</ul>
						</nav>
					</div>
					<div class="basket">
						<a href="<? print $this->root; ?>basket" class="btn btn-default">Корзина: <span id="count_offer_basket"><? print $this->countOffers(); ?></span> товарів</a>
					</div>
				</div>
			</div>
			<div id="main_content">
				<div class="container">
					<? $this->excute($template,$vars); ?>
				<div class="container">
			</div>
			<div id="footer">
				
			</div>
			<div id="form_basket_add_offer" class="hidden-form">
				<button type="button" class="close" aria-label="Close" onclick="hiddenFormBasket()"><span aria-hidden="true">&times;</span></button>
				<div class="basket_up">
				</div>
				<input id="count_offers_form" type="text" value="1" data-max="0" data-inc="0" readonly /><div data-price="0" id="price_value"> </div><button class="btn" onclick="upCountOffer()">+</button><button class="btn" onclick="downCountOffer()">-</button>
				<br/>
				<button class="btn btn-success" onclick="addToBasket('<? print $this->root; ?>basket/add')">Додати до Корзини</button>
			</div>
		</div>
	</body>
</html>