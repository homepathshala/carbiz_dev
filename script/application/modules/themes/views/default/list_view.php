<?php $CI = get_instance();?>
<div class="blog-one">
	<?php
	if($posts->num_rows()<=0)
	{
		echo '<div class="alert alert-info">'.lang_key('no_posts').'</div>';
	}
	else
	{
    $i = 0;
    foreach($posts->result() as $post){
        $i++;
        $detail_link = post_detail_url($post);
    ?>

    <div class="blog-one-item row">
		<!-- blog One Img -->
		<div class="blog-one-img col-md-3 col-sm-3 col-xs-12">
			<!-- Image -->
			<a href="<?php echo $detail_link;?>">
				<div class="image-style-one">
				<?php if($post->featured == 1){ ?>
                    <span class="hot-tag-list" data-toggle="tooltip" data-placement="left" data-original-title="<?php echo lang_key('featured');?>"><i class="fa fa-bookmark"></i></span>
                <?php } ?>
                    <span class="price-tag" data-toggle="tooltip" data-placement="left" data-original-title="<?php echo lang_key('featured');?>">
                        <?php echo show_price($post->price,$post->ask_for_price);?>
                    </span>
                    <span class="condition-tag" data-toggle="tooltip" data-placement="left" data-original-title="<?php echo lang_key('featured');?>">
                        <?php echo lang_key($post->condition);?>
                    </span>

				<img class="img-responsive img-thumbnail" alt="<?php echo get_post_data_by_lang($post,'title');?>" src="<?php echo get_featured_photo_by_id($post->featured_img);?>">
                </div>
			</a>
		</div>
		<!-- blog One Content -->
		<div class="blog-one-content col-md-9 col-sm-9 col-xs-12">
			<!-- Heading -->
			<h3 style="word-wrap:break-word;"><a href="<?php echo $detail_link;?>"><?php echo get_post_data_by_lang($post,'title');?></a>
				<?php if(get_settings('content_settings','enable_review','Yes')=='Yes'){?>
					<?php $average_rating = $post->rating; ?>
					<?php $half_star_position = check_half_star_position($average_rating); ?>
					<a href="<?php echo $detail_link;?>#review">
					<?php echo get_review_with_half_stars($average_rating,$half_star_position);?>
					</a>
				<?php }?>	
			</h3>
			<!-- Blog meta -->
			<div class="blog-meta">
				<!-- Author -->
				<a href="<?php echo site_url('show/categoryposts/'.$post->category.'/'.dbc_url_title(lang_key(get_category_title_by_id($post->category))));?>">

					<?php $cat_featured_img = $CI->post_model->get_category_featured_img($post->category);?>
					<img src="<?php echo $cat_featured_img;?>" class="cat-img-small-list" />
					<?php echo get_category_title_by_id($post->category); ?>
				</a> &nbsp;
				<!-- Comments -->

				<i class="fa fa-diamond"></i> &nbsp; <?php echo get_brand_model_name_by_id($post->brand).' '.get_brand_model_name_by_id($post->model);?> &nbsp;
				<a href="<?php echo site_url('location-posts/'.$post->city.'/city/'.dbc_url_title(get_location_name_by_id($post->city)));?>"><i class="fa fa-map-marker"></i> &nbsp; <?php echo get_location_name_by_id($post->city);?></a> &nbsp;
                <?php if(get_post_meta($post->id,'hide_my_phone','')!=1){?>
				<i class="fa fa-phone"></i> &nbsp; <?php echo $post->phone_no; ?>
				<?php }else{?>
				<i class="fa fa-phone"></i> &nbsp;
				<?php }?>
			</div>
			<!-- Paragraph -->
			<p><?php echo truncate(strip_tags(get_post_data_by_lang($post,'description')),200,' <a class="see-more" href="'.$detail_link.'">'.lang_key('read_more').'</a>',false);?></p>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php
		}
	}
	?>

</div>
<div class="clearfix"></div>
<?php echo (isset($pages))?'<ul class="pagination">'.$pages.'</ul>':'';?>