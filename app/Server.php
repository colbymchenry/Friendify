<?php

namespace App;

use phpseclib\Net\SSH2;
use Anchu\Ftp\FtpServiceProvider;

class Server {

  static function getServerSpace($server_id) {
    $json = json_decode(\Storage::get('Servers.json'), true);

    $ssh = new SSH2($json[$server_id]['HOST']);
    if (!$ssh->login($json[$server_id]['USER'], $json[$server_id]['PASS'])) {
        throw new \Exception("Could not connect to server.");
    } else {
        $output = $ssh->exec('php /var/www/html/diskspace.php');
    }

    return floatval($output);
  }

  static function getAvailableServerID($fileSize) {
    $json = json_decode(\Storage::get('Servers.json'), true);

    foreach($json as $serverId => $value) {
      $serverSpace = Server::getServerSpace($serverId);
      if($serverSpace > ((int) $fileSize) + 100) {
        return $serverId;
      }
    }

    return -1;
  }

  static function uploadFile($server_id, $directory, $file, $name)
  {
    $json = json_decode(\Storage::get('Servers.json'), true);
    try {
        $ftp = \Storage::createFtpDriver([
          'host'     => $json[$server_id]['HOST'],
          'username' => $json[$server_id]['USER'],
          'password' => $json[$server_id]['PASS'],
          'port'     => $json[$server_id]['PORT'],
          'timeout'  => '5',
          'root'     => '',
        ]);

        $ftp->putFileAs($directory, $file, $name);
    }catch(\Exception $e) {
      \Log::info($e);
    }
  }
  

}
