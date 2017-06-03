<?

class ExtractorFactory {

  public function build($url) {
    $siteParserFactory = new SiteParserFactory;
    $siteParser = $siteParserFactory->build($url);

    $podcastFactory = new \Podcast\PodcastFactory;

    return new Extractor($siteParser, $podcastFactory);
  }

}