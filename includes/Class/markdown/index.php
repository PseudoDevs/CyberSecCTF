<?php 	
include("../auth/config.php");
include("vendor/autoload.php");
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use League\CommonMark\Extension\Autolink\InlineMentionParser;

// Obtain a pre-configured Environment with all the CommonMark parsers/renderers ready-to-go

$environment = Environment::createCommonMarkEnvironment();
$environment->addInlineParser(InlineMentionParser::createCyberSecCTFHandleParser());

// Add this extension
$environment->addExtension(new TaskListExtension());

// Instantiate the converter engine and start converting some Markdown!
$converter = new CommonMarkConverter([], $environment);

$markdown = urldecode('%5B%22title%5D%28j%2561v%2561sc%2572ipt%3A%2561le%2572t%28%27a%27%29%29');

echo $converter->convertToHtml($markdown);

?>