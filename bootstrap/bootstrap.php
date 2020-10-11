 <?php

use Smarty;
use App\FolderService;
use App\Renderer\Renderer;
use App\DI\Container;
use App\Router\Dispatcher;
use App\Controller\ProductController;
use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';


define('APP_DIR', realpath(__DIR__ . '/../'));
define('APP_PUBLIC_DIR', realpath(APP_DIR . '/public'));
define('APP_UPLOAD_DIR', (APP_PUBLIC_DIR . '/upload'));
define('APP_UPLOAD_PRODUCT_DIR', (APP_UPLOAD_DIR . '/products'));

function dump($var) {
    echo "<pre>"; var_dump($var); echo "</pre>";
}

(new Kernel())->run();



//
//if (!file_exists(APP_UPLOAD_DIR)) {
//mkdir(APP_UPLOAD_DIR);
//}
//if (!file_exists(APP_UPLOAD_PRODUCT_DIR)) {
//mkdir(APP_UPLOAD_PRODUCT_DIR);
//}
//
//function deleteDir($dir) {
//   $sistemLinks = [
//            '.',
//            '..',
//        ];
//
//    $files = array_diff(scandir($dir), $sistemLinks);
//    foreach ($files as $file) {
//        $filePath = "$dir/$file";
//        if (is_dir($filePath)) {
//            $this->deleteDir($filePath);
//        } else {
//            unlink($filePath);
//        }
//    }
//    return rmdir($dir);
//}
//
//$di = new Container();
//
//$di->singletone(Smarty::class, function() {
//    $smarty = new Smarty();
//    $smarty->template_dir = APP_DIR . '/templates';
//    $smarty->compile_dir = APP_DIR . '/var/compile';
//    $smarty->cache_dir = APP_DIR . '/var/cache';
//    $smarty->config_dir = APP_DIR . '/var/config';
//
//
//
//    return $smarty;
//});
//
//$smarty = $di->get(Smarty::class);
////echo "<pre>"; var_dump($di); "</pre>"; exit;
//$foldersService = new FolderService();
//$folders = $foldersService->get_Spisok();
//$smarty->assign('folders_menu', $folders);




