<section id="content">
	<section class="vbox">
		<section class="scrollable padder">
			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
				<small><?=lang('welcome_back')?> ,
				<?php echo User::displayName(User::get_id()); ?> </small>
			</ul>

			<?php
			$user_id = User::get_id();
			$depts = User::profile_info($user_id)->department;
			$belongs_to = json_decode($depts);
			$worked_hours = Project::staff_logged_time($user_id);
			?>

			<section class="panel panel-default">
				<div class="row m-l-none m-r-none">
					<div class="col-sm-6 col-md-3 padder-v b-r b-light">
						<a class="clear" href="<?= base_url() ?>projects">
							<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-warning"></i> <i class="fa fa-paper-plane fa-stack-1x text-white"></i>
							</span>
							<small class="text-muted text-uc"><?=lang('worked')?> </small>
							<span class="h4 block m-t-xs">
								<?=Applib::sec_to_hours($worked_hours)?>

							</span>
							</a>
						</div>

						<div class="col-sm-6 col-md-3 padder-v b-r b-light">
							<a class="clear" href="<?= base_url() ?>projects">
								<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-success"></i> <i class="fa fa-list fa-stack-1x text-white"></i>
								</span>
								<small class="text-muted text-uc"><?=lang('tasks')?> </small>
								<span class="h4 block m-t-xs">
									<?php
									$this->db->join('assign_tasks', 'assign_tasks.task_assigned = tasks.t_id');
									echo $this->db->where(array('assigned_user'=>$user_id,'task_progress <'=> 100))->get('tasks')->num_rows();
									?>
								</span>
								</a>
							</div>

							<div class="col-sm-6 col-md-3 padder-v b-r b-light">
								<a class="clear" href="<?= base_url() ?>tickets">
									<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-dark"></i> <i class="fa fa-ticket fa-stack-1x text-white"></i>
									</span>
									<small class="text-muted text-uc"><?=lang('tickets')?> </small>
									<span class="h4 block m-t-xs">
									<?php
									$this->db->where('status !=','closed');
									echo $this->db->where_in('department', $belongs_to)->get('tickets')->num_rows();
									?>
									</span>
									</a>
								</div>


					<div class="col-sm-6 col-md-3 padder-v b-r b-light">
								<a class="clear" href="<?= base_url() ?>projects">
									<span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i> <i class="fa fa-clock-o fa-stack-1x text-white"></i>
									</span>
									<small class="text-muted text-uc"><?=lang('this_week')?> </small>
									<span class="h4 block m-t-xs">
									<?php echo Project::staff_work('week',$user_id);?>
									</span>
									</a>
					</div>
				</div> </section>
				<div class="row">
					<div class="col-md-8">
						<section class="panel panel-default">
						<header class="panel-heading font-bold"> <?=lang('recent_projects')?></header>
						<div class="panel-body">

							<table class="table table-striped m-b-none text-sm">
								<thead>
									<tr>
                                    	<th class="col-md-6"><?=lang('project_name')?> </th>
										<th class="col-md-4"><?=lang('progress')?></th>
										<th class="col-options no-sort col-md-2"><?=lang('options')?></th>
									</tr> </thead>
									<tbody>

						<?php foreach (Welcome::recent_projects($user_id) as $key => $project) { ?>
										<tr>
						<?php $progress = Project::get_progress($project->project_id); ?>
         <td><a href="<?=base_url()?>projects/view/<?=$project->project_id?>"><?=$project->project_title?></a></td>
											<td>
												<?php $bg = ($progress >= 100) ? 'success' : 'danger'; ?>
							<div class="progress progress-xs progress-striped active">
							<div class="progress-bar progress-bar-<?=$bg?>" data-toggle="tooltip" data-original-title="<?=$progress?>%" style="width: <?=$progress?>%">
													</div>
							</div>
											</td>

											<td>
		<a class="btn  btn-<?=config_item('theme_color')?> btn-xs" href="<?=base_url()?>projects/view/<?=$project->project_id?>">
												<i class="fa fa-folder-open-o text"></i> <?=lang('view')?></a>
											</td>
										</tr>
										<?php } ?>

										<?php if(count(Welcome::recent_projects($user_id)) == 0) { ?>
										<tr>
											<td class="it"><?=lang('nothing_to_display')?></td><td></td><td></td>
										</tr>
										<?php } ?>


									</tbody>
								</table>
							</div> <footer class="panel-footer bg-white no-padder">
							<div class="row text-center no-gutter">
								<div class="col-xs-3 b-r b-light">
									<span class="h4 font-bold m-t block">
									<?=lang('today')?>
									</span> <small class="text-muted m-b block">
									<?php echo Project::staff_work('today',$user_id);?>
									</small>
								</div>
								<div class="col-xs-3 b-r b-light">
									<span class="h4 font-bold m-t block">
									<?=lang('this_week')?>
									</span> <small class="text-muted m-b block">
									<?php echo Project::staff_work('week',$user_id);?>
									</small>
								</div>
								<div class="col-xs-3 b-r b-light">
									<span class="h4 font-bold m-t block">
									<?=lang('this_month')?>
									</span> <small class="text-muted m-b block">
									<?php echo Project::staff_work('month',$user_id);?>
									</small>
								</div>
								<div class="col-xs-3">
									<span class="h4 font-bold m-t block">
									<?=lang('this_year')?>
									</span> <small class="text-muted m-b block">
									<?php echo Project::staff_work('year',$user_id);?>
									</small>
								</div>
							</div> </footer>
						</section>
					</div>

					<div class="col-lg-4">
						<section class="panel panel-default">
                                <header class="panel-heading">
                                    <?=lang('recent_tickets')?>
                                </header>
                                <div class="panel-body">
                                <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
								
								<div class="list-group bg-white">

						<?php
							$this->db->order_by('id','desc')->where('status !=','closed');
							$tickets = $this->db->where_in('department', $belongs_to)->get('tickets')->result();
							$this->load->helper('text');
                                        foreach ($tickets as $key => $ticket) {
                                            if($ticket->status == 'open'){ $badge = 'danger'; }elseif($ticket->status == 'closed'){ $badge = 'success'; }else{ $badge = 'dark'; }
                                            ?>
                                            <a href="<?=base_url()?>tickets/view/<?=$ticket->id?>" data-original-title="<?=$ticket->subject?>" data-toggle="tooltip" data-placement="top" title = "" class="list-group-item">
                                            <small class="text-muted"><?=word_limiter($ticket->subject,5)?></small>
                                            </a>
                                        <?php  } ?>
                                    </div>

                            </section>

							</div>
							
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<section class="panel panel-default b-light">
						<header class="panel-heading"><?=lang('recent_tasks')?></header>
						<div class="panel-body">


							<div class="list-group bg-white">
		<?php foreach (Welcome::recent_tasks($user_id) as $key => $task) { ?>
		<div class="list-group-item">

		<?php if(Project::is_assigned($user_id, $task->project)) {  ?>

                        <!-- mark as complete checkbox -->
                        <span class="task_complete">

                        <input type="checkbox" data-id="<?=$task->t_id?>"
                        <?php if($task->task_progress == '100') {
                          echo 'checked="checked"'; } ?>
                          <?php if($task->timer_status == 'On') { echo 'disabled="disabled"'; } ?>>


                        </span>
        <?php }  ?>


								<a href="<?=base_url()?>projects/view/<?=$task->project?>?group=tasks&view=task&id=<?=$task->t_id?>"> <?=$task->task_name?> - <small class="text-muted">
								<?=Project::by_id($task->project)->project_title; ?></small>
								</a>
								</div>
		<?php } ?>
							</div>
						</div>
					</section>
				</div>



				<!-- Recent activities -->
				<div class="col-md-4">
			<section class="panel panel-default b-light">
			<header class="panel-heading"><?= lang('recent_activities') ?></header>
			<div class="panel-body">
				<section class="comment-list block">
					<section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

				<?php foreach (Welcome::recent_activities($user_id) as $key => $activity) { ?>

						<article id="comment-id-1" class="comment-item small">
							<div class="pull-left thumb-sm">

								<img src="<?=User::avatar_url($activity->user); ?>" class="img-circle">

							</div>
							<section class="comment-body m-b-lg">
								<header class="b-b">
									<strong>
									<?php echo User::displayName($activity->user); ?></strong>
									<span class="text-muted text-xs">
									<?php echo Applib::time_elapsed_string(strtotime($activity->activity_date)); ?>
									</span>
								</header>
								<div>
									<?php
									if (lang($activity->activity) != '') {
										if (!empty($activity->value1)) {
											if (!empty($activity->value2)) {
												echo sprintf(lang($activity->activity), '<em>' . $activity->value1 . '</em>', '<em>' . $activity->value2 . '</em>');
											} else {
												echo sprintf(lang($activity->activity), '<em>' . $activity->value1 . '</em>');
											}
										} else {
											echo lang($activity->activity);
										}
									} else {
										echo $activity->activity;
									}
									?>
								</div>
							</section>
						</article>
						<?php } ?>
					</section>
				</section>
			</div>
		</section>
	</div>
		</div>
	</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
