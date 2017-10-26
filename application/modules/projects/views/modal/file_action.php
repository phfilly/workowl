<?php $action = (isset($action)) ? $action : ''; ?>

<?php if($action == 'add_file') { ?>


<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('upload_file')?></h4>
		</div>
		
	<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open_multipart(base_url().'projects/files/add',$attributes); ?>
          <input type="hidden" name="project" value="<?=$project?>">
		<div class="modal-body">

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?=lang('file_title')?> <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                    <input name="title" class="form-control" required placeholder="<?=lang('file_title')?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?=lang('description')?></label>
                    <div class="col-lg-9">
                    <textarea name="description" class="form-control" placeholder="<?=lang('description')?>" ></textarea>
                    </div>
                </div>
                    
                <div id="file_container">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input type="file" name="projectfiles[]" required="">
                        </div>
                    </div>
                </div>

		<div class="modal-footer">
                    <a href="#" class="btn btn-<?=config_item('theme_color');?> pull-left" id="add-new-file"><?=lang('upload_another_file')?></a>
                    <a href="#" class="btn btn-default pull-left" id="clear-files" style="margin-left:6px;"><?=lang('clear_files')?></a>
                    <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
                    <button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('upload_file')?></button>
		</form>
		</div>
	        </div>
        </div>
  
    <script type="text/javascript">
        $('#clear-files').click(function(){
            $('#file_container').html(
                "<div class='form-group'>" +
                    "<div class='col-lg-offset-3 col-lg-9'>" +
                    "<input type='file' name='projectfiles[]'>" +
                    "</div></div>"
            );
        });

        $('#add-new-file').click(function(){
            $('#file_container').append(
                "<div class='form-group'>" +
                "<div class='col-lg-offset-3 col-lg-9'>" +
                "<input type='file' name='projectfiles[]'>" +
                "</div></div>"
            );
        });
    </script>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->



<?php } ?>

<?php if($action == 'edit_file') { ?>




<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title"><?=lang('edit_file')?></h4>
		</div>
		
					<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open_multipart(base_url().'projects/files/edit',$attributes); ?>
          <input type="hidden" name="project" value="<?=$project_id?>">
          <input type="hidden" name="file_id" value="<?=$file_id?>">
		<div class="modal-body">
                    <?php   $icon = $this->applib->file_icon($f->ext); 
                            $real_url = base_url().$file_path; ?>
                    
                <div class="form-group">
                    <div class="col-lg-3">
                    <?php if ($f->is_image == 1) : ?>
                    <?php if ($f->image_width > $f->image_height) {
                        $ratio = round(((($f->image_width - $f->image_height) / 2) / $f->image_width) * 100);
                        $style = 'height:100%; margin-left: -'.$ratio.'%';
                    } else {
                        $ratio = round(((($f->image_height - $f->image_width) / 2) / $f->image_height) * 100);
                        $style = 'width:100%; margin-top: -'.$ratio.'%';
                    }  ?>
                        <div class="file-icon icon-large pull-right">
                            <a href="<?=base_url()?>projects/files/preview/<?=$f->file_id?>/<?=$project_id?>" data-toggle="ajaxModal">
                            <img style="<?=$style?>" src="<?=$real_url?>" /></a>
                        </div>
                    <?php else : ?>
                        <div class="file-icon icon-large pull-right"><i class="fa <?=$icon?> fa-5x"></i></div>
                    <?php endif; ?>
                    </div>
                    <div class="col-lg-9">
                    <table class="table table-striped table-small">
                        <tbody>
                            <tr>
	                            <td class="col-lg-3"><?=lang('file_name');?></td>
	                            <td><?=$f->file_name;?></td>
                            </tr>
                            <tr>
	                            <td><?=lang('size');?></td>
	                            <td><?=$f->size;?></td>
                            </tr>
                            <?php if($f->is_image == 1) : ?>
                            <tr>
	                            <td><?=lang('dimensions');?></td>
	                            <td><?=$f->image_width;?>x<?=$f->image_height;?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                            <td><?=lang('date');?></td>
                            <td><?=strftime(config_item('date_format')." %H:%M", strtotime($f->date_posted));?></td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?=lang('file_title')?></label>
                    <div class="col-lg-9">
                    <input name="title" class="form-control" value="<?=$f->title;?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?=lang('description')?></label>
                    <div class="col-lg-9">
                    <textarea name="description" class="form-control" ><?=$f->description;?></textarea>
                    </div>
                </div>
		<div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
                    <button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('save_changes')?></button>
		</form>
		</div>
	        </div>
        </div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->



<?php } ?>


<?php if($action == 'preview_file') { ?>


<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
            <h4 class="modal-title"><?=$file->title?></h4>
        </div>
        <div class="modal-body">
            <img width="538" src="<?=base_url()?><?=$file_path?>" alt="<?=$file->file_name?>"/>
        </div>
    </div>
</div>


<?php } ?>

<?php if($action == 'delete_file') { ?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
        <h4 class="modal-title"><?=lang('delete_file')?></h4>
        </div><?php
            echo form_open(base_url().'projects/files/delete'); ?>
        <div class="modal-body">
            <p><?=lang('delete_file_warning')?></p>
            
            <input type="hidden" name="file" value="<?=$file_id?>">
            <input type="hidden" name="project" value="<?=$project_id?>">

        </div>
        <div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
            <button type="submit" class="btn btn-<?=config_item('theme_color')?>"><?=lang('delete_button')?></button>
        </form>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<?php } ?>