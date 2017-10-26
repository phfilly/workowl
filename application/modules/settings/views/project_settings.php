<div class="row">
    <!-- Start Form -->
        <div class="col-lg-12">
            <section class="panel panel-default">
                <header class="panel-heading font-bold"><i class="fa fa-sliders"></i> <?=lang('client')?> <?=lang('project_settings')?></header>
                <div class="panel-body">
                    <?php
                    $attributes = array('class' => 'bs-example form-horizontal','data-validate'=>'parsley');
                    echo form_open('settings/project_settings', $attributes); ?>
                    <?php echo validation_errors(); $this->load->helper('inflector'); ?>

                   <?php $json = json_decode(config_item('default_project_settings')); 
                   foreach ($json as $key => $value) { ?>
                    <div class="form-group">
                        <label class="col-lg-5 control-label"><?=humanize($key);?></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="off" name="<?=$key?>" />
                                <input type="checkbox" <?php if($value == 'on'){ echo "checked=\"checked\""; } ?> name="<?=$key?>">
                                <span></span>
                            </label>

                        </div>
                    </div>
                    <?php } ?>


                    <div class="form-group">
                        <div class="col-lg-offset-6 col-lg-10">
                            <button type="submit" class="btn btn-sm btn-<?=config_item('theme_color')?>"><i class="fa fa-check"></i> <?=lang('save_changes')?></button>
                        </div>
                    </div>
                    </form>
                </div> </section>
        </div>
    <!-- End Form -->
</div>