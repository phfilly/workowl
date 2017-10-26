<?php 
$info = Project::by_id($project_id);
$cur = Client::client_currency($info->client);
?>

<section class="panel panel-default">
<header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                  <div class="col-sm-12 m-b-xs">
                  <?php if (!User::is_client() || Project::setting('client_add_tasks',$project_id)) : ?>
                  <a href="<?=base_url()?>projects/tasks/add/<?=$project_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('add_task')?></a> 
                  <?php endif; ?>

                  <?php  if(User::is_admin()){ ?>
                  <a href="<?=base_url()?>projects/tasks/add_from_template/<?=$project_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-dark"><?=lang('from_templates')?></a> 
                  <?php } ?>

                     

                    </div>
                  </div>
                </header>
                <?php echo $this->session->flashdata('form_error');?>
    <div class="table-responsive">
                  <table id="table-tasks" class="table table-striped b-t b-light AppendDataTables small">
                    <thead>
                      <tr>
                        
                        <th><?=lang('task_name')?></th>
                        <th><?=lang('time_spent')?></th>
                        <th class="col-date"><?=lang('due_date')?></th>
                        <th><?=lang('progress')?></th>
                        <th class="col-options no-sort"><?=lang('action')?></th>
                      </tr>
                    </thead>
                    <tbody>
    <?php if(!User::is_client()){ // get visible tasks
              $tasks = App::get_by_where('tasks',array('project'=>$project_id));
          }else{
              $tasks = App::get_by_where('tasks',array('project'=>$project_id,'visible'=>'Yes'));
          }
          foreach ($tasks as $key => $t) { 
            $timer = (Project::timer_status('tasks',$t->timer_status) == 'Off') ? 'success' : 'danger'; ?>
                      <tr>




      <td style="border-left: 2px solid <?php echo ($t->task_progress == '100') ? '#16a085' : '#e05d6f';?>;">

      <?php if(!User::is_client()) { 
        if(Project::is_task_team($t->t_id) || $t->assigned_to == NULL || User::is_admin()) { ?>

         

        <span class="task_complete">
                              <label class="checkbox-custom" style="margin-left:0px">
                                <input type="checkbox" data-id="<?=$t->t_id?>"
                        <?php echo ($t->task_progress == '100') ? 'checked="checked"' : ''; ?> 
                        <?php echo (Project::timer_status('tasks',$t->t_id) == 'On') ? 'disabled="disabled"' : ''; ?>>
                                <i class="fa fa-fw fa-square-o <?=($t->task_progress == '100') ? 'checked' : ''; ?> <?=(Project::timer_status('tasks',$t->t_id) == 'On') ? 'disabled' : '';?>"></i>
                              </label>
 
                        


                        </span>
                        <?php
                        $comments = App::counter('comments',array('task_id'=>$t->t_id));
                        $files = App::counter('task_files',array('task'=>$t->t_id));
                        ?>
                        <!-- mark as complete checkbox -->
                        <span class="small text-primary">
                        <?php if($files > 0) { ?>
                        [<i class="fa fa-paperclip"></i><?=$files;?>]
                        <?php } ?>
                        <?php if($comments > 0){ ?>
                        [<i class="fa fa-comments-o"></i><?=$comments;?>]
                        <?php } ?>
                        </span>

                        

      <?php } } ?>


                        <a class="text-info <?php if($t->task_progress == 100 ) { echo 'text-lt'; } ?>" data-toggle="tooltip" data-original-title="<?=$t->task_progress?>% <?=lang('done')?>" data-placement="right" href="<?=base_url()?>projects/view/<?=$t->project?>?group=tasks&view=task&id=<?=$t->t_id?>"><?=$t->task_name?></a> 

                        

                        </td>


                        <td class="small"> 
                         <strong>
                         <?=Applib::sec_to_hours(Project::task_timer($t->t_id))?>
                         </strong>
                        
                        </td>

                        <td><?=strftime(config_item('date_format'), strtotime($t->due_date))?></td>

                        <td>

                        

                      <div class="progress-xxs not-rounded mb-0 inline-block progress" style="width: 100%; margin-right: 5px">
                        <div class="progress-bar progress-bar-<?php echo ($t->task_progress >= 100 ) ? 'success' : 'greensea'; ?>" role="progressbar" aria-valuenow="<?=$t->task_progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$t->task_progress?>%;" data-toggle="tooltip" data-original-title="<?=$t->task_progress?>%"></div>
                      </div>

                       

                    </td>




                        <td>
  <?php  if(User::is_admin()){ ?>
     <a class="btn btn-xs btn-dark" href="<?=base_url()?>projects/tasks/timesheet/<?=$t->t_id?>" data-toggle="ajaxModal"><i class="fa fa-hourglass-half"></i></a>

      <a class="btn btn-xs btn-<?=($t->pinned == 0) ? 'default' : 'danger';?>" href="<?=base_url()?>projects/tasks/<?=($t->pinned == '0') ? 'pin' : 'unpin';?>/<?=$t->t_id?>" data-toggle="tooltip" data-original-title="<?=lang(($t->pinned == '0') ? 'pin_sidebar' : 'unpin_sidebar');?>" data-toggle="tooltip">
      <i class="fa fa-thumb-tack"></i>
      </a>
  <?php } ?>


  <?php if(!User::is_client() || $t->added_by == User::get_id()){ ?>

    <a class="btn btn-xs btn-dark" href="<?=base_url()?>projects/tasks/edit/<?=$t->t_id?>" data-toggle="ajaxModal"><i class="fa fa-edit"></i></a>

    <?php } ?>

  

    <?php if(!User::is_client()) { ?>
    <?php if(Project::timer_status('tasks',$t->t_id) == 'On') { ?>

     <a class="btn btn-xs btn-danger" data-toggle="tooltip" data-title="<?=lang('stop_timer')?>" href="<?=base_url()?>projects/tasks/tracking/off/<?=$t->project?>/<?=$t->t_id?>"><i class="fa fa-clock-o"></i> </a> 

    <?php }else{ ?>

     <a class="btn btn-xs btn-success" data-toggle="tooltip" data-title="<?=lang('start_timer')?>" href="<?=base_url()?>projects/tasks/tracking/on/<?=$t->project?>/<?=$t->t_id?>"><i class="fa fa-clock-o"></i> </a> 

    <?php  } ?>
    <?php } ?>

                        </td>


<?php } ?>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>

<!-- End details -->
 </section>