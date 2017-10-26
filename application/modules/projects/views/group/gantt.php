<link rel="stylesheet" href="<?=base_url()?>resource/css/gantt.css" type="text/css" />
 <?php if (!User::is_client() || Project::is_assigned(User::get_id(),$project_id) || Project::setting('show_project_gantt',$project_id)) { ?>

<!-- Gantt Chart Fix for IE -->
<!--[if IE]><!-->
    <style>
        .fn-gantt .day, .fn-gantt .date {
                box-sizing: border-box !important;
                width: 25px !important;
            }
    </style>
<!--<![endif]-->

<section class="scrollable">

<div class="contain">
    <!-- Start Form -->
    <div class="col-lg-12">

<div class="gantt"></div>


</div>
</div>


</section>

<?php } ?>