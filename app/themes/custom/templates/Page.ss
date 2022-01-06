<!DOCTYPE html>
<html lang="$ContentLocale" class="no-js">
	<head>
		<% base_tag %>
		$MetaTags(false)
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui" />
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

		<title>$MetaTitle</title>

		<link rel="shortcut icon" href="{$AbsoluteBaseURL}favicon.png" />
		<link rel="apple-touch-icon" href="{$AbsoluteBaseURL}favicon.png" />
		
		<link href="https://fonts.googleapis.com/css2?family=Actor&amp;display=swap" rel="stylesheet">
	</head>

	<body class="body{$ClassName}">
		<a id="SkipToContent" class="accessibilityLink" href="#Content">Skip to Content</a>
		<!--[if lte IE 9]>
			<p>
				<span aria-hidden="true" class="icon fas fa-exclamation-triangle"></span> You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
			</p>
		<![endif]-->

		<main class="pageContainer">
			$Layout
		</main>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script type="application/javascript" src="/_resources/themes/custom/javascript/script.js"></script>
	</body>
</html>
