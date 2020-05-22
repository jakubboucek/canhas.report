<?php
declare(strict_types = 1);

// Next time use a framework dude

require __DIR__ . '/../shared/functions.php';

$uri = $_SERVER['REQUEST_URI'] === '/' ? '/index' : $_SERVER['REQUEST_URI'];
$file = __DIR__ . '/../pages/' . basename($uri) . '.php';

if (is_readable($file)) {
	require $file;
} else {
	http_response_code(404);
	echo \Can\Has\pageHead('Not Found');
?>
	<body>
	<?= \Can\Has\headerHtml('Reporting API Demos'); ?>
	<div>
		<?= \Can\Has\bookmarks('index', 'reports'); ?>
		<h1>Page Not Found 🙊🙈🙉</h1>
		<p>Don't be sad though and watch Minority Report trailer instead</p>
		<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/aGWQYgZZEEQ" frameborder="0"></iframe>
	</div>
	<?= \Can\Has\footerHtml(); ?>
	</body>
<?php
}
