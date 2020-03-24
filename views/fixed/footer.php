
<section class="htc__contact__area ptb--120 bg__white" id="contact">
    <div class="container" >
        <div class="row" >
            <div class="col-md-12 col-lg-6 col-sm-12">
                <div class="htc__contact__container">
                    <div class="htc__contact__address">
                        <h2 class="contact__title">contact info</h2>
                        <div class="contact__address__inner">
                            <!-- Start Single Adress -->
                            <div class="single__contact__address">
                                <div class="contact__icon">
                                    <span class="ti-location-pin"></span>
                                </div>
                                <div class="contact__details">
                                    <p>Location : <br> 555 Marriott Drive
Nashville, USA</p>
                                </div>
                            </div>
                            <!-- End Single Adress -->
                        </div>
                        <div class="contact__address__inner">
                            <!-- Start Single Adress -->
                            <div class="single__contact__address">
                                <div class="contact__icon">
                                    <span class="ti-mobile"></span>
                                </div>
                                <div class="contact__details">
                                    <p> Phone : <br><a href="#">1-800-425-9937</a></p>
                                </div>
                            </div>
                            <!-- End Single Adress -->
                            <!-- Start Single Adress -->
                            <div class="single__contact__address">
                                <div class="contact__icon">
                                    <span class="ti-email"></span>
                                </div>
                                <div class="contact__details">
                                    <p> E-mail :<br><a href="#">info@graff.com</a></p>
                                </div>
                            </div>
                            <!-- End Single Adress -->
                        </div>
                    </div>
                    <div class="contact-form-wrap">
                        <div class="contact-title">
                            <h2 class="contact__title">Get In Touch</h2>
                        </div>
                        <form id="contact-form" action="#" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="contact-name" name="name" placeholder="Your Name*">
                                    <p class="jewelryP" ><i id="error-contact-name"></i></p>
                                    <input type="text" id="contact-email" name="email" placeholder="E-mail*">
                                    <p class="jewelryP" ><i id="error-contact-email"></i></p>
                                </div>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="text" id="contact-subject" name="subject" placeholder="Subject*">
                                    <p class="jewelryP" ><i id="error-contact-subject"></i></p>
                                </div>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box message">
                                    <textarea name="message"  id="contact-message" placeholder="Message*"></textarea>
                                    <p class="jewelryP" ><i id="error-contact-message"></i></p>
                                </div>
                            </div>
                            <div class="contact-btn">
                                <button type="submit" id="btn-contact" class="fv-btn">SEND</button>
                            </div>
                        </form>
                    </div>
                    <div class="form-output">
                        <p class="form-message jewelryP"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-sm-12 smt-30 xmt-30">
                <div class="map-contacts">
                    <div id="contactAddress">
                      <p>CONTACT US</p>
                      <hr>
                      <p class="bolderFooter">Customer Delight</p> </br>
                      <p>Call us at 1-800-425-9937 (8am-12 midnight, 7 days a week)</p>
                      <p>or</p>
                      <p>Write to us at info@graff.com</p>
                    </br>
                    <p class="bolderFooter">Office Address</p> </br>
                    <div id="location">
                      <div class="childLocation ">
                        <a href="#" class="ti-location-pin">Aspen</a>
                        <p>
                          Graff Jewellery and Lifestyle Pvt. Ltd.</br>
                           RubeQube, 3rd Floor,</br>
                           Plot No. 19/4 & 27,</br>
                           408 E Cooper Ave,</br>
                           Outer Ring Road,</br>
                           Aspen CO 81611</br>
                           CO, USA
                        </p>

                      </div>
                      <div class="childLocation">
                        <a href="#" class="ti-location-pin">Santa Fe</a>
                        <p>
                          Graff Jewellery and Lifestyle Pvt. Ltd.</br>
                           DeVargas Center, 2nd Floor,</br>
                           Plot No. 11/4 & 21,</br>
                           Kadubisanahalli,</br>
                           Inner Ring Road,</br>
                           120 Don Gaspar at Water St.</br>
                           Santa Fe, NM

                        </p>
                      </div>

                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->

<footer class="htc__foooter__area" id="footer">
   <div class="container">
     <div class="row">
       <div class="col-md-12" id="div_counter">
         <span><p class="jewelryP"><i>visits</i></p>
           <p class="counter">
             <?php
             require_once(__DIR__."/../../models/visits/functions.php");

             $queryVisit = getVisits();
             echo $queryVisit -> number;


             ?>
           </p>
         </span>
       </div>
     </div>
      <div class="row footer__container clearfix">
         <!-- Start Single Footer Widget -->
         <div class="col-md-4 col-lg-4 col-6">
            <div class="logo">
               <a href="index.php">
               <img src="assets/images/logo/logo1.png" alt="logo">
               </a>
            </div>
            <!-- <div class="footer__details">
               <p>Get 10% discount</p>
               </div> -->
         </div>
         <!-- <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="ft__widget">


                <div class="footer__details">
                    <p>Get 10% discount with notified about the latest news and updates.</p>
                </div>
            </div>
            </div> -->
         <!-- End Single Footer Widget -->
         <!-- Start Single Footer Widget -->
         <!-- <div class="col-md-6 col-lg-3 col-sm-6 smb-30 xmt-30">
            <div class="ft__widget">
               <h2 class="ft__title">Newsletter</h2>
               <div class="newsletter__form">
                  <div class="input__box">
                     <div id="mc_embed_signup">
                        <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                           <div id="mc_embed_signup_scroll" class="htc__news__inner">
                              <div class="news__input">
                                 <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
                              </div>
                              <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div> -->
         <!-- End Single Footer Widget -->
         <!-- Start Single Footer Widget -->
         <div class="col-md-4 col-lg-4 col-sm-6 smt-30 xmt-30">
            <div class="ft__widget contact__us">
               <h2 class="ft__title">Contact Us</h2>
               <div class="footer__inner">
                  <p> 555 Marriott Drive <br> Nashville, TN 37214, USA </p>
               </div>
            </div>
         </div>
         <!-- End Single Footer Widget -->
         <!-- Start Single Footer Widget -->
         <div class="col-md-4 col-lg-4 lg-offset-1 col-sm-6 smt-30 xmt-30">
            <div class="ft__widget">
               <h2 class="ft__title">Follow Us</h2>
               <ul class="social__icon">
                  <li><a href="https://twitter.com/" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                  <li><a href="https://www.instagram.com/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
                  <li><a href="https://www.facebook.com/" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                  <li><a href="https://www.linkedin.com/" target="_blank"><i class="zmdi zmdi-linkedin"></i></a></li>
               </ul>
            </div>
         </div>
         <!-- End Single Footer Widget -->
      </div>
      <!-- Start Copyright Area -->
      <div class="htc__copyright__area">
         <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
               <div class="copyright__inner">
                  <div class="copyright">
                    <p><a href="documentation.pdf">Documentation</a> </p>
                     <p>© 2019 | <a href="https://www.linkedin.com/in/ognjena-mihajlovic-2bb2a5168/" target="_blank"> Ognjena</a>
                        | All Right Reserved.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End Copyright Area -->
   </div>
</footer>
<!-- End Footer Area -->
</div>
<!-- Body main wrapper end -->
<!-- QUICKVIEW PRODUCT -->

<div id="quickview-wrapper">
<!-- Modal -->

<div class="modal fade productModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal__container" role="document">
      <div class="modal-content">
         <div class="modal-header modal__header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            <div class="modal-product" id="modalProduct">

               <!-- .product-info -->
            </div>
            <!-- .modal-product -->
         </div>
         <!-- .modal-body -->
      </div>
      <!-- .modal-content -->
   </div>
   <!-- .modal-dialog -->
</div>
<!-- END Modal -->

</div>
<!-- END QUICKVIEW PRODUCT -->
<!-- Placed js at the end of the document so the pages load faster -->
<!-- jquery latest version -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Bootstrap Framework js -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="assets/js/plugins.min.js"></script>
<script src="assets/js/loginModalForm.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="assets/js/main.js"></script>
<?php
  if(isset($_SESSION['user']))
  {
    ?>
      <script src="assets/js/cart_log.min.js"></script>
    <?php
  }

  else if(!isset($_SESSION['user']))
  {
    ?>
      <script src="assets/js/cart_nolog.min.js"></script>
    <?php
  }

?>


<div class="spinner">
<div class="cube1"></div>
<div class="cube2"></div>
</div>

</body>


</html>
