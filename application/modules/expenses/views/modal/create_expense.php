<style>
.datepicker{z-index:1151 !important;}

</style>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('create_expense')?></h4>
		</div>

		<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open_multipart(base_url().'expenses/create',$attributes); ?>
		<div class="modal-body">
			 
          		<div class="form-group">
				<label class="col-lg-4 control-label"><?=lang('amount')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" placeholder="800.00" name="amount">
				</div>
				</div>

				<div class="form-group">
				<label class="col-lg-4 control-label"><?=lang('notes')?> </label>
				<div class="col-lg-8">
				<textarea class="form-control" name="notes"></textarea>
				</div>
				</div>

				<div class="form-group">
				<label class="col-lg-4 control-label"><?=lang('project')?> </label>
				<div class="col-lg-8">
					<select name="project" class="form-control m-b" id="selected_project">
						<?php foreach ($projects as $key => $p) { ?>
                          <option value="<?=$p->project_id?>" <?=($auto_select_project == $p->project_id) ? 'selected="selected"':''?>><?=$p->project_title?></option>
                          <?php } ?>

                          <option value="NULL">None</option>
                        </select>
				</div>
				</div>


				<div id="client_select" style="display:none">

				<div class="form-group">
				<label class="col-lg-4 control-label"><?=lang('client')?></label>
				<div class="col-lg-8">
					<select name="client" class="form-control m-b">
					
						<?php foreach (Client::get_all_clients() as $key => $c) { ?>
                          <option value="<?=$c->co_id?>"><?=$c->company_name?></option>
                          <?php } ?>

                        </select>
				</div>
				</div>
					
				</div>





				<div class="form-group">
				<label class="col-lg-4 control-label"><?=lang('expense_date')?> </label>
				<div class="col-lg-8">
				<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), time());?>" name="expense_date" data-date-format="<?=config_item('date_picker_format');?>" >
				</div>
				</div>

				
				<div class="form-group">
				<label class="col-lg-4 control-label"><?=lang('category')?> <span class="text-danger">*</span></label>
				<div class="col-lg-5">
					<select name="category" class="form-control m-b">
						<?php foreach ($categories as $key => $cat) { ?>
                          <option value="<?=$cat->id?>"><?=$cat->cat_name?></option>
                          <?php } ?>
                        </select>
				</div>
				<a href="<?=base_url()?>settings/add_category" class="btn btn-<?=config_item('theme_color');?> btn-sm" data-toggle="ajaxModal" title="<?=lang('add_category')?>"><i class="fa fa-plus"></i> <?=lang('add_category')?></a>

				</div>

				<div class="form-group">
                      <label class="col-lg-4 control-label"><?=lang('billable')?></label>
                      <div class="col-lg-8">
                        <label class="switch">
                          <input type="checkbox" name="billable" checked="checked">
                          <span></span>
                        </label>
                      </div>
                    </div>

                 <div class="form-group">
                      <label class="col-lg-4 control-label"><?=lang('show_to_client')?></label>
                      <div class="col-lg-8">
                        <label class="switch">
                          <input type="checkbox" name="show_client" checked="checked">
                          <span></span>
                        </label>
                      </div>
                    </div>


				<div class="form-group">
                      <label class="col-lg-4 control-label"><?=lang('invoiced')?></label>
                      <div class="col-lg-8">
                        <label class="switch">
                          <input type="checkbox" name="invoiced">
                          <span></span>
                        </label>
                      </div>
                    </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label"><?=lang('attach_file')?></label>

                       <div class="col-lg-3">
                            <input type="file" class="filestyle" data-buttonText="<?=lang('choose_file')?>" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s" name="receipt">
                        </div>

                </div

			
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<button type="submit" class="btn btn-<?=config_item('theme_color')?>"><?=lang('save_changes')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script type="text/javascript">
    $('.datepicker-input').datepicker({ language: locale});
    </script>

 <script type="text/javascript">
$('#selected_project').change(function() {
    if($("#selected_project").val()==="NULL"){ 
    	$("#client_select").show();
    }else{
    	$("#client_select").hide();
    }
});
 </script>