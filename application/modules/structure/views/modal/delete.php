<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header bg-danger"> 
		<button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title">Delete</h4>
		</div><?php
			echo form_open(base_url().'structure/structure/delete'); ?>
		<div class="modal-body">
			<p>Are you sure you want to delete this entry?</p>
			
			<input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="table" value="<?=$table?>">
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn btn-<?=config_item('theme_color')?>"><?=lang('delete_button')?></button>
		</form>
	</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->