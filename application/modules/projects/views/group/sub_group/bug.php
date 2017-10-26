<section class="panel panel-default">
  <?php
  $bug = isset($_GET['id']) ? $_GET['id'] : 0;
  $i = Project::view_bug($bug);
    ?>
      <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
          <div class="col-sm-12 m-b-xs">
            <a href="<?=base_url()?>projects/bugs/file/<?=$i->project?>/<?=$i->bug_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('attach_file')?></a>
            <?php if (User::is_admin() || Project::is_assigned(User::get_id(),$i->project)) { ?>
              <a href="<?=base_url()?>projects/bugs/edit/<?=$i->project?>/?id=<?=$i->bug_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('edit_bug')?></a> 
            <?php } ?>
          </div>
        </div>
      </header>
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-group no-radius">
                    <li class="list-group-item">
                      <span class="pull-right">

                      <strong>
                      <?php echo Project::by_id($i->project)->project_title; ?> 
                      </strong>
                      </span><?=lang('project')?>
                    </li>

                    <li class="list-group-item">
                      <span class="pull-right"><strong><?=$i->issue_title?></strong></span><?=lang('issue_title')?>
                    </li>

                    <li class="list-group-item">
                      <span class="pull-right"><strong><?=$i->issue_ref?></strong></span><?=lang('issue_ref')?>
                    </li>

                    <li class="list-group-item">
                      <span class="pull-right">
                      <strong><?=ucfirst(User::displayName($i->reporter))?></strong>
                      </span><?=lang('reporter')?>
                    </li>
                    <?php if (User::is_admin() || Project::is_assigned(User::get_id(),$i->project)) { ?>
                      <li class="list-group-item">
                        <span class="pull-right">
                        <strong>
                            <?php echo ($i->assigned_to > 0) ? User::displayName($i->assigned_to) : 'N/A'; ?>
                        </strong>
                        </span><?=lang('assigned_to')?>
                      </li>
                    <?php } ?>   
                  </ul>
                </div>
                <!-- End details C1-->
                <div class="col-lg-6">
                  <ul class="list-group no-radius">
                    <li class="list-group-item">
                      <span class="pull-right"><strong><?=$i->severity?></strong></span><?=lang('severity')?>
                    </li>
                    <li class="list-group-item">
                      <span class="pull-right"><strong><?=lang(strtolower($i->bug_status))?></strong></span><?=lang('bug_status')?>
                    </li>
                    <li class="list-group-item">
                      <span class="pull-right"><strong><?=ucfirst($i->priority)?></strong> </span>
                      <?=lang('priority')?>
                    </li>


                    <li class="list-group-item">
                      <span class="pull-right"><strong><?=strftime(config_item('date_format'), strtotime($i->reported_on));?></strong>
                      </span><?=lang('reported_on')?>
                    </li>

                    <li class="list-group-item">
                      <span class="pull-right">
                      <span class="label label-success">
                        <strong><?=strftime(config_item('date_format'), strtotime($i->last_modified));?></strong>
                      </span>
                      </span><?=lang('last_modified')?>
                    </li>    
                  </ul>
                </div>
              </div>
              <!-- End details -->
                    <?php
                $this->load->helper('file');
                foreach (Project::bug_has_files($bug) as $key => $f) {
                  $icon = $this->applib->file_icon($f->file_ext);
                  $real_url = base_url().'resource/bug-files/'.$f->file_name;
                  ?>
                <div class="file-small">
                        <?php if ($f->is_image == 1) : ?>
                        <?php if ($f->image_width > $f->image_height) {
                            $ratio = round(((($f->image_width - $f->image_height) / 2) / $f->image_width) * 100);
                            $style = 'height:100%; margin-left: -'.$ratio.'%';
                        } else {
                            $ratio = round(((($f->image_height - $f->image_width) / 2) / $f->image_height) * 100);
                            $style = 'width:100%; margin-top: -'.$ratio.'%';
                        }  ?>
                            <div class="file-icon icon-small"><a href="<?=base_url()?>projects/bugs/preview/<?=$f->file_id?>/<?=$i->project?>" data-toggle="ajaxModal"><img style="<?=$style?>" src="<?=$real_url?>" /></a></div>
                        <?php else : ?>
                            <div class="file-icon icon-small"><i class="fa <?=$icon?> fa-lg"></i></div>
                        <?php endif; ?>

                        <a data-toggle="tooltip" data-placement="top" data-original-title="<?=$f->description?>" class="text-info" href="<?=base_url()?>projects/bugs/download/<?=$i->project?>/<?=$f->file_id?>">
                        <?=(empty($f->title) ? $f->file_name : $f->title)?>
                        </a>

                        <?php  if($f->uploaded_by == User::get_id() || User::is_admin()){ ?>
                        <a class="btn btn-xs btn-default" href="<?=base_url()?>projects/bugs/file/delete/<?=$f->file_id?>/<?=$i->project?>" data-toggle="ajaxModal"><i class="fa fa-trash-o"></i></a>
                        <a class="btn btn-xs btn-default" href="<?=base_url()?>projects/bugs/file/edit/<?=$f->file_id?>/<?=$i->project?>" data-toggle="ajaxModal"><i class="fa fa-edit"></i></a>
                        <?php } ?>
                        
                </div>
              <?php } ?>
              <br/>
              <br/>
              <div class="line line-dashed line-lg pull-in"></div>
              <blockquote class="small text-muted activate_links" style="border-left: 2px solid #e05d6f"><?=nl2br_except_pre($i->reproducibility)?></blockquote>
              <blockquote class="activate_links" style="border-left: 2px solid #27C24C"><?=nl2br_except_pre($i->bug_description)?></blockquote>
            </div>
          </section>
          <!-- Start Comments -->
          <div class="row">
            <div class="col-lg-12">
              <section class="panel panel-body">
                <section class="comment-list block">
                  <article class="comment-item media" id="comment-form">
                  
                    <a class="pull-left thumb-sm avatar">
                    <img src="<?php echo User::avatar_url(User::get_id()); ?>" class="img-circle">
                    </a>


                     
                    <section class="media-body">
                      <section class="panel panel-default">
                        <?php 
                        $attributes = 'class="m-b-none"';
                        echo form_open(base_url().'projects/bugs/comment/',$attributes); ?>
                          <input type="hidden" name="bug_id" value="<?=$bug?>">
                          <input type="hidden" name="project" value="<?=$i->project?>">
                          <textarea class="form-control foeditor-100" name="comment" placeholder="<?=lang('issue_ref')?><?=$i->issue_ref?> <?=lang('comment')?>"></textarea>
                          <footer class="panel-footer bg-light lter">
                             <button class="btn btn-<?=config_item('theme_color');?> pull-right btn-sm" type="submit"><?=lang('post_comment')?></button>
                            <ul class="nav nav-pills nav-sm"></ul>
                          </footer>
                        </form>
                      </section>
                    </section>
                  </article>
                  <?php foreach (Project::bug_has_comments($bug) as $key => $c) {
                    $role_label = (User::login_info($c->comment_by) == '1') ? 'danger' : 'info';
                  ?> 
                          <article id="comment-id-1" class="comment-item">
                            <a class="pull-left thumb-sm avatar">
                      <img src="<?php echo User::avatar_url($c->comment_by); ?>" class="img-circle">
                            </a>
                            <span class="arrow left"></span>
                            <section class="comment-body panel panel-default">
                              <header class="panel-heading bg-white">
                                <a href="#"><?=ucfirst(User::displayName($c->comment_by))?></a>
                                <label class="label bg-<?=$role_label?> m-l-xs">
                                <?php echo User::get_role($c->comment_by); ?></label> 
                                <span class="text-muted m-l-sm pull-right">
<?php echo strftime(config_item('date_format')." %H:%M:%S", strtotime($c->date_commented)) ?>
                                <?php
                  if(config_item('show_time_ago') == 'TRUE'){
                    echo ' - '.Applib::time_elapsed_string(strtotime($c->date_commented));
                  } ?>


                  <?php if($c->comment_by == User::get_id()){ ?>

                     <a href="<?=base_url()?>projects/bugs/delete_comment/<?=$c->c_id?>" data-toggle="ajaxModal" title="<?=lang('comment_reply')?>"><i class="fa fa-trash-o text-danger"></i>
                     </a>
                  <?php } ?>
                                </span>
                              </header>

                              <div class="panel-body">
                                <div class="text-muted small activate_links"><?=nl2br_except_pre($c->comment)?></div>
                               
                              </div>

                            </section>
                          </article>
                        <?php } ?>

                        <?php if(count(Project::bug_has_comments($bug)) <= 0) { ?>
                          <article id="comment-id-1" class="comment-item">
                            <section class="comment-body panel panel-default">
                              <div class="panel-body">
                                <p>No comments found</p>
                              </div>
                            </section>
                          </article>
                        <?php } ?>

                      </section>
                    </section>
                  </div>
                </div>
              <!-- END COMMENTS -->
                 </div> 
      </div>
    <!-- End ROW 1 -->
  </section>