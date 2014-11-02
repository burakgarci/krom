<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post() ?>
	<article <?php post_class('kutu yazi') ?>>
		<?php if (has_title()): ?>
			<h1 class="kutu-baslik">
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
			</h1>
		<?php endif ?>

		<?php if (!empty_content()): ?>
			<div class="yazi-icerigi">
				<?php the_content() ?>
				<div class="clear"></div>
			</div>
		<?php endif ?>

		<div class="yazi-bilgileri">
			<span class="yazi-bilgisi"><?php the_time( get_option( 'date_format' )) ?></span>
			<?php edit_post_link('Düzenle', '<span>', '</span>'); ?>
		</div>

	</article>
	<?php comments_template() ?>
<?php endwhile; else: ?>
	<div class="kutu">
		<div class="kutu-baslik">Bulunamadı...</div>
		<p>İlgili içerik mecvut değil.</p>
		<?php get_search_form() ?>
	</div>
<?php endif ?>
</div>
<?php get_sidebar() ?>
<?php get_footer() ?>
