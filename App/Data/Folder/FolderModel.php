<?php

namespace App\Data\Folder;

class FolderModel {
  
    /**
     *
     * @var int
     */
    protected $id_folder;
    
    /**
     *
     * @var string 
     */
    protected $name_folder;
    
    /**
     * 
     * @param string $name_folder
     */
    public function __construct(string $name_folder) {
        $this->setName_folder($name_folder);
    }
    
    /**
     * 
     * @return int
     */
    public function getId_folder(): int {
        return $this->id_folder;
    }
    
    /**
     * 
     * @param int $id_folder
     * @return $this
     */
    public function setId_folder($id_folder) {
        $this->id_folder=$id_folder;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getName_folder(): string {
        return $this->name_folder;
    }
    
    /**
     * 
     * @param string $name_folder
     * @return $this
     */
    public function setName_folder($name_folder) {
        $this->name_folder=$name_folder;
        return $this;
    }
    
    
}
