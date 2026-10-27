<?php
/**
 * Header logo: the VDS lockup, inline so the wordmark renders in Montserrat SemiBold
 * (loaded as a subset of its own letters, see functions.php) and its colour follows the
 * header via currentColor: white over the photo hero, Deep Navy on the sticky white
 * header. The arrowhead stays Signal Gold (brand guidelines v1.2).
 */
function logo_knowledgetheme() {
	?>
	<a class="vds-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><svg viewBox="0 0 360 56" width="360" height="56" role="img" aria-label="Vietnam Direct Sourcing"><line x1="20" y1="28" x2="35" y2="28" stroke="currentColor" stroke-width="3.4" stroke-linecap="round"/><circle cx="19" cy="28" r="6" fill="currentColor"/><path d="M35 20 L43 28 L35 36" fill="none" stroke="#E3A23A" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/><text x="60" y="36" fill="currentColor" font-family="Montserrat, 'Helvetica Neue', Arial, sans-serif" font-weight="600" font-size="23" letter-spacing="-0.1">Vietnam Direct Sourcing</text></svg></a>
	<?php
}
function footer_infor_knowledgetheme() {
	global $tp_options;
	if( ! empty( $tp_options['copyright-main'] ) || ! empty( $tp_options['footerinfo-main'] )){ ?>
			<div class="row align-items-center">
				<?php if(! empty( $tp_options['copyright-main'] )){ ?>
	                <div class="col-lg-6 col-md-7">
	                        <div class="copyright mb-45 text-start text-md-start">
	                            <p><?php echo $tp_options['copyright-main'];?></p>
	                        </div>
	                </div>
            	<?php } ?>
            	<?php if(! empty( $tp_options['footerinfo-main'] )){ ?>
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
?>