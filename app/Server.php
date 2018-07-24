<?php

namespace App;

use phpseclib\Net\SSH2;
use Anchu\Ftp\FtpServiceProvider;

class Server {

  static function getServerSpace($server_id) {
    $json = json_decode(\Storage::get('Servers.json'), true);

    $ssh = new SSH2($json[$server_id]);
    if (!$ssh->login('root', '90percent')) {
        throw new \Exception("Could not connect to server.");
    } else {
        $output = $ssh->exec('php /var/www/html/diskspace.php');
    }

    return floatval($output);
  }

  static function uploadFile($server_id, $fileFrom, $fileTo)
  {
    $json = json_decode(\Storage::get('Servers.json'), true);
    try {
        $ftp = \Storage::createFtpDriver([
          'host'     => '142.44.162.229',
          'username' => 'root',
          'password' => '90percent',
          'port'     => '21',
          'timeout'  => '3',
          'root'     => '',
        ]);

        $ftp->put('/var/www/html/', $fileFrom);
    }catch(\Exception $e) {
      \Log::info($e);
    }
  }

}
