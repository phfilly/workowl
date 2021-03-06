<div class="table-responsive">
  <table id="table-tasks-timelog" class="table table-striped b-t b-light AppendDataTables small">
    <thead>
      <tr>
      <th style="width:5px; display:none;"></th>
      <th class="no-sort"><?=lang('user')?></th>        
        <th class=""><?=lang('task_name')?></th>
        <th class="col-time"><?=lang('time_spent')?></th>
        <th class="col-time"><?=lang('date_saved')?></th>
        <?php  if(!User::is_client()){ ?> 

        <th class="col-options no-sort"></th>

        <?php } ?>

      </tr>
    </thead>
    <tbody>
      <?php $timesheet = (User::is_staff()) ? Project::timesheet($project_id,'tasks',User::get_id())
                                        : Project::timesheet($project_id,'tasks');
      
      foreach ($timesheet as $key => $t) {  ?>
      <tr>
      <td style="display:none;"><?=$t->timer_id?></td>
        <td>
 
          <a class="pull-left thumb-sm avatar" data-toggle="tooltip" data-title="<?=$t->description;?>" data-placement="right">

        
          <img src="<?php echo User::avatar_url($t->user); ?>"  class="img-rounded" style="border-radius: 6px;">
      
            <span class="m-l-xs"><?=ucfirst(User::displayName($t->user))?></span>
           
          </a>


       </td>

        <td>

        <strong>
        <a href="<?=base_url()?>projects/view/<?=$project_id?>?group=tasks&view=task&id=<?=$t->task?>">
        <?php echo Project::view_task($t->task)->task_name;?>
        </a>
        </strong>

        </td>
        <td>
          <small class="text-muted">
          <?php if($t->status == '1'){ ?>
            <label class="label label-primary"><?=lang('on')?></label>
          <?php }else{ ?>
            <?=Applib::sec_to_hours(Project::logged_time('tasks',$t->timer_id));?>
          <?php } ?>

          </small>
          </td>


        <td><small class="text-muted">
          <?=strftime(config_item('date_format'), strtotime($t->date_timed))?>
          </small>
          </td>

        <?php  if(!User::is_client()){ ?>
        <td>
        <?php if($t->billable == '1') { ?>

        <a class="btn btn-xs btn-success" href="<?=base_url()?>projects/timesheet/billable/<?=$t->pro_id?>?group=timesheets&cat=tasks&id=<?=$t->timer_id?>" title="<?=lang('billable')?>" data-toggle="tooltip" data-placement="left">
        <i class="fa fa-check"></i>
        </a>

        <?php }else{ ?>
        <a class="btn btn-xs btn-danger" href="<?=base_url()?>projects/timesheet/billable/<?=$t->pro_id?>?group=timesheets&cat=tasks&id=<?=$t->timer_id?>" title="<?=lang('not_billable')?>" data-toggle="tooltip" data-placement="left"><i class="fa fa-square-o"></i></a>

        <?php } ?>

        <?php if($t->status == '0'){ ?>
          <a class="btn btn-xs btn-info" href="<?=base_url()?>projects/timesheet/edit/<?=$t->pro_id?>?group=timesheets&cat=tasks&id=<?=$t->timer_id?>" data-toggle="ajaxModal"><i class="fa fa-edit"></i></a>
        <?php } ?>


          <a class="btn btn-xs btn-dark" href="<?=base_url()?>projects/timesheet/delete/<?=$t->pro_id?>?group=timesheets&cat=tasks&id=<?=$t->timer_id?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i></a>
        </td>
        <?php } ?>
        
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>