<?php
require_once 'vendor/autoload.php';

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;

header('Content-type:text/json'); 

class AgentResult {
    public $userAgent = null;
    public $isBot = false;
    public $botInfo = null;
    public $clientInfo = null;
    public $osInfo = null;
    public $device = '';
    public $brand = '';
    public $model = '';
}

// OPTIONAL: Set version truncation to none, so full versions will be returned
// By default only minor versions will be returned (e.g. X.Y)
// for other options see VERSION_TRUNCATION_* constants in DeviceParserAbstract class
DeviceParserAbstract::setVersionTruncation(DeviceParserAbstract::VERSION_TRUNCATION_NONE);

$userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse

$dd = new DeviceDetector($userAgent);

// OPTIONAL: Set caching method
// By default static cache is used, which works best within one php process (memory array caching)
// To cache across requests use caching in files or memcache
// $dd->setCache(new Doctrine\Common\Cache\PhpFileCache('./tmp/'));

// OPTIONAL: Set custom yaml parser
// By default Spyc will be used for parsing yaml files. You can also use another yaml parser.
// You may need to implement the Yaml Parser facade if you want to use another parser than Spyc or [Symfony](https://github.com/symfony/yaml)
// $dd->setYamlParser(new DeviceDetector\Yaml\Symfony());

// OPTIONAL: If called, getBot() will only return true if a bot was detected  (speeds up detection a bit)
$dd->discardBotInformation();

// OPTIONAL: If called, bot detection will completely be skipped (bots will be detected as regular devices then)
$dd->skipBotDetection();

$dd->parse();

$result = new AgentResult();
$result->userAgent = $userAgent;
$result->isBot = $dd->isBot();

if ($dd->isBot()) {
  // handle bots,spiders,crawlers,...
  $result->botInfo = $dd->getBot();
  echo json_encode($result);
  return;
} else {
  $result->clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
  $result->osInfo = $dd->getOs();
  $result->device = $dd->getDeviceName();
  $result->brand = $dd->getBrandName();
  $result->model = $dd->getModel();
  echo json_encode($result);
  return;
}