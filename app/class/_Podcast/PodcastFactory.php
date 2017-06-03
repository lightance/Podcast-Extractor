<?
namespace Podcast;

class PodcastFactory implements I_PodcastFactory {

  /**
   * @param string $title
   * @param string $coverUrl
   * @param array[] $items Format: array(array('title'=>..., 'url'=>..., 'duration'=>...), ...)
   * @return I_Podcast
   */
  public function build($title, $coverUrl, array $items) {
    $podcast = new Podcast($title, $coverUrl);

    if ($items) {
      $pubDate_ = gmmktime(1, 0, 0, 1, 1, 2000);
      foreach ($items as $itemData_) {
        $itemObj_ = new Item(
          isset($itemData_['guid'])? $itemData_['guid']: $itemData_['url'],
          $itemData_['url'],
          $itemData_['title'],
          $pubDate_
        );
        $podcast->addItem($itemObj_);

        $pubDate_ += 24 * 60 * 60;
      }
    }

    return $podcast;
  }

}