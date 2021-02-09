<?php
/**
 * maraphon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package maraphon
 */

//Обновление версии style.css для сброса кеша у пользователей
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.4.16' );
}


//автоматическое добавление первой картинки к изображению записи
/*add_action('future_to_publish', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('save_post', 'autoset_featured');

function autoset_featured() {
	global $post;
	// проверка на наличие миниатюры посте
	if( get_post_type($post->ID) != 'razbor') {
		return;
	};

	if( has_post_thumbnail($post->ID) )
		return;

	$attached_image = get_children( array(
		'post_parent'=>$post->ID, 'post_type'=>'attachment', 'post_mime_type'=>'image', 'numberposts'=>1, 'order'=>'ASC'
	) );
	// делаем условие проверку на наличие картинки
	if( $attached_image ){
		foreach ($attached_image as $attachment_id => $attachment)
			set_post_thumbnail($post->ID, $attachment_id);
	}
}*/

//удаление лишних элементов в админке
add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
	remove_menu_page('perfopsone-settings');
	remove_menu_page('perfopsone-analytics');
	remove_menu_page('themes.php'); // Внешний вид	
	//remove_menu_page('edit-comments.php'); // Комментарии	
}

//Добавляем стили в текстовый редактор
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {

	add_editor_style( '/editor-styles.css' );
}

//Кнопка "Читать далее" в результатах поиска
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
	global $post;
	return '<a href="'. get_permalink($post) . '">...<p style="color: #fec300; margin-top: -20px; font-size: 32px;"> Читать далее → </p></a>';
}

if ( ! function_exists( 'maraphon_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maraphon_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on maraphon, use a find and replace
		 * to change 'maraphon' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'maraphon', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'maraphon' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'maraphon_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'maraphon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maraphon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maraphon_content_width', 640 );
}
add_action( 'after_setup_theme', 'maraphon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maraphon_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'maraphon' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'maraphon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'maraphon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function maraphon_scripts() {
	//wp_enqueue_style( 'maraphon-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'maraphon-style', get_template_directory_uri() . '/style.css', array(), _S_VERSION );
	//wp_enqueue_style( 'maraphon-style-classic-editor', get_template_directory_uri() . '/css/editor-style-classic.css', array(), '1.0.3' );
	wp_style_add_data( 'maraphon-style', 'rtl', 'replace' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . 'css/owl.carousel.css', array('maraphon_style')); //добавил из функции ниже
	wp_enqueue_script( 'maraphon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'maraphon_scripts' );

/**
  * Подключаем стили и скрипты

function maraphon_style() {
	wp_enqueue_style( 'maraphon-style', get_stylesheet_uri(), array() );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . 'css/owl.carousel.css', array('maraphon_style'));
}
add_action( 'wp_enqueue_scripts', 'maraphon_style' ); */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Автологин и редирект после регистрации
*/
function auto_login_new_user( $user_id ) {
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id); 
        //wp_redirect( 'http://maraphon.online/lk/#tab5' );
        wp_redirect( 'http://maraphon.online/thank-you' );
        exit;
    }
 add_action( 'user_register', 'auto_login_new_user' );
 
// Функция для изменения email адреса по умолчанию

function devise_sender_email( $original_email_address ) {
    return 'info@maraphon.online';
}

// Функция для изменения имени отправителя по умолчанию
function devise_sender_name( $original_email_from ) {
	return 'Марафон Войтенко';
}

// Цепляем наши функции на фильтры WordPress
add_filter( 'wp_mail_from', 'devise_sender_email' );
add_filter( 'wp_mail_from_name', 'devise_sender_name' );



/**
 * Отключаем admin-bar
 */
add_filter('show_admin_bar', '__return_false'); // отключить
show_admin_bar( false );

/**
 * Проверяет роль определенного пользователя.
 * Возвращает true при совпадении.
 *
 * @param строка $role Название роли.
 * @param логический $user_id (не обязательный) ID пользователя, роль которого нужно проверить.
 * @return bool
 */
 function is_user_role($role, $user_id = null) {
 $user = is_numeric($user_id) ? get_userdata($user_id) : wp_get_current_user();
 if (!$user)
 return false;
 return in_array($role, (array) $user->roles);
 }

//Разрешаем работу шорткодов
add_filter('widget_text', 'do_shortcode');

// Удаление пункта Персональные настройки, изменение названия заголовков
add_action( 'personal_options', 'ozh_personal_options');
function ozh_personal_options() 
{
?>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("#your-profile .form-table:first, #your-profile h3:first").remove();
    jQuery("#your-profile .form-table:nth-child(14), #your-profile h3:first").remove();
  });
</script>
<?php
}

/* = Удаляем из профиля пользователя элементы
непредусмотренные встроенными функциями
----------------------------------------- */
function remove_profile_fields_selectors() {

    $delete = array(

        // Цветовая схема
        "tr.user-admin-color-wrap",

        // Горячие клавиши
        "tr.user-comment-shortcuts-wrap",

        // Основной язык сайта
        "tr.user-language-wrap",
        
        //Биография
        "tr.user-description-wrap",
        
        "tr.user-capabilities-wrap",
    );

    $selectors = implode(", ", $delete);

    echo "<style>{$selectors}{display:none;}</style>"; ?>

  <?php
}
add_action('admin_head','remove_profile_fields_selectors');

//Удаляем поле сайт
function start_output_buffering() {
	ob_start();
}
add_action( 'personal_options', 'start_output_buffering' );

function remove_user_fields() {
	$output = ob_get_clean();

	$output = preg_replace( '#<tr class="user-url-wrap">.*?</tr>#ims', '', $output );

	echo $output;
}
add_action( 'show_user_profile', 'remove_user_fields' );
add_action( 'edit_user_profile', 'remove_user_fields' );










//Добавляем поле телефон и мессенджер в контакты профиля пользователя
add_filter('user_contactmethods', 'ved_user_contactmethods');
function ved_user_contactmethods($user_contactmethods){
  $user_contactmethods['ID'] = 'ID пользователя';
  $user_contactmethods['maraphon_counter'] = '№ марафона';
  $user_contactmethods['workout_class'] = 'Класс тренировок';
  $user_contactmethods['age'] = 'Возраст';
  $user_contactmethods['height'] = 'Рост';
  $user_contactmethods['weight-at-start'] = 'Текущий вес';
  $user_contactmethods['breastfeed'] = 'Грудное вскармливание';
  $user_contactmethods['daily-activity'] = 'Активность';
  $user_contactmethods['kcal_with_active'] = 'Дневная норма c активностью и дефицитом 15%';
  $user_contactmethods['first_menstruation_day'] = 'Первый день месячных';
  $user_contactmethods['pregnant'] = 'Роды, когда?';
  $user_contactmethods['weight_at_1_maraphon'] = 'Вес на момент начала участия в 1 марафоне';
  $user_contactmethods['dream-weight'] = 'Желаемый вес';
  $user_contactmethods['telephone'] = 'Телефон';
  $user_contactmethods['town'] = 'Город';
  $user_contactmethods['hormonal-background'] = 'Есть ли проблемы, связанные с гормональной системой';
  $user_contactmethods['hair-problems'] = 'Есть ли проблемы с волосами? Какие?';
  $user_contactmethods['intestin_problems'] = 'Есть ли проблемы с кишечником?';
  $user_contactmethods['joint_problems'] = 'Есть ли проблемы с суставами? Травма?';
  $user_contactmethods['diastaz'] = 'Есть ли диастаз (расхождение передней мышцы живота после беременности) ?';
  $user_contactmethods['thyroid'] = 'Есть ли проблемы с щитовидной железой?';
  $user_contactmethods['vitamins'] = 'Принимаете ли витамины? Какие?';
  $user_contactmethods['medicines'] = 'Принимаете ли лекарства на постоянной основе?';
  $user_contactmethods['contraceptive'] = 'Принимаете ли противозачаточные?';
  $user_contactmethods['day_menu'] = 'Опишите свое меню за день';
  $user_contactmethods['bad_food_for_you'] = 'Есть ли пищевая аллергия или непереносимость?';
  $user_contactmethods['milk_food'] = 'Как относитесь к молочным продуктам?';
  $user_contactmethods['diet'] = 'Какие диеты у вас были до сегодняшнего дня?';
  $user_contactmethods['cardio'] = 'Есть ли дома кардиотренажер?';
  $user_contactmethods['workout_experience'] = 'Опыт тренировок';
  $user_contactmethods['sport_last_time'] = 'Когда занимались спортом последний раз?';
  $user_contactmethods['what_you_know'] = 'Откуда узнали о марафоне?';
  $user_contactmethods['date_report_create'] = 'Дата заполнения анкеты';
  $user_contactmethods['date_report_fill'] = 'Последнее обновление анкеты';
  
  $user_contactmethods['men_menu_lk'] = 'Мужское меню';
  $user_contactmethods['women_menu_lk'] = 'Женское меню';
  $user_contactmethods['recipe_book_lk'] = 'Книга рецептов';
  $user_contactmethods['telegram_lk'] = 'Подписка на Telegram';
  
  $user_contactmethods['men_menu_age'] = 'Возраст (муж. меню)';
  $user_contactmethods['men_menu_height'] = 'Рост (муж .меню)';
  $user_contactmethods['men_menu_weight_at_start'] = 'Текущий вес (муж. меню)';
  $user_contactmethods['men_menu_daily_activity'] = 'Активность (муж. меню)';
  $user_contactmethods['men_menu_health_problems'] = 'Есть ли проблемы со здоровьем? (муж. меню)';
  $user_contactmethods['men_menu_diet'] = 'Какие диеты у вас были до сегодняшнего дня?';
  $user_contactmethods['men_menu_workout'] = 'Физическая активность, тренировки? (муж. меню)';
  $user_contactmethods['men_menu_what_result'] = 'Какой результат хотите достичь? (муж. меню)';

  $user_contactmethods['women_menu_age'] = 'Возраст (жен. меню)';
  $user_contactmethods['women_menu_height'] = 'Рост (жен. меню)';
  $user_contactmethods['women_menu_weight_at_start'] = 'Текущий вес (жен. меню)';
  $user_contactmethods['women_menu_breastfeed'] = 'Грудное вскармливание (жен. меню)';
  $user_contactmethods['women_menu_daily_activity'] = 'Активность (жен. меню)';  
  $user_contactmethods['women_menu_health_problems'] = 'Есть ли проблемы со здоровьем? (жен. меню)';
  $user_contactmethods['women_menu_diet'] = 'Какие диеты у вас были до сегодняшнего дня?';
  $user_contactmethods['women_menu_workout'] = 'Физическая активность, тренировки? (жен. меню)';
  $user_contactmethods['women_menu_what_result'] = 'Какой результат хотите достичь? (жен. меню)';
  $user_contactmethods['history_comment'] = 'История участника'; 
  
  
  
  
  
/*  $user_contactmethods['breast'] = 'Объем груди';
  $user_contactmethods['waist'] = 'Талия (самое узкое место)';
  $user_contactmethods['stomach'] = 'Живот (самое широкое место';
  $user_contactmethods['booty'] = 'Объем ягодиц';
  $user_contactmethods['left-leg'] = 'Нога левая (самое широкое место)';
  $user_contactmethods['right-leg'] = 'Нога правая (самое широкое место)';
  $user_contactmethods['arm'] = 'Рука';
  $user_contactmethods['calf'] = 'Икра'; */
  return $user_contactmethods;
}