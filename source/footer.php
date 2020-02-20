		<!-- footer -->
		<footer class="footer">
			<div class="container-fluid border_top_gold pt-3">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col">
							<?php if ( is_active_sidebar( 'widget-sponsor-head' ) ) { ?>
						        <?php dynamic_sidebar('widget-sponsor-head'); ?>
							<?php } ?>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-sponsor-1' ) ) { ?>
						        <?php dynamic_sidebar('widget-sponsor-1'); ?>
							<?php } ?>
						</div>
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-sponsor-2' ) ) { ?>
						        <?php dynamic_sidebar('widget-sponsor-2'); ?>
							<?php } ?>
						
						</div>
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-sponsor-3' ) ) { ?>
						        <?php dynamic_sidebar('widget-sponsor-3'); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid gold">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-footer-1' ) ) { ?>
						        <?php dynamic_sidebar('widget-footer-1'); ?>
							<?php } ?>
						</div>
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-footer-2' ) ) { ?>
						        <?php dynamic_sidebar('widget-footer-2'); ?>
							<?php } ?>
						
						</div>
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-footer-3' ) ) { ?>
						        <?php dynamic_sidebar('widget-footer-3'); ?>
							<?php } ?>
						
						</div>
						<div class="col-md-3">
							<?php if ( is_active_sidebar( 'widget-footer-4' ) ) { ?>
						        <?php dynamic_sidebar('widget-footer-4'); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- /footer -->
		<?php wp_footer(); ?>
		<?php if( current_user_can('administrator') ) { ?>

<script>

// -----------
  // Debugger that shows view port size. Helps when making responsive designs.
  // -----------
jQuery(function($){

  function showViewPortSize(display) {
    if(display) {
      var height = window.innerHeight;
      var width = window.innerWidth;
      jQuery('body').prepend('<div id="viewportsize" style="z-index:9999;position:fixed;bottom:0px;left:0px;color:#fff;background:#000;padding:10px">Height: '+height+'<br>Width: '+width+'</div>');
      jQuery(window).resize(function() {
              height = window.innerHeight;
              width = window.innerWidth;
              jQuery('#viewportsize').html('Height: '+height+'<br>Width: '+width);
      });
    }
  }

  $(document).ready(function(){
     showViewPortSize(true);
  });
});
</script>
<?php }; ?>
	</body>
</html>