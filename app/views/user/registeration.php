<div>
	<? if(isset($massage)) : ?>
		<p class="bg-danger" style="padding:10px;"><? print $massage; ?></p>
	<? endif; ?>
	<form method="post">
		<div class="form-group">
			<label>Name *</label>
			<input class="form-control" name="name" type="text" required placeholder="name" />
		</div>
		<div class="form-group">
			<label>email *</label>
			<input class="form-control" name="email" type="text" required placeholder="email" />
		</div>
		<div class="form-group">
			<label>Login *</label>
			<input class="form-control" name="login" type="text" required placeholder="login" />
		</div>
		<div class="form-group">
			<label>Password *</label>
			<input class="form-control" name="password" type="text" required placeholder="password" />
		</div>
		<div class="form-group">
			<label>Password repeat *</label>
			<input class="form-control" name="password_repeat" type="text" required placeholder="password" />
		</div>
		<div class="form-group" align="center">
			<button type="submit" class="btn btn-success">Registration</button><button type="reset" class="btn btn-default">Reset</button>
		</div>
	</form>
</div>