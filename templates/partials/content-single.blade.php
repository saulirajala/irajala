<article @php(post_class())>
	<div class="entry-content">
		@php(the_content())
	</div>
	{{--<h3 class="react">Reagoi:</h3>--}}
<!--	--><?php //if(function_exists('the_ratings')) { the_ratings(); } ?>
<!--	--><?php //if (function_exists('dw_reactions')) { dw_reactions(); } ?>
<!--	--><?php //echo do_shortcode( '[ssba]' ); ?>
	@php(comments_template('/templates/partials/comments.blade.php'))
</article>
