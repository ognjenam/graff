<section class="htc__product__area ptb--130 bg__white">
   <div class="container boxShadow alignCenterUl">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#categories" role="tab" aria-controls="categories">Categories</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#products_panel" role="tab" aria-controls="products_panel">Products</a>
         </li>
         <li class="nav-item">
            <a id="users-panel-link" class="nav-link" data-toggle="tab" href="#users" role="tab" aria-controls="users">Users</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#stats" role="tab" aria-controls="stats">Stats</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#author" role="tab" aria-controls="author">Author</a>
         </li>
      </ul>

      <div class="tab-content ">
        <!-- CATEGORIES -->
         <div class="tab-pane active " id="categories" role="tabpanel">
            <section class="htc__category__area bg__white " >
               <div class="page">

                  <table class="layout display responsive-table">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th colspan="2">Name</th>
                        </tr>
                     </thead>
                     <tbody id="category-table">
                       <?php
                       require_once(__DIR__."/../config/connection.php");
                       require_once(__DIR__."/../models/categories/functions.php");
                       require_once(__DIR__."/../models/products/functions.php");
                       $categories = queryExecute(getCategories());
                       $counter = 1;
                       foreach($categories as $c):
                       ?>
                        <tr>
                          <input type="hidden" id="hiddenCat" value="<?= $c -> category_ID ?>">
                           <td class="organisationnumber"><?= $counter++; ?></td>
                           <td class="organisationname"><?= $c -> name ?></td>
                           <td class="actions">
                              <a href="#" data-id = "<?= $c -> category_ID ?>" class="edit-item" title="Edit">Edit </a> -
                              <a href="#" data-id = "<?= $c -> category_ID ?>" class="remove-item" title="Remove">Remove</a>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
               <div class="container" >
                  <div class="row">
                     <div class="col-md-12 col-lg-6 col-sm-12">
                        <div class="htc__category__container">
                           <div class="category-form-wrap formCategory">
                              <div class="category-title">
                                 <h2 class="category__title">Add </h2>
                              </div>
                              <!-- <form class="form_category" action="#" method="post"> -->
                                 <div class="single-category-form">
                                    <div class="category-box subject">
                                       <input type="text" id="add-cat-value" name="subject" placeholder="Name">

                                    </div>
                                    <p class="jewelryP" ><i id="errorNameCat"></i></p>

                                 </div>
                                 <!-- <span id="catNameError">sdfsdffd</span> -->
                                 <div class="category-btn">
                                    <button type="submit" id="add-cat" class="fv-btn">Add</button>
                                 </div>
                              <!-- </form> -->
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-6 col-sm-12">
                        <div class="htc__category__container">
                           <div class="category-form-wrap formCategory">
                              <div class="category-title">
                                 <h2 class="category__title">Update</h2>
                              </div>
                              <!-- <form class="form_category" action="#" method="post"> -->
                                 <div class="single-category-form">
                                    <div class="category-box subject">
                                      <input type="hidden" id="hidden-cat" value="">
                                       <input type="text" id="edit-cat" name="subject" placeholder="Name">

                                    </div>
                                    <p class="jewelryP"><i id="errorNameEditCat"></i></p>
                                 </div>
                                 <div class="category-btn">
                                    <button type="submit"  class="fv-btn" id="edit-btn-cat" >Edit</button>
                                 </div>
                              <!-- </form> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>


         <!--  PRODUCTS -->
         <div class="tab-pane" id="products_panel" role="tabpanel">
           <section class="htc__category__area bg__white " >
              <div class="page">

                <div class="wrapper-btn">
                    <button type="submit" id="add-prod-btn" class="btn-pulse">add product</button>
                </div>
                 <table id="pag-table" class="layout display responsive-table pagination_display">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Cover image</th>
                          <th>Big image</th>
                          <th>Price</th>
                          <th>Old price</th>
                          <th>Description</th>
                          <th>Color</th>
                          <th>Category</th>
                          <th></th>
                       </tr>
                    </thead>
                    <tbody id="pagination_products">
                      <?php
                      $count = 1;

                        $paginationRes = queryExecute(productsImages());

                        foreach($paginationRes as $key => $p):
                            if($key == 0){
                      ?>
                      <tr>
                        <input type="hidden" id="hiddenProd" value="<?= $p -> product_ID?>">
                         <td class="organisationnumber"><?= $p -> product_ID?></td>
                         <td class="organisationname"><?= $p -> name?></td>
                         <td> <img class="img-size-optimize" src="assets/<?=$p -> image?>"/></td>
                         <td> <img class="img-size-optimize" src="assets/<?=$p -> image_big?>"/></td>
                         <td class="organisationname">&dollar;<?= $p -> price?></td>
                         <td class="organisationname"><?php

                         if($p -> price_old == NULL){
                           echo "/";
                         }
                         else {
                           echo "&dollar;".$p -> price_old;
                         }



                         ?></td>
                         <td  class="organisationname resize-descr border-edit-2 no_top_border"><?= $p -> description?></td>
                         <td class="organisationname"><?= $p -> color?></td>
                         <td class="organisationname"><?php


                         $result_prod = categoryByProduct($p -> product_ID);
                         echo $result_prod -> catName;


                         ?></td>
                         <td class="actions">
                            <a href="#" data-id="<?= $p -> product_ID?>" class="edit-item-product" title="Edit">Edit </a> -
                            <a href="#" data-id="<?= $p -> product_ID?>" class="remove-item-product" title="Remove">Remove</a>
                         </td>
                      </tr>

                        <?php
                      }

                      else { ?>
                        <tr>
                          <input type="hidden" id="hiddenProd" value="<?= $p -> product_ID?>">
                           <td class="organisationnumber"><?= $p -> product_ID?></td>
                           <td class="organisationname"><?= $p -> name?></td>
                           <td> <img class="img-size-optimize" src="assets/<?=$p -> image?>"/></td>
                           <td> <img class="img-size-optimize" src="assets/<?=$p -> image_big ?>"/></td>
                           <td class="organisationname">&dollar;<?= $p -> price?></td>
                           <td class="organisationname"><?php


                           if($p -> price_old == NULL){
                             echo "/";
                           }
                           else {
                             echo "&dollar;".$p -> price_old;
                           }
                           ?>


                         </td>
                           <td class="organisationname resize-descr border-edit-2"><?= $p -> description?></td>
                           <td class="organisationname"><?= $p -> color?></td>
                           <td class="organisationname"> <?php
                           $result_prod = categoryByProduct($p -> product_ID);
                           echo $result_prod -> catName;

                           ?>
                           </td>
                           <td class="actions">
                              <a href="#" data-id="<?= $p -> product_ID?>" class="edit-item-product" title="Edit">Edit </a> -
                              <a href="#" data-id="<?= $p -> product_ID?>" class="remove-item-product" title="Remove">Remove</a>
                           </td>
                        </tr>
                        <?php
                      }
                      endforeach;
                        ?>


                    </tbody>

                 </table>
                 <ul id="nav_pagination" class="list-inline">
                   <?php

                      $result = countProducts();
                      $sum = $result -> total;

                      $links = ceil($sum / 4);

                      for($i = 1; $i <= $links ; $i++):
                        ?>
                        <li class="list-inline-item" data-id = "<?= $i ?>"><?= $i ?></li>
                        <?php
                      endfor;

                   ?>

                 </ul>

              </div>
              <div class="container" >
                <form enctype="multipart/form-data" id="form-prod">
                 <div class="row" id="row-prod">
                    <div class="col-md-6 col-lg-3 col-sm-12">
                       <div class="htc__category__container">
                          <div class="category-form-wrap formCategory">
                             <div class="category-title">
                                <h2 class="category__title">Name </h2>
                             </div>
                             <!-- <form class="form_category"  method="post"> -->
                                <div class="single-category-form">
                                   <div class="category-box subject">
                                     <input type="hidden" id="hidden-prod" value="">
                                      <input type="text" id="edit-prod" name="subject" placeholder="Name">

                                   </div>
                                   <p class="jewelryP"><i id="errorNameEditProd"></i></p>
                                   <p class="jewelryP"><i id="errorName-Edit-Edit-Prod"></i></p>
                                </div>
                                <!-- <div class="category-btn">
                                   <button type="submit" id="edit-btn-prod" class="fv-btn">Edit</button>
                                </div> -->
                             <!-- </form> -->
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-12">
                       <div class="htc__category__container">
                          <div class="category-form-wrap formCategory">
                             <div class="category-title">
                                <h2 class="category__title">Description</h2>
                             </div>
                             <!-- <form class="form_category" action="#" method="post"> -->
                                <div class="single-category-form">
                                   <div class="category-box subject">
                                     <input type="hidden"  value="">
                                      <input type="text" id="edit-descr" name="subject" placeholder="Description">

                                   </div>
                                   <p class="jewelryP"><i id="errorDescrEditProd"></i></p>
                                   <p class="jewelryP"><i id="errorDescr-Edit-Edit-Prod"></i></p>
                                </div>
                                <!-- <div class="category-btn">
                                   <button type="submit"  id="edit-btn-descr" class="fv-btn">Edit</button>
                                </div> -->
                             <!-- </form> -->
                          </div>
                       </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-sm-12">
                       <div class="htc__category__container">
                          <div class="category-form-wrap formCategory">
                             <div class="category-title">
                                <h2 class="category__title">Price</h2>
                             </div>
                             <!-- <form class="form_category" action="#" method="post"> -->
                                <div class="single-category-form">
                                   <div class="category-box subject">
                                     <input type="hidden"  value="">
                                      <input type="text"  id="edit-price" name="subject" placeholder="Price">

                                   </div>
                                   <p class="jewelryP"><i id="errorPriceEditProd"></i></p>
                                   <p class="jewelryP"><i id="errorPrice-Edit-Edit-Prod"></i></p>
                                </div>
                                <!-- <div class="category-btn">
                                   <button type="submit"  id="edit-btn-price" class="fv-btn">Edit</button>
                                </div> -->
                             <!-- </form> -->
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-12">
                       <div class="htc__category__container">
                          <div class="category-form-wrap formCategory">
                             <div class="category-title">
                                <h2 class="category__title">Old price</h2>
                             </div>
                             <!-- <form class="form_category" action="#" method="post"> -->
                                <div class="single-category-form">
                                   <div class="category-box subject">
                                     <input type="hidden"  value="">
                                      <input type="text" id="edit-old-price"  name="subject" placeholder="Old price">
                                   </div>
                                   <p class="jewelryP"><i id="errorOldPriceEditProd"></i></p>
                                   <p class="jewelryP"><i id="errorOldPrice-Edit-Edit-Prod"></i></p>
                                </div>
                                <!-- <div class="category-btn">
                                   <button type="submit"  id="edit-btn-oldprice" class="fv-btn">Edit</button>
                                </div> -->
                             <!-- </form> -->
                          </div>
                       </div>
                    </div>


                 </div>
                 <div class="row">
                   <div class="col-md-6 col-lg-4 col-sm-12">
                      <div class="htc__category__container">
                         <div class="category-form-wrap formCategory">
                            <div class="category-title">
                               <h2 class="category__title">Color</h2>
                            </div>
                            <!-- <form class="form_category" action="#" method="post"> -->
                               <div class="single-category-form">
                                  <div class="category-box subject">
                                     <input type="text"  id="edit-color" name="subject" placeholder="Color">

                                  </div>
                                  <p class="jewelryP"><i id="errorColorEditProd"></i></p>
                                  <p class="jewelryP"><i id="errorColor-Edit-Edit-Prod"></i></p>
                               </div>
                               <!-- <div class="category-btn">
                                  <button type="submit"  id="edit-btn-color" class="fv-btn">Edit</button>
                               </div> -->
                            <!-- </form> -->
                         </div>
                      </div>
                   </div>
                   <div class="col-md-6 col-lg-4 col-sm-12">
                      <div class="htc__category__container">
                         <div class="category-form-wrap formCategory">
                            <div class="category-title">
                               <h2 class="category__title">Category</h2>
                            </div>
                            <!-- <form class="form_category" action="#" method="post"> -->
                               <div class="single-category-form">
                                  <div class=" subject">
                                      <input class="chosen-value"  id="cat_val" type="text" placeholder=""/>
                                                  <ul class="value-list">


                                                   <?php
                                                   $categories = queryExecute(getCategories());
                                                   foreach($categories as $c):
                                                   ?>
                                                   <li data-id = "<?= $c -> category_ID ?>"><?= $c -> name?></li>
                                                 <?php endforeach;?>
                                                  </ul>

                                  </div>
                                  <p class="jewelryP"><i id="errorChooseCatEditProd"></i></p>
                                  <p class="jewelryP"><i id="errorChooseCat-Edit-Edit-Prod"></i></p>
                               </div>

                            <!-- </form> -->
                         </div>
                      </div>
                   </div>
                   <div class="col-md-6 col-lg-4 col-sm-12">
                      <div class="htc__category__container">
                         <div class="category-form-wrap formCategory">
                            <div class="category-title">
                               <h2 class="category__title">Cover image </h2>
                            </div>
                            <!-- <form class="form_category" action="#" method="post"> -->
                               <div class="single-category-form">
                                  <div class="category-box subject">

                                <input type="file" id="small-image" name="small-image"/>
                                <input type="button" value="Upload" onclick="document.getElementById('small-image').click();" />

                                  </div>
                                  <p class="jewelryP" ><i id="small-image-path"></i></p>
                                  <p class="jewelryP" ><i id="errorSmallImgEditProd"></i></p>
                                  <p class="jewelryP"><i id="errorSmallImg-Edit-Edit-Prod"></i></p>
                               </div>
                               <!-- <div class="category-btn">
                                  <button type="submit" id="edit-btn-cover" class="fv-btn">Edit</button>
                               </div> -->
                            <!-- </form> -->
                         </div>
                      </div>
                   </div>
                   <div class="col-md-6 col-lg-4 col-sm-12">
                      <div class="htc__category__container">
                         <div class="category-form-wrap formCategory">
                            <div class="category-title">
                               <h2 class="category__title">Big image </h2>
                            </div>
                            <!-- <form class="form_category" action="#" method="post"> -->
                               <div class="single-category-form">
                                  <div class="category-box subject">
                                    <input type="file" id="big-image" name="big-image">
                                    <input type="button" value="Upload" onclick="document.getElementById('big-image').click();" />

                                  </div>
                                  <p class="jewelryP" ><i id="big-image-path"></i></p>
                                  <p class="jewelryP" ><i id="errorBigImgEditProd"></i></p>
                                  <p class="jewelryP"><i id="errorBigImg-Edit-Edit-Prod"></i></p>

                               </div>
                               <!-- <div class="category-btn">
                                  <button type="submit" id="edit-btn-small" class="fv-btn">Edit</button>
                               </div> -->
                            <!-- </form> -->
                         </div>
                      </div>
                   </div>


                 </div>
                 <div class="row">
                   <div class="col-md-12 col-lg-12 col-sm-12">
                     <div class="category-btn" id="add-product-div">
                       <input type="submit" id="edit-values-product" value = "Edit" class="fv-btn"/>
                        <input type="submit" id="add-product" value = "Add" class="fv-btn"/>

                     </div>
                   </div>

                 </div>
               </form>
              </div>
           </section>




         </div>
         <!-- USERS -->
         <div class="tab-pane" id="users" role="tabpanel">
           <section class="htc__category__area bg__white " >
              <div class="page">

                 <table class="layout display responsive-table">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>E-mail</th>
                          <th>Active</th>
                          <th>Role</th>
                          <th>Last visit</th>
                          <th></th>
                       </tr>
                    </thead>
                    <tbody id="users-panel">
                      <?php
                      require_once(__DIR__."/../models/users/functions.php");
                      $users = getUsers();
                      $counter = 1;
                      foreach($users as $u):
                      ?>
                       <tr>
                         <input type="hidden" id="hiddenUser" value="<?= $u -> user_ID ?>">
                          <td class="organisationnumber"><?= $counter++; ?></td>
                          <td class="organisationname"><?php
                          if($u -> role_ID == 1):

                            echo "<p style = 'color: red'>" . $u -> username . "</p>";

                          else:
                            echo $u -> username;
                          endif;

                          ?></td>
                          <td class="organisationname"><?=  $u -> e_mail ?></td>
                          <td>
                            <?php

                                if($u -> active == 1){

                            ?>
                            <div class="circle green"></div>
                            <?php
                          }
                          else {
                            ?>
                            <div class="circle red"></div>
                            <?php

                          }
                            ?>


                          </td>
                          <td data-id = "<?= $u -> roleID ?>" class="organisationname"><?=

                            $u -> role;

                           ?></td>
                           <td class="organisationname"><?php
                            $timestamp = strtotime($u -> last_visit);
                            echo date("d/F/Y H:i:s", $timestamp);

                            ?></td>
                          <td class="actions">
                             <a href="#" data-id="<?= $u -> user_ID ?>" class="edit-item-user" title="Edit">Edit </a>
                          </td>
                       </tr>
                     <?php endforeach; ?>
                    </tbody>
                 </table>
              </div>
              <div class="container" >
                 <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="htc__category__container">
                          <div class="category-form-wrap formCategory">
                             <div class="category-title">
                                <h2 class="category__title">Role</h2>
                             </div>
                             <!-- <form class="form_category" action="#" method="post"> -->
                                <div class="single-category-form">
                                   <div class="category-box subject">
                                      <input type="text" id="user-role" data-id name="subject" placeholder="Role">
                                   </div>
                                   <p class="jewelryP"><i id="errorRoleUser"></i></p>
                                </div>

                                <div class="category-btn">
                                   <button type="submit" id="submit-user-role" class="fv-btn">Edit</button>
                                </div>
                             <!-- </form> -->
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </section>


         </div>



         <!-- STATS -->
         <div class="tab-pane" id="stats" role="tabpanel">
           <section class="htc__category__area bg__white " >
              <div class="page">

                 <table class="layout display responsive-table">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Page</th>
                          <th>%</th>
                          <th>Last 24h</th>

                       </tr>
                    </thead>
                    <tbody id="page-visits">

                   </tbody>
                </table>
              </div>
           </section>



         </div>
         <!-- AUTHOR -->

      <div class="tab-pane" id="author" role="tabpanel">
        <section class="htc__category__area bg__white " >
           <div class="page">

             <table class="layout display responsive-table">
                <thead>
                   <tr>
                     <th>#</th>

                      <th colspan="2">File</th>
                   </tr>
                </thead>
                <tbody>
                  <?php
                  $counter = 1;
                  $data = ["CV", "Products"];
                  $formats = ["Word", "Excel"];

                  foreach($data as $key => $d):


                  ?>

                   <tr class='increaseWidth '>
                     <td class='increaseWidth organisationnumber'> <?= $counter++?>
                     </td>
                      <td class="organisationname back_border td_edit"><?= $d ?>
                        <p class="jewelryP">
                        <?php
                        if($d == "CV"):
                          echo $formats[0];
                        else:
                          if($d == "Products"):
                            echo $formats[1];
                          endif;

                        endif;


                        ?>

                        </p>
                        </td>
                      <td class="actions td_edit">
                        <a href="index.php?page=file&id=<?= $key ?>">Download</a>
                      </td>
                   </tr>
                 <?php
                        endforeach; ?>
                      </table>

      </div>
   </div>
</section>
