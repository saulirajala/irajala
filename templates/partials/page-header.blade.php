<?php
$post_id = get_the_ID();
$image_id = get_post_meta( $post_id, 'hero__image_id', true );
$image_url = wp_get_attachment_image_url( $image_id, 'hero' );
if (is_front_page()):
?>
<div class="page-header hero">

	<?php if ( $image_layer_0_id = get_post_meta( $post_id, 'hero__image_id', true ) ):
		$image = wp_get_attachment_image( $image_layer_0_id, 'hero', false, array( 'class' => 'hero__image hero__image--layer-0' ) );
		echo $image;
		?>
    <?php endif; ?>


	<?php if ( $image_layer_1_id = get_post_meta( $post_id, 'hero__image__layer-1_id', true ) ):
		$image = wp_get_attachment_image( $image_layer_1_id, 'hero', false, array( 'class' => 'hero__image hero__image--layer-1' ) );
		echo $image;
		?>
    <?php endif; ?>

	<?php
	if ( $image_layer_2_id = get_post_meta( $post_id, 'hero__image__layer-2_id', true ) ):
		$image = wp_get_attachment_image( $image_layer_2_id, 'hero', false, array( 'class' => 'hero__image hero__image--layer-2' ) );
		echo $image;
		?>
    <?php endif; ?>

	<h1 class="hero__title"><span class="hero__title--subtract">R</span>ajala</h1>
	<p class="hero__subtitle"><?php echo get_bloginfo( 'description' ); ?></p>

	<a href="#main" class="hero__scroll-down" id="scroll__link">
		<i class="fa fa-angle-double-down" aria-hidden="true"></i>
	</a>
</div>
<?php else: ?>
<?php if ( ! $image_url ) {
	$image_url = get_the_post_thumbnail_url( $post_id, 'hero' );
} ?>
<div class="page-header hero hero--post" style="background-image: url(<?php echo $image_url; ?>);background-size: cover; background-position: center; ">
	<h1>{!! App\title() !!}</h1>
	@include('partials/entry-meta')
</div>
<?php endif; ?>

