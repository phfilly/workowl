<style>
.datepicker{ z-index:1151 !important; }

</style>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('add_event')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'calendar/add_event',$attributes); ?>
		<div class="modal-body">
			 
			 <div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('event_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" placeholder="<?=lang('event_name')?>" name="event_name">
				</div>
				</div>

				<div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('description')?></label>
				<div class="col-lg-8">
					<textarea class="form-control" name="description"></textarea>
				</div>
				</div>


				<div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('start_date')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-5">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'));?>" name="start_date" data-date-format="<?=config_item('date_picker_format');?>" data-date-start-date="0d" >
                                    </div>
                                </div>

                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('end_date')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-5">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'));?>" name="end_date" data-date-format="<?=config_item('date_picker_format');?>" data-date-start-date="0d">
                                    </div>
                                </div>

				

				<div class="form-group">
                                <label class="col-lg-3 control-label"><?=lang('project')?></label>
                                <div class="col-lg-8">
                                    <select class="select2-option" style="width:210px" name="project" >
                                    <optgroup label="<?=lang('none')?>">
                                        <option value="0" selected="selected"><?=lang('none')?></option>
                                    </optgroup>
                                    <optgroup label="<?=lang('projects')?>">
                                        <?php foreach (Project::all() as $p){ ?>
                                        <option value="<?=$p->project_id?>"><?=$p->project_title?></option>
                                        <?php } ?>
                                    </optgroup>
                                    </select>
                                </div>
                            </div>

                <div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('event_color')?> <span class="text-danger">*</span></label>
				<div class="col-lg-5">
					<input type="text" class="form-control" placeholder="#38354a" name="color">
				</div>
				</div>


			      
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('add_event')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script type="text/javascript">
    $('.datepicker-input').datepicker({ language: locale, autoclose: true});
</script>
<script type="text/javascript">
    $(".select2-option").select2();
</script>