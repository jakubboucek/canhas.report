<?php
declare(strict_types = 1);

header("Content-Security-Policy: default-src 'none'; img-src 'self'; script-src 'self'; style-src 'self'; base-uri 'none'; form-action 'none'");
include __DIR__ . '/config.php';
$subdomain = require './subdomain.php';

$database = new PDO("mysql:host=$dbHost;dbname=$dbSchema", $dbUsername, $dbPassword);
$statement = $database->prepare('SELECT received, types, report FROM reports WHERE who = ? ORDER BY received DESC');
$statement->execute([$subdomain]);
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>(Minority) Reporting: Received reports</title>
	<link rel="stylesheet" href="style.css">
	<script src="highlight.pack.js"></script>
	<script src="highlight-init.js"></script>
</head>
<body>
<div id="reports">
<h1>Received Reports</h1>
<?php
foreach ($statement as $row) {
	$counts = array_count_values(json_decode($row['types']));
	$types = [];
	foreach ($counts as $type => $count) {
		$types[] = "{$count}× $type";
	}
	$reports = json_decode($row['report']);

	$json = urldecode(json_encode($reports, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
	printf('<p>%s <strong>%s</strong>%s</p><pre><code class="json">%s</code></pre>',
		htmlspecialchars($row['received']),
		htmlspecialchars(implode(' + ', $types)),
		(is_array($reports) ? ' via <code>Report-To</code>' : ''),
		htmlspecialchars(preg_replace('/^(  +?)\\1(?=[^ ])/m', '$1', $json))
	);
}

if ($statement->rowCount() === 0) {
	echo '<p>No reports yet</p>';
}
?>
<p><a href=".">↩ Back</a> <em>By <a href="https://www.michalspacek.cz">Michal Špaček</a>, <a href="https://twitter.com/spazef0rze">spazef0rze</a></em></p>
</div>
