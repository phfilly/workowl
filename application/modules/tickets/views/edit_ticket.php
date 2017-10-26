<?php $info = Ticket::view_by_id($id); ?>
<section id="content">
	<section class="hbox stretch">
	
		<aside class="aside-md bg-white b-r" id="subNav">

			<header class="dk header b-b">
		<a href="<?=base_url()?>tickets/add" data-original-title="<?=lang('create_ticket')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-<?=config_item('theme_color');?> btn-sm pull-right"><i class="fa fa-plus"></i></a>
		<p class="h4"><?=lang('all_tickets')?></p>
		</header>

			<section class="vbox">
			 <section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

			<?=$this->load->view('sidebar/tickets',$tickets)?>

			</div></section>
			</section>
			</aside> 
			
			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">
					
						<div class="btn-group">
						<a href="<?=base_url()?>tickets/view/<?=$info->id?>" data-original-title="<?=lang('view_details')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-<?=config_item('theme_color');?> btn-sm"><i class="fa fa-info-circle"></i> <?=lang('ticket_details')?></a>
						</div>
						
						</div>
						<div class="col-sm-4 m-b-xs">
						
						</div>
					</div> </header>
					<section class="scrollable wrapper">

					 <!-- Start create ticket -->
<div class="col-sm-12">
	<section class="panel panel-default">
	
	<header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('ticket_details')?> - <?=$info->ticket_code?></header>
	<div class="panel-body">
	
<!-- Start ticket form -->
<?php echo $this->session->flashdata('form_error'); ?>

	<?php 
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open_multipart(base_url().'tickets/edit/',$attributes);
           ?>
			 
			 <input type="hidden" name="id" value="<?=$info->id?>">

			    <div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('ticket_code')?> <span class="text-danger">*</span></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" value="<?=$info->ticket_code?>" name="ticket_code">
				</div>
				</div>

				<div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('subject')?> <span class="text-danger">*</span></label>
				<div class="col-lg-7">
					<input type="text" class="form-control" value="<?=$info->subject?>" name="subject">
				</div>
				</div>

				

			

				<div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('priority')?> <span class="text-danger">*</span> </label>
				<div class="col-lg-6">
					<div class="m-b"> 
					<select name="priority" class="form-control" >
					<option value="<?=$info->priority?>"><?=lang('use_current')?></option>
					<?php 
					$priorities = $this->db->get('priorities')->result();
						foreach ($priorities as $p): ?>
					<option value="<?=$p->priority?>"><?=lang(strtolower($p->priority))?></option>
					<?php endforeach; ?>
					</select> 
					</div> 
				</div>
			</div>

			 <div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('department')?> </label>
				<div class="col-lg-6">
					<div class="m-b"> 
					<select name="department" class="form-control" >
					<?php 
					$departments = App::get_by_where('departments',array('deptid >'=>'0'));
						foreach ($departments as $d): ?>
					<option value="<?=$d->deptid?>"<?=($info->department == $d->deptid ? ' selected="selected"' : '')?>><?=strtoupper($d->deptname)?></option>
					<?php endforeach;  ?>
					</select> 
					</div> 
				</div>
			</div>


			<div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('reporter')?> <span class="text-danger">*</span> </label>
				<div class="col-lg-6">
					<div class="m-b"> 
					<select class="select2-option" style="width:260px" name="reporter" >
					<optgroup label="<?=lang('users')?>"> 
					<?php foreach (User::all_users() as $user): ?>
					<option value="<?=$user->id?>"<?=($info->reporter == $user->id ? ' selected="selected"' : '')?>><?php echo User::displayName($user->id); ?></option>
					<?php endforeach; ?>
					</optgroup> 
					</select> 
					</div> 
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('ticket_message')?> </label>
				<div class="col-lg-9">
				<textarea name="body" class="form-control foeditor"><?=$info->body?></textarea>
				
				</div>
				</div>

			<div id="file_container">
				<div class="form-group">
				<label class="col-lg-3 control-label"><?=lang('attachment')?></label>
				<div class="col-lg-6">
					<input type="file" name="ticketfiles[]">
				</div>
				</div>

			</div>

<a href="#" class="btn btn-primary btn-xs" id="add-new-file"><?=lang('upload_another_file')?></a>
<a href="#" class="btn btn-default btn-xs" id="clear-files" style="margin-left:6px;"><?=lang('clear_files')?></a>

<div class="line line-dashed line-lg pull-in"></div>

	<button type="submit" class="btn btn-sm btn-<?=config_item('theme_color')?>"><i class="fa fa-ticket"></i> <?=lang('edit_ticket')?></button>


				
		</form>



		<!-- End ticket -->
		
</div>
</section>
</div>


<!-- End edit ticket -->



</section>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
        $('#clear-files').click(function(){
            $('#file_container').html(
                "<div class='form-group'>" +
                    "<label class='col-lg-3 control-label'> <?=lang('attachment')?></label>" +
                    "<div class='col-lg-6'>" +
                    "<input type='file' name='ticketfiles[]'>" +
                    "</div></div>"
            );
        });

        $('#add-new-file').click(function(){
            $('#file_container').append(
                "<div class='form-group'>" +
                    "<label class='col-lg-3 control-label'> <?=lang('attachment')?></label>" +
                    "<div class='col-lg-6'>" +
                    "<input type='file' name='ticketfiles[]'>" +
                    "</div></div>"
            );
        });
    </script>


		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->