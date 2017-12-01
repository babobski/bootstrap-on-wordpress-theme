<form class="navbar-form navbar-left" id="searchform" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
		<input id="s" type="text" class="form-control" name="s" placeholder="<?php echo __('Search', 'wp_babobski'); ?>">
	</div>
	<button type="submit" class="btn btn-default">
		<?php echo __('Submit', 'wp_babobski'); ?>
	</button>
</form>
