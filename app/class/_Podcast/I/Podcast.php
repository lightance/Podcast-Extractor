<?
namespace Podcast;

interface I_Podcast {

  public function addItem(I_Item $item);

  /**
   * @return string
   */
  public function generateXml();

}