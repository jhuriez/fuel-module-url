<?= $widget; ?>

<section class="panel panel-default">
	<div class="panel-heading">
		<strong>URL</strong>
	</div>

	<div class="panel-body">
		<?php if(empty($urls)): ?>
			<p><?= __('url.none'); ?></p>
		<?php else: ?>
			<div id="alerts"></div>

			<div class="table-responsive">
		        <table class="table table-striped table-bordered table-hover" data-toggle="datatable" id="table-url">
		            <thead>
		                <tr>
		                    <th><?= __('url.table.id'); ?></th>
		                    <th><?= __('url.table.short_url'); ?></th>
		                    <th><?= __('url.table.long_url'); ?></th>
		                    <th><?= __('url.table.method'); ?></th>
		                    <th><?= __('url.table.code'); ?></th>
		                    <th><?= __('url.table.hits'); ?></th>
		                    <th><?= __('url.table.active'); ?></th>
		                    <th><?= __('url.table.actions'); ?></th>
		                </tr>
		            </thead>
		            <tbody>
		            	<?php foreach($urls as $url): ?>
						<tr id="object-<?= $url->id; ?>" data-id="<?= $url->id; ?>">
							<td><?= $url->id; ?></td>
							<td><a href="<?= \LbUrl\Helper_Url::getUrl($url, true); ?>" target="_blank"><?= $url->slug; ?></a></td>
							<td><?= $url->url_target ?></td>
							<td><?= $url->method ?></td>
							<td><?= $url->code ?></td>
							<td><?= $url->hits; ?></td>
							<td>
								<?php if($url->active): ?>
									<a href="#" class="toggle activate" data-id="<?= $url->id; ?>"><i class="fa fa-check-square-o fa-lg"></i></a>
								<?php else: ?>
									<a href="#" class="toggle desactivate" data-id="<?= $url->id; ?>"><i class="fa fa-square-o fa-lg"></i></a>
								<?php endif; ?>
							</td>
							<td>
								<a href="<?= \Router::get('url_backend_delete', array('id' => $url->id)); ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash-o fa-lg"></i></a>
								<a href="<?= \Router::get('url_backend_edit', array('id' => $url->id)); ?>" class="btn btn-info btn-circle"><i class="fa fa-pencil fa-lg"></i></a>
		                    </td>
						</tr>
		            	<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
		<a href="<?= \Router::get('url_backend_add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?= __('url.action.create'); ?></a>
	</div>
</section>


<script type="text/javascript">
$(function() {
        // For activate url
        $('#table-url').on('click', '.toggle', function(e) {
        	manageUrlActivate(this, 'desactivate');
        	return false;
        });
        function manageUrlActivate(el, action)
        {
        	var action = ($(el).hasClass('activate')) ? 'desactivate' : 'activate';
        	var id = $(el).attr('data-id');
			$.ajax({
				url: baseUri + 'url/backend/index/api/toggle_url.json',
				data: 'id='+id+'&action='+action,
				type: 'get',
				dataType: 'json',
				success: function(data){
					if (action == 'activate')
					{
						$(el).attr('class', 'toggle activate').html('<i class="fa fa-check-square-o fa-lg"></i>');
					}
					else
					{
						$(el).attr('class', 'toggle desactivate').html('<i class="fa fa-square-o fa-lg"></i>');
					}
				},
				error: function() {
					alert("Error");
				}
			});
        }
});
</script>

