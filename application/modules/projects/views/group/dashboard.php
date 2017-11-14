<link rel="stylesheet" href="<?= base_url() ?>resource/css/tasks.css" type="text/css"/>

<div class="row">

    <div class="panel panel-body">


        <?php
        $all_tasks = App::counter('tasks', array('project' => $project_id));

        $done_tasks = App::counter('tasks', array('project' => $project_id, 'task_progress >=' => '100'));

        $in_progress = App::counter('tasks', array('project' => $project_id, 'task_progress <' => '100'));

        $perc_done = $perc_progress = 0;

        if ($all_tasks > 0) {
            $perc_done = ($done_tasks / $all_tasks) * 100;
            $perc_progress = ($in_progress / $all_tasks) * 100;
        }

        $progress = Project::get_progress($project_id);

        $project_hours = Project::total_hours($project_id);

        $project_cost = Project::sub_total($project_id);
        $info = Project::by_id($project_id);
        $currency = ($info->client > 0) ? Client::get_currency_code($info->client)->code : $info->currency;
        if ($info->client <= 0) {
            ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="fa fa-info-sign"></i>
                No Client attached to this project.
            </div>
        <?php
        } ?>

        <div>
            <strong><?= lang('progress') ?></strong>
            <div class="pull-right">
                <strong class="<?= ($progress < 100) ? 'text-danger' : 'text-success'; ?>"><?= $progress ?>
                    %</strong>
            </div>
        </div>


        <div class="progress-xxs mb-0 <?= ($progress != '100') ? 'progress-striped active' : ''; ?> inline-block progress">
            <div class="progress-bar progress-bar-<?= config_item('theme_color') ?> " data-toggle="tooltip"
                 data-original-title="<?= $progress ?>%" style="width: <?= $progress ?>%"></div>
        </div>


        <div class="row proj-summary-band">

            <?php if (User::is_admin()) : ?>

                <div class="col-md-3 text-center">
                    <label class="text-muted small"><?=lang('project_cost')?></label>
                    <h4 class="cursor-pointer text-open small"><?php echo ($info->fixed_rate == 'No') ? $info->hourly_rate.'/'.lang('hour') : lang('fixed_rate'); ?>
                    </h4>
                    <h4>
                        <?php echo Applib::format_currency($currency, $project_cost); ?>
                    </h4>
                </div>

                <div class="col-md-3 text-center">
                    <label class="small text-muted"><?= lang('billable_amount') ?></label>
                    <h4 class="cursor-pointer text-open small">+ <?php echo Applib::format_currency($currency, Project::total_expense($project_id))?> <?=lang('expenses')?></h4>
                    <h4><?=Applib::format_currency($currency, Project::total_expense($project_id) + $project_cost)?></h4>
                </div>

                <div class="col-md-3 text-center">
                    <label class="small text-muted"><?=lang('billable')?></label>
                    <h4 class="cursor-pointer text-success small"><?=Applib::gm_sec($project_hours * 3600)?></h4>
                    <h4><?=$project_hours?> <?=lang('hours')?></h4>
                </div>

                <div class="col-md-3 text-center">
                    <label class="small text-muted text-danger"><?=lang('unbillable')?></label>
                    <h4 class="cursor-pointer text-danger small"><?=Applib::gm_sec(Project::unbillable($project_id) * 3600)?></h4>
                    <h4><?php echo Project::unbillable($project_id); ?> <?=lang('hours')?></h4>
                </div>

            <?php elseif (User::is_staff()): ?>



            <div class="col-md-4 text-center">
                    <label class="text-muted small"><?=lang('complete_tasks')?></label>
                    <h4 class="cursor-pointer text-open small">
                    <?php
                    $all_tasks = Project::user_tasks(User::get_id());
                    $complete = $total_tasks = 0;
                    foreach ($all_tasks as $key => $v) :
                        if ($v->task_progress == '100' && $v->project == $project_id) :
                          $complete += 1;
                        endif;

                        if ($v->project == $project_id) :
                          $total_tasks += 1;
                        endif;
                    endforeach; ?>

                    <?php echo $complete.'/'.$total_tasks; ?>
                    </h4>
                    <label class="label label-success">
                      <?php echo ($total_tasks > 0) ? ($complete / $total_tasks) * 100 : '0'; ?>% <?=lang('done')?>
                    </label>
                </div>

                <div class="col-md-4 text-center">
                    <label class="small text-muted"><?= lang('billable') ?></label>
                    <h4 class="cursor-pointer text-open small">
                      <?php echo Applib::gm_sec(Project::staff_logged_time(User::get_id(), 1)); ?>
                    </h4>
                    <h4 class="small">
                      <?php echo Applib::sec_to_hours(Project::staff_logged_time(User::get_id(), 1)); ?>
                    </h4>
                </div>

                <div class="col-md-4 text-center">
                    <label class="small text-muted"><?=lang('unbillable')?></label>
                    <h4 class="cursor-pointer text-success small">
                        <?php
                        $spent = Project::time_by_user(User::get_id(), 0, $project_id);
                        $total = $spent->tasks_time + $spent->projects_time;
                        ?>
                      <?php echo Applib::gm_sec($total); ?>
                    </h4>
                    <h4 class="small">
                      <?php echo Applib::sec_to_hours($total); ?>
                    </h4>
                </div>

            <?php else: ?>

                <div class="col-md-3 text-center">
                    <label class="text-muted small"><?=lang('project_cost')?></label>
                    <h4 class="cursor-pointer text-open small"><?php echo ($info->fixed_rate == 'No') ? $info->hourly_rate.'/'.lang('hour') : lang('fixed_rate'); ?>
                    </h4>
                    <h4>
                        <?php echo Applib::format_currency($currency, $project_cost); ?>
                    </h4>
                </div>

                <div class="col-md-3 text-center">
                    <label class="small text-muted"><?= lang('billable_amount') ?></label>
                    <h4 class="cursor-pointer text-open small">+ <?php echo Applib::format_currency($currency, Project::total_expense($project_id))?> <?=lang('expenses')?></h4>
                    <h4><?=Applib::format_currency($currency, Project::total_expense($project_id) + $project_cost)?></h4>
                </div>

                <div class="col-md-3 text-center">
                    <label class="small text-muted"><?=lang('billable')?></label>
                    <h4 class="cursor-pointer text-success small"><?=Applib::gm_sec($project_hours * 3600)?></h4>
                    <h4><?=$project_hours?> <?=lang('hours')?></h4>
                </div>

                <div class="col-md-3 text-center">
                    <label class="small text-muted text-danger"><?=lang('unbillable')?></label>
                    <h4 class="cursor-pointer text-danger small"><?=Applib::gm_sec(Project::unbillable($project_id) * 3600)?></h4>
                    <h4><?php echo Project::unbillable($project_id); ?> <?=lang('hours')?></h4>
                </div>


            <?php endif; ?>









        </div>



        <div class="row" style="margin-top:10px;">
            <div class="col-lg-6">

                <section class="panel panel-default">
                    <header class="panel-heading"><?= lang('overview') ?></header>



                    <ul class="list-group no-radius">





                        <li class="list-group-item">

              <span class="pull-right text">
              <?= $info->project_title ?>
              </span>
                            <span class="text-muted"><?= lang('project_name') ?></span>


                        </li>
                        <?php if (User::is_admin() || User::is_client() ||
                            User::perm_allowed(User::get_id(), 'view_project_clients')
                        ) {
                            ?>

                            <?php if ($info->client > 0) {
                                ?>
                                <li class="list-group-item">


              <span class="pull-right">
              <a href="<?= site_url() ?>companies/view/<?= $info->client ?>">
                  <?php echo Client::view_by_id($info->client)->company_name; ?>
              </a>
               </span>
                                    <span class="text-muted">Company</span>

                                </li>
                            <?php
                            } ?>
                        <?php
                        } ?>


                        <li class="list-group-item">


              <span class="pull-right">
              <?= (strtotime($info->start_date) == 0 ? '' : strftime(config_item('date_format'), strtotime($info->start_date))) ?>
              </span>
                            <span class="text-muted"><?= lang('start_date') ?></span>

                        </li>


                        <li class="list-group-item">
                            <span class="pull-right">
                <?php if (valid_date($info->due_date)) {
                            ?>

                    <?= strftime(config_item('date_format'), strtotime($info->due_date)) ?>
                    <?php if (time() > strtotime($info->due_date) and $progress < 100) {
                                ?>
                        <span class="badge bg-danger"><?= lang('overdue') ?></span>
                    <?php
                            } ?>
                <?php
                        } else {
                            echo lang('ongoing');
                        } ?>
              </span>
                            <span class="text-muted"><?= lang('due_date') ?></span>
                        </li>

                        <?php if (User::is_admin() || User::is_staff() || Project::setting('show_team_members', $project_id)) {
                            ?>

                            <li class="list-group-item">
                <span class="pull-right">
                <small class="small">
                    <a class="thumb-xs pull-left m-r-sm">
                        <?php foreach (Project::project_team($project_id) as $user) {
                                ?>

                            <img src="<?php echo User::avatar_url($user->assigned_user); ?>" class="img-circle"
                                 data-toggle="tooltip" data-title="<?= User::displayName($user->assigned_user) ?>"
                                 data-placement="left">

                        <?php
                            } ?>
                    </a>


                </small>
                </span>
                                <span class="text-muted"><?= lang('team_members') ?></span>
                            </li>
                        <?php
                        } ?>

                        <?php if (User::is_admin() || User::is_client() || User::perm_allowed(User::get_id(), 'view_project_cost')) {
                            ?>
                            <li class="list-group-item">
                <span class="pull-right">
                <strong><?= $info->estimate_hours; ?> </strong><small><?= lang('hours') ?></small>

                </span>
                                <span class="text-muted"><?= lang('estimated_hours') ?></span>
                            </li>
                        <?php
                        } ?>





                        <?php if (User::is_admin() || User::is_client() || User::perm_allowed(User::get_id(), 'view_project_cost')) {
                            ?>
                            <li class="list-group-item">
                <span class="pull-right">
      <?php
      $used_budget = null;
                            if ($info->estimate_hours > 0) {
                                $used_budget = round(($project_hours / $info->estimate_hours) * 100, 2);
                            } ?>
                    <strong class="<?= ($used_budget > 100) ? 'text-danger' : 'text-success'; ?>">
                        <?= ($used_budget != null) ? $used_budget.' %' : 'N/A'; ?>
                    </strong>

                </span>
                                <span class="text-muted"><?= lang('used_budget') ?></span>
                            </li>
                        <?php
                        } ?>


                        <?php if (User::is_admin() || User::is_client() || User::perm_allowed(User::get_id(), 'view_project_expenses')) {
                            ?>

                <li class="list-group-item">
                    <span class="text-muted">Project Budget</span>
                    <span class="pull-right">
                        <strong><?=$info->budget ? 'R'.$info->budget: 'N/A' ?></strong>
                    </span>
                </li>

                <?php 
                    $user = User::profile_info($info->created_by);
                     
                ?>
                <li class="list-group-item">
                    <span class="text-muted">Created By</span>
                    <span class="pull-right">
                        <strong><?=$user->fullname?></strong>
                    </span>
                </li>
                            <li class="list-group-item">
                <span class="pull-right">

                <strong>
                    <?php echo Applib::format_currency($currency, Project::total_expense($project_id)) ?></strong>

                    <?php if (User::is_admin() || User::perm_allowed(User::get_id(), 'add_expenses')) {
                                ?>

                        <a href="<?= site_url() ?>expenses/create/?project=<?= $project_id ?>" data-toggle="ajaxModal"
                           title="<?= lang('create_expense') ?>"
                           class="btn btn-xs btn-<?= config_item('theme_color') ?>">
                            <i class="fa fa-plus"></i></a>
                    <?php
                            } ?>
                            
                    <a href="<?= site_url() ?>expenses/?project=<?= $project_id ?>" data-toggle="tooltip"
                       title="<?= lang('view_expenses') ?>" data-placement="left"
                       class="btn btn-xs btn-<?= config_item('theme_color') ?>"><i class="fa fa-ellipsis-h"></i></a>

                </span>
                                <span class="text-muted"><?= lang('expenses') ?></span>
                            </li>
                        <?php
                        } ?>









                    </ul>

                </section>

            </div>
            <!-- End details C1-->


            <div class="col-lg-6">

                <section class="panel panel-default">
                    <header class="panel-heading"><?= lang('activities') ?></header>

                    <section class="slim-scroll" data-height="340" data-disable-fade-out="true"
                             data-distance="0" data-size="5px" data-color="#333333">

                        <div id="activity">
                            <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                <?php $activities = Project::activity($project_id);
                                foreach ($activities as $key => $a) {
                                    $module = strtolower($a->module); ?>
                                    <li class="list-group-item">
                                        <a class="thumb-sm pull-left m-r-sm">

                                            <img src="<?php echo User::avatar_url($a->user); ?>" class="img-rounded"
                                                 style="border-radius: 6px;">

                                        </a>


                                        <small class="pull-right"><?= strftime(config_item('date_format').' %H:%M:%S', strtotime($a->activity_date)) ?></small>
                                        <strong class="block"><?php echo User::displayName($a->user); ?></strong>
                                        <span
                                            class="label label-<?= module_color($module) ?>"><?= lang($module) ?></span>
                                        <small>
                                            <?php
                                            if (lang($a->activity) != '') {
                                                if (!empty($a->value1)) {
                                                    if (!empty($a->value2)) {
                                                        echo sprintf(lang($a->activity), '<em>'.$a->value1.'</em>', '<em>'.$a->value2.'</em>');
                                                    } else {
                                                        echo sprintf(lang($a->activity), '<em>'.$a->value1.'</em>');
                                                    }
                                                } else {
                                                    echo lang($a->activity);
                                                }
                                            } else {
                                                echo $a->activity;
                                            } ?>
                                        </small>
                                    </li>
                                <?php
                                } ?>
                            </ul>
                        </div>

                    </section>

                </section>

            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>

        <div class="small text-muted panel-body m-sm"
             style="border-left: 2px solid #e8e8e8;"><?= nl2br_except_pre($info->description) ?></div>


        <div class="row">

            <!-- start recent tasks -->

            <?php if (User::is_admin() || User::is_staff() || Project::setting('show_project_tasks', $project_id)) {
                                    ?>

                <div class="col-sm-6">
                    <section class="panel panel-default tasks-widget">
                        <header class="panel-heading"><?= lang('my_tasks') ?></header>

                        <section class="panel-body">

                            <section class="slim-scroll" data-height="400" data-disable-fade-out="true"
                                     data-distance="0" data-size="5px" data-color="#333333">

                                <?php $tasks = Project::has_tasks($project_id);
                                    if (count($tasks) > 0) {
                                        ?>
                                    <div class="task-content small">
                                        <ul id="sortable" class="task-list ui-sortable">


                                            <?php foreach ($tasks as $key => $t) {
                                            ?>

                                                <?php $color = 'danger'; ?>
                                                <?php if ($t->task_progress >= '50') {
                                                $color = 'warning';
                                            } ?>
                                                <?php if ($t->task_progress == '100') {
                                                $color = 'primary';
                                            } ?>

                                                <li class="task-view list-<?php echo $color; ?> <?php if ($t->task_progress >= 100) {
                                                echo 'task-done';
                                            } ?>">

                                                    <?php if (!User::is_client()) {
                                                if (Project::is_task_team($t->t_id) || $t->assigned_to == null || User::is_admin()) {
                                                    ?>
                                                            <div class="task-checkbox">
                                    <span class="task_complete">

                                    <label class="checkbox-custom">
                                        <input type="checkbox" class="list-child" data-id="<?=$t->t_id?>"
                                            <?php echo ($t->task_progress == '100') ? 'checked="checked"' : ''; ?>
                                            <?php echo (Project::timer_status('tasks', $t->t_id) == 'On') ? 'disabled="disabled"' : ''; ?>>
                                        <i class="fa fa-fw fa-square-o <?=($t->task_progress == '100') ? 'checked' : ''; ?> <?=(Project::timer_status('tasks', $t->t_id) == 'On') ? 'disabled' : ''; ?>"></i>
                                    </label>

                                    </span>
                                                            </div>
                                                        <?php
                                                } ?>
                                                    <?php
                                            } ?>
                                                    <div class="task-title">
                                                                <span class="task-title-sp" data-toggle="tooltip"
                                                                      data-original-title="<?= $t->task_progress ?>% <?= lang('done') ?>"
                                                                      data-placement="right"><?= $t->task_name ?></span>
                                                        <div class="pull-right hidden-phone">
                                                            <a href="<?= base_url() ?>projects/view/<?= $t->project ?>?group=tasks&view=task&id=<?= $t->t_id ?>">
                                                                <i class="fa fa-paper-plane text-info fa-lg icon-view"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>

                                            <?php
                                        } ?>

                                        </ul>
                                    </div>

                                <?php
                                    } else {
                                        ?>
                                    <div class="small text-muted"
                                         style="margin-left:5px; padding:5px; margin-top:12px; border-left: 2px solid #16a085; "><?= lang('no_task_in_project') ?></div>
                                <?php
                                    } ?>


                            </section>

                        </section>

                    </section>
                </div>
            <?php
                                } ?>

            <!-- End Recent Task -->


            <!-- Start Project Checklist -->

            <div class="col-lg-6">
                <section class="panel panel-default tasks-widget">
                    <header class="panel-heading"><?= lang('todo_list') ?>
                        <span class="pull-right"><a href="<?= base_url() ?>projects/todo/add/<?= $project_id ?>"
                                                    data-toggle="ajaxModal"
                                                    class="btn btn-success btn-xs"><?= lang('create_list') ?></a></span>
                    </header>
                    <section class="panel-body">
                        <section class="slim-scroll" data-height="400" data-disable-fade-out="true"
                                 data-distance="0" data-size="5px" data-color="#333333">


                            <div class="task-content small">
                                <ul id="sortable" class="task-list ui-sortable">

                                    <?php $todo = $this->db->where(array('project' => $project_id))->get('todo')->result(); ?>
                                    <?php foreach ($todo as $key => &$list) {
                                    if ($list->saved_by == User::get_id() || $list->visible == 'Yes') {
                                        unset($todo[$key]); ?>
                                            <li class="todo-view list-<?= ($list->status == 'done') ? 'primary task-done' : 'danger'; ?>">
                                                <div class="task-checkbox">
                  <span class="todo_complete">

                  <label class="checkbox-custom">
                      <input type="checkbox" class="list-child" data-id="<?=$list->id?>"
                          <?php echo ($list->status == 'done') ? 'checked="checked"' : ''; ?>
                          <?php echo ($list->saved_by != User::get_id()) ? 'disabled="disabled"' : ''; ?>>
                      <i class="fa fa-fw fa-square-o <?=($list->status == 'done') ? 'checked' : ''; ?>
                                <?=($list->saved_by != User::get_id()) ? 'disabled' : ''; ?>"></i>
                  </label>


                      </span>
                                                </div>

                                                <div class="task-title">
                                                    <span class="task-title-sp"><?= $list->list_name ?></span>
                                                    <div class="pull-right hidden-phone">
                                                        <?php if ($list->saved_by == User::get_id()) {
                                            ?>
                                                            <a href="<?=base_url()?>projects/todo/edit/<?= $list->id ?>"
                                                               data-toggle="ajaxModal"
                                                               class="icon-edit"><i class="fa fa-pencil text-muted fa-lg"></i>

                                                            </a>
                                                            <a href="<?=base_url()?>projects/todo/delete/<?= $list->id ?>" data-toggle="ajaxModal"
                                                               class="icon-remove"><i class="fa fa-times text-danger fa-lg"></i>

                                                            </a>
                                                        <?php
                                        } ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                    } ?>
                                    <?php
                                } ?>

                                </ul>
                            </div>

                        </section>

                    </section>
                </section>
            </div>

            <!-- END TODO -->


        </div>


        <!-- END ROW -->


        <div class="row">


            <!-- start recent files -->

            <?php if (User::is_admin() || User::is_staff() || Project::setting('show_project_files', $project_id)) {
                                    ?>
                <div class="col-sm-6">
                    <section class="panel panel-default">
                        <header class="panel-heading"><?= lang('recent_files') ?></header>

                        <section class="slim-scroll" data-height="400" data-disable-fade-out="true"
                                 data-distance="0" data-size="5px" data-color="#333333">

                            <table class="table table-striped m-b-none">
                                <thead>
                                <tr>
                                    <th><?= lang('file_name') ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $files = Project::has_files($project_id);
                                    if (count($files) > 0) {
                                        foreach ($files as $key => $f) {
                                            $icon = $this->applib->file_icon($f->ext);
                                            $path = $f->path;
                                            $file_path = ($path != null)
                                            ? base_url().'resource/project-files/'.$path.$f->file_name
                                            : base_url().'resource/project-files/'.$f->file_name;
                                            $real_url = $file_path; ?>
                                        <tr>
                                            <td>
                                                <?php if ($f->is_image == 1) : ?>
                                                    <?php if ($f->image_width > $f->image_height) {
                                                $ratio = round(((($f->image_width - $f->image_height) / 2) / $f->image_width) * 100);
                                                $style = 'height:100%; margin-left: -'.$ratio.'%';
                                            } else {
                                                $ratio = round(((($f->image_height - $f->image_width) / 2) / $f->image_height) * 100);
                                                $style = 'width:100%; margin-top: -'.$ratio.'%';
                                            } ?>
                                                    <div class="file-icon icon-small"><a
                                                            href="<?= base_url() ?>projects/files/preview/<?= $f->file_id ?>/<?= $project_id ?>"
                                                            data-toggle="ajaxModal"><img style="<?= $style ?>"
                                                                                         src="<?= $real_url ?>"/></a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="file-icon icon-small"><i
                                                            class="fa <?= $icon ?> fa-lg"></i></div>
                                                <?php endif; ?>


                                                <a href="<?= base_url() ?>projects/files/download/<?= $f->file_id ?>"
                                                   data-original-title="<?= $f->description ?>"
                                                   data-toggle="tooltip" data-placement="top" title="">
                                                    <?php
                                                    if (empty($f->title)) {
                                                        echo $this->applib->short_string($f->file_name, 10, 8, 22);
                                                    } else {
                                                        echo $this->applib->short_string($f->title, 20, 0, 22);
                                                    } ?>

                                                </a></td>


                                            <td class="small">
                                                <?php echo User::displayName($f->uploaded_by); ?>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        ?>
                                    <div class="small text-muted"
                                         style="margin-left:5px; padding:5px; margin-top:12px; border-left: 2px solid #16a085; "><?= lang('no_file_in_project') ?></div>
                                <?php
                                    } ?>
                                </tbody>
                            </table>

                        </section>


                    </section>
                </div>
            <?php
                                } ?>

            <!-- END FILES -->


            <?php if (User::is_admin() || User::is_staff() || Project::setting('show_project_bugs', $project_id)) {
                                    ?>
                <div class="col-sm-6">
                    <section class="panel panel-default">
                        <header class="panel-heading"><?= lang('recent_bugs') ?></header>
                        <section class="slim-scroll" data-height="400" data-disable-fade-out="true"
                                 data-distance="0" data-size="5px" data-color="#333333">
                            <table class="table table-striped m-b-none">
                                <thead>
                                <tr>
                                    <th><?= lang('action') ?></th>
                                    <th><?= lang('reporter') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $bugs = Project::has_bugs($project_id);
                                    if (count($bugs) > 0) {
                                        foreach ($bugs as $key => $b) {
                                            ?>
                                        <tr>
                                            <td>
                                                <a class="btn btn-xs btn-<?= config_item('theme_color') ?>"
                                                   href="<?= base_url() ?>projects/view/<?= $project_id ?>/?group=bugs&view=bug&id=<?= $b->bug_id ?>"><?= lang('preview') ?></a>
                                            </td>
                                            <td class="small"><?php echo User::displayName($b->reporter); ?></td>
                                        </tr>

                                    <?php
                                        }
                                    } else {
                                        ?>
                                    <span class="small text-muted"
                                          style="margin-left:5px; padding:5px; margin-top:12px; border-left: 2px solid #16a085; "><?= lang('no_bug_in_project') ?></span>
                                <?php
                                    } ?>
                                </tbody>
                            </table>

                        </section>

                    </section>
                </div>
            <?php
                                } ?>
            <!-- END FILES -->
        </div>





    </div>
    <!-- End ROW 1 -->
