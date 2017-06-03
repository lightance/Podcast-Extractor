<?
namespace Podcast;

class Item implements I_Item {

  protected $guid;
  protected $url;
  protected $title;
  protected $pubDate;

  public function __construct($guid, $url, $title, $pubDate) {
    $this->guid = $guid;
    $this->url = $url;
    $this->title = $title;
    $this->pubDate = $pubDate;
  }

  /**
   * @return string
   */
  public function generateXml() {
    if (!$this->url) {
      return null;
    }

    $guid_ = $this->guid? $this->guid: $this->url;
    $guid_ = str_replace(array("\r","\n"), array('',''), $guid_);

    $pubDateStr = $this->pubDate? gmdate('r', $this->pubDate): null; // Thu, 02 Feb 2001 00:00:00 EST

    //<enclosure url="'.htmlspecialchars($item_['url']).'" type="audio/mpeg" length="1" />
    //($durationStr_?'<itunes:duration>'.$durationStr_.'</itunes:duration>':'')
    return '
  <item>
    <title>'.strip_tags($this->title).'</title>
    <enclosure url="'.htmlspecialchars($this->url).'" type="audio/mpeg" />
    <guid isPermaLink="false">'.strip_tags($guid_).'</guid>
    '.($pubDateStr?'<pubDate>'.$pubDateStr.'</pubDate>':'').'
  </item>';
  }

}