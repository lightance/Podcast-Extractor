<?

abstract class SiteParser implements I_SiteParser {

  /** @var string */
  protected $url;
  /** @var I_Downloader */
  protected $downloader;

  public function __construct($url, I_Downloader $downloader) {
    $this->url = $url;
    $this->downloader = $downloader;
  }

  /**
   * @return array Format: array('title'=>'...', 'items'=>array(array('title'=>..., 'url'=>..., 'duration'=>...), ...))
   */
  abstract public function parse();

}