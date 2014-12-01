<?php
/**
 *
 * Krom fonksiyonlar, ayarlar, tanımlamalar
 *
 * "kroma" kısaltması "krom ayar" için olarak kullanmıştır.
 *
 */

function krom_ana_menu(){
	wp_nav_menu( array(
		'theme_location'	=> 'ana-menu',
		'sort_column'		=> 'menu_order',
		'fallback_cb'		=> false,
		'menu_class'		=> 'ana-menu clear',
		'depth'				=> 2,
	));
}

/**
* Yerleşim ayarı değerini body classları arasına yazdır
*/
function krom_yerlesim_classlari($classlar){
	$classlar[] = get_theme_mod('kroma_yerlesim', 'icerik-yan');
	return $classlar;
}
add_filter('body_class', 'krom_yerlesim_classlari');


/**
 * Eğer rastgele özet kenarlık renkleri açıksa post_class fonksiyonuna rengin sınıfını ekle
 */
function kenarlik_renklerini_uygula( $classes ) {

	$renkler = array("000000", "000080", "0000ff", "008000", "008080", "00ff00", "00ffff", "1abc9c", "2ecc71", "336E7B", "34495e", "3498db", "800000", "808080", "8f00ff", "964B00", "9b59b6", "c0c0c0", "DB0A5B", "e67e22", "dd4b4c", "f1c40f", "ff0000", "ff00ff", "ffff00", "ffffff");

	$r = array_rand($renkler);
	$onceki_renk = $r;
	$kenarlik_rengi =  $renkler[$r];

	if (get_theme_mod('kroma_rastgele_renkler', 'acik') == 'acik') {
		$classes[] = "kenarlik-".$kenarlik_rengi;
	}

	return $classes;
}
add_filter( 'post_class', 'kenarlik_renklerini_uygula' );

/**
* Üst kısım açık mı ?
*/
function krom_ust_alan(){
	if (get_theme_mod('kroma_ust_alan', 'acik') == 'acik') {
		return true;
	} else {
		return false;
	}
}

/**
* Üst kısım arama formu açık mı ?
*/
function krom_ust_arama(){
	if (get_theme_mod('kroma_ust_arama', 'acik') == 'acik') {
		return true;
	} else {
		return false;
	}
}

/**
* Paylaş butonları açık mı? Açıksa yazdır
*/
function krom_paylasim_butonlari(){
	if (get_theme_mod('kroma_paylas_butonlari', 'acik') == 'acik') {
		$baslik = rawurlencode(get_the_title());
		$baglanti = rawurlencode(wp_get_shortlink());
		$aciklama = rawurlencode(mb_substr(strip_tags(get_the_excerpt()), 0, 100))."...";
		?>
		<div class="yaziyi-paylas">
			<strong>Paylaş:</strong>
			<span class="paylas">
				<a target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=600');return false;" href="http://facebook.com/share.php?u=<?php echo $baglanti ?>">Facebook</a>
			</span>
			<span class="paylas">
				<a target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=600');return false;" href="http://twitter.com/home?status=<?php echo $baslik.'%20'.$baglanti ?>">Twitter</a>
			</span>
			<span class="paylas">
				<a target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=600');return false;" href="https://plus.google.com/share?url=<?php echo $baglanti ?>">Google+</a>
			</span>
			<span class="paylas">
				<a target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=600');return false;" href="http://www.tumblr.com/share/link?url=<?php echo $baglanti ?>&amp;name=<?php echo $baslik ?>&amp;description=<?php echo $aciklama ?>">Tumblr</a>
			</span>
			<?php if (has_post_thumbnail()): ?>
			<span class="paylas">
				<a target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=600');return false;" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?>&amp;url=<?php echo $baglanti ?>&amp;is_video=false&amp;description=<?php echo $baslik.'%20-%20'.$aciklama ?>">Pinterest</a>
			</span>
			<?php endif ?>
		</div>
		<?php
	} else {
		return false;
	}
}

/**
* Logo varsa logoyu yazdır.
*/
function krom_logo(){
	if (!get_theme_mod('krom_logo')) {
		return false;
	} else {
		echo '<img src="'.get_theme_mod('krom_logo').'" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('name').'">';
		return true;
	}
}

/**
* Tema özelleştirme ayarları
*/
function krom_theme_customizer( $wp_customize ) {

	/**
	*     Site yerleşimi için alan ve site yerleşimi seçimi
	*/
	$wp_customize->add_section( 'krom_yerlesimi' , array(
				'title'       => 'Yerleşim',
				'priority'    => 2,
				'description' => 'İçeriğinize göre en uygun yerleşimi seçin.',
				) );

	$wp_customize->add_setting('kroma_yerlesim', array(
				'default'        => 'icerik-yan',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'kroma_kontrol',
				));

	$wp_customize->add_control('krom_yerlesim_secenek', array(
				'label'      => 'Site Genel Yerleşimi',
				'section'    => 'krom_yerlesimi',
				'settings'   => 'kroma_yerlesim',
				'type'       => 'radio',
				'choices'    => array(
							'tek-dar' => 'Tek sütun ve dar',
							'tek-normal' => 'Tek sütun ve normal',
							'tek-genis' => 'Tek sütun ve geniş',
							'icerik-yan' => 'İçerik + yan sütun',
							'yan-icerik' => 'Yan sütun + içerik',
							),
				));


	/**
	* Logo işlemleri için bölüm ve logo işlemleri
	*/
	$wp_customize->add_section( 'krom_logo_section' , array(
				'title'       => 'Logo',
				'priority'    => 1,
				'description' => 'Üst kısımda gösterilmek üzere bir logo yükleyin. Önerilen boyut <strong>300 x 65 piksel</strong>. Yükseklik her durumda <strong>65px</strong> olarak ayarlanacak!',
				) );

	$wp_customize->add_setting('krom_logo', array(
				// 'default'      		=> esc_url( get_template_directory_uri() ).'/images/logo.png',
				'capability'   		=> 'edit_theme_options',
				'sanitize_callback' => 'kroma_kontrol',
				));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'krom_logo', array(
				'label'    => 'Logo',
				'section'  => 'krom_logo_section',
				'settings' => 'krom_logo',
				) ) );

	/**
	* Diğer tema ayarları için bölüm ve diğer tema ayarları
	*/
	$wp_customize->add_section( 'krom_ayarlari' , array(
				'title'       => 'Krom Ayarları',
				'priority'    => 0,
				'description' => 'Tema ile ilgili çeşitli ayarlar. Ayarlama yapmadan <span style="color:#f10">önce yardım dökümanlarını okuyun.</span>',
				) );

	/**
	 * Üst kısımı aç/kapat
	 */
	$wp_customize->add_setting('kroma_ust_alan', array(
				'default'        => 'acik',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'kroma_kontrol',
				));

	$wp_customize->add_control('ust_alan_acik_kapali', array(
				'label'      => 'Üst Kısım',
				'section'    => 'krom_ayarlari',
				'settings'   => 'kroma_ust_alan',
				'type'       => 'radio',
				'choices'    => array(
							'acik' => 'Açık',
							'kapali' => 'Kapalı',
							),
				));

	/**
	 * Üst kısımda arama formunu aç/kapat
	 */
	$wp_customize->add_setting('kroma_ust_arama', array(
				'default'        => 'acik',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'kroma_kontrol',
				));

	$wp_customize->add_control('ust_arama_acik_kapali', array(
				'label'      => 'Üst Kısımda Arama Kutusu',
				'section'    => 'krom_ayarlari',
				'settings'   => 'kroma_ust_arama',
				'type'       => 'radio',
				'choices'    => array(
							'acik' => 'Açık',
							'kapali' => 'Kapalı',
							),
				));

	/**
	 * Paylaş butonlarını aç/kapat
	 */
	$wp_customize->add_setting('kroma_paylas_butonlari', array(
				'default'        => 'acik',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'kroma_kontrol',
				));

	$wp_customize->add_control('paylas_butonlari_acik_kapali', array(
				'label'      => 'Paylaş Butonları',
				'section'    => 'krom_ayarlari',
				'settings'   => 'kroma_paylas_butonlari',
				'type'       => 'radio',
				'choices'    => array(
							'acik' => 'Açık',
							'kapali' => 'Kapalı',
							),
				));

	/**
	 * Kutu üst kenarlığa rastgele renkler
	 */
	$wp_customize->add_setting('kroma_rastgele_renkler', array(
				'default'        => 'acik',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'kroma_kontrol',
				));

	$wp_customize->add_control('rastgele_renkler_acik_kapali', array(
				'label'      => 'Rastgele Kutu Kenarlık Rengi',
				'section'    => 'krom_ayarlari',
				'settings'   => 'kroma_rastgele_renkler',
				'type'       => 'radio',
				'choices'    => array(
							'acik'    => 'Açık',
							'kapali'  => 'Kapalı',
							),
				));

	/**
	 * Alt kısım gösterilecek metin.
	 */
	$wp_customize->add_setting('krom_alt_metin', array(
				'capability'         => 'edit_theme_options',
				'sanitize_callback'  => 'kroma_kontrol',
				'default'            => '&copy; '. date('Y') .' <a href="'. esc_url( home_url() ) .'">'. get_bloginfo('display') .'</a>, bazı hakları saklıdır. <strong>Krom</strong> teması <a href="http://burakgarci.net">Burak Garcı</a> tarafından...',
				));

	class Textarea_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	$wp_customize->add_control('kroma_alt_metin', array(
				'label'      => 'Alt Kısım Metni',
				'section'    => 'krom_ayarlari',
				'settings'   => 'krom_alt_metin',
				'type'		 => 'textarea'
				));

	/**
	 * Kutu arkaplan rengi
	 */
    $wp_customize->add_setting('kroma_kutu_arkaplan_rengi', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'kroma_kontrol',
        'capability'        => 'edit_theme_options',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'kroma_kutu_arkaplan_rengi', array(
        'label'    =>  'Kutu arkaplan rengi',
        'section'  => 'colors',
        'settings' => 'kroma_kutu_arkaplan_rengi',
    )));

	/**
	 * Kutu üst kenarlık rengi
	 */
    $wp_customize->add_setting('kroma_kutu_kenarlik_rengi', array(
        'default'           => '#3e3e3e',
        'sanitize_callback' => 'kroma_kontrol',
        'capability'        => 'edit_theme_options',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'kroma_kutu_kenarlik_rengi', array(
        'label'    => 'Kutu üst kenarlık rengi',
        'section'  => 'colors',
        'settings' => 'kroma_kutu_kenarlik_rengi',
    )));

	/**
	 * Kutu yazi rengi
	 */
    $wp_customize->add_setting('kroma_kutu_yazi_rengi', array(
        'default'           => '#444',
        'sanitize_callback' => 'kroma_kontrol',
        'capability'        => 'edit_theme_options',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'kroma_kutu_yazi_rengi', array(
        'label'    => 'Kutu yazi rengi',
        'section'  => 'colors',
        'settings' => 'kroma_kutu_yazi_rengi',
    )));

}
add_action('customize_register', 'krom_theme_customizer');

/**
 * Tema özelleştirme panelinde seçilen renkleri uygula
 */
function ozel_renkleri_uygula(){

	if ( get_theme_mod('kroma_kutu_arkaplan_rengi') !== '#f9f9f9' ) {
		$eklenecek_stil = '.yorum-sag {background-color: '.get_theme_mod('kroma_kutu_arkaplan_rengi').'}';
	}

	?>
	<style id="ozellestirilmis-renkler">
		.kutu,
		#respond {
			background-color: <?php echo get_theme_mod('kroma_kutu_arkaplan_rengi', '#f9f9f9') ?>;
			border-top-color: <?php echo get_theme_mod('kroma_kutu_kenarlik_rengi', '#3e3e3e') ?>;
		}

		.kutu,
		#respond,
		.kutu-baslik,
		#reply-title,
		.kutu-baslik a:not(:hover),
		#reply-title a:not(:hover),
		.yazi-bilgileri a:not(:hover),
		#kenar-icerik a:not(:hover) {
			color: <?php echo get_theme_mod('kroma_kutu_yazi_rengi', '#444') ?>;
		}

		pre,
		table,
		blockquote {
			background-color: #f5f5f5;
			color: #444;
		}
	<?php echo @$eklenecek_stil ?>
	</style>
	<?php
}
add_action('wp_head', 'ozel_renkleri_uygula');

/**
 * Tema özelleştirme ayarlarını kontrol et
 */
function kroma_kontrol( $value ){
	return $value;
}

/**
 * Özel arkaplan desteği ekle
 */
$defaults = array(
                  'default-color'		=> 'efefef',
                  );
add_theme_support( 'custom-background', $defaults );

/**
 * Üst kısım özelleştirmelerini uygula
 */
function ozel_ust_kisim_uygula() {
	echo '<style id="ozel-ust-kisim-css">@media screen and (min-width: 768px) {';

	/**
	 * Arkaplan resmini al
	 */
	if (get_header_image()) {
		echo '#ust { background-image: url('.get_header_image().') !important}';
	}

	/**
	 * Başlık rengini al (Sadece logoya uygular)
	 */
	if ('blank' !== get_header_textcolor()) {
		echo '#logo a:not(:hover) { color: #'.get_header_textcolor().' !important}';
	} else {
		echo '#logo { display: none !important}';
	}

	echo '}</style>';
}
add_action('wp_head','ozel_ust_kisim_uygula');

/**
 * Üst kısım için arkdaplan resimleri ekle
 */
register_default_headers( array(
                         'balon' => array(
                                          'url'           => '%s/images/ust/balon.jpg',
                                          'thumbnail_url' => '%s/images/ust/balon_thumb.jpg',
                                          'description'   => 'Balon'
                                          ),
                         'bulutlar' => array(
                                             'url'           => '%s/images/ust/bulutlar.jpg',
                                             'thumbnail_url' => '%s/images/ust/bulutlar_thumb.jpg',
                                             'description'   => 'Bulutlar'
                                             ),
                         'istanbul' => array(
                                             'url'           => '%s/images/ust/istanbul.jpg',
                                             'thumbnail_url' => '%s/images/ust/istanbul_thumb.jpg',
                                             'description'   => 'İstanbul'
                                             ),
                         'kir' => array(
                                        'url'           => '%s/images/ust/kir.jpg',
                                        'thumbnail_url' => '%s/images/ust/kir_thumb.jpg',
                                        'description'   => 'Kir'
                                        ),
                         'kitap' => array(
                                          'url'           => '%s/images/ust/kitap.jpg',
                                          'thumbnail_url' => '%s/images/ust/kitap_thumb.jpg',
                                          'description'   => 'Kitap'
                                          ),
                         'sahil' => array(
                                          'url'           => '%s/images/ust/sahil.jpg',
                                          'thumbnail_url' => '%s/images/ust/sahil_thumb.jpg',
                                          'description'   => 'Sahil'
                                          ),
                         'sehir' => array(
                                          'url'           => '%s/images/ust/sehir.jpg',
                                          'thumbnail_url' => '%s/images/ust/sehir_thumb.jpg',
                                          'description'   => 'Sehir'
                                          )
                         ) );

/**
 * Özel üst arkaplan resmi desteği
 */
$args = array(
              'flex-width'    => true,
              'width'         => 1500,
              'flex-height'    => true,
              'height'        => 180,
              'default-image' => get_template_directory_uri() . '/images/ust/sehir.jpg',
              'uploads'       => true,
              'default-text-color'     => 'fff',
              );
add_theme_support( 'custom-header', $args );

/**
 *  HTML5 desteği
 */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/**
 *  Feed linkleri
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Menüleri ekle
 */
add_theme_support( 'nav-menus' );
register_nav_menu('ana-menu', 'Navigasyon Menüsü');
register_nav_menu('sosyal-menu', 'Sosyal Menü');

/**
 * Öne çıkarılmıış görsel desteği
 */
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
set_post_thumbnail_size( 150, 150 );

/**
 * Gerkesiz şeyler :)
 */
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/*
 * Sayfa oluşturulmasını geciktirmemek için sayfa altındaki scriptlere defer niteliği ekle.
 */
function defer_niteligi_ekle ( $url ) {
	if ( FALSE === strpos( $url, '.js' ) ) {
		return $url;
	}
	if ( strpos( $url, '/jquery' ) ) {
		return $url;
	}
	return "$url' defer='defer"; # Tırnaklarda bir sıkıntı yok.
}
add_filter( 'clean_url', 'defer_niteligi_ekle', 11, 1 );


/**
 * Stilleri ve scriptleri ekle
 */
function stiller_ve_scriptler() {

	// SCRIPT_DEBUG açılmışsa .min kullanma 
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_style( 'anastil', esc_url( get_stylesheet_directory_uri() )."/style$suffix.css", array(), '1.0.0', 'screen'  );
	wp_enqueue_script( 'jquery-1.11.1.min.js', esc_url( get_template_directory_uri() ).'/js/jquery-1.11.1.min.js', array(), '1.11.1', true );
	wp_enqueue_script( 'script.js', esc_url( get_template_directory_uri() )."/js/script{$suffix}.js", array(), '1.0.0', true );
	if ( is_singular() ) { wp_enqueue_script( "comment-reply" ); }

}
add_action( 'wp_enqueue_scripts', 'stiller_ve_scriptler' );


/**
 * Yazı boş mu değil mi
 */
function has_title(){
	$title = trim(get_the_title());
	if (empty($title)) {
		return false;
	} else {
		return true;
	}
}


/**
 * Sayfa başlığı düzeltmesi
 */
function baslik_duzelt( $title ) {
	if( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return get_bloginfo( 'display' );
	}
	return trim($title);
}
add_filter( 'wp_title', 'baslik_duzelt' );

/**
 * Varsayılan içerik genişliği
 */
if ( ! isset( $content_width ) ) {
	$content_width = 702; /* pixels */
}

/**
 * Özel özet uzunluğu
 */
function custom_excerpt_length( $length ){
	return 65;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * "category" değeri "rel" niteliği için html5'de geçersiz. rel="tag" olarak düzeltilmesi gerekiyor
 */
function rel_cat_duzelt( $text ) {
	$text = str_replace('rel="category tag"', 'rel="tag"', $text);
	return $text;
}
add_filter( 'the_category', 'rel_cat_duzelt' );

/**
 * Özet sonuna devam linki ekle/değiştir
 */
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">devamı &rarr;</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


/**
 * içeriğin boş olup olmadığını kontrol et
 */
function empty_content(){
	$content = trim(get_the_content(''));
	if (empty($content)) {
		return true;
	} else {
		return false;
	}
}


/**
 * Bileşen Desteği
 */
function krom_widgets_init() {
	register_sidebar( array(
	                 'name' => 'Birincil Yan Sütun',
	                 'id' => 'birincil-sidebar',
	                 'description' => 'Buradaki bileşenler tüm yazı ve sayfalarda göstrerilecek.',
	                 'before_widget' => '<div class="kutu">',
	                 'before_title' => '<h3 class="kutu-baslik">',
	                 'after_title' => '</h3>',
	                 'after_widget' => '</div>',
	                 ) );
}
add_action( 'widgets_init', 'krom_widgets_init' );


/**
 * Yorumları listele
 */
function krom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<?php if ( $comment->comment_type == "" ): ?>

	<li <?php comment_class('yorum') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment ); ?>
		<div class="yorum-sag">
			<div class="yorum-ust">
				<span class="yorum-yazari">
					<?php comment_author_link() ?>
				</span>
				<span class="yorum-ust-sag">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>">
						<time datetime="<?php comment_time( 'c' ) ?>"><?php comment_date() ?> - <?php comment_time() ?></time>
					</a>&nbsp;
					<?php comment_reply_link( array('depth' => $depth, 'max_depth' => $args['max_depth']), $comment->comment_ID ) ?>
					<?php edit_comment_link( 'Düzenle', '&nbsp;') ?>
				</span>
			</div> <!-- yorum-ust -->
			<div class="yorum-icerik">
				<?php comment_text(); ?>
			</div> <!-- .yorum-icerik -->
		</div> <!-- .yorum-sag -->
		<div class="clear"></div>
	<!-- WordPress zaten bir tane "</li>" ekliyor -->
	<?php endif; } ?>
