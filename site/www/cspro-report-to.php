<?php
declare(strict_types = 1);

require __DIR__ . '/../shared/functions.php';

header("Content-Security-Policy-Report-Only: default-src https: 'unsafe-inline'; report-to default");

$reportTo = [
	'group' => 'default',
	'max_age' => 60,
	'endpoints' => [
		[
			'url' => \Can\Has\reportUrl(),
		]
	],
	'include_subdomains' => true,
];
header('Report-To: ' . json_encode($reportTo, JSON_UNESCAPED_SLASHES));
echo \Can\Has\pageHead('CSP report-to');
?>
<body>
<div>
<?= \Can\Has\bookmarks('index', 'reports'); ?>
<img src="http://www.michalspacek.cz/i/images/photos/michalspacek-trademark-400x268.jpg" width="100" height="67">
<script>
	console.log('hi');
</script>
</div>
</body>
