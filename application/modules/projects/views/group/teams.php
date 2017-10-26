<section class="panel panel-default">
    <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">
                <?php if(User::is_admin()){ ?>
                    <a href="<?=base_url()?>projects/team/<?=$project_id?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('update_team')?></a>
                <?php } ?>
            </div>
        </div>
    </header>
    <div class="table-responsive">
        <?php if (!User::is_client() || Project::setting('show_team_members',$project_id)) { ?>
            <table id="table-teams" class="table table-striped b-t b-light AppendDataTables">
                <thead>
                <tr>
                    <th style="width:5px; display:none;"></th>
                    <th class=""><?=lang('user')?></th>
                    <th class=""><?=lang('last_login')?></th>
                    <th class=""><?=lang('email')?></th>
                    <?php if(User::is_admin()){ ?>
                        <th class=""><?=lang('hours')?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach(Project::project_team($project_id) as $key => $u) { ?>
                    <tr>
                        <td style="display:none;"><?=$u->assigned_user?></td>

                        <td style="border-left: 2px solid #16a085;">
                            <a class="pull-left thumb-sm small avatar">
                                <img src="<?php echo User::avatar_url($u->assigned_user); ?>" class="img-rounded" style="border-radius: 6px;">
                                <?php echo User::displayName($u->assigned_user); ?>
                            </a>
                        </td>
                        <td class="">
        <span class="text-muted">
        <?php if(User::login_info($u->assigned_user)->last_login != '0000-00-00 00:00:00'){
            echo Applib::time_elapsed_string(strtotime(User::login_info($u->assigned_user)->last_login));
        }else{ echo User::login_info($u->assigned_user)->last_login; } ?>
        </span>

            <br>
                            <i class="fa fa-phone"></i>
                            <small><?=User::profile_info($u->assigned_user)->phone;?></small>

                        </td>
                        <?php $email = User::login_info($u->assigned_user)->email?>
                        <td class=""><a href="mailto:<?=$email?>"><?=$email?></a></td>

                        <?php if(User::is_admin()){
                            $p_hours = Project::time_by_user($u->assigned_user,'1',$project_id)->projects_time;
                            $t_hours = Project::time_by_user($u->assigned_user,'1',$project_id)->tasks_time;
                            $total_hours = $p_hours + $t_hours;
                            $format = sprintf('%02d:%02d:%02d', ($total_hours / 3600), ($total_hours / 60 % 60), $total_hours % 60);
                            ?>
                            <td class="">
                                <span class=""><?=lang('time_spent')?></span> &raquo; <span class="label label-success"><?=$format?></span><br>
                                <span class=""><?=lang('hourly_rate')?></span> &raquo; <span class="label label-default">
       <?=User::profile_info($u->assigned_user)->hourly_rate?>/<?=lang('hour')?></span>
                            </td>

                        <?php } ?>

                    </tr>
                <?php }  ?>


                </tbody>
            </table>
        <?php } ?>
        <!-- End view team members -->
    </div>
    <!-- End details -->
</section>
