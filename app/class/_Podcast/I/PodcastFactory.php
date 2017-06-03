<?
namespace Podcast;

interface I_PodcastFactory {

  /**
   * @return I_Podcast
   */
  public function build($title, $coverUrl, array $items);

}