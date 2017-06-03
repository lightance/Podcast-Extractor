<?
include('app/config.php');
include('app/core.php');

if (isset($_GET['url'])) {
  $factory = new ExtractorFactory;
  $extractor = $factory->build($_GET['url']);

  $xmlString = $extractor->extractPodcastXml();
  if (!$xmlString) {
    header('HTTP/1.1 404', true, 404);
    exit;
  }

  header('Content-Type: application/atom+xml; charset=utf-8');
  echo $xmlString;
  exit;
}

include('app/template/form.php');