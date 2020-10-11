<?php

namespace App\Middleware;

use App\Data\User\UserRepository;
use App\Data\User\UserService;
use App\DI\Container;
use App\Http\Request;
use App\Data\User\UserModel;
use Exception;
use App\Renderer\Renderer;

class AuthMiddleware implements IMiddleware
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * AuthMiddleware constructor.
     * @param UserRepository $userRepository
     * @param Request $request
     * @param Container $di
     */
    public function __construct(
        UserRepository $userRepository,
        Request $request,
        Container $di,
        UserService $userService
    )
    {
        $this->userRepository = $userRepository;
        $this->request = $request;
        $this->di = $di;
        $this->userService = $userService;
    }

    /**
     * @throws Exception
     */
    public function beforeDispatch()
    {
        $this->sessionInit();
        $user = $this->getSessionUser();
        if (is_null($user)) {
            $this->auth();
        }

    }

    protected function sessionInit()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * @return UserModel|null
     */
    protected function getSessionUser() {
        $id_user = (int) ($_SESSION['id_user'] ?? 0);

        if (!$id_user) {
            return null;
        }

        $user = $this->userRepository->getById($id_user);

        if (!is_null($user)) {
            $this->setUser($user);
        }
        return $user;
    }


    /**
     * @return UserModel|null
     * @throws Exception
     */
    protected function auth()
    {
        if (!$this->request->isPost()){
            return null;
        }

        $email = $this->request->getStrFromPost('email');
        $password = $this->request->getStrFromPost('password');

        if ($email === false || $password === false) {
            return null;
        }

        $user = $this->userRepository->getByEmail($email);

        if (is_null($user) || !$this->userService->passwordVerify($password, $user->getPassword())){
            return null;
        }



        $_SESSION['id_user'] = $user->getId();
        $this->setUser($user);

        return $user;
    }

    protected function setUser(UserModel $user)
    {
        $this->di->addOneMapping(UserModel::class, $user);
    }

    public function afterDispatch()
    {

    }

}
