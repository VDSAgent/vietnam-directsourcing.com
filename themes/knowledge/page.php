<?php get_header();?>
<?php
global $tp_options;
$images_bg=get_field('images_bg');
//var_dump($images_bg);
//die();
$title_page=get_field('title_page');
if(!is_front_page() && !is_home()){
?>
	<div class="images-bg">
		<?php
		if(!empty($images_bg)){
			?>
			<div class="detail">
				<img src="<?php echo $images_bg; ?>" class="images-background" />
			</div>
		<?php
		}
		else{ ?>
			<div class="detail">
				<img src="<?php echo site_url();?>/wp-content/uploads/2016/05/imageabouts.png" class="images-background" />
			</div>
		<?php 
		}
		if(!empty($title_page)){
			$title_page=get_field('title_page');
		}
		else{
			$title_page=get_the_title();
		}
			?>
			<div class="title-custom-page">
				<div class="container">
					<div class="row">
						<div class="detail-title-page">
							<h1 class="title-page">
								<?php
									echo $title_page;
								?>
							</h1>
						</div>
					</div>
				</div>
			</div>
	</div>
<?php
}
?>
<?php
if(is_front_page() || is_home()){
$images_bg_home=get_field('images');
$title_page_home=get_field('title');
$text_link_page_home=get_field('text_link');
$description_page_home=get_field('description');
$link_page_home=get_field('link');
?>
<div class="images-top-home">
	<div class="diamond-left"></div>
	<img src="<?php echo $images_bg_home;?>"/>
		<div class="container content-title-homepage">
			<div class="row">
				<div class="detail-title-homepage">			
					<h1 class="title-home-page">
						<?php echo $title_page_home;?>
					</h1>
					<p class="description-title-homepage">
						<?php echo $description_page_home;?>
					</p>
					<p class="link-title-homepage">
						<a href="<?php echo $link_page_home;?>"><?php echo $text_link_page_home;?></a> 
					</p>
				</div>
			</div>
		</div>
</div>
<?php
}
if(!is_home()&&!is_front_page()){
	$add_class_width="width-700-padding-right";
?>
<!--<div class="custom-breadcrumbs">
  
</div>-->
<?php
$bg_custom=get_field('background_top_content');
if(!empty($bg_custom)){
	$color_bg="rgba(0, 0, 0, 0)";
}
else{
	$color_bg="#72a088";
}
?>
<div class="custom-top-content" style="padding-bottom: 50px; background: <?php echo $color_bg;?> url('<?php echo $bg_custom;?>') no-repeat scroll 0 0 / cover">
	<div class="container">
		<div class="row">
		    <?php
		      custom_breadcrumbs();
		    ?>
		</div>
	</div>
	<div class="container <?php echo $add_class_width;?>">
		<div class="row">
		    <?php
		      	$title_content=get_field('title_content');
				$text_content=get_field('text_content');
		    ?>
		    <h2 class="title-text-page">
		    	<?php
		    		echo $title_content;
		    	?>
		    </h2>
		    <div class="text_content_pages">
		    	<?php
		    		echo $text_content;
		    	?>
		    </div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="main-content-pages">
	<div class="container theme-showcase <?php if(!is_home()&&!is_front_page()){ echo 'width-700-padding-right';}?>" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="row">				
				<?php the_content(); ?>
			</div>
		<?php endwhile;
		if(!is_home()&&!is_front_page()){
		?>
			<div class="container main-share-social summary news">
				<?php
					custom_social();
				?>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php
	get_footer();
?>
<?php the_content(); ?>