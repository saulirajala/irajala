<?php
$category = get_the_category( get_the_ID() );
$category = $category[0];
$category_slug = $category->slug;
$category_name = $category->name;

?>
<div class="rotatory__object rotatory__object--{{$category_slug}} rotatory__object--{{$index}}" data-tooltip-content="#tooltip_content--{{$index}}">
	<?php
	$post_id = get_the_ID();
	$thumbnail_url = get_the_post_thumbnail_url( $post_id, 'article' );
	?>
	<a href="{{get_permalink()}}" class="post__link">
		<div class="rotatory__post" style="background: url('{{$thumbnail_url}}') center center;background-size: cover;">

		</div>
	</a>
	<article class="tooltip__templates">
		<span class="rotatory__article" id="tooltip_content--{{$index}}">
			<div class="tooltip__image">
				<img src="{{$thumbnail_url}}"/>
			</div>
			<div class="tooltip__content">
				<h3 class="tooltip__title">{{get_the_title()}}</h3>
				<p class="tooltip__category">Kategoria:
					<span class="tooltip__category--{{$category_slug}}">{{$category_name}}</span>
				</p>
				<p class="tooltip__excerpt">{{get_the_excerpt()}}</p>
				<a href="{{get_permalink()}}">{{__( 'Continued', 'sage' )}}</a>
			</div>
		</span>
	</article>
</div>
