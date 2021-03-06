<?= \Form::open(array('action' => \Router::get('url_create_short'), 'method' => 'get')); ?>
	<div class="row">
	  <div class="col-lg-6">
		<section class="panel panel-default">
			<div class="panel-heading">
			  	<strong><?= __('url.url_shortener'); ?></strong>
			</div>
			<div class="panel-body">
			    <div class="input-group">
			      <input type="text" name="url" class="form-control" placeholder="<?= __('url.your_url'); ?>">
			      <span class="input-group-btn">
			        <input class="btn btn-primary" name="add" type="submit" value="<?= __('url.create_short_url'); ?>"></input>
			      </span>
			    </div><!-- /input-group -->
			</div>
		</section>
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
<?php \Form::close(); ?>