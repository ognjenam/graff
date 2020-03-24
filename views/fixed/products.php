
         <!-- Start Our Product Area -->

         <section class="htc__product__area ptb--130 bg__white lessPadding" id="about">

            <div class="container" id="containerVideo">
               <div class="wrapperVideo">
                  <div class="section-announcement">
                     <div class="section-announcement-inner">
                        <p><strong>About us </strong></p>
                     </div>
                  </div>
                  <div class="htc__product__container">
                     <div class="row product__list videoHolder" >
                        <div class="aboutIntro">
                           <p>Why Graff's?</p>
                        </div>
                        <div class="videoAnnoun intro">
                           <div class="aboutIntrop">
                              <p>At Graff your satisfaction is our number one priority. That's why we offer an unconditional 100% Satisfaction Guarantee on our exceptional selection of jewelry, collectibles and fine home accessories.
                                 </br>These are blooms of the imagination. </br>A vision of petals cut from paper and delicately pinned back together, this collection reinterprets nature’s most essential forms.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr class="dotted-rule">
               </div>
            </div>
         </section>
         <section class="htc__product__area ptb--130 bg__white removePadding">
            <div class="container" id="containerVideo">
               <div class="wrapperVideo">
                  <div class="section-announcement">
                     <div class="section-announcement-inner">
                        <span> <strong>April Magic: </strong>
                        <span>Sparkle that makes heads turn</span>
                        </span>
                     </div>
                  </div>
                  <div class="htc__product__container">
                     <div class="row product__list videoHolder" >
                        <video id="p-video" width="50%" height = "50%" loop controls muted autoplay poster="https://kinclimg9.bluestone.com/f_webp,c_scale,w_418,b_rgb:f0f0f0/giproduct/BISP0359S13-POSTER-19123.jpg">
                           <source src="https://kinvid0.bluestone.com/output/mp4/BISP0359S13-VIDEO-19123.mp4/BISP0359S13-VIDEO-19123.mp4" type="video/mp4">
                        </video>
                        <div class="videoAnnoun">
                           <div class="headerAnnoun">
                              <p>New arrivals</p>
                              <p class="jewelryP"><i>The latest looks to love</i></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="htc__product__container boxShadow">
                     <div class="row product__list videoHolder" >
                        <img src="assets/images/ann1.jpg" alt="">
                        <p class="bannerTextBottom">6 Designs Starting from 35 &dollar;</p>
                     </div>
                  </div>
                  <div class="htc__product__container boxShadow">
                     <div class="row product__list videoHolder" >
                        <img src="assets/images/ann2.jpg" alt="">
                        <p class="bannerTextBottom">7 Designs Starting from 30 &dollar;</p>
                     </div>
                  </div>
                  <div class="htc__product__container boxShadow">
                     <div class="row product__list videoHolder" >
                        <img src="assets/images/ann3.jpg" alt="">
                        <p class="bannerTextBottom">2 Designs Starting from 25 &dollar;</p>
                     </div>
                  </div>
                  <div class="htc__product__container boxShadow">
                     <div class="row product__list videoHolder" >
                        <img src="assets/images/ann4.jpg" alt="">
                        <p class="bannerTextBottom">12 Designs Starting from 30 &dollar;</p>
                     </div>
                  </div>
               </div>
            </div>
         </section>

<section class="htc__product__area ptb--130 bg__white" id="shop">
   <div class="container">
      <div class="htc__product__container" >
         <!-- Start Product MEnu -->
         <div class="row">
            <div class="col-md-12">
               <div class="product__menu" id="category-buttons">

                  <button  data-id="0" class="is-checked">All</button>
                  <!-- <button data-filter=".cat-1">Bracelets</button> -->
                  <?php
                  require_once(__DIR__."/../../models/categories/functions.php");
                  require_once(__DIR__."/../../models/products/functions.php");
                   $categories = queryExecute(getCategories());
                   foreach($categories as $c):

                  ?>
                  <button data-id="<?= $c -> category_ID?>"><?= $c -> name ?></button>

                <?php endforeach; ?>
               </div>
            </div>
         </div>
         <!-- End Product MEnu -->
         <div class="row" id="products" style="height: auto!important;">


           <!-- Start Single Product -->
           <?php


             $products = queryExecute(getProducts());
             foreach($products as $p):


           ?>

            <div class="col-md-3 single__pro col-lg-3 col-md-4 col-sm-12">
               <div class="product foo">
                  <div class="product__inner">
                     <div class="pro__thumb">
                        <a href="#">
                        <img src="assets/<?=$p -> image ?>" alt="<?= $p -> name ?>">
                        </a>
                     </div>
                     <div class="product__hover__info">
                        <ul class="product__action">
                           <li><a data-toggle="modal" data-id = "<?= $p -> product_ID?>" data-target=".productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>

                        </ul>
                     </div>

                  </div>
                  <div class="product__details">
                     <h2><a href="product-details.html"><?= $p -> name ?></a></h2>
                     <ul class="product__price">
                       <?php if($p -> price_old != NULL):?>
                        <li class="old__price">&dollar;<?= $p -> price_old?></li>
                      <?php endif; ?>
                        <li class="new__price">&dollar;<?= $p -> price?></li>
                     </ul>
                  </div>
               </div>
            </div>
          <?php endforeach; ?>
            <!-- End Single Product -->
         </div>
      </div>
   </div>
</section>
