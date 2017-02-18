<?php if( ! is_front_page() ): ?>
<header class="banner header">
	<div class="container">
		<nav class="nav-primary">
			@if (has_nav_menu('primary_navigation'))
				{!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
			@endif
		</nav>
	</div>
</header>
<?php endif; ?>
