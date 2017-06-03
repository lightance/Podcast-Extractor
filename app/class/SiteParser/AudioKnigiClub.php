<?

class SiteParser_AudioKnigiClub extends SiteParser {

  /**
   * @return array Format: array('title'=>'...', 'coverUrl'=>'...', 'items'=>array(array('title'=>..., 'url'=>..., 'duration'=>...), ...))
   */
  public function parse() {
    // load page
    $pageHtml = $this->downloader->load($this->url);
    if (!$pageHtml) {
      return null;
    }

    // parse book ID
    $bookId = null;
    if (preg_match('~\.audioPlayer\s*\(\s*(\d+)\s*,~', $pageHtml, $match)) {
      $bookId = (int)$match[1];
    }
    if (!$bookId) {
      return null;
    }

    // parse title
    $title = null;
    //<meta property="og:title" content="Герберт Френк - Дюна"/>
    if (preg_match('~<meta property="og:title" content="([^"]+)"/>~', $pageHtml, $match)) {
      $title = $match[1];
    }
    else {
      $title = trim($this->url, '/');
      $title = explode('/', $title);
      $title = end($title);
      $title = str_replace('-', ' ', $title);
      $title = ucfirst($title);
    }

    // parse cover image
    $coverUrl = null;
    //<meta property="og:image" content="https://audioknigi.club/uploads/topics/preview/00/00/28/15/49dbfd191d.jpg"/>
    if (preg_match('~<meta property="og:image" content="([^"]+)"/>~', $pageHtml, $match)) {
      $coverUrl = $match[1];
    }

    // load playlist by book ID
    $playlistUrl = 'https://audioknigi.club/rest/bid/'.$bookId;
    $playlistJson = $this->downloader->load($playlistUrl);
    if (!$playlistJson) {
      return null;
    }

    // decode playlist json
    $playlist = json_decode($playlistJson, true, 10);
    if (!$playlist) {
      return null;
    }

    // items
    $items = array();
    $i = 1;
    foreach ($playlist as $playlistItem_) {
      $guid_ = $this->url . '#item' . $i;

      $urlParts_ = parse_url($playlistItem_['mp3']);
      if (isset($urlParts_['path'])) {
        $urlParts_['path'] = explode('/', $urlParts_['path']);
        $urlParts_['path'] = array_map('rawurlencode', $urlParts_['path']);
        $urlParts_['path'] = implode('/', $urlParts_['path']);
      }
      $url_ = $urlParts_['scheme'].'://'.$urlParts_['host'].$urlParts_['path'];

      $items[] = array(
        'guid' => $guid_,
        'title' => $playlistItem_['title'],
        'url' => $url_,
        //'duration' => $playlistItem_['time']
      );

      $i++;
    }

    return array(
      'title' => $title,
      'coverUrl' => $coverUrl,
      'items' => $items
    );
  }

}