<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title">Add</h4>
		</div>
		<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'structure/structure/add',$attributes); ?>
          <input type="hidden" name="table" value="<?=$table?>">
		<div class="modal-body">
			<div class="form-group">
				<label class="col-lg-4 control-label">Name <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" required name="name">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
			<button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('save_changes')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>
	<script>
		$(function() {
		$('.money').maskMoney();
		})
	</script>