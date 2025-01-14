<?php get_header(); ?>

<main id="site-content" role="main">

	<?php

	$archive_title = '';
	$archive_subtitle = '';
	
	if ( is_search() ) {
		global $wp_query;
		/* Translators: %s = The search query */
		$archive_title = sprintf( _x( 'Search: %s', '%s = The search query', 'twentytwenty' ), '&ldquo;' . get_search_query() . '&rdquo;' );
		if ( $wp_query->found_posts ) {
			/* Translators: %s = Number of results */
			$archive_subtitle = sprintf( _nx( 'We found %s result for your search.', 'We found %s results for your search.',  $wp_query->found_posts, '%s = Number of results', 'twentytwenty' ), $wp_query->found_posts );
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( ! is_home() ) {
		$archive_title = get_the_archive_title();
		$archive_subtitle = get_the_archive_description( '<div>', '</div>' ); 
	}
	
	if ( $archive_title || $archive_subtitle ) : ?>
		
		<header class="archive-header has-text-align-center">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php endif; ?>

				<?php if ( $archive_subtitle ) : ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php endif; ?>
			
			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

	<?php endif; ?>

	<div class="posts">

		<?php 
		if ( have_posts() ) : 
		
			while ( have_posts() ) : the_post();
			
				 get_template_part( 'content', get_post_type() );

			endwhile;

		elseif ( is_search() ) : ?>

			<div class="no-search-results-form">

				<?php get_search_form(); ?>

			</div><!-- .no-search-results -->

		<?php endif; ?>
	
	</div><!-- .posts -->

	<?php get_template_part( 'pagination' ); ?>

</main><!-- #site-content -->

<?php get_footer(); ?>