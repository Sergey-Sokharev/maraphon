<?php
$post = $wp_query->post;
if ( in_category( 'workout' ) ) { //слаг категории
    include( TEMPLATEPATH.'/single-workout.php' );
} else if ( in_category( 'blog' ) ) { //слаг категории
	include( TEMPLATEPATH.'/single-my-blog.php' );
} else if ( in_category( 'wikipedia' ) ) { //слаг категории
    include( TEMPLATEPATH.'/single-wikipedia.php' );
} else if ( in_category( 'razbor' ) ) { //слаг категории
	include( TEMPLATEPATH.'/single-razbor.php' );
} else if ( in_category( 'manual' ) ) { //слаг категории
	include( TEMPLATEPATH.'/single-manual.php' );
} else {
    include( TEMPLATEPATH.'/single-default.php' );
}
?>