<?php

namespace App\Data;

use App\Db\Db;

class FolderService {
    
    public function get_Spisok(){
        $query='SELECT * FROM folders';
        return Db::fetchAll($query);
    }

    public function get_By_Id($id_folder) {
        $query="SELECT * FROM folders WHERE id_folder = $id_folder";
        return Db::fetchRow($query);
    }
    
    public function update_By_Id($id_folder, $folder) {
//        if (isset($product['id_folder'])){
//            unset($product['id_folder']);
//        }
        return Db::update('folders', $folder, "id_folder = $id_folder");

    }

    public function add($folder) {
        if (isset($product['id_folder'])){
            unset($product['id_folder']);
        }
        return Db::insert('folders', $folder);
    }

    public function delete_By_Id($id_folder) {
        return Db::delete('folders', "id_folder = $id_folder");
    }
    
    public function getDataFromPost(Request $request) {
        return [
          'id_folder' => $request->getIntFromPost('id_folder', false),  
          'name_folder' => $request->getStrFromPost('name_folder', ''),
        ];
    }
    
    public function getByName( string $name_folder) {
        $query = "SELECT * FROM folders WHERE name_folder= '$name_folder'";
        return Db::fetchRow($query);
    }
    
}

