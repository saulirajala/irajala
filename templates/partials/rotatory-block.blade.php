<div class="helper-text">
	<p class="helper-text__text">Uusin kirjoitus on uloimmalla kehällä. Kategoriat on värikoodattu seuraavasti:</p>
	<ul class="helper-text__list">
		<li class="helper-text__list-item">
			<div class="helper-text__list-item--theology"></div>Teologia
		</li>
		<li class="helper-text__list-item">
			<div class="helper-text__list-item--web"></div>Web
		</li>
		<li class="helper-text__list-item">
			<div class="helper-text__list-item--else"></div>Muut
		</li>
	</ul>
</div>
<div class="rotatory__wrapper">
	<div class="rotatory__outline-wrap">
		<div class="rotarory__outline rotatory__outline--270"></div>
		<div class="rotarory__outline rotatory__outline--230"></div>
		<div class="rotarory__outline rotatory__outline--190"></div>
		<div class="rotarory__outline rotatory__outline--150"></div>
	</div>
	<div class="rotatory">
		<div class="rotatory__archive border-hover">
			<h2 class="rotatory__text">
				<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="rotatory__link">Arkistoon</a>
			</h2>
		</div>
		<?php
		//Haetaan 4 uusinta postausta
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 4,
		);
		$post_query = new WP_Query( $args ); ?>
		@if($post_query->have_posts())
			@php($index = 0)
			@while($post_query->have_posts()) @php($post_query->the_post())
			@include('partials.rotatory__object')
			@php($index++)
			@endwhile
		@endif
		@php(wp_reset_postdata())
	</div>
</div>
