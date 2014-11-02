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

		<?php wp_link_pages('before=<p class="yazi-sayfalari">&after=</p>&next_or_number=number&pagelink=Sayfa %'); ?>

		<?php krom_paylasim_butonlari() ?>

		<?php if (has_tag()): ?>
			<?php the_tags('<div class="yazi-etiketleri"><strong>Etiketler: </strong>', ' ', '</div>') ?>
		<?php endif ?>

		<div class="yazi-bilgileri">
			<span class="yazi-bilgisi"><?php the_time( get_option( 'date_format' )) ?> <em>tarihinde</em> </span>
			<span class="yazi-bilgisi"><a href="<?php the_author_meta('url') ?>"><?php the_author('') ?></a>, </span>
			<?php if (has_category()): ?>
				<span class="yazi-bilgisi"><?php the_category(', ') ?> <em>kategorisinde yazdı.</em></span>
			<?php endif ?>
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
