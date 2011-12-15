<?php

include './facade/class.userfacade.php';
include 'abstract.controller.php';

class UserController extends Controller {

    public function __construct() {
        session_start();
        $this->com = $_GET['com'];
        $this->action = $_GET['action'];
        $this->message = NULL;
        $this->_init();
    }

    private function _init() {

        switch ($this->com) {
            case 'user':
                switch ($this->action) {
                    case 'create':
                        $user = new UserFacade();
                        $user->userInstance()->setUsername("admin");
                        $user->userInstance()->setName("admin");
                        $user->userInstance()->setEmail("admin@localhost.com");
                        $user->userInstance()->setTelno("123456789");
                        $user->userInstance()->setPassword("123456");
                        $user->userInstance()->setIsActive(1);
                        $user->addressInstance()->setAddress1("Kg. Cherating");
                        $user->createUser($user);
                        break;
                    case 'retrieve':
                        $user = new UserFacade('UserApi');
                        $user->retrieveUser();
                        break;
                    case 'update':
                        $user = new UserFacade();
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
                        $user = new UserFacade('UserApi');
                        $user->deleteUser("admin");
                        break;
                }
                break;
            case 'login':
                if ($_POST['submitLogin']) {
                    $user = new UserFacade('UserApi');
                    $login = $user->retrieveUser($_POST['username']);
                    if (!empty($login)) {
                        if ($login['username'] == $_POST['username'] && $login['password'] == $_POST['password']) {
                            session_start();
                            $_SESSION['user']['username'] = $login['username'];
                            Util::redirect("index.php?com=otherpage");
                        } else {
                            Util::redirect("index.php?com=login");
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
                include 'view/user/loginform.php';
                break;
            case"user":
                switch ($this->action) {
                    case "view":
                        if ($_SESSION['user'] || $_SESSION['user'][0]->username == $_REQUEST['username']) {
                            include 'view/user/adduser.php';
                        }
                        break;
                }
                break;
            case "otherpage":
                include 'view/user/otherpage.php';
                break;
            default:
                include 'view/user/main.php';
                break;
        }
    }

}

?>
