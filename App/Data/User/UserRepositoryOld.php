<?php
namespace App\Data\User;

use App\Data\User\UserModel;
use App\Data\User\UserService;
use App\Db\Db;
use Exception;


class UserRepositoryOld
{
    /**
     * @var \App\Data\User\UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {

        $this->userService = $userService;
    }

    /**
     * @param int $id_user
     * @return \App\Data\User\UserModel
     * @throws Exception
     */
    public function getById(int $id_user)
    {
        $query = "SELECT u.* FROM users u WHERE u.id = $id_user";
        $userArray = Db::fetchRow($query);

        return $this->fromArray($userArray);
    }

    public function save(UserModel $user): UserModel {
        $id = $user->getId();
        $arrayData = $this->toArray($user);
        if ($id) {
            Db::update('users', $arrayData, "id = $id");
            return $user;
        }

        $id = Db::insert('users', $arrayData);
        $user->setId($id);

        return $user;
    }

    public function fromArray(array $data): UserModel {
        $id = $data['id'];

        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (is_null($name)) {
            throw new Exception('Имя пользователя для инициализации модели обязательно');
        }
        if (is_null($email)) {
            throw new Exception('email пользователя для инициализации модели обязательно');
        }
        if (is_null($password)) {
            throw new Exception('Пароль для инициализации модели обязательно');
        }

        $user = new UserModel($name, $email, $password);

        $user->setId($id);

        return $user;
    }

    public function toArray(UserModel $user) {
        $data = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];

        return $data;
    }

    /**
     * @param string $email
     * @param string $password
     * @return \App\Data\User\UserModel|null
     * @throws Exception
     */
    public function getByEmail(string $email): ?UserModel
        {
        $query = "SELECT u.* FROM users u WHERE u.email = '$email'";
        $userArray = Db::fetchRow($query);

        if (empty($userArray)) {
            return null;
        }
        return $this->fromArray($userArray);
    }

}