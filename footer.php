</div>
</div>
<div class="clear"></div>
<div id="alt">
<div class="tut">
	<p id="alt-metin">
		<?php echo get_theme_mod('krom_alt_metin', '&copy; '. date('Y') .' <a href="'. esc_url( home_url() ) .'">'. get_bloginfo('display') .'</a>, bazı hakları saklıdır. <strong>Krom</strong> teması <a href="http://burakgarci.net">Burak Garcı</a> tarafından...') ?>
	</p>

	<div class="clear"></div>

	<?php if (has_nav_menu( "sosyal-menu" )): ?>
	<nav id="sosyal-navigasyon">
			<?php
			wp_nav_menu( array(
				'theme_location'	=> 'sosyal-menu',
				'sort_column'		=> 'menu_order',
				'fallback_cb'		=> false,
				'menu_class'		=> 'sosyal-menu clear',
				'depth'				=> 1,
			))
			?>
	</nav>
	<?php endif ?>

</div>
</div>
<?php wp_footer(); ?>
</body>
</html>