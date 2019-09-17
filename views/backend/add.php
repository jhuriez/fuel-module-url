<?= \Form::open(array('role' => 'form', 'class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-lg-6">
      <section class="panel panel-default">
        <div class="panel-heading">
          <h3>Configuration</h3>
        </div>

        <div class="panel-body">
          <div class=" form-group">
            <label id="label_slug" for="form_slug" class="control-label col-lg-2"><?= __('url_model_url.slug'); ?></label>
            <div class="col-lg-10">
              <div class="input-group">
                <span class="input-group-btn">
                  <button class="btn btn-warning random" type="button" data-target="#form_slug"><?= __('url.random'); ?></button>
                </span>
                <input type="text" class="form-control" id="form_slug" name="slug" value="<?= $form->field('slug')->get_attribute('value'); ?>"> <span></span> 
              </div><!-- /input-group -->
            </div>
          </div>

          <?= $form->field('url_target')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('code')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('method')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('description')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('is_download')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('expired_at')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('active')->set_attribute(array('class' => 'form-control')); ?>
          <?= $form->field('add'); ?>
        </div>
      </section>
    </div>
    <div class="col-lg-6">
      <?php if(!empty($url->associated_urls)): ?>
        <section class="panel panel-default">
          <div class="panel-heading">
            <h3><?= __('url.title.associated_url'); ?></h3>
          </div>
          <div class="panel-body">
            <div class="associated-url">
              <dl class="dl-horizontal">
                <?php foreach($url->associated_urls as $associated_url): ?>
                  <div>  
                  <dt><?= $associated_url->slug; ?></dt>
                  <dd>
                    <?php if($associated_url->active): ?>
                      <a href="#" class="toggle activate" data-id="<?= $associated_url->id; ?>"><i class="fa fa-check-square-o fa-lg"></i></a>
                    <?php else: ?>
                      <a href="#" class="toggle desactivate" data-id="<?= $associated_url->id; ?>"><i class="fa fa-square-o fa-lg"></i></a>
                    <?php endif; ?>       
                    <a href="#" class="delete" data-id="<?= $associated_url->id; ?>"><i class="fa fa-trash-o fa-lg"></i></a>

                  </dd>
                  </div>
                <?php endforeach; ?>
              </dl>
            </div>
          </div>
        </section>
      <?php endif; ?>
    </div>
</div>
<?= \Form::close(); ?>


<script type="text/javascript">
    $(function() {
        // Random function
        $('.random').on('click', function() {
          var el = $(this);
          $.ajax({
            url: baseUri + 'url/backend/index/api/get_random.json',
            type: 'get',
            dataType: 'json',
            success: function(data){
              $($(el).attr('data-target')).val(data.slug);
            },
            error: function() {
              alert("Error");
            }
          });
          return false;
        }); 
        
        // For delete url
        $('.associated-url').on('click', '.delete', function(e) {
          var id = $(this).attr('data-id');
          var el = $(this);
          $.ajax({
            url: baseUri + 'url/backend/index/api/delete_url.json',
            data: 'id='+id,
            type: 'get',
            dataType: 'json',
            success: function(data){
              $(el).parent().parent().remove();
            },
            error: function() {
              alert("Error");
            }
          });
          return false;
        });

        // For activate url
        $('.associated-url').on('click', '.toggle', function(e) {
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
