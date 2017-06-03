<?
namespace Podcast;

class Podcast implements I_Podcast {

  /** @var string */
  protected $title;
  /** @var string */
  protected $coverUrl;
  /** @var I_Item[] */
  protected $items;

  /**
   * @param string $title
   * @param string $coverUrl
   * @param array[] $items Format: array(array('title'=>..., 'url'=>..., 'duration'=>..., 'time'=>...), ...)
   */
  public function __construct($title, $coverUrl) {
    $this->title = $title;
    $this->coverUrl = $coverUrl;
  }

  public function addItem(I_Item $item) {
    $this->items[] = $item;
  }

  /**
   * @return string
   */
  public function generateXml() {
    if (!$this->items) {
      return null;
    }

    $xmlOut = '<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>
  <title>'.$this->title.'</title>
  <description>'.$this->title.'</description>
  <link>http://'.$_SERVER['HTTP_HOST'].'</link>
  <atom10:link href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml"/>
  <language>ru</language>
  <itunes:category text="Music"/>
  <itunes:explicit>no</itunes:explicit>
  <itunes:owner>
    <itunes:name>'.$_SERVER['HTTP_HOST'].'</itunes:name>
    <itunes:email>email@'.$_SERVER['HTTP_HOST'].'</itunes:email>
  </itunes:owner>';

    if ($this->coverUrl) {
      $xmlOut .= '
  <itunes:image href="'.htmlspecialchars($this->coverUrl).'"/>';
    }

    foreach ($this->items as $item_) {
      $xmlOut .= $item_->generateXml();
    }

    $xmlOut .= '
</channel>
</rss>';

    return $xmlOut;
  }

}