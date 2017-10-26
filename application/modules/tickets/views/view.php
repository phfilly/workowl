<?php $info = Ticket::view_by_id($id); ?>
<!--Start -->
<section id="content">
    <section class="hbox stretch">
        <aside class="aside-md bg-white b-r hidden-print" id="subNav">
            <header class="dk header b-b">
                <a href="<?=base_url()?>tickets/add" data-original-title="<?=lang('create_ticket')?>" data-toggle="tooltip" data-placement="top" class="btn btn-icon btn-<?=config_item('theme_color')?> btn-sm pull-right"><i class="fa fa-plus"></i></a>
                <p class="h4"><?=lang('all_tickets')?></p>
            </header>
            <section class="vbox">
                <section class="scrollable w-f">
                    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                        <?=$this->load->view('sidebar/tickets',$tickets)?>
                    </div>
                    </section>
                </section>
            </aside>
            <aside>
                <section class="vbox">
                    <header class="header bg-white b-b clearfix hidden-print">

                    

                        <div class="row m-t-sm">

                        <div class="col-md-12">
        
        <a href="#t_info" class="btn btn-sm btn-danger btn-responsive" id="info_btn" data-toggle="class:hide"><i class="fa fa-info-circle"></i></a>
        <?php if (!User::is_client()) { ?>
            <a href="<?=base_url()?>tickets/edit/<?=$info->id?>" class="btn btn-sm btn-dark btn-responsive">
            <i class="fa fa-pencil"></i> <?=lang('edit_ticket')?></a>
        <?php } ?>

        <div class="btn-group">
            <button class="btn btn-sm btn-<?=config_item('theme_color')?> dropdown-toggle btn-responsive" data-toggle="dropdown">
                                    <?=lang('change_status')?>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <?php
                                        $statuses = $this->db->get('status')->result();
                                        foreach ($statuses as $key => $s) { ?>
                                        <li><a href="<?=base_url()?>tickets/status/<?=$info->id?>/?status=<?=$s->status?>"><?=ucfirst($s->status)?></a></li>
                                        <?php } ?>
                                    </ul>
        </div>
        <?php if (User::is_admin()) { ?>
                                <a href="<?=base_url()?>tickets/delete/<?=$info->id?>" class="btn btn-sm btn-danger pull-right btn-responsive" data-toggle="ajaxModal">
                                <i class="fa fa-trash-o"></i> <?=lang('delete_ticket')?></a>

        <?php } ?>
   </div>


                            
                        </div>

                    </header>
                    <section class="scrollable wrapper">


                    <?php
                    $rep = $this->db->where('ticketid',$info->id)->get('ticketreplies')->num_rows();
                    if($rep == 0 AND $info->status != 'closed'){ ?>

                <div class="alert alert-success hidden-print">
                        <button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-warning"></i>
                        <?= lang('ticket_not_replied') ?>
                    </div>
                <?php } ?>


                        <!-- Start ticket Details -->
                        <div class="row">
                            <section class="">
                                <div class="col-sm-4" id="t_info">


    <?php if(!User::is_client()){ ?>                                
    <section class="panel panel-default">
      <header class="panel-heading font-bold"><?=lang('ticket_details')?></header>
      <div class="panel-body">

      <?php echo form_open(base_url().'tickets/quick_edit'); ?>
      
      <input type="hidden" name="id" value="<?=$info->id?>">
        <div class="form-group">
          <label><?=lang('ticket_code')?></label>
          <input type="text" class="form-control" value="<?=$info->ticket_code?>" required="" readonly="readonly"> 
        </div>

        <div class="form-group">
          <label><?=lang('created')?> </label>
          <input type="text" class="form-control" value="<?php echo strftime(config_item('date_format')." %H:%M", strtotime($info->created)); ?>" required="" readonly="readonly">
        </div>

        <div class="form-group">
          <label><?=lang('reporter')?> <span class="text-danger">*</span></label>
          <div class="m-b"> 
                    <select class="select2-option form-control" name="reporter" required="">
                    <?php foreach (User::all_users() as $user): ?>
                    <option value="<?=$user->id?>"<?=($info->reporter == $user->id ? ' selected="selected"' : '')?>><?php echo User::displayName($user->id); ?></option>
                    <?php endforeach; ?>
                    </select> 
                    </div> 

        </div>
         <div class="form-group">
          <label><?=lang('department')?> <span class="text-danger">*</span></label>
          <div class="m-b"> 
                    <select name="department" class="form-control" required="">
                    <?php 
                    $departments = App::get_by_where('departments',array('deptid >'=>'0'));
                        foreach ($departments as $d): ?>
                    <option value="<?=$d->deptid?>"<?=($info->department == $d->deptid ? ' selected="selected"' : '')?>><?=ucfirst($d->deptname)?></option>
                    <?php endforeach;  ?>
                    </select> 
            </div> 
        </div>


        <div class="form-group">
          <label><?=lang('priority')?> <span class="text-danger">*</span></label>
          <div class="m-b"> 
                    <select name="priority" class="form-control" required="">
                    <option value="<?=$info->priority?>"><?=lang(strtolower($info->priority))?></option>
                    <?php 
                    $priorities = $this->db->get('priorities')->result();
                        foreach ($priorities as $p): ?>
                    <option value="<?=$p->priority?>"><?=lang(strtolower($p->priority))?></option>
                    <?php endforeach; ?>
                    </select> 
                    </div> 
        </div>

        
        
        <button type="submit" class="btn btn-sm btn-dark"><?=lang('save_changes')?></button>
      </form>


    </div>
  </section>


<?php } else { ?>






                                    <ul class="list-group no-radius small">
                                        <?php
                                        if($info->status == 'open'){ $s_label = 'danger'; }elseif($info->status =='closed'){ $s_label = 'success'; }elseif($info->status=='resolved'){ $s_label = 'primary'; }else{ $s_label = 'default';}
                                        ?>
                                        <li class="list-group-item"><span class="pull-right">#<?=$info->ticket_code?></span><?=lang('ticket_code')?></li>
                                        <li class="list-group-item">
                                            <?=lang('reporter')?>
                                            <span class="pull-right">
                                                <?php if($info->reporter != NULL){ ?>
                                                <a class="thumb-xs avatar pull-left" data-toggle="tooltip" data-title="<?=User::login_info($info->reporter)->email?>" data-placement="right">
                                                    
        <img src="<?php echo User::avatar_url($info->reporter); ?>" class="img-circle">
                                                    
                                                    <?php echo User::displayName($info->reporter); ?>
                                                </a>
                                                <?php } else{ echo 'NULL'; } ?>
                                            </span>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right">
                <?php echo App::get_dept_by_id($info->department); ?>
                                            </span><?=lang('department')?>
                                        </li>
                                    <li class="list-group-item">
                                    <?php
                                    switch ($info->status) {
                                        case 'open':
                                            $status_lang = 'open';
                                            break;
                                        case 'closed':
                                            $status_lang = 'closed';
                                            break;
                                        case 'pending':
                                            $status_lang = 'pending';
                                            break;
                                        case 'resolved':
                                            $status_lang = 'resolved';
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }?>
                                            <span class="pull-right"><label class="label label-<?=$s_label?>">
                                            <?=ucfirst(lang($status_lang))?></label>
                                        </span><?=lang('status')?>
                                    </li>


                                    <li class="list-group-item"><span class="pull-right"><?=$info->priority?></span><?=lang('priority')?></li>

                                    <li class="list-group-item">
                                    <span class="pull-right label label-success" data-toggle="tooltip" data-title="<?=$info->created?>" data-placement="left">

                        <?php echo strftime(config_item('date_format')." %H:%M", strtotime($info->created)); ?>

                                    </span><?=lang('created')?>
                                    </li>


                                    <?php
                                    $additional = json_decode($info->additional, true);
                                    if (is_array($additional)) {
                                        foreach ($additional as $key => $value)
                                        {
                                        $result = $this->db->where('uniqid', $key)->get(Applib::$custom_fields_table);
                                        $row = $result->row_array();
                                        echo '<li class="list-group-item"><span class="pull-right">' .$this->encrypt ->decode($value).'</span>'.$row['name'] .'</li>';
                                        }
                                    }
                                    ?>

                                </ul>


    <?php } ?>
                            </div>
                            <!-- End ticket details-->


<style>
img { max-width: 100%; height: auto; }
</style>


                            <div class="col-sm-8 ticket_body">
                                <strong><?=$info->subject?></strong>
                                <div class="line line-dashed line-lg pull-in"></div>
                                <div class=""><?=nl2br_except_pre($info->body)?></div>

                                <?php if($info->attachment != NULL){
                                echo '<div class="line line-dashed line-lg pull-in"></div>';
                                $files = '';
                                if (json_decode($info->attachment)) {
                                $files = json_decode($info->attachment);
                                foreach ($files as $f) { ?>
                                <a class="label bg-info" href="<?=base_url()?>resource/attachments/<?=$f?>" target="_blank"><?=$f?></a><br>
                                <?php }
                                }else{ ?>
                                <a class="label bg-info" href="<?=base_url()?>resource/attachments/<?=$info->attachment?>" target="_blank"><?=$info->attachment?></a><br>
                                <?php } ?>

                                <?php } ?>
                                <div class="line line-dashed line-lg pull-in"></div>
                               
                                <section class="comment-list block">
                                    <!-- ticket replies -->
                                    
                                    <?php 
                                    if(count(Ticket::view_replies($id)) > 0) {
                                    foreach (Ticket::view_replies($id) as $key => $r) {
                                    $role = User::get_role($r->replierid); 
                                    $role_label = ($role == 'admin') ? 'danger' : 'info';
                                    ?>
                                    <article id="comment-id-1" class="comment-item" >
                                        <a class="pull-left thumb-sm avatar">
                                           
            <img src="<?php echo  User::avatar_url($r->replierid); ?>" class="img-circle" alt="<?=User::displayName($r->replierid)?>">
                                           
                                        </a>
                                        <span class="arrow left" <?=($role != 'client') ? 'style="border-right-color:#999"' : ''; ?>></span>
                                        <section class="comment-body panel panel-default" <?=($role != 'client') ? 'style="background-color: #fefef0; border: 1px solid #999;"' : ''; ?>>
                                            <header class="panel-heading bg-white" <?=($role != 'client') ? 'style="background-color: #fefef0;"' : ''; ?>>
                                                <a href="#"><?php echo User::displayName($r->replierid); ?></a>
                                                <label class="label bg-<?=$role_label?> m-l-xs">
                                                <?php echo ucfirst(User::get_role($r->replierid))?></label>
                                                <span class="text-muted m-l-sm pull-right">
                                                    <i class="fa fa-clock-o"></i>

                    <?php echo strftime(config_item('date_format')." %H:%M:%S", strtotime($r->time)); ?>
                          <?php
                        if(config_item('show_time_ago') == 'TRUE'){
                        echo ' - '.Applib::time_elapsed_string(strtotime($r->time));
                      }
                        ?>

                                                </span>
                                            </header>
                                            <div class="panel-body">
                                                <div class="small m-t-sm activate_links">
                                                <?=$r->body?>
                                                </div>

                                                <?php if($r->attachment != NULL){
                                                echo '<div class="line line-dashed line-lg pull-in"></div>';
                                                $replyfiles = '';
                                                if (json_decode($r->attachment)) {
                                                $replyfiles = json_decode($r->attachment);
                                                foreach ($replyfiles as $rf) { ?>
                                                <a class="label bg-info" href="<?=base_url()?>resource/attachments/<?=$rf?>" target="_blank"><?=$rf?></a><br>
                                                <?php }
                                                }else{ ?>
                                                <a href="<?=base_url()?>resource/attachments/<?=$r->attachment?>" target="_blank"><?=$r->attachment?></a><br>
                                                <?php } ?>

                                                <?php } ?>
                                            </div>
                                        </section>
                                    </article>
                                    <?php } } else { ?>
                                    <article id="comment-id-1" class="comment-item">
                                        <section class="comment-body panel panel-default">
                                            <div class="panel-body">
                                                <p><?=lang('no_ticket_replies')?></p>
                                            </div>
                                        </section>
                                    </article>
                                    <?php } ?>


                                    <!-- comment form -->
                                    <article class="comment-item media" id="comment-form">
                                        <a class="pull-left thumb-sm avatar">
                                           
            <img src="<?php echo User::avatar_url(User::get_id()); ?>" class="img-circle">
                                        
                                        </a>
                                        <section class="media-body">
                                            <section class="panel panel-default foeditor-noborder">
                                                <?php
                                                $attributes = 'class="m-b-none"';
                                                echo form_open_multipart(base_url().'tickets/reply',$attributes); ?>
                                                <input type="hidden" name="ticketid" value="<?=$info->id?>">
                                                <input type="hidden" name="ticket_code" value="<?=$info->ticket_code?>">
                                                <input type="hidden" name="replierid" value="<?=User::get_id();?>">
                                                <textarea required="required" class="form-control foeditor" name="reply" rows="3" placeholder="<?=lang('ticket')?> <?=$info->ticket_code?> <?=lang('reply')?>">
                                                </textarea>

                                                <footer class="panel-footer bg-light lter">
                                                    <div id="file_container">
                                                        <input type="file" class="filestyle" data-buttonText="<?=lang('choose_file')?>" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s" name="ticketfiles[]">
                                                    </div>
                                                    <div class="line line-dashed line-lg pull-in"></div>
                                                    <a href="#" class="btn btn-default btn-xs" id="add-new-file"><?=lang('upload_another_file')?></a>
                                                    <a href="#" class="btn btn-default btn-xs" id="clear-files" style="margin-left:6px;"><?=lang('clear_files')?></a>
                                                    <div class="line line-dashed line-lg pull-in"></div>
                                                    <button class="btn btn-<?=config_item('theme_color');?> pull-right btn-sm" type="submit"><?=lang('reply_ticket')?></button>
                                                    <ul class="nav nav-pills nav-sm">
                                                    </ul>
                                                </footer>
                                            </form>
                                        </section>
                                    </section>
                                </article>

                                <!-- End ticket replies -->
                            </section>
                        </div>
                        <!-- End details -->
                    </section>
                </div>
                <!-- End display details -->
            </section>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script type="text/javascript">
            $('#clear-files').click(function(){
            $('#file_container').html(
            "<input type='file' class='filestyle' data-buttonText='<?=lang('choose_file')?>' data-icon='false' data-classButton='btn btn-default' data-classInput='form-control inline input-s' name='ticketfiles[]'>"
            );
            });
            $('#add-new-file').click(function(){
            $('#file_container').append(
            "<input type='file' class='filestyle' data-buttonText='<?=lang('choose_file')?>' data-icon='false' data-classButton='btn btn-default' data-classInput='form-control inline input-s' name='ticketfiles[]'>"
            );
            });
            $('#info_btn').click(function(){
                var st = $( ".ticket_body" ).attr( "class" );

                if (st == 'col-sm-8 ticket_body' || st == 'ticket_body col-sm-8') {
                    $('.ticket_body').removeClass("col-sm-8");
                    $('.ticket_body').addClass("col-sm-12");
                }else{
                    $('.ticket_body').addClass("col-sm-8");
                    $('.ticket_body').removeClass("col-sm-12");
                }

            });
            </script>
            </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
            <!-- end -->