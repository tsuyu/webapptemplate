<?php

include_once '../facade/class.facade.php';

$user = new Facade(array("UserApi","User","Address"));
$user->userInstance()->setUsername("admin");
$user->userInstance()->setName("admin");
$user->userInstance()->setEmail("admin@localhost");
$user->userInstance()->setTelno("123456789");
$user->userInstance()->setPassword("123456");
$user->userInstance()->setIsActive(1);
$user->userInstance()->setPermission(4);
$user->addressInstance()->setAddress1("Kg. Cherating");
$user->saveUser($user);

?>
