<?php
declare(strict_types = 1);

require __DIR__ . '/functions.php';

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

$nel = [
	'report_to' => 'default',
	'max_age' => 60,
	'include_subdomains' => true,
];
// $nel['success_fraction' => 0.5];  // 0.0-1.0
// $nel['failure_fraction' => 0.5];
header('NEL: ' . json_encode($nel, JSON_UNESCAPED_SLASHES));

switch ($_GET['do'] ?? '') {
	case '404':
		http_response_code(404);
		echo 'Not Found';
		break;
	case 'wronghost':
		echo 'Go to: <a href="https://wrong.host.exploited.cz/">https://wrong.host.exploited.cz/</a>';
		break;
	default:
		echo 'Can do: 404 wronghost';
		break;
}
