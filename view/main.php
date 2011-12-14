<?php
//loginform.inc
if(!$_SESSION['userInSession']){
?>
<div id="right">
<h3><strong>Welcome to tsuyu.org (Webpage)</strong></h3>
   <div id="welcome">
   <img src="template/images/pic_1.jpg" width="171" height="137" alt="Pic 1" class="left" />
   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
   sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        <p class="more">&nbsp;&nbsp;</p>
      </div>
      <br></br>
      <h3><strong>tsuyu.org Profile</strong></h3>
      <div id="profile">
        <div id="corp">
          <div id="corp-img">
            Profile
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.<a href="#">more</a>.</p>
        </div>
        <div id="indu">
          <div id="indu-img">
            Services
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="clear"> </div>
        
      </div>
   </div>
<?php }?>