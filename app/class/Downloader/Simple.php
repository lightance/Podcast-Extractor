<?

class Downloader_Simple extends Downloader {

  const MAX_SIZE = 20000000; // 20Мб

  /**
   * Get downloaded content
   *
   * @param string $url
   * @return string/null
   */
  public function load($url) {
    $this->error = null;

    if (!$this->checkUrl($url)) {
      $this->error = 'incorrect url';
      return null;
    }

    $result = @file_get_contents($url, false, null, 0, self::MAX_SIZE);
    if ($result === false) {
      $this->error = 'loading error';
      return null;
    }

    return $result;
  }

}