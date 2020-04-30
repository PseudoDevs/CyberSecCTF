<?php
//$root = $_SERVER['DOCUMENT_ROOT'];
include(ROOT."/includes/Class/markdown/vendor/autoload.php");

use League\CommonMark\Environment;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\HtmlRenderer;
use League\CommonMark\Extension\Autolink;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Autolink\InlineMentionParser;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;


// Obtain a pre-configured Environment with all the CommonMark parsers/renderers ready-to-go
$environment = Environment::createCommonMarkEnvironment();
$environment->addInlineParser(InlineMentionParser::createCyberSecCTFHandleParser());
// Add this extension
$environment->addExtension(new TableExtension());
$environment->addExtension(new AutolinkExtension());
$environment->addExtension(new SmartPunctExtension());
$environment->addExtension(new StrikethroughExtension());

// Instantiate the markdown  engine and start converting some Markdown!
$markdown  = new CommonMarkConverter([
  'html_input' => 'strip',
  'allow_unsafe_links' => false,
  'smartpunct' => [
        'double_quote_opener' => '“',
        'double_quote_closer' => '”',
        'single_quote_opener' => '‘',
        'single_quote_closer' => '’',
    ],
],
$environment,
new DocParser($environment), 
new HtmlRenderer($environment)
);
?>