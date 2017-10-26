<?php foreach ($messages as $key => $msg) { ?>
			<li class="list-group-item">
					<a class="thumb-xs pull-left m-r-sm">
					
						<img src="<?php echo User::avatar_url($msg->user_from); ?>" class="img-circle">
					</a>
						<a href="<?=base_url()?>messages/view/<?=$msg->user_from?>" class="clear">
						<small class="pull-right text-muted small">

						<?php echo Applib::time_elapsed_string(strtotime($msg->date_received)); ?>

							</small>
						<strong><?=ucfirst(User::displayName($msg->user_from));?></strong>
										<?php
										if($msg->user_from != User::get_id()){
										 if($msg->status == 'Unread'){ ?>
										 <span class="label label-sm bg-success text-uc"><?=lang('unread')?></span><?php } } ?>
										
										<span class="small text-muted">
										&raquo;
										<?php
										$longmsg = strip_tags($msg->message);
										$message = word_limiter($longmsg, 6);
										echo $message;
									?></span> 
						</a> 
						</li>

						<?php } ?>
		<?php if(count($messages) == 0 ){ ?>
	<div class="small text-muted" style="margin-left:5px; padding:5px; margin-top:12px; border-left: 2px solid #16a085; "><?=lang('nothing_to_display')?></div>
	<?php } ?>