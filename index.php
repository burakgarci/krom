<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post() ?>
<article <?php post_class('kutu ozet') ?>>
	<?php if (has_title()): ?>
	<h1 class="kutu-baslik">
		<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
	</h1>
	<?php endif ?>

	<?php if (has_post_thumbnail()): ?>
	<div class="yazi-gorseli">
	<?php the_post_thumbnail( 'thumbnail' ) ?>
	</div>
	<?php endif ?>

	<?php if (!empty_content()): ?>
	<div class="yazi-icerigi">
	<?php the_excerpt()?>
	</div>
	<?php endif ?>

	<div class="clear"></div>
	<div class="yazi-bilgileri">

	<span class="yazi-bilgisi">
	<a href="<?php the_permalink() ?>"><?php the_time( get_option( 'date_format' ) ) ?></a>
	</span>

	<?php if (has_category()): ?>
	<span class="yazi-bilgisi">
	<?php the_category(', ') ?>
	</span>
	<?php endif ?>

	<?php if ( comments_open() && ! post_password_required()): ?>
	<span class="yazi-bilgisi">
	<a href="<?php the_permalink() ?>#comments"><?php comments_number('Yorumla', '1 yorum', '% yorum' ) ?></a>
	</span>
	<?php endif ?>

	<?php edit_post_link('Düzenle', '<span>', '</span>'); ?>

	</div>
</article>
<?php endwhile ?>
<div class="clear"></div>
<div class="nav-previous alignleft"><?php next_posts_link( 'Önceki yazılar' ); ?></div>
<div class="nav-next alignright"><?php previous_posts_link( 'Sonraki yazılar' ); ?></div>
<div class="clear"></div>
<?php else: ?>
<div class="kutu">
<div class="kutu-baslik">Bulunamadı...</div>
<p>İlgili içerik mecvut değil.</p>
<?php get_search_form() ?>
</div>
<?php endif ?>
</div>
<?php get_sidebar() ?>
<?php get_footer() ?>
