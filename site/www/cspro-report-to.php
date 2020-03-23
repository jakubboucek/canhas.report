<?php
declare(strict_types = 1);

require __DIR__ . '/../shared/functions.php';

$cspHeader = "Content-Security-Policy-Report-Only: default-src 'self' 'report-sample'; report-to default";
$reportToHeader = \Can\Has\reportToHeader();
header($cspHeader);
header($reportToHeader);

echo \Can\Has\pageHead('CSPRO report-to', ['highlight.pack.js', 'highlight-init.js']);
?>
<body>
<div>
	<?= \Can\Has\bookmarks('index', 'reports'); ?>
	<h1>Content Security Policy <em>Report-Only</em> with <code>report-to</code></h1>
	<p><em>Loading images, executing JavaScript and everything else as usual but sending a Content Security Policy violation report (with <code>"disposition": "report"</code> instead of <code>"disposition": "enforce"</code>) if something would go wrong</em></p>
	<h2>The CSPRO (CSP Report-Only) header:</h2>
	<pre><code class="csp"><?= htmlspecialchars($cspHeader); ?></code></pre>
	<ul>
		<li>
			<code>default-src</code>: what's allowed by default, includes images, fonts, JavaScript <a href="https://www.w3.org/TR/CSP3/#directive-default-src">and more</a>
			<ul>
				<li><code>'self'</code> means current URL's origin (scheme + host + port)</li>
				<li>
					<code>'report-sample'</code> instructs the browser to include a violation sample, the first 40 characters
					(valid for CSS, JS only but included in <code>default-src</code> here to keep the header short)
				</li>
			</ul>
		</li>
		<li><code>report-to</code>: name of the group where to send violation reports to</li>
	</ul>

	<h2>Try it with images</h2>
	<img src="https://www.michalspacek.cz/i/images/photos/michalspacek-trademark-400x268.jpg" width="100" height="67" alt="Loaded image">
	<ul>
		<li><span class="allowed">allowed</span> even though the image was loaded from <em>https://www.michalspacek.cz</em> and not from <em>this origin</em></li>
		<li><?= \Can\Has\willTriggerReportToHtml(); ?></li>
		<li><?= \Can\Has\checkReportsReportToHtml(); ?></li>
	</ul>

	<h2>&hellip; and with JavaScript</h2>
	<p>
		<button id="insert" class="allowed">Click to insert a text</button> <em id="here"></em>
		<script>
			document.getElementById('insert').onclick = function() {
				document.getElementById('here').innerHTML = "by JavaScript with <code>document.getElementById('here').innerHTML</code>";
				alert('Text inserted');
			}
		</script>
	</p>
	<ul>
		<li>
			<span class="allowed">allowed</span> even though it's inserted by an inline JavaScript (the code between <code>&lt;script&gt;</code> and <code>&lt;/script&gt;</code>)
			and not loaded from <em>this origin</em> (<code>'self'</code> doesn't include inline JavaScript)
		</li>
		<li><?= \Can\Has\willTriggerReportToHtml(); ?></li>
		<li><?= \Can\Has\checkReportsReportToHtml(); ?></li>
	</ul>

	<h2>Other CSPRO uses</h2>
	<em>Mixed content detection: let the browser report HTTP resources loaded into HTTPS pages but still load them</em>
	<pre><code class="csp">Content-Security-Policy-Report-Only: default-src https: 'unsafe-inline'; report-to default</code></pre>
	<ul>
		<li>
			allows only files (images, JS, CSS, fonts, etc.) loaded using HTTPS,
			and inline JavaScript (code between <code>&lt;script&gt;</code> and <code>&lt;/script&gt;</code>, handlers like <code>onmouseover</code> etc.)
		</li>
		<li>would trigger a report</li>
		<li>but would still load everything because it's a <code>Content-Security-Policy-<strong>Report-Only</strong></code> header</li>
	</ul>
</div>
</body>
