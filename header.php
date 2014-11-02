<!doctype html>
<html <?php language_attributes() ?>>
<head>
	<!-- Tasarım ve geliştirme: Burak Garcı, burakgarci.net, 2014 -->
	<meta charset="UTF-8">
	<title><?php wp_title('', true, 'right'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
	wp_head();
	?>
</head>
<body <?php body_class() ?>>
	<div id="ust">

		<?php if (krom_ust_alan()): ?>
			<div class="tut">
				<div id="logo">

					<?php if ( ! krom_logo() ): ?>
						<a href="<?php echo esc_url( home_url() ) ?>" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a>
					<?php endif ?>

				</div>

				<?php if (krom_ust_arama()): ?>
					<div id="ust-arama-gecis" tabindex="0">
						<span>Ara</span>
					</div>
					<div id="ust-arama">
						<form role="search" method="get" action="<?php echo home_url( '/' ) ?>">
							<!-- <input type="search" name="s" id="ust-arama-metni"> -->
							<input type="text" name="s" id="ust-arama-metni" required>
							<button type="submit" id="ust-arama-butonu">
								<span id="ust-arama-butonu-resmi"></span>
								<span id="ust-arama-butonu-metni">Ara</span>
							</button>
							<div class="clear"></div>
						</form>
					</div>
				<?php endif ?>

				<div class="clear"></div>
			</div>
		<?php endif ?>

		<nav id="ana-navigasyon">
			<div class="tut">
				<div id="ana-menu-gecis" tabindex="0">
					<span>Menü</span>
					<span class="menu-ikon">
						<span class="i1"></span>
						<span class="i2"></span>
						<span class="i3"></span>
					</span>
				</div>
				<?php if (has_nav_menu( "ana-menu" )): ?>
					<?php krom_ana_menu() ?>
				<?php else: ?>
					<ul class="ana-menu clear">
						<li><a href="<?php echo esc_url( home_url() ) ?>">Anasayfa</a></li>
						<li><a href="<?php echo esc_url( home_url() ) ?>/wp-admin/nav-menus.php">Menü seçin</a></li>
						<li><a href="http://burakgarci.net/?s=krom&amp;ref=<?php echo esc_url( home_url() ) ?>">Krom Teması</a></li>
						<li><a href="http://burakgarci.net/?ref=<?php echo esc_url( home_url() ) ?>">Burak Garcı</a></li>
					</ul>
				<?php endif ?>
				<div class="clear"></div>
			</div>
		</nav>
	</div>
	<div id="ana">
		<div class="tut">
			<?php if ( is_active_sidebar( 'birincil-sidebar' ) ): ?>
				<div id="ana-icerik">
			<?php else: ?>
				<div id="ana-icerik" class="genis-icerik">
			<?php endif; ?>
