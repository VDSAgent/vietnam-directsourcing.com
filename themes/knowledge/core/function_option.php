<?php
function logo_knowledgetheme() {
	global $tp_options;
	if(	isset($tp_options['logo-on']) 
		&& $tp_options['logo-on'] != 0 
		&& isset($tp_options['logo-image']['url']) 
		&& $tp_options['logo-image']['url'] != ''){		
		?>
		<a class="" href="<?php echo site_url();?>"><img class="img-fluid" src="<?php echo $tp_options['logo-image']['url'];?>" alt="logo"/></a>
		<?php
	}else{
		?>
		<a class="" href="<?php echo site_url();?>"><?php echo get_bloginfo();?></a>
		<?php
	}
}
function logo_footer_knowledgetheme() {
	global $tp_options;
	if(	isset($tp_options['logo-on-footer']) 
		&& $tp_options['logo-on-footer'] != 0 
		&& isset($tp_options['logo-image-footer']['url']) 
		&& $tp_options['logo-image-footer']['url'] != ''){		
		?>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 logo_footer">
				<a href="<?php echo home_url();?>"><img src="<?php echo $tp_options['logo-image-footer']['url'];?>" class="detail-logo_footer" /></a>
			</div>
		</div>
	<?php	
	}
}
function footer_infor_knowledgetheme() {
	global $tp_options;
	if( $tp_options['copyright-main'] != '' || $tp_options['footerinfo-main'] != ''){ ?>
			<div class="row align-items-center">
				<?php if($tp_options['copyright-main'] != ''){ ?>
	                <div class="col-lg-6 col-md-7">
	                        <div class="copyright mb-45 text-start text-md-start">
	                            <p><?php echo $tp_options['copyright-main'];?></p>
	                        </div>
	                </div>
            	<?php } ?>
            	<?php if($tp_options['footerinfo-main'] != ''){ ?>
                <div class="col-lg-6 col-md-5 text-md-end">
                         <div class="footer__widget mb-25">
                            <?php echo 	$tp_options['footerinfo-main'];?>
                        </div>
                </div>
                <?php } ?>
            </div>
		<?php		
	}
}
function footer_social_knowledgetheme() {
	global $tp_options;
	if( $tp_options['social-facebook'] != ''
		|| $tp_options['social-twitter'] != ''
		|| $tp_options['social-pinterest'] != ''
		|| $tp_options['social-instagram'] != ''
		|| $tp_options['social-googleplus'] != ''
		|| $tp_options['social-youtube'] != ''
		|| $tp_options['social-linkedin'] != ''
		)
	{
	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 social-footer">
			<ul class="detail-social">
				<?php
					if($tp_options['social-linkedin'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-linkedin'];?>" target="_blank">
								<i class="fa fa-linkedin"></i>
							</a>
						</li>
					<?php
					}
					if($tp_options['social-twitter'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-twitter'];?>" target="_blank">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					<?php
					}
					if($tp_options['social-instagram'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-instagram'];?>" target="_blank">
								<i class="fa fa-instagram"></i>
							</a>
						</li>
					<?php
					}
					if($tp_options['social-facebook'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-facebook'];?>" target="_blank">
								<i class="fa fa-facebook-official"></i>
							</a>
						</li>
					<?php
					}
					if($tp_options['social-pinterest'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-pinterest'];?>" target="_blank">
								<i class="fa fa-pinterest-p"></i>
							</a>
						</li>
					<?php
					}
					if($tp_options['social-googleplus'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-googleplus'];?>" target="_blank">
								<i class="fa fa-google-plus"></i>
							</a>
						</li>
					<?php
					}
					if($tp_options['social-youtube'] != ''){?>
						<li>
							<a href="<?php echo $tp_options['social-youtube'];?>" target="_blank">
								<i class="fa fa-youtube"></i>
							</a>
						</li>
					<?php
					}
				?>
			</ul>
		</div>
	</div>
<?php	
	}
}
function back_to_top_knowledgetheme() {
	global $tp_options;
	if(	isset($tp_options['status-back-top']) 
		&& $tp_options['status-back-top'] != 0 ){		
		?>
		<a href="#" class="back-to-top" style="">
		</a>
	<?php	
	}
}
?>