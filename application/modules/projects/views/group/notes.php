<!-- Start Notebook -->
<?php if(User::is_admin() || (User::is_staff() && User::perm_allowed(User::get_id(),'view_project_notes'))){ ?>
<section class="panel panel-default">
<header class="panel-heading"> <i class="fa fa-pencil"></i> <?=lang('project_notes')?></header>
<?php echo form_open(base_url().'projects/notebook/savenote'); ?>
<input type="hidden" name="project" value="<?=$project_id?>">
<aside>
    <section class="foeditor-noborder">
        <textarea type="text" class="form-control  foeditor-500" name="notes" placeholder="<?=lang('type_your_note_here')?>"><?php echo Project::by_id($project_id)->notes;?></textarea>
    </section>
    
</aside>
</section>
<hr>
<button type="submit" class="btn btn-<?=config_item('theme_color')?>"><?=lang('save_changes')?></button>
</form>
<!-- End Notebook -->
<?php } ?>