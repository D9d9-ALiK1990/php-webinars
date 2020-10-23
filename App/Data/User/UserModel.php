<?php


namespace App\Data\User;

use App\Model\AbstractModel;

/**
 * Class UserModel
 * @package App\Data\User
 * @Model\Table("users")
 */
class UserModel extends AbstractModel
{
    /**
     * @var int
     * @Model\Id
     */
    protected $id = 0;

    /**
     * @var string
     * @Model\TableField
     */
    protected $name;

    /**
     * @var string
     * @Model\TableField
     */
    protected $email;

    /**
     * @var string
     * @Model\TableField
     */
    protected $password;

   // public function __construct(string $name, string $email, string $password)

    public function __construct()
    {
//        $this->name = $name;
//        $this->email = $email;
//        $this->password = $password;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}

