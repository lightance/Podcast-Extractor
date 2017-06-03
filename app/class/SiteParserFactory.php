<?

class SiteParserFactory {

  public function build($url) {
    $downloader = new Downloader_Simple;
    return new SiteParser_AudioKnigiClub($url, $downloader);
  }

}