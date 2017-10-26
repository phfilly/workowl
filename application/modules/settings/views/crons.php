<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">

    <div class="alert alert-info small">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>GENERAL CRON: </strong> <code>wget -O /dev/null <?=base_url()?>crons/run/<?=config_item('cron_key')?></code>
    </div>

    <div class="alert alert-info small">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>EMAIL PIPING: </strong> <code>wget -O /dev/null <?=base_url()?>crons/email_piping</code>
    </div>

            <section class="panel panel-default">
                <header class="panel-heading font-bold">
                    <i class="fa fa-cogs"></i> <?=lang('cron_jobs')?>
                </header>
                <div class="panel-body">
                        <div class="table-responsive">
                          <table id="cron-jobs" class="table table-striped b-t b-light table-menu">
                            <thead>
                                    <tr>
                                    <th><?=lang('job')?></th>
                                    <th><?=lang('cron_last_run')?></th>
                                    <th><?=lang('result')?></th>
                                    <th><?=lang('settings')?></th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php 
                                error_reporting(0);
                                $result = unserialize(config_item('cron_last_run')); ?>
                                <?php foreach($crons as $cron) : ?>
                                <tr>
                                    <td><i class="fa fa-fw m-r-sm <?=($cron->icon != '' ? $cron->icon : 'cog')?>"></i> <?=lang($cron->name)?></td>
                                    <td><?=date('Y-m-d H:i',strtotime($cron->last_run))?></td>
                                    <td><?php   
                                                if ($result) { 
                                                    if (is_array($result[$cron->module])) {
                                                        echo $result[$cron->module]['result'];
                                                    } else {
                                                        echo ($result[$cron->module] ? lang('success'): lang('error'));
                                                    }
                                                } 
                                    ?></td>
                                    <td>
                                        <a data-rel="tooltip" data-original-title="<?=lang('toggle_enabled')?>" class="cron-enabled-toggle btn btn-xs btn-<?=($cron->enabled == 1 ? 'success':'default')?> m-r-xs" href="#" data-role="1" data-href="<?=base_url()?>settings/hook/enabled/<?=$cron->module?>"><i class="fa fa-check"></i></a>
                                        <?php
                                            $cron_set = $this->db->where("hook","cron_job_settings")->where("parent",$cron->module)->get('hooks')->result_array();
                                            if (count($cron_set) == 1) { $cron_set = $cron_set[0]; 
                                        ?>
                                        <a data-rel="tooltip" data-original-title="<?=lang('settings')?>" data-toggle="ajaxModal" class="cron-settings btn btn-xs btn-default" href="<?=base_url()?><?=$cron_set["route"]?>/<?=$cron->module?>"><i class="fa fa-cog"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                 </div>
            </section>
        <?php
        $attributes = array('class' => 'bs-example form-horizontal');
        echo form_open_multipart('settings/update', $attributes); ?>
            <section class="panel panel-default">
                <header class="panel-heading font-bold"><i class="fa fa-cogs"></i> <?=lang('cron_settings')?></header>
                <div class="panel-body">
                    <?php echo validation_errors(); ?>
                    <input type="hidden" name="settings" value="<?=$load_setting?>">

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?=lang('cron_key')?></label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" value="<?=config_item('cron_key')?>" name="cron_key">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?=lang('auto_backup_db')?></label>
                        <div class="col-lg-3">
                            <label class="switch">
                                <input type="hidden" value="off" name="auto_backup_db" />
                                <input type="checkbox" <?php if(config_item('auto_backup_db') == 'TRUE'){ echo "checked=\"checked\""; } ?> name="auto_backup_db">
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-<?=config_item('theme_color')?>"><?=lang('save_changes')?></button>
                    </div>
                 </div>
            </section>
        </form>
        
    </div>
    <!-- End Form -->
</div>