<?php

if ( post_password_required() )
	return;
?>

<?php if ( have_comments() ) : ?>
	<div id="yorumlar" class="kutu">
		<h1 class="kutu-baslik">
			<?php comments_number('Henüz Yorum Yapılmamış. Tartışmaya Siz Başlatın','1 Yorum Yapılmış. Tartışmaya Katılın','% Yorum Yapılmış. Tartışmaya Katılın'); ?>
		</h1>

		<ol class="yorum-listesi">
			<?php wp_list_comments( array(
			                       'style'			=> 'ol',
			                       'short_ping'		=> false,
			                       'avatar_size'	=> 60,
			                       'callback'		=> 'krom_comment',
			                       'format'			=> 'html5' ));
			?>
		</ol>

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
		<nav class="navigation comment-navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( '&larr; Eski Yorumlar' ); ?></div>
			<div class="nav-next"><?php next_comments_link( 'Yeni Yorumlar &rarr;' ); ?></div>
			<div class="clear"></div>
		</nav>
	<?php endif;?>
</div>

<?php endif; ?>

<?php if ( ! comments_open() && ! is_page()) : ?>
	<div id="yorumlar" class="kutu yorumlar-kapali">
		<?php echo 'Bu yazı yorumlara kapatılmış.'; ?>
	</div>
<?php endif; ?>

<?php comment_form(array('comment_notes_before' => '', 'comment_notes_after' => '')); ?>
