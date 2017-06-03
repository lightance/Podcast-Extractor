<?

abstract class Downloader implements I_Downloader {

  /** @var string/null */
  protected $error = null;

  /**
   * Get downloaded content
   *
   * @param string $url
   * @return string/null
   */
  abstract public function load($url);

  /**
   * @param string $url
   * @return bool
   */
  protected function checkUrl($url) {
    if (!$url) {
      return false;
    }

    $result = parse_url($url);
    if ($result === false) {
      return false;
    }

    if (!isset($result['scheme']) || !isset($result['host'])) {
      return false;
    }

    $scheme = strtolower($result['scheme']);
    if (!in_array($scheme, array('http', 'https'))) {
      return false;
    }

    $host = strtolower($result['host']);
    if (in_array($host, array('localhost', '127.0.0.1'))) {
      return false;
    }

    return true;
  }

  /**
   * Last error description
   *
   * @return string/null
   */
  public function getError() {
    return $this->error;
  }

}