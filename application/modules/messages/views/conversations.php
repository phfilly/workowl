<style>
    img { max-width: 100%; height: auto; }
</style>
<section id="content">
    <section class="hbox stretch">

        <aside class="aside-md bg-white b-r" id="subNav">
            <div class="wrapper b-b header"><?=lang('all_messages')?></div>
            <section class="vbox">
                <section class="scrollable w-f">
                    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

                        <section id="setting-nav" class="hidden-xs">
                            <ul class="nav nav-pills nav-stacked no-radius">
                                <li class="<?php echo ($group == 'inbox') ? 'active' : '';?>">
                                    <a href="<?=base_url()?>messages?group=inbox"> <i class="fa fa-fw fa-envelope"></i>
                                        <?=lang('inbox')?>
                                    </a>
                                </li>
                                <li class="<?php echo ($group == 'sent') ? 'active' : '';?>">
                                    <a href="<?=base_url()?>messages?group=sent"> <i class="fa fa-fw fa-exchange"></i>
                                        <?=lang('sent')?>
                                    </a>
                                </li>
                                <li class="<?php echo ($group == 'favourites') ? 'active' : '';?>">
                                    <a href="<?=base_url()?>messages?group=favourites"> <i class="fa fa-fw fa-star"></i>
                                        <?=lang('favourites')?>
                                    </a>
                                </li>
                                <li class="<?php echo ($group == 'trash') ? 'active' : '';?>">
                                    <a href="<?=base_url()?>messages?group=trash"> <i class="fa fa-fw fa-trash-o"></i>
                                        <?=lang('trash')?>
                                    </a>
                                </li>



                            </ul>
                        </section>
                    </div></section>
            </section>
        </aside>
        <!-- .aside -->
        <aside class="bg-light lter b-l" id="email-list">
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">

                            <div class="btn-group">
                                <a class="btn btn-sm btn-<?=config_item('theme_color')?>" href="<?=base_url()?>messages/send?group=sent" title="<?=lang('send_message')?>" data-placement="top">
                                    <i class="fa fa-envelope"></i> <?=lang('send_message')?></a>
                            </div>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <?php echo form_open(base_url().'messages/search/'); ?>
                            <div class="input-group">
                                <input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('keyword')?>">
										<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit">Go!</button>
										</span>
                            </div>
                            </form>
                        </div>
                    </div> </header>
                <section class="scrollable hover">
                    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                        <div class="panel-body">
                            <!-- message form -->
                            <article class="comment-item media" id="comment-form">
                                <a class="pull-left thumb-sm avatar">

                                    <img src="<?php echo User::avatar_url(User::get_id()); ?>" class="img-circle">
                                </a> <section class="media-body">
                                    <?php
                                    $attributes = array('class' => 'class="m-b-none"');
                                    echo form_open(base_url().'messages/send', $attributes); ?>
                                    <input type="hidden" name="user_to[]" value="<?=$user_from?>">
                                    <input type="hidden" name="r_url" value="<?=current_url()?>">
                                    <section class="panel panel-default">
                                        <textarea class="form-control foeditor-100" name="message" placeholder="<?=lang('enter_message')?>"></textarea>
                                        <footer class="panel-footer bg-light lter">
                                            <button class="btn btn-<?=config_item('theme_color')?> pull-right btn-sm" type="submit"><?=lang('send_message')?></button>
                                            <ul class="nav nav-pills nav-sm">

                                            </ul> </footer>
                                    </section>
                                    </form> </section> </article>

                            <!-- Conversation Start -->
                            <section class="comment-list block">
                                <?php
                                $this->load->helper('text');
                                foreach (Message::conversation($user_from) as $key => $msg) { ?>
                                    <article id="comment-id-1" class="comment-item">

                                        <a class="pull-left thumb-sm avatar">
                                            <img src="<?php echo User::avatar_url($msg->user_from); ?>" class="img-circle">
                                        </a>
                                        <span class="arrow left"></span>
                                        <section class="comment-body panel panel-default">
                                            <header class="panel-heading bg-white">
                                                <a href="#">
                                                    <?=ucfirst(User::displayName($msg->user_from))?>
                                                </a>
					<span class="text-muted m-l-sm pull-right">
					<?php if($msg->user_from != User::get_id()) { ?>
                        <a href="<?=base_url()?>messages/favourite/<?=$msg->msg_id?>" title="<?=lang('favourite')?>">
                            <i class="fa <?=($msg->favourite) ? 'fa-heart text-danger' : 'fa-heart-o';?> text-danger"></i>
                        </a>
                    <?php } ?>


                        <i class="fa fa-clock-o"></i>
                        <?php echo Applib::time_elapsed_string(strtotime($msg->date_received)); ?>
                        <?php
                        if ($msg->user_to == User::get_id()) { ?>
                            <a href="<?=base_url()?>messages/delete/<?=$msg->msg_id?>" data-toggle="ajaxModal" class="btn btn-danger btn-xs active"><i class="fa fa-trash-o text-white text-active"></i>
                            </a>
                        <?php } ?></span>
                                            </header>
                                            <div class="panel-body"><div><?=nl2br($msg->message);?></div>

                                            </div>
                                        </section>
                                    </article>
                                <?php } ?>
                                <!-- .message-end -->

                            </section>
                        </div>
                    </div></section>


            </section></aside>
    </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>