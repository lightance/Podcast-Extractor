<?

class Downloader_Curl extends Downloader {

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

    $ch = curl_init();
    if ($ch === false) {
      $this->error = 'curl init error';
      return null;
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    //curl_setopt($ch, CURLOPT_PATH_AS_IS, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);

    $result = curl_exec($ch);
    if ($result === false) {
      $this->error = 'curl error #'.curl_errno($ch).': '.curl_error($ch);
      return null;
    }

    curl_close($ch);

    return $result;
  }

}