<?php


namespace App\Data\User;


use App\Controller\AbstractController;
use App\Data\User\Exception\EmptyFieldsException;
use App\Data\User\UserService;
use App\Data\User\Exception\PasswordMismathException;
use App\Http\Request;
use App\Http\Response;

class UserController extends AbstractController
{

    /**
     * @param Request $request
     * @param UserRepositoryOld $userRepository
     * @route("/user/auth")
     */
    public function auth(Request $request, UserRepositoryOld $userRepository)
    {
        $data = [];
        if ($request->isPost()) {

            try {
                $user = $this->authAction($userRepository);

                $_SESSION['id'] = $user->getId();

                return $this->redirect('/user/auth');
            } catch (EmptyFieldsException $e) {
                $data['error'] = [
                    'message' => 'Заполните необходимые поля',
                    'requiredFields' => $e->getEmptyFields(),
                ];
            } catch (PasswordMismathException $e) {
                $data['error'] = [
                    'message' => 'Пользователь с таким емайлом и паролем не найден!',
                    'requiredFields' => [
                        'password' => true,
                        'passwordRepeat' => true,
                    ],
                ];
            }
        }
        return $this->render('user/auth.form.tpl', $data);
    }

    /**
     * @route("/user/register")
     */
    public function register(Request $request, UserRepositoryOld $userRepository, UserService $userService)
    {
        $data = [];
 //       echo "<pre>"; var_dump($request); echo "</pre>";
        if ($request->isPost()) {

            try {
                $user = $this->registerAction();
                $user->setPassword($userService->passwordEncoder($user->getPassword()));


                $userRepository->save($user);

                return $this->redirect('/user/register');
   //             echo "<pre>"; var_dump($this); echo "</pre>"; exit;
            } catch (EmptyFieldsException $e) {
                $data['error'] = [
                    'message' => 'Заполните необходимые поля',
                    'requiredFields' => $e->getEmptyFields(),
                ];
            } catch (PasswordMismathException $e) {
                $data['error'] = [
                    'message' => 'Пароли не совпадают',
                    'requiredFields' => [
                        'password' => true,
                        'passwordRepeat' => true,
                    ],
                ];
            }
        }


        return $this->render('user/register.form.tpl', $data);
    }

    private function registerAction(): UserModel
    {
        $name = $this->request->getStrFromPost('name');
        $email = $this->request->getStrFromPost('email');
        $password = $this->request->getStrFromPost('password');
        $passwordRepeat = $this->request->getStrFromPost('passwordRepeat');

        //      echo "<pre>"; var_dump($password, $passwordRepeat); echo "</pre>";

        $hasEmptyFields = false;
        $emptyFieldsException = new EmptyFieldsException();
        if (empty($name)) {
            $emptyFieldsException->addEmptyFields('name');
            $hasEmptyFields = true;
        }
        if (empty($email)) {
            $emptyFieldsException->addEmptyFields('email');
            $hasEmptyFields = true;
        }
        if (empty($password)) {
            $emptyFieldsException->addEmptyFields('password');
            $hasEmptyFields = true;
        }
        if (empty($passwordRepeat)) {
            $emptyFieldsException->addEmptyFields('passwordRepeat');
            $hasEmptyFields = true;
        }

        if ($hasEmptyFields) {
            throw $emptyFieldsException;
        }

        if ($password !== $passwordRepeat) {
            throw new PasswordMismathException();
        }

        $user = new UserModel($name, $email, $password);
        return $user;
    }

    /**
     * @param UserRepositoryOld $userRepository
     * @return UserModel|null
     * @throws EmptyFieldsException
     * @throws PasswordMismathException
     */
    private function authAction(UserRepositoryOld $userRepository): ?UserModel
    {
        $email = $this->request->getStrFromPost('email');
        $password = $this->request->getStrFromPost('password');

        //      echo "<pre>"; var_dump($password, $passwordRepeat); echo "</pre>";

        $hasEmptyFields = false;
        $emptyFieldsException = new EmptyFieldsException();
        if (empty($email)) {
            $emptyFieldsException->addEmptyFields('email');
            $hasEmptyFields = true;
        }
        if (empty($password)) {
            $emptyFieldsException->addEmptyFields('password');
            $hasEmptyFields = true;
        }

        if ($hasEmptyFields) {
            throw $emptyFieldsException;
        }

        $user = $userRepository->findByEmailAndPassword($email, $password);

        if (is_null($user)) {
            throw new PasswordMismathException();
        }
        return $user;
    }


}