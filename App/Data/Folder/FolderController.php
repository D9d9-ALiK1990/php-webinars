<?php

namespace App\Data\Folder;

use App\Http\Response;
use App\Data\FolderService;
use App\Http\Request;
use App\Renderer\Renderer;
use App\Router\Route;

class FolderController{
    
     /**
     *
     * @var Route 
     */
    private $route;
    
    public function __construct(Route $route) {
        $this->route = $route;
    }
    
    public function add() {
        if (Request::isPost()) {
    
            $inserted = FolderService::add(FolderService::getDataFromPost());

            if ($inserted) {
                Response::redirect('/folders');
            }
            else {
                die("ne proshlo");
            }
        }
        $smarty = Renderer::getSmarty();
        $smarty->display('folders/add.tpl');
    }
    

    public function del() {
        $id_folder = Request::getIntFromPost('id_folder');
        if (!$id_folder) {
            die("poshlo ne tak");
        }
        (int)$id_folder; 

        $deleted = FolderService::delete_By_Id($id_folder);
        if ($deleted) {
           Response::redirect('/folders');
        }
        else {
            die("ne proshlo");
        }
    }
    
     /**
     * @route("/folder_list")
     */
    public function list() {
        $folders = FolderService::get_Spisok();
        $smarty = Renderer::getSmarty();    
        $smarty->assign('folders', $folders);
        $smarty->display('folders/folders.tpl');
    }
    
    public function upd() {
        $id_folder = Request::getIntFromGet('id_folder', null);
        if (is_null($id_folder)) {
            $id_folder = $this->route->getParam('id_folder');
        }

        $folder = [];
        if ($id_folder) {
            $folder = FolderService::get_By_Id($id_folder);    
        } 

        if (Request::isPost()) {
            $id_folder = $_POST['id_folder'] ?? '';
            $name_folder = $_POST['name_folder'] ?? '';

        $updated = FolderService::update_By_Id($id_folder, FolderService::getDataFromPost());
            if ($updated) {
                Response::redirect('/folders');
            }
            else {
                die("ne proshlo");
            }
        }
        $smarty = Renderer::getSmarty();
        $smarty->assign('folder', $folder);
        $smarty->display('folders/upd.tpl');
    }
    
    public function view() {
        $id_folder = Request::getIntFromGet('id_folder', null);
        
//        echo var_dump($id_folder);
//exit;
        if (is_null($id_folder)) {
            $id_folder = $this->route->getParam('id_folder');
        }
//        echo var_dump($id_folder);
//exit;
        $folder_activ = FolderService::get_By_Id($id_folder);

        $products = Product::get_By_Id_Folder($id_folder);
        $smarty = Renderer::getSmarty();
        $smarty->assign('folder_activ', $folder_activ);
        $smarty->assign('products', $products);
        $smarty->display('folders/view.tpl');
    }
}
