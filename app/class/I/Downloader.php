<?

interface I_Downloader {

  /**
   * Get downloaded content
   *
   * @param string $url
   * @return string/null
   */
  public function load($url);

  /**
   * Last error description
   *
   * @return string/null
   */
  public function getError();

}