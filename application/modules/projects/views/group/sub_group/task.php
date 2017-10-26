<style type="text/css">
  .note-editor.note-frame {
    border: none; 
}
</style>
<section class="panel panel-default">
    <?php
    $task = isset($_GET['id']) ? $_GET['id'] : 0;
    $t = (!User::is_client()) ? Project::view_task($task) : Project::view_task($task,'Yes');
    if($t->project == $project_id){ ?>


    <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">


           

                <?php if($t->task_progress < 100) {
                    if(!User::is_client()){
                        if(Project::timer_status('tasks',$t->t_id) == 'On') { ?>
                            <a class="btn btn-sm btn-danger" href="<?=base_url()?>projects/tasks/tracking/off/<?=$t->project?>/<?=$t->t_id?>"><?=lang('stop_timer')?>
                            </a>

                        <?php }else{ ?>
                            <a class="btn btn-sm btn-success" href="<?=base_url()?>projects/tasks/tracking/on/<?=$t->project?>/<?=$t->t_id?>"><?=lang('start_timer')?>
                            </a>
                        <?php }  }
                }
                ?>


            <?php if($t->task_progress < 100 && !User::is_client()) : ?>
              <a class="btn btn-sm btn-dark" href="<?=base_url()?>projects/tasks/close_open/<?=$t->t_id?>" data-toggle="tooltip" data-title="<?=lang('mark_as_complete');?>" data-placement="bottom">
              <i class="fa fa-lg fa-check-square-o text-white"></i>
              </a>
            <?php endif; ?>

                <a href="<?=base_url()?>projects/tasks/file/<?=$t->project?>/<?=$t->t_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('attach_file')?>
                </a>

                <?php if(!User::is_client() || $t->added_by == User::get_id()){ ?>
                    <a href="<?=base_url()?>projects/tasks/edit/<?=$t->t_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('edit_task')?>
                    </a>
                <?php } if(User::is_admin()){ ?>
                    <a href="<?=base_url()?>projects/tasks/delete/<?=$t->project?>/<?=$t->t_id?>" data-toggle="ajaxModal" title="<?=lang('delete_task')?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o text-white"></i> <?=lang('delete_task')?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="row">

                <aside class="col-lg-4 bg-light lter">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="#" class="pull-left thumb m-r">
                          <img src="<?php echo User::avatar_url($t->added_by); ?>" class="img-circle"
                                 data-toggle="tooltip" data-title="<?=User::displayName($t->added_by); ?>"
                                 data-placement="bottom">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs"><?=User::displayName($t->added_by)?></div>
                            <small class="text-muted"><i class="fa fa-leaf"></i> <?=$t->task_name?></small>

                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs block"><?=lang('total_time')?></span>
                                <small class="text-muted"><?=Applib::sec_to_hours(Project::task_timer($t->t_id))?></small>
                              </a>
                            </div>
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs block"><?=lang('estimate')?></span>
                                <small class="text-muted"><?=$t->estimated_hours?> <?=lang('hours')?></small>
                              </a>
                            </div>
                          </div>
                        </div>

                            <div class="progress progress-xs <?=($t->task_progress != '100') ? 'progress-striped active' : ''; ?> m-t-sm">
                                <div class="progress-bar progress-bar-<?=config_item('theme_color')?>" data-toggle="tooltip" data-original-title="<?=$t->task_progress?>%" style="width: <?=$t->task_progress?>%">
                                </div>
                            </div>


                        <div>
                          <small class="text-uc text-xs text-muted"><?=lang('milestone')?></small>
                          <p>
                          <a href="<?=base_url()?>projects/view/<?=$t->project?>/?group=milestones&view=milestone&id=<?=$t->milestone?>" class="text-primary">
                                    <?php echo ($t->milestone) ? Project::view_milestone($t->milestone)->milestone_name : 'N/A';
                                    ?>
                         </a>
                        </p>

                        <small class="text-uc text-xs text-muted"><?=lang('start_date')?></small>
                          <p>
                          <label class="label label-success">
                          <?php $start_date = ($t->start_date == NULL) ? $t->date_added : $t->start_date; ?>
                            <?=strftime(config_item('date_format'), strtotime($start_date))?>
                          </label>
                        </p>

                        <small class="text-uc text-xs text-muted"><?=lang('end_date')?></small>
                          <p>
                          <label class="label label-danger">
                          <?=strftime(config_item('date_format'), strtotime($t->due_date))?>
                          </label>
                        </p>

                          <small class="text-uc text-xs text-muted"><?=lang('description')?></small>
                          <p><?=nl2br_except_pre($t->description)?></p>


                          
                          <small class="text-uc text-xs text-muted"><?=lang('files')?></small>
                          <p>

                          <ul class="list-unstyled p-files">
                          <?php $this->load->helper('file');
                            foreach (Project::task_has_files($t->t_id) as $key => $f) {
                                $icon = $this->applib->file_icon($f->file_ext);
                                $real_url = ($f->path != NULL)
                                    ? base_url().'resource/project-files/'.$f->path.$f->file_name
                                    : base_url().'resource/project-files/'.$f->file_name;
                                ?>
                          <?php if(count(Project::task_has_files($t->t_id) > 0)): ?>
<div class="line"></div>
                                  <li>
                                    <?php if ($f->is_image == 1) : ?>
                                        <?php if ($f->image_width > $f->image_height) {
                                            $ratio = round(((($f->image_width - $f->image_height) / 2) / $f->image_width) * 100);
                                            $style = 'height:100%; margin-left: -'.$ratio.'%';
                                        } else {
                                            $ratio = round(((($f->image_height - $f->image_width) / 2) / $f->image_height) * 100);
                                            $style = 'width:100%; margin-top: -'.$ratio.'%';
                                        }  ?>
                                        <div class="file-icon icon-small"><a href="<?=base_url()?>projects/tasks/preview/<?=$f->file_id?>/<?=$project_id?>" data-toggle="ajaxModal"><img style="<?=$style?>" src="<?=$real_url?>" /></a></div>
                                    <?php else : ?>
                                        <div class="file-icon icon-small"><i class="fa <?=$icon?> fa-lg"></i></div>
                                    <?php endif; ?>
                                    <a data-toggle="tooltip" data-placement="top" data-original-title="<?=$f->description?>" class="text-muted" href="<?=base_url()?>projects/tasks/download/<?=$f->file_id?>">
                                        <?=(empty($f->title) ? $f->file_name : $f->title)?>
                                    </a>
                                    <?php  if($f->uploaded_by == User::get_id() || User::is_admin()){ ?>
                                      <div class="pull-right">
                                      <a href="<?=base_url()?>projects/tasks/file/edit/<?=$f->file_id?>/<?=$project_id?>" data-toggle="ajaxModal"><i class="fa fa-edit text-muted"></i></a>
                                        <a href="<?=base_url()?>projects/tasks/file/delete/<?=$f->file_id?>/<?=$project_id?>" data-toggle="ajaxModal"><i class="fa fa-trash-o text-danger"></i></a>
                                        
                                        </div>
                                    <?php } ?>
                                </li>
                                  
                                  <?php endif; ?>

                          
                                  <?php } ?>
                              </ul>
                          </p>

                          

                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted"><?=lang('team_members')?></small>
                          <p class="m-t-sm">

                          <?php if(!User::is_client()){ ?>
                                    <a class="thumb-sm pull-left m-r-sm">
                                        <?php foreach (Project::task_team($t->t_id) as $u) { ?>
                                        <img src="<?php echo User::avatar_url($u->assigned_user); ?>" class="img-circle"
                                 data-toggle="tooltip" data-title="<?=User::displayName($u->assigned_user); ?>"
                                 data-placement="right">
                                        <?php } ?>
                                    </a>
                                <?php } ?>

                            
                          </p>

                          

                        </div>
                      </div>
                    </section>
                </aside>

                
                <aside class="col-lg-8 b-l">
                    <section class="scrollable">
                      <div class="wrapper">
                        <section class="panel panel-default">

<?php
                                $attributes = 'class="m-b-none"';
                                echo form_open(base_url().'projects/tasks/comment',$attributes); ?>
                                <input type="hidden" name="task_id" value="<?=$t->t_id?>">
                                <input type="hidden" name="project" value="<?=$t->project?>">
                                <textarea class="form-control foeditor-100" name="message" placeholder="<?=$t->task_name?> <?=lang('comment')?>"></textarea>
                                <footer class="panel-footer bg-light lter">
                                    <button class="btn btn-<?=config_item('theme_color');?> pull-right btn-sm" type="submit"><?=lang('comment')?></button>
                                    <ul class="nav nav-pills nav-sm"></ul>
                                </footer>
                                </form>



                          
                        </section>
                        <section class="panel panel-default">
                       
                          <h4 class="font-thin padder"><?=lang('latest_comments')?></h4>
                          <ul class="list-group">

                          <?php foreach (Project::task_has_comments($t->t_id) as $key => $c) {
                        $role_label = (User::login_info($c->posted_by)->role_id == '1') ? 'danger' : 'info';
                        ?>
                        <li class="list-group-item">
                            
                            
                                <a class="thumb-sm pull-left m-r-sm">

                                        <img src="<?php echo User::avatar_url($c->posted_by); ?>" class="img-rounded"
                                             style="border-radius: 6px;" data-toggle="tooltip" data-title="<?=User::displayName($c->posted_by); ?>"
                                 data-placement="right">

                                    </a>

                                    <div class="activate_links">
                                    <?=nl2br_except_pre($c->message)?>
                                        
                                    </div>

                                     


                        <small class="block text-muted">
                        <strong><?=User::displayName($c->posted_by);?></strong>
                        <i class="fa fa-clock-o"></i> 
                        <?php
                                    if(config_item('show_time_ago') == 'TRUE'){
                                        echo strtolower(humanFormat(strtotime($c->date_posted)).' '.lang('ago'));
                                    } ?></small>

                        </li>
                    <?php } ?>

                    <?php if(count(Project::task_has_comments($t->t_id)) <= 0) : ?>

                    <li class="list-group-item"><?=lang('no_comment_found')?></li>
                    
                    <?php endif; ?>


                            
                          </ul>
                        </section>
                       
                      </div>
                    </section>         
                </aside>
             




                       
                    

                            
                            <!-- End details -->
                            
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- End ROW 1 -->
    


</section>