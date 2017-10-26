<section id="content">
	<section class="hbox stretch">
		
		<aside class="aside-md bg-white b-r hidden-print" id="subNav">
			<header class="dk header b-b">

			<?php if(User::is_admin() || User::perm_allowed(User::get_id(),'add_estimates')) { ?>
				<a href="<?=base_url()?>estimates/add" data-original-title="<?=lang('create_estimate')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-<?=config_item('theme_color');?> btn-sm pull-right"><i class="fa fa-plus"></i></a>
				<?php } ?>

				<p class="h4"><?=lang('all_estimates')?></p>
			</header>
			
			<section class="vbox">
				<section class="scrollable">
					<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

						<?=$this->load->view('sidebar/estimates',$estimates)?>
						
					</div></section>
				</section>
			</aside>
			
			<aside>
				<section class="vbox">
					<header class="header bg-white b-b clearfix hidden-print">
						<div class="row m-t-sm">
							<div class="col-sm-7 m-b-xs">

			<?php $e = Estimate::view_estimate($id); ?>
								
								
						<div class="btn-group">
						<a href="<?=base_url()?>estimates/view/<?=$e->est_id?>" data-original-title="<?=lang('view_details')?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-<?=config_item('theme_color');?> btn-sm"><i class="fa fa-info-circle"></i> <?=lang('estimate_details')?></a>
						</div>
								
								
							</div>
							<div class="col-sm-4 m-b-xs pull-right">
								 <?php if ($e->client != 0) { ?>
                                <?php if (config_item('pdf_engine') == 'invoicr') : ?>
                                <a href="<?=base_url()?>fopdf/estimate/<?=$e->est_id?>" class="btn btn-sm btn-dark pull-right"><i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a>
                                <?php elseif(config_item('pdf_engine') == 'mpdf') : ?>
                                <a href="<?=base_url()?>estimates/pdf/<?=$e->est_id?>" class="btn btn-sm btn-dark pull-right"><i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?></a>
                                <?php endif; ?>
                            <?php } ?>

							</div>
						</div> </header>
						
						
						
						<section class="scrollable">
							<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">






								<!-- Start Display Details -->
								

								<!-- Timeline START -->
								<section class="panel panel-default">
									<div class="panel-body">


					<div  id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
							<?php foreach ($activities as $key => $a) { ?>
                            <li class="list-group-item">

                       <a class="pull-left thumb-sm avatar">
							<img src="<?php echo User::avatar_url($a->user); ?>" class="img-rounded" style="border-radius: 6px;">
						</a> 
                              
                              <a href="#" class="clear">
                                <small class="pull-right">
                                <?=strftime("%b %d, %Y %H:%M:%S", strtotime($a->activity_date)) ?></small>
                                <strong class="block m-l-xs"><?=ucfirst(User::displayName($a->user)); ?></strong>
                                <small class="m-l-xs">
                                    <?php 
                                    if (lang($a->activity) != '') {
                                        if (!empty($a->value1)) {
                                            if (!empty($a->value2)){
                                                echo sprintf(lang($a->activity), '<em>'.$a->value1.'</em>', '<em>'.$a->value2.'</em>');
                                            } else {
                                                echo sprintf(lang($a->activity), '<em>'.$a->value1.'</em>');
                                            }
                                        } else { echo lang($a->activity); }
                                    } else { echo $a->activity; } 
                                    ?> 
                                </small>
                              </a>
                            </li>
                            <?php } ?>

                          </ul>
                        </div>
								



												
									</div>
								</section>
							</div>
						</section>
						<!-- End display details -->
						</section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
						<!-- end -->