<!-- Start -->
<section id="content">
	<section class="hbox stretch">
		
		<aside class="aside-md bg-white b-r hidden-print" id="subNav">
			<header class="dk header b-b">
			<?php 	$est = Estimate::view_estimate($id);
               		if(User::can_add_estimate()) { ?>
				<a href="<?=base_url()?>estimates/add" data-original-title="<?=lang('create_estimate')?>" data-toggle="tooltip" data-placement="top" class="btn btn-icon btn-default btn-sm pull-right"><i class="fa fa-plus"></i></a>
				<?php } ?>

				<p class="h4"><?=lang('all_estimates')?></p>
			</header>
			<section class="vbox">
				<section class="scrollable w-f">
					<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
						 <?=$this->load->view('sidebar/estimates',$estimates)?>
					</div></section>
				</section>
			</aside>
			
			<aside>
				<section class="vbox">
					<header class="header bg-white b-b clearfix hidden-print">
						<div class="row m-t-sm">
							<div class="col-sm-8 m-b-xs">
								
						<div class="btn-group">
						<a href="<?=base_url()?>estimates/view/<?=$est->est_id?>" data-original-title="<?=lang('view_details')?>" data-toggle="tooltip" data-placement="top" class="btn btn-<?=config_item('theme_color');?> btn-sm"><i class="fa fa-info-circle"></i> <?=lang('estimate_details')?></a>
						</div>
						
								
							</div>
							<div class="col-sm-4 m-b-xs">
								<a href="<?=base_url()?>fopdf/estimate/<?=$est->est_id?>" class="btn btn-sm btn-dark pull-right"><i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a> 
								
							</div>
						</div> </header>
						
						<section class="scrollable wrapper w-f">
							<!-- Start create invoice -->
							<div class="col-sm-12">
								<section class="panel panel-default">
									
								<header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('estimate_details')?> - <?=$est->reference_no?></header>
								<div class="panel-body">
									
									<?php
									$attributes = array('class' => 'bs-example form-horizontal');
									echo form_open_multipart(base_url().'estimates/edit',$attributes); ?>
									<input type="hidden" name="est_id" value="<?=$est->est_id?>">
									
									<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('reference_no')?> <span class="text-danger">*</span></label>
										<div class="col-lg-3">
											<input type="text" class="form-control" value="<?=$est->reference_no?>" name="reference_no" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('client')?> <span class="text-danger">*</span> </label>
										<div class="col-lg-6">
                                <select class="select2-option" style="width:260px" name="client" >
                                    <?php if ($est->client > 0) { ?>
                                            <option value="<?=$est->client?>">
                                            <?=ucfirst(Client::view_by_id($est->client)->company_name)?>
                                            </option>
                                    <?php } ?>
                                <optgroup label="<?=lang('clients')?>">

                                    <?php foreach (Client::get_all_clients() as $client): ?>
                                        <option value="<?=$client->co_id?>"><?=ucfirst($client->company_name)?>
                                        </option>
                                            <?php endforeach; ?>
                                </optgroup>

                                <optgroup label="<?=lang('general_estimate')?>">
                                            <option value="0"><?=lang('unregistered_clients')?></option>
                                </optgroup>

                                
                                </select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('created')?></label>
										<div class="col-lg-8">
							<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), strtotime($est->date_saved));?>" name="date_saved" data-date-format="<?=config_item('date_picker_format');?>" >
										</div>
									</div>


									<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('due_date')?></label>
										<div class="col-lg-8">
							<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), strtotime($est->due_date));?>" name="due_date" data-date-format="<?=config_item('date_picker_format');?>" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('tax')?> 1</label>
										<div class="col-lg-4">
											<div class="input-group">
												<span class="input-group-addon">%</span>
												<input class="form-control money" type="text" value="<?=$est->tax?>" name="tax">
											</div>
										</div>
									</div>

							<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('tax')?> 2</label>
										<div class="col-lg-4">
											<div class="input-group">
												<span class="input-group-addon">%</span>
												<input class="form-control money" type="text" value="<?=$est->tax2?>" name="tax">
											</div>
										</div>
							</div>

									<!-- Start discount fields -->
					
							<div class="form-group">
							<label class="col-lg-2 control-label"><?=lang('discount')?> </label>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">%</span>
									<input class="form-control money" type="text" value="<?=$est->discount?>" name="discount">
								</div>
							</div>
							</div>
					<!-- End discount Fields -->

										<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('currency')?> </label>
										<div class="col-lg-4">
											<div class="input-group">
											<select name="currency" class="form-control">
					<option value="<?=$est->currency?>"><?=lang('use_current')?> - <?=$est->currency?></option>
											<?php foreach (App::currencies() as $currency) { ?>
												<option value="<?=$currency->code?>"><?=$currency->name?></option>
											<?php } ?>
											</select>
											</div>
										</div>
									</div>

			
									
									<div class="form-group">
										<label class="col-lg-2 control-label"><?=lang('notes')?> </label>
										<div class="col-lg-10">
											<textarea name="notes" class="form-control foeditor"><?=$est->notes?></textarea>
										</div>
									</div>
									<button type="submit" class="btn btn-sm btn-<?=config_item('theme_color');?>"> <?=lang('save_changes')?></button>
									
								</form>
							</div>
						</section>
					</div>
					<!-- End create invoice -->
				</section>
				</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
				<!-- end -->