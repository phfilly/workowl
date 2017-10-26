<section id="content">
  <section class="hbox stretch">
    <aside>
      <section class="vbox">
        <section class="scrollable wrapper">
          <section class="panel panel-default">
            <header class="panel-heading">

            <div class="btn-group"> 

              <button class="btn btn-<?=config_item('theme_color');?> btn-sm">
              <?php
              $view = isset($_GET['view']) ? $_GET['view'] : NULL;
              switch ($view) {
                case 'on_hold':
                  echo lang('on_hold');
                  break;
                case 'done':
                  echo lang('done');
                  break;
                case 'active':
                  echo lang('active');
                  break;
                
                default:
                  echo lang('filter');
                  break;
              }
              ?></button> 
              <button class="btn btn-<?=config_item('theme_color');?> btn-sm dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              </button> 
              <ul class="dropdown-menu"> 
             
              <li><a href="<?=base_url()?>projects?view=active"><?=lang('active')?></a></li> 
              <li><a href="<?=base_url()?>projects?view=on_hold"><?=lang('on_hold')?></a></li> 
              <li><a href="<?=base_url()?>projects?view=done"><?=lang('done')?></a></li>
              <li><a href="<?=base_url()?>projects"><?=lang('all_projects')?></a></li>   

              </ul> 
              </div>

            <span class="h3"><?=($archive ? lang('project_archive') : lang('projects'));?> </span>

                <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'add_projects') || User::login_role_name() == 'client' && config_item('client_create_project') == 'TRUE') { ?>

                  <a href="<?=base_url()?>projects/add" class="btn btn-sm btn-<?=config_item('theme_color');?> pull-right"><i class="fa fa-plus"></i><?=lang('create_project')?></a>
                <?php } ?>


                
                
            <?php if ($archive) : ?>
                <a href="<?=base_url()?>projects" class="btn btn-sm btn-<?=config_item('theme_color');?> pull-right"><?=lang('view_active')?></a>
                <?php else: ?>

              <a href="<?=base_url()?>projects?view=archive" class="btn btn-sm btn-dark pull-right">
              <?=lang('view_archive')?></a>
              <?php endif; ?>

              

              




            </header>
            <div class="table-responsive">
              <table id="table-projects<?=($archive ? '-archive':'')?>" class="table table-striped b-t b-light AppendDataTables">
                <thead>
                  <tr>
                  <th style="width:5px; display:none;"></th>
                    <th class="col-title"><?=lang('project_title')?></th>
        <?php if (User::login_role_name() == 'admin') { ?>
                    <th class=""><?=lang('client_name')?></th>
                    <?php } ?>
        <?php if (User::login_role_name() != 'client') { ?>
                    <th class="col-title "><?=lang('status')?></th>
                    <?php } ?>
                    <th><?=lang('team_members')?></th>
                    <th class="col-date "><?=lang('used_budget')?></th>

        <?php if (User::login_role_name() != 'admin') { ?>
                    <th class=""><?=lang('hours_spent')?></th>
                    <?php } ?>
        <?php if(User::login_role_name() != 'staff' || User::perm_allowed(User::get_id(),'view_project_cost')){ ?>
                    <th class="col-currency"><?=lang('amount')?></th>
                    <?php } ?>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($projects as $key => $p) { 
                      $progress = Project::get_progress($p->project_id); ?>
                    <tr class="<?php if (Project::timer_status('project',$p->project_id) == 'On') { echo "text-danger"; } ?>">

      <td style="display:none;"><?=$p->project_id?></td>
      <td style="border-left: 2px solid <?php if($progress == '100') { echo '#1ab394';}else{ echo '#e05d6f'; } ?>;">


                        <div class="btn-group">
                          <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                            
                          </button>
                          <ul class="dropdown-menu"> 

                            <li>
                            <a href="<?=base_url()?>projects/view/<?=$p->project_id?>"><?=lang('preview_project')?>
                            </a>
                            </li>

                    <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'edit_all_projects')){ ?>   
                              <li>
                              <a href="<?=base_url()?>projects/view/<?=$p->project_id?>/?group=dashboard&action=edit"><?=lang('edit_project')?>
                              </a>
                              </li>

                              <li>
                              <a href="<?=base_url()?>projects/<?=($p->pinned == '0') ? 'pin' : 'unpin';?>/<?=$p->project_id?>"><?=lang(($p->pinned == '0') ? 'pin_sidebar' : 'unpin_sidebar');?>
                              </a>
                              </li>

                    <?php if ($archive) : ?>
                                <li><a href="<?=base_url()?>projects/archive/<?=$p->project_id?>/0"><?=lang('move_to_active')?></a></li>  
                    <?php else: ?>

                                <li>
                                <a href="<?=base_url()?>projects/archive/<?=$p->project_id?>/1"><?=lang('archive_project')?></a>
                                </li>        

                                <?php endif; ?>
                            <?php } ?>  

                  <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'delete_projects')){ ?> 
                              <li>
                              <a href="<?=base_url()?>projects/delete/<?=$p->project_id?>" data-toggle="ajaxModal"><?=lang('delete_project')?>
                              </a>
                              </li>

                  <?php } ?>
                          </ul>
                        </div>


      <?php  $no_of_tasks = App::counter('tasks',array('project' => $p->project_id)); ?>


                      <a class="text-info" data-toggle="tooltip" 
                      data-original-title="<?=$no_of_tasks?> <?=lang('tasks')?> | <?=$progress?>% <?=lang('done')?>" href="<?=base_url()?>projects/view/<?=$p->project_id?>"><?=$p->project_title?></a>

                      <?php if (Project::timer_status('project',$p->project_id) == 'On') {   ?>
                        <i class="fa fa-spin fa-clock-o text-danger"></i>
                      <?php } ?>
          
                            <?php 
                            if (time() > strtotime($p->due_date) AND $progress < 100){
                            $color = (valid_date($p->due_date)) ? 'danger': 'default';
                            echo '<span class="label label-'.$color.' pull-right">';
                            echo (valid_date($p->due_date)) ? lang('overdue') : lang('ongoing'); 
                            echo '</span>'; 
                            } ?>
                  


                      <div class="progress-xxs not-rounded mb-0 inline-block progress" style="width: 100%; margin-right: 5px">
                        <div class="progress-bar progress-bar-<?php echo ($progress >= 100 ) ? 'success' : 'danger'; ?>" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;" data-toggle="tooltip" data-original-title="<?=$progress?>%"></div>
                      </div>


                        

                      </td>


          <?php if (User::is_admin()) { ?>
                        <td class="">
                        <?=($p->client > 0) ? Client::view_by_id($p->client)->company_name : 'N/A'; ?>
                        </td>
          <?php } ?>



          <?php if (User::login_role_name() != 'client') { ?>
                      <?php 
                        switch ($p->status) {
                            case 'Active': $label = 'success'; break;
                            case 'On Hold': $label = 'warning'; break;
                            case 'Done': $label = 'default'; break;
                        }
                      ?>
                      <td>
          <span class="label label-<?=$label?>"><?=lang(str_replace(" ","_",strtolower($p->status)))?></span>
                      </td>
          <?php } ?>
                      
                      <td class="text-muted">

                      
                      <a class="thumb-xs pull-left m-r-sm">
                        <?php foreach (Project::project_team($p->project_id) as $user) { ?>

                            <img src="<?php echo User::avatar_url($user->assigned_user); ?>" class="img-circle"
                                 data-toggle="tooltip" data-title="<?=User::displayName($user->assigned_user); ?>"
                                 data-placement="top">

                        <?php } ?>
                    </a>
                    </td>



                       <?php $hours = Project::total_hours($p->project_id);
                       if($p->estimate_hours > 0){
                       $used_budget = round(($hours / $p->estimate_hours) * 100,2);
                       }else{ $used_budget = NULL; }
                       ?>
                
                      <td class="">
                      <strong class="<?=($used_budget > 100) ? 'text-danger' : 'text-success'; ?>"><?=($used_budget != NULL) ? $used_budget.' %': 'N/A'?>
                      </strong>
                        </td>





                      <?php if (!User::is_admin()) { ?>
                        <td class="text-muted"><?=$hours?> <?=lang('hours')?></td>
                      <?php } ?>

    <?php if(User::login_role_name() != 'staff' || User::perm_allowed(User::get_id(),'view_project_cost')){ ?>
                        <?php $cur = ($p->client > 0) ? Client::client_currency($p->client)->code : $p->currency; ?>
                        <td class="col-currency">
                        <strong>
    <?=Applib::format_currency($cur, Project::sub_total($p->project_id))?>
                        </strong>
                        <small class="text-muted" data-toggle="tooltip" data-title="<?=lang('expenses')?>">
                        (<?=Applib::format_currency($cur, Project::total_expense($p->project_id))?>)
                        </small>
                        </td>
                      <?php } ?>
                      
                    </tr>


                  <?php } ?>
                </tbody>
              </table>
            </div>
          </section>
        </section>
      </section>
    </aside>
  </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
<!-- end -->