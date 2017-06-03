<?

interface I_SiteParser {

  /**
   * @return array Format: array('title'=>'...', 'coverUrl'=>'...', 'items'=>array(array('title'=>..., 'url'=>..., 'duration'=>...), ...))
   */
  public function parse();

}