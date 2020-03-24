
<div class="wrapper fixed__footer">

   <!-- Start Header Style -->
   <header id="header" class="htc-header">

      <!-- Start Mainmenu Area -->
      <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
         <div class="container" >
<div class="row" >
   <div class="col-md-2 col-lg-2 col-6" id="remove_logo">
      <div class="logo">
         <a href="index.php">
         <img src="assets/images/logo/logo1.png" alt="logo">
         </a>
      </div>
   </div>
   <!-- Start MAinmenu Ares -->
   <div class="col-md-8 col-lg-8 d-none d-md-block">
      <nav class="mainmenu__nav  d-none d-lg-block">
         <ul class="main__menu">
           <?php
           require_once(__DIR__."/../../models/categories/functions.php");
           $menu = queryExecute(getMenuItems());
           foreach($menu as $m):
           ?>
            <li onclick = "catchMe('<?= $m -> name?>')" data-id ="<?= $m -> name?>" id="count-<?= $m -> name?>"><a href="#<?= $m -> name?>"><?= ucfirst($m -> name)?></a></li>
          <?php endforeach; ?>
         </ul>

      </nav>
      <div class="mobile-menu clearfix d-block d-lg-none">
         <nav id="mobile_dropdown">
            <ul class="mobile_menu">
              <?php
              $menu = queryExecute(getMenuItems());
              foreach($menu as $m):
              ?>
               <li id="count-<?= $m -> name?>"><a href="#<?= $m -> name?>"><?= ucfirst($m -> name)?></a></li>
              <?php endforeach; ?>
            </ul>
         </nav>
      </div>
   </div>

   <!-- End MAinmenu Ares -->
<!-- <div class="col-md-2 col-lg-2 col-6"> -->
   <div class="col-md-2 col-lg-2" id="remove-width">

      <ul class="menu-extra">

         <li  class="search search__open d-sm-block"><a href="#shop"><span class="ti-search"></span></a> </li>
         <!-- <li><a href="login-register.html"><span class="ti-user"></span></a></li> -->

         <!-- <div class="main-nav"> -->

         <?php if(!isset($_SESSION['user'])):?>
           <div class="main-nav">
             <li><span class="ti-user"></span></li>
           </div>
         <?php else:

           ?>

           <li><span><p class="jewelryP"><i class="user"><?= $_SESSION['user'] -> username ?></i></p>  </span></li>
           <?php

           if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 1){

           ?>
             <li class="cart__menu"><span class="ti-shopping-cart"></span></li>
           <?php } ?>
         <li><span><a href="models/users/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></span> </li>
       <?php endif;?>

      </ul>

   </div>

</div>
<div class="row" id="display_logo">
  <div class="col-md-12 col-lg-12">
    <div class="logo newlogo">
       <a href="index.php">
       <img src="assets/images/logo/logo1.png" alt="logo">
       </a>
    </div>
  </div>

</div>
