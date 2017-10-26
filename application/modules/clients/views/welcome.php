<section id="content"> <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <small><?=lang('welcome_back')?> , <?php echo User::displayName(User::get_id());?> </small>

            </ul>
            <?php
            $user = User::get_id();
            $cur = App::currencies(config_item('default_currency'));
            $user_company = User::profile_info($user)->company;

            if ($user_company > 0) {
              $client_expenses = Client::total_expenses($user_company);
              $client_paid = Client::amount_paid($user_company);

                $client_outstanding = Client::due_amount($user_company);

                $client_payments = Client::amount_paid($user_company);

                $client_payable = Client::payable($user_company);

                if ($client_payable > 0 && $client_payments > 0) {
                    $perc_paid = round(($client_payments/$client_payable) * 100,1);
                    $perc_paid = ($perc_paid > 100) ? '100' : $perc_paid;
                }else{
                    $perc_paid = 0;
                }


                $total_projects = App::counter('projects',array('client'=>$user_company));
                $complete_projects =App::counter('projects',array('client'=>$user_company,'progress >='=>'100'));
                if ($total_projects > 0) {
                    $perc_complete = round(($complete_projects/$total_projects) *100,1);
                    $perc_open = 100 - $perc_complete;
                }else{
                    $perc_complete = 0;
                    $perc_open = 0;
                }
                ?>

            <?php } else {

                $client_outstanding = $perc_paid = $client_payable = $total_projects = $perc_complete = 0;
                $perc_open = 0;
            }
            ?>

            <div class="m-b-md">

                <?php if($client_outstanding > 0){ ?>

                    <div class="alert alert-info hidden-print">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?=lang('amount_displayed_in_your_cur')?> &raquo; <?=$cur->code;?></strong>
                    </div>
                <?php } ?>



            </div>
            <section class="panel panel-default">
                <div class="row m-l-none m-r-none lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r bg-dark b-light">
                    <a class="clear" href="<?= base_url() ?>invoices">
                      <span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-warning"></i> <i class="fa fa-paper-plane fa-stack-1x text-white"></i>
                      </span>
                      <small class="text-muted text-uc"><?= lang('outstanding') ?> </small>
                      <span class="h4 block m-t-xs">
                        <?=Applib::format_currency($cur->code, $client_outstanding)?>

                      </span>
                      </a>
                    </div>

                    <div class="col-sm-6 col-md-3 padder-v b-r bg-dark b-light">
                      <a class="clear" href="<?= base_url() ?>expenses">
                        <span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-success"></i> <i class="fa fa-balance-scale fa-stack-1x text-white"></i>
                        </span>
                        <small class="text-muted text-uc"><?= lang('expenses') ?> </small>
                        <span class="h4 block m-t-xs">
                          <?=Applib::format_currency($cur->code, $client_expenses)?>

                        </span>
                        </a>
                      </div>


                      <div class="col-sm-6 col-md-3 padder-v b-r bg-dark b-light">
                        <a class="clear" href="<?= base_url() ?>payments">
                          <span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-dark"></i> <i class="fa fa-bank fa-stack-1x text-white"></i>
                          </span>
                          <small class="text-muted text-uc"><?= lang('paid_amount') ?> </small>
                          <span class="h4 block m-t-xs">
                            <?=Applib::format_currency($cur->code, $client_paid)?>

                          </span>
                          </a>
                        </div>


                        <div class="col-sm-6 col-md-3 padder-v b-r bg-dark b-light">
                          <a class="clear" href="<?= base_url() ?>tickets">
                            <span class="fa-stack fa-2x pull-left m-r-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i> <i class="fa fa-support fa-stack-1x text-white"></i>
                            </span>
                            <small class="text-muted text-uc"><?= lang('tickets') ?> </small>
                            <span class="h4 block m-t-xs">
                              <?=App::counter('tickets',array('reporter'=>$user,'status !='=>'closed'));?>

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
                                    <th class=""><?=lang('project_name')?> </th>
                                    <th class="hidden-xs"><?=lang('progress')?></th>
                                    <th class="col-currency"><?=lang('project_cost')?></th>
                                    <th class="col-options no-sort"></th>
                                </tr> </thead>
                                <tbody>

                                <?php foreach (Welcome::recent_projects($user_company) as $key => $project) { ?>
                                    <tr>
                                        <?php
                                        $project_cost = Project::sub_total($project->project_id);
                                        $progress = Project::get_progress($project->project_id);

                                        ?>
                                        <td><?=$project->project_title?> </td>
                                        <td class="hidden-xs">
                                            <?php $bg = ($progress >= 100) ? 'success' : 'danger'; ?>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-<?=$bg?>" data-toggle="tooltip" data-original-title="<?=$progress?>%" style="width: <?=$progress?>%">
                                                </div>
                                            </div>
                                        </td>

                                        <td class="col-currency"><?=Applib::format_currency($cur->code, $project_cost)?></td>

                                        <td>

                                            <a class="btn  btn-<?=config_item('theme_color')?> btn-xs" href="<?=base_url()?>projects/view/<?=$project->project_id?>">
                                                <i class="fa fa-folder-open-o text"></i> <?=lang('view')?>
                                            </a>

                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php if(count(Welcome::recent_projects($user_company)) <= 0){ ?>
                                    <tr>
                                        <td colspan="4"><?=lang('nothing_to_display')?></td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>

                        </div> <footer class="panel-footer bg-white no-padder">
                            <div class="row text-center no-gutter">
                                <div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block">
							<?php echo App::counter('bugs',array('reporter'=>$user))?>
							</span> <small class="text-muted m-b block"><?=lang('reported_bugs')?></small>
                                </div>

                                <div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block">
						<?php echo App::counter('projects',array('client'=>$user_company,'progress >='=>'100')); ?>
							</span> <small class="text-muted m-b block"><?=lang('complete_projects')?></small>
                                </div>

                                <div class="col-xs-3 b-r b-light">
							<span class="h4 font-bold m-t block">
							<?php echo App::counter('messages',array('user_to'=>$user,'status'=>'Unread'))?>
							</span> <small class="text-muted m-b block"><?=lang('unread_messages')?></small>
                                </div>

                                <?php
                                $ticketnumber = App::counter('tickets',array('reporter'=>$user, 'status !='=>'closed'));
                                ?>

                                <div class="col-xs-3">
							<span class="h4 font-bold m-t block">
							<?=$ticketnumber?>
							</span> <small class="text-muted m-b block"><?=lang('tickets')?></small>
                                </div>



                            </div> </footer>
                    </section>
                </div>
                <div class="col-lg-4"> <section class="panel panel-default">
                        <header class="panel-heading"><?=lang('payments')?> </header>
                        <div class="panel-body text-center"> <h4><small> <?=lang('paid_amount')?> : </small>
                                <?php echo Applib::format_currency($cur->code, Client::amount_paid($user_company)); ?></h4>
                            <small class="text-muted block">
                                <?=lang('outstanding')?> : <?=Applib::format_currency($cur->code, $client_outstanding)?>
                            </small>
                            <div class="inline">

                                <div class="easypiechart" data-percent="<?=$perc_paid?>" data-line-width="16" data-loop="false" data-size="188">

                                    <span class="h2 step"><?=$perc_paid?></span>%
                                    <div class="easypie-text"><?=lang('paid')?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer"><small><?=lang('invoice_amount')?>:
                                <strong><?=Applib::format_currency($cur->code, $client_payable)?></strong></small>
                        </div> </section>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <!-- Start Charts -->
                    <div class="row">
                        <div class="col-lg-6">
                            <section class="panel panel-default">
                                <header class="panel-heading"><?=lang('my_projects')?></header>
                                <div class="panel-body text-center">

                                    <h4><small></small><?=$total_projects?><small> <?=lang('projects')?></small></h4>
                                    <small class="text-muted block"><?=lang('complete_projects')?> - <strong><?=$perc_complete?>%</strong></small>
                                    <div class="sparkline inline" data-type="pie" data-height="150" data-slice-colors="['#99c7ce','#e1e1e1']">
                                        <?=$perc_complete?>,<?=$perc_open?></div>
                                    <div class="line pull-in"></div>
                                    <div class="text-xs">
                                        <i class="fa fa-circle text-info"></i> <?=lang('closed')?> - <?=$perc_complete?>%
                                        <i class="fa fa-circle text-muted"></i> <?=lang('open')?> - <?=$perc_open?>%
                                    </div>
                                </div>
                                <div class="panel-footer"><small><?=lang('projects_completion')?></small></div>
                            </section>
                        </div>
                        <!-- Start Tickets -->
                        <div class="col-lg-6">

                            <section class="panel panel-default">
                                <header class="panel-heading">
                                    <?=lang('recent_tickets')?>
                                </header>
                                <div class="panel-body">

                                    <div class="list-group bg-white">
                                        <?php
                                        $tickets = Ticket::by_where(array('reporter'=>$user)); // Get 7 tickets
                                        foreach ($tickets as $key => $ticket) {
                                            if($ticket->status == 'open'){ $badge = 'danger'; }elseif($ticket->status == 'closed'){ $badge = 'success'; }else{ $badge = 'dark'; }
                                            ?>
                                            <a href="<?=base_url()?>tickets/view/<?=$ticket->id?>" data-original-title="<?=$ticket->subject?>" data-toggle="tooltip" data-placement="top" title = "" class="list-group-item">
                                                <?=$ticket->ticket_code?> - <small class="text-muted"><?=lang('priority')?>: <?=$ticket->priority?> <span class="badge bg-<?=$badge?> pull-right"><?=$ticket->status?></span></small>
                                            </a>
                                        <?php  } ?>
                                    </div>

                                </div>

                            </section>
                        </div>
                        <!-- End Tickets -->
                    </div>

                </div>

                <!-- Recent activities -->
                <div class="col-md-4">
                    <section class="panel panel-default b-light">
                        <header class="panel-heading"><?= lang('recent_activities') ?></header>
                        <div class="panel-body">
                            <section class="comment-list block">
                                <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                    <?php foreach (Welcome::recent_activities($user) as $key => $activity) { ?>
                                        <article id="comment-id-1" class="comment-item small">
                                            <div class="pull-left thumb-sm">

                                                <img src="<?php echo User::avatar_url($activity->user); ?>" class="img-circle">

                                            </div>
                                            <section class="comment-body m-b-lg">
                                                <header class="b-b">
                                                    <strong>
                                                        <?php echo User::displayName($activity->user); ?></strong>
									<span class="text-muted text-xs">
							<?php echo Applib::time_elapsed_string(strtotime($activity->activity_date));?>
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
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
