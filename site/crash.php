<?php
declare(strict_types = 1);

$reportTo = [
	'group' => 'default',
	'max_age' => 60,
	'endpoints' => [
		[
			'url' => 'https://' . $_SERVER['HTTP_HOST'] . '/report.php',
		]
	],
	'include_subdomains' => true,
];
header('Report-To: ' . json_encode($reportTo, JSON_UNESCAPED_SLASHES));
?>
Crash the tab: <a href="chrome://crash/">chrome://crash/</a> (copy and paste the link)
