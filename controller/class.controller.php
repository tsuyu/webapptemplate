<?php

include '../facade/class.facade.php';

class Controller {

    public $com;
    public $action;
    public $message;

    public function __construct($request) {
        session_start();
        $this->com = $request['com'];
        $this->action = $request['action'];
        $this->message = '';
        $this->_init();
    }
    
    private function _init() {

        switch ($this->com) {
            case 'user':
                switch ($this->action) {
                   case 'create':
                        $user = new Facade('user:default');
                        $user->userInstance()->setUsername("admin");
                        $user->userInstance()->setName("admin");
                        $user->userInstance()->setEmail("admin@localhost.com");
                        $user->userInstance()->setTelno("123456789");
                        $user->userInstance()->setPassword("123456");
                        $user->userInstance()->setIsActive(1);
                        $user->userInstance()->setPermission(4);
                        $user->addressInstance()->setAddress1("Kg. Cherating");
                        $user->saveUser($user);
                        break;
                     case 'retrieve':
                        $user = new Facade('user:default');
                        $user->retrieveUser();
                        break;
                     case 'update':
                        $user = new Facade('user:default');
                        $user->userInstance()->setName("admin");
                        $user->userInstance()->setEmail("admin@localhost.com");
                        $user->userInstance()->setTelno("123456789");
                        $user->userInstance()->setPassword("123456");
                        $user->userInstance()->setIsActive(1);
                        $user->userInstance()->setPermission(4);
                        $user->addressInstance()->setAddress1("Kg. Cherating");
                        $user->updateUser($user);
                        break;
                     case 'delete':
                        $user = new Facade('user:delete');
                        //$user->deleteUser("admin");
                        break;
                }
                break;
            case 'login':

                if ($_REQUEST['submitLogin']) {
                    $user = $this->facade->getUser($_REQUEST['username']);
                    if ($user) {
                        //print_r($user);
                        if ($user[0]->username == $_REQUEST['username'] && $user[0]->password == $_REQUEST['password']) {
                            //	if($user[0]->permission & $this->isUser){
                            $_SESSION['user'] = $user;
                            header("Location:index.php?com=otherpage");
                            //}
                        } else {
                            header("Location:index.php?com=login");
                            $this->facade->utilInstance()->flash_warning("Login Failed!!");
                            exit;
                        }
                    }
                }
                break;
            case 'logout':
                $this->logout();
                break;
        }
    }

    public function logout() {
        $_SESSION = array();
        session_unset();
        session_destroy();
        header("Location:index.php");
        exit();
    }

    public function loadMenu() {
        if ($_SESSION['user']) {
            echo<<<LIST
        <h3 class="menuheader">User Tool</h3>
		<ul>
		<li><a href="index.php?com=logout">Logout</a></li>
		</ul>
LIST;
        } else {
            echo <<<LIST
	<h3 class="menuheader">Main Menu</h3>
	<ul>
       <li><a href="index.php">Home</a></li>
       <li><a href="index.php?com=login">Authentication</a></li>
    </ul>
LIST;
        }
    }

    public function loadForm() {
        switch ($this->com) {
            case "login":
                include 'view/loginform.php';
                break;
            case"user":
                switch ($this->action) {
                    case "view":
                        if ($_SESSION['user'] || $_SESSION['user'][0]->username == $_REQUEST['username']) {
                            include 'view/adduser.php';
                        }
                        break;
                }
                break;
            case "otherpage":
                include 'view/otherpage.php';
                break;
            default:
                include 'view/main.php';
                break;
        }
    }

}

