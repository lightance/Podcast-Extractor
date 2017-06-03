<?

class Extractor {

  /** @var I_SiteParser */
  protected $siteParser;
  /** @var \Podcast\I_PodcastFactory */
  protected $podcastFactory;

  public function __construct(I_SiteParser $siteParser, \Podcast\I_PodcastFactory $podcastFactory) {
    $this->siteParser = $siteParser;
    $this->podcastFactory = $podcastFactory;
  }

  public function extractPodcastXml() {
    $data = $this->siteParser->parse();
    if (!$data) {
      return null;
    }

    $podcast = $this->podcastFactory->build(
      isset($data['title'])? $data['title']: null,
      isset($data['coverUrl'])? $data['coverUrl']: null,
      isset($data['items'])? $data['items']: null
    );

    return $podcast->generateXml();
  }

}