<div class="entry-meta">
	<time class="entry-meta__date" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
	<span class="entry-meta__delimeter">|</span>
	<?php echo get_the_category_list(); ?>
</div>