<section id="content">
	<section class="hbox stretch">



		<aside class="aside-md bg-white b-r" id="subNav">

			<header class="dk header b-b">
<?php if(User::can_add_estimate()) { ?>
		<a href="<?=base_url()?>estimates/add" data-original-title="<?=lang('create_estimate')?>" data-toggle="tooltip" data-placement="top" class="btn btn-icon btn-<?=config_item('theme_color');?> btn-sm pull-right"><i class="fa fa-plus"></i></a>
<?php } ?>
		<p class="h4"><?=lang('all_estimates')?></p>
		</header>


			<section class="vbox">
			 <section class="scrollable w-f">
			   <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

			   <?=$this->load->view('sidebar/estimates',$estimates)?>

			</div>
			</section>
			</section>
			</aside>

			<aside>
			<section class="vbox">
				<header class="header bg-white b-b clearfix">
					<div class="row m-t-sm">
						<div class="col-sm-8 m-b-xs">


						</div>
						<div class="col-sm-4 m-b-xs">

						</div>
					</div> </header>
					<section class="scrollable wrapper">



					<!-- Start create estimate -->
<div class="col-sm-12">
	<section class="panel panel-default">
	<header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('estimate_details')?></header>
	<div class="panel-body">

<?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'estimates/add',$attributes); ?>

          		<div class="form-group">
				<label class="col-lg-2 control-label"><?=lang('reference_no')?> <span class="text-danger">*</span></label>
				<div class="col-lg-5">
				<?php $this->load->helper('string'); ?>
					<input type="text" class="form-control" value="<?=config_item('estimate_prefix')?><?=Estimate::generate_estimate_number();?>" name="reference_no">
				</div>
				</div>


				<div class="form-group">
				<label class="col-lg-2 control-label"><?=lang('client')?> <span class="text-danger">*</span> </label>
				<div class="col-lg-5">
					<select class="select2-option" style="width:260px" name="client" >
					<optgroup label="<?=lang('clients')?>">
					<?php foreach (Client::get_all_clients() as $client): ?>
					<option value="<?=$client->co_id?>"><?=ucfirst($client->company_name)?></option>
					<?php endforeach; ?>
					</optgroup>
					</select>
				</div>
				<?php if(User::is_admin()) : ?>
				<a href="<?=base_url()?>companies/create" class="btn btn-<?=config_item('theme_color');?> btn-sm" data-toggle="ajaxModal" title="<?=lang('new_company')?>" data-placement="bottom"><i class="fa fa-plus"></i> <?=lang('new_client')?></a>
			<?php endif; ?>

			</div>

				<div class="form-group">
				<label class="col-lg-2 control-label"><?=lang('due_date')?></label>
				<div class="col-lg-4">
				<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), time());?>" name="due_date" data-date-format="<?=config_item('date_picker_format');?>" >
				</div>
				</div>

				<div class="form-group">
                                <label class="col-lg-2 control-label"><?=lang('tax')?> 1</label>
                                <div class="col-lg-4">
				<div class="input-group">
					<span class="input-group-addon">%</span>
				<input class="form-control money" type="text" value="<?=config_item('default_tax')?>" name="tax">
				</div>
                                </div>
                                </div>
                <div class="form-group">
                                <label class="col-lg-2 control-label"><?=lang('tax')?> 2</label>
                                <div class="col-lg-4">
				<div class="input-group">
					<span class="input-group-addon">%</span>
				<input class="form-control money" type="text" value="<?=config_item('default_tax2')?>" name="tax2">
				</div>
                                </div>
                </div>

				<div class="form-group">
                                <label class="col-lg-2 control-label"><?=lang('discount')?></label>
                                <div class="col-lg-4">
				<div class="input-group">
					<span class="input-group-addon">%</span>
					<input class="form-control money" type="text" value="0.00" name="discount">
				</div>
                                </div>
                                </div>

				<div class="form-group">
				<label class="col-lg-2 control-label"><?=lang('notes')?> </label>
				<div class="col-lg-10">
				<textarea name="notes" class="form-control foeditor"><?=config_item('estimate_terms')?></textarea>
				</div>
				</div>
				<button type="submit" class="btn btn-sm btn-<?=config_item('theme_color');?>"><i class="fa fa-plus"></i> <?=lang('create_estimate')?></button>



		</form>
</div>
</section>
</div>


<!-- End create estimate -->






					</section>




		</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->
