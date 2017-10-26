<?php foreach ($messages as $key => $msg) { ?>
			<li class="list-group-item">
					<a class="thumb-xs pull-left m-r-sm">
					
						<img src="<?php echo User::avatar_url($msg->user_from); ?>" class="img-circle">
									</a>

						<small class="pull-right text-danger small">
						<?php echo Applib::time_elapsed_string(strtotime($msg->date_received)); ?>
							
							</small>
							<strong><?=ucfirst(User::displayName($msg->user_from));?></strong>
										<?php
										if($msg->user_from != User::get_id()){
										 if($msg->status == 'Unread'){ ?>
										 <span class="label label-sm bg-success text-uc"><?=lang('unread')?></span><?php } } ?>
										
										<span class="small text-muted">
										&raquo;
										<?=strip_tags($msg->message);?>
										</span> 
										<a href="<?=base_url()?>messages/restore/<?=$msg->msg_id?>" title="Restore"><i class="fa fa-retweet text-primary"></i></a>

										<a href="<?=base_url()?>messages/remove/<?=$msg->msg_id?>" title="Permanent Delete"><i class="fa fa-times text-danger"></i></a>
						</li>


			<?php } ?>

		<?php if(count($messages) == 0 ){ ?>
	<div class="small text-muted" style="margin-left:5px; padding:5px; margin-top:12px; border-left: 2px solid #16a085; "><?=lang('nothing_to_display')?></div>
	<?php } ?>