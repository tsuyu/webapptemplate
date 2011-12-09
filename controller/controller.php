<?php

include 'facade/class.facade.php';

class Controller {

    public $reqArray;
    public $com;
    public $action;
    public $message;
    public $facade;

    public function __construct($requestArray) {
        session_start();
        $this->facade = Facade::getInstance(array('userapi' => 'UserApi', 'util' => 'Util'));
        $this->reqArray = $requestArray;
        $this->message = '';
        $this->sanitize();
        $this->_init();
    }

    private function sanitize() {
        switch ($this->reqArray['com']) {
            case "login":
            case "user":
            case "otherpage":
            case "logout":
                $this->com = $this->reqArray['com'];
                break;
            default:
                $this->com = 'invalid';
                break;
        }
        $this->processAction();
    }

    private function _init() {
        switch ($this->com) {
            case 'user':
                switch ($this->action) {
                    case 'edit':
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
                            $_SESSION['userInSession'] = $user;
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

    private function processAction() {
        switch ($this->reqArray['action']) {
            case "view":
            case "edit":
                $this->action = $this->reqArray['action'];
                break;
            default:
                $this->action = 'invalid1';
                break;
        }
    }

    public function loadMenu() {
        if ($_SESSION['userInSession']) {
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
                        if ($_SESSION['userInSession'] || $_SESSION['userInSession'][0]->username == $_REQUEST['username']) {
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

