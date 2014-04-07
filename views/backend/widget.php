<?= \Form::open(array('action' => \Router::get('url_create_short'), 'method' => 'get')); ?>
	<div class="row">
	  <div class="col-lg-6">
	  	<div class="well">
	  	<h2><?= __('url.url_shortener'); ?></h2>
	    <div class="input-group">
	      <input type="text" name="url" class="form-control" placeholder="<?= __('url.your_url'); ?>">
	      <span class="input-group-btn">
	        <input class="btn btn-primary" name="add" type="submit" value="<?= __('url.create_short_url'); ?>"></input>
	      </span>
	    </div><!-- /input-group -->
	  	</div>
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
<?php \Form::close(); ?>