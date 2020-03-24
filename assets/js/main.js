
window.onload = function()
{
  $('img[alt="www.000webhost.com"]').hide();
  $(".spinner").fadeOut();
  document.body.classList.remove('preloader_body');
}







$(document).on("click", "#users-panel-link", function(e){
    e.preventDefault();
    updateUsers();

});


if(JSON.parse(localStorage.getItem("products")) != null)
{
  fillCart();

}
allAboutStats();
function catchMe(page_name)
{
  ajaxPhpCount(page_name);
}

function ajaxPhpCount(page_div)
{
  let page = page_div;
  $.ajax({
    url : "models/visits/count_visits.php",
    method : "post",
    data : {
      _page : page
    },
    success : function(data)
    {
      // console.log(data);
      fillStats(data);
      $(".spinner").fadeOut();
    },
    error : function(xhr, status, responseText)
    {
      console.log(responseText);
    }
  });
}

function allAboutStats()
{
  // console.log(window.location.href);
  $.ajax({
    url : "models/visits/all_visits.php",
    method : "post",
    success : function(data)
    {

      fillStats(data);
      $(".spinner").fadeOut();
    },
    error : function(xhr, status, responseText)
    {
      console.log(status);
    }
  });
}
function fillStats(data)
{
  let array_pages = ['home', 'about', 'shop', 'contact'];
  let x = "";
  let counter = 1;
  for(let a of array_pages)
  {
    x += `
    <tr class='increaseWidth'>
       <td class="organisationnumber ">${counter++}</td>
       <td class="organisationnumber">${a}</td>
       <td class="organisationname">`;
       // for(let d of data)
       // {
         if( a == 'home')
         {
           x += `${Math.round(((data.count_index / data.countAll) * 100),2)} %`;
         }
         else if( a == 'about')
         {
           x += `${Math.round(((data.count_about / data.countAll) * 100),2)} %`;
         }
         else if( a == 'shop')
         {
           x += `${Math.round(((data.count_shop / data.countAll) * 100),2)} %`;
         }
         else if( a == 'contact')
         {
           x += `${Math.round(((data.count_contact / data.countAll) * 100),2)} %`;
         }
       // }
      x += ` </td>
       <td class="organisationname">`;
       if( a == 'home')
       {
         x += `${data.counter_index_today}`;
       }
       else if( a == 'about')
       {
         x += `${data.counter_about_today}`;
       }
       else if( a == 'shop')
       {
         x += `${data.counter_shop_today}`;
       }
       else if( a == 'contact')
       {
         x += `${data.counter_contact_today}`;
       }

       x += `
        </td>
    </tr>`;

  }
  $("#page-visits").html(x);
}
// CART - LOCAL STORAGE
// $(document).on("click", ".cart-link", function(e){
//
//   e.preventDefault();
//
//   let product_id = this.dataset.id;
//
//   $.ajax({
//     url : "/models/products/product_by_id.php",
//     method : "post",
//     dataType : "json",
//     data : {
//       _id : product_id
//     },
//     success : function(data)
//     {
//       //console.log(data);
//       product_cart(data);
//     },
//     error : function(xhr, status, responseText)
//     {
//       console.log(responseText);
//     }
//   });
//
//
// });
$(document).on("click", ".modal-cart", function(e){

  e.preventDefault();
  let current_cart = this;
  let product_id = this.dataset.id;

  $.ajax({
    url : "models/products/product_by_id.php",
    method : "post",
    dataType : "json",
    data : {
      _id : product_id
    },
    success : function(data)
    {
      $(current_cart).text("Added to cart!").fadeIn().delay(800).fadeOut(500, nextQuote);
      function nextQuote()
      {
        $(current_cart).text("Add to cart!").fadeIn();
      }
      product_cart(data);
      $(".spinner").fadeOut();
    },
    error : function(xhr, status, responseText)
    {
      console.log(responseText);
    }
  });


});

function product_cart(data)
{

  let products = JSON.parse(localStorage.getItem("products") || "[]");
  let sum = JSON.parse(localStorage.getItem("sum") || 0);



  let product = {
    id : data.product_ID,
    name : data.name,
    price : data.price,
    image : data.image,
    date : Date.now()
  }
  products.push(product);
  sum += Number(product.price);


  localStorage.setItem("products", JSON.stringify(products));
  localStorage.setItem("sum", JSON.stringify(sum));



  fillCart();
}

$(document).on("click", ".cart-link-remove", function(e){

  e.preventDefault();
  let prod_remove = [];
  let new_sum = 0;
  let product_id = Number(this.dataset.id);

  let product = JSON.parse(localStorage.getItem("products"));

  for(let i = 0; i < product.length; i++)
  {
    if(product[i].date != product_id)
    {
      prod_remove.push(product[i]);
      new_sum += Number(product[i].price);
    }
  }
  localStorage.setItem("products", JSON.stringify(prod_remove));
  localStorage.setItem("sum", JSON.stringify(new_sum));
  fillCart();




});


function fillCart()
{
  let products = JSON.parse(localStorage.getItem("products"));
  let sum = JSON.parse(localStorage.getItem("sum"));




  if(JSON.parse(localStorage.getItem("sum")) != 0)
  {
    $("#empty-flag").hide();
  }
  else {
    $("#empty-flag").show();
  }
  let x = "";


  for(let p of products)
  {

    x += `
    <div class="shp__cart__wrap">
       <div class="shp__single__product">
          <div class="shp__pro__thumb">

             <img src="assets/${p.image}" alt="${p.name}"/>

          </div>
          <div class="shp__pro__details">
             <h2>${p.name}</h2>
             <span class="shp__price">$${p.price}</span>
          </div>
          <div class="remove__btn">
             <a href="#" class="cart-link-remove" data-id = "${p.date}" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
          </div>
       </div>
    </div>
    `;
  }

  $("#products-cart").html(x);
  $(".total__price").html("$" + sum);

}











$(document).ready(function(){

  $("#form-prod").hide();

});

function fillCategoryValues()
{

  $.ajax({
    url : "models/categories/all_categories.php",
    method : "get",
    dataType : "json",
    success : function(data)
    {
      fillCategoryLinks(data);
      $(".spinner").fadeOut();
    },
    error : function(xhr, status, responseText)
    {
      console.log(responseText);
    }
  });
}
function fillCategoryLinks(data)
{

  let x = "";
  for(let d of data){
  x += `
  <li data-id = "${d.category_ID}">${d.name}</li>

  `;
}
$(".value-list").html(x);
}
function category_field(){

const inputField = document.querySelector('.chosen-value');
const dropdown = document.querySelector('.value-list');
inputField.placeholder = "Choose category";
const dropdownArray = [... document.querySelectorAll('.value-list li')];

dropdown.classList.add('open');
let valueArray = [];
dropdownArray.forEach(item => {
  valueArray.push(item.textContent);
});

const closeDropdown = () => {
  dropdown.classList.remove('open');
}

inputField.addEventListener('input', () => {
  dropdown.classList.add('open');
  let inputValue = inputField.value.toLowerCase();
  let valueSubstring;
  if (inputValue.length > 0) {
    for (let j = 0; j < valueArray.length; j++) {
      if (!(inputValue.substring(0, inputValue.length) === valueArray[j].substring(0, inputValue.length).toLowerCase())) {
        dropdownArray[j].classList.add('closed');
      } else {
        dropdownArray[j].classList.remove('closed');
      }
    }
  } else {
    for (let i = 0; i < dropdownArray.length; i++) {
      dropdownArray[i].classList.remove('closed');
    }
  }
});


dropdownArray.forEach(item => {
  item.addEventListener('click', (evt) => {
    let category = item.textContent;
    let category_id = item.dataset.id;

    inputField.value = category;
    inputField.dataset.id = category_id;
    dropdownArray.forEach(dropdown => {
      dropdown.classList.add('closed');
    });
  });
})


inputField.addEventListener('focus', () => {
  category_field();
   inputField.placeholder = 'Type to filter';
   dropdown.classList.add('open');
   dropdownArray.forEach(dropdown => {
     dropdown.classList.remove('closed');
   });
});

inputField.addEventListener('blur', () => {
  dropdown.classList.remove('open');
});

document.addEventListener('click', (evt) => {
  const isDropdown = dropdown.contains(evt.target);
  const isInput = inputField.contains(evt.target);
  if (!isDropdown && !isInput) {
    dropdown.classList.remove('open');
  }
});
}

if(document.querySelector('.chosen-value') != null)
{
  category_field();
}


$(document).ready(function(){




  $(document).on("click", ".product__menu button", function(){
    // $("#products").addClass("newHeight");
    let category = $(this).data("id");
     // console.log(category);

    if(category != 0)
    {
      $.ajax({
        url : "models/products/filter.php",
        method : "get",
        dataType : "json",
        data : {
          _id : category
        },

        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          // console.log(data);
          fillProducts(data);
          $(".spinner").fadeOut();
        },
        error : function(xhr, status, responseText)
        {
          console.log(responseText);
        }
      });
    }
    else {
      $.ajax({
        url : "models/products/all_products.php",
        method : "get",
        dataType : "json",
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          fillProducts(data);
          $(".spinner").fadeOut();
        },
        error : function(xhr, status, responseText)
        {
          console.log(status)
        }
      });
    }

  });

    $(document).on("click", "#search_button", function(e){
      e.preventDefault();
    });
    function emptyResultProd()
    {
      $("#products").html("<div id='no_products'><p class='jewelryP'><i>No results! <i class='fa fa-frown-o' aria-hidden='true'></i></i></p></div>");
    }

  $(document).on("click", "#search_button", function(){

    let inputValue = $("#inputSearch").val();
    if(inputValue != "")
    {
      $.ajax({
        url : "models/products/filter_search.php",
        method : "get",
        dataType : "json",
        data : {
          _val : inputValue
        },
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          if(data.length > 0)
          {
            fillProducts(data);
          }
          else {
            emptyResultProd();
          }
          $(".spinner").fadeOut();

        },
        error : function(xhr, status, responseText)
        {
          console.log(status);
        }
      });
    }

    else {
      emptyResultProd();
    }

  });



  function fillProducts(data)
  {
    // if(typeof data.length == 'number')
    // {
    //   alert('sdfd');
    // }
    let x = '';

    for(let d of data)
    {

      x += `
      <div class="col-md-3 single__pro col-lg-3 col-md-4 col-sm-12">
         <div class="product foo">
            <div class="product__inner">
               <div class="pro__thumb">
                  <a href="#">
                  <img src="assets/${d.image}" alt="${d.name}">
                  </a>
               </div>
               <div class="product__hover__info">
                  <ul class="product__action">
                     <li><a data-toggle="modal" data-id = "${d.product_ID}" data-target=".productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>

                  </ul>
               </div>
            </div>
            <div class="product__details">
               <h2><a href="product-details.html">${d.name}</a></h2>
               <ul class="product__price">`;
               if(typeof d.price_old != 'object'){
               x += `<li class="old__price">&dollar;${d.price_old}</li>`;
              }
               x += `
                  <li class="new__price">&dollar;${d.price}</li>
               </ul>
            </div>
         </div>
      </div>
      `;
    };

    $("#products").html(x);
  }



});


  // $(window).on("load", function(e){
  //
  //   document.querySelector("#edit-btn-cat").disabled = true;
  //   document.querySelector("#edit-btn-cat").classList.add("disabledCat");
  //
  // });
// CATEGORIES - EDIT
$(document).ready(function(){
  $(document).on("click", ".edit-item", function(e){

    e.preventDefault();
    document.querySelector("#edit-btn-cat").disabled = false;
    document.querySelector("#edit-btn-cat").classList.remove("disabledCat");

    $("#errorNameEditCat").text("");

    let category_id = $(this).data("id");

    $.ajax({
      url : "models/categories/category_by_id.php",
      method : "post",
      dataType : "JSON",
      data : {
        _id : category_id
      },
      beforeSend : function()
      {

        $(".spinner").show();
      },
      success : function(data)
      {
        editCategory(data);
        $(".spinner").fadeOut();
      },
      error : function(xhr, status, reponseText)
      {
        console.log(status);
      }
    });


  });


  // $(document).on("blur", "#edit-cat", function(e){
  //
  //   document.querySelector("#edit-btn-cat").disabled = true;
  //   document.querySelector("#edit-btn-cat").classList.add("disabledCat");
  //
  // });
  // $(document).on("focus", "#edit-cat", function(e){
  //
  //   document.querySelector("#edit-btn-cat").disabled = false;
  //   document.querySelector("#edit-btn-cat").classList.remove("disabledCat");
  //
  // });

  $(document).on("click", "#edit-btn-cat", function(e){
    e.preventDefault();
    if($("#edit-cat").val() != "")
    {

      let category_name = $("#edit-cat").val();
      let category_id = $("#hidden-cat").val();

      let reValue = /^[A-z]{1,}(\s([A-z]{1,}))*$/;

      if(reValue.test(category_name))
      {
        $("#errorNameEditCat").text("");

      $.ajax({
        url : "models/categories/edit_category.php",
        method : "post",
        dataType : "JSON",
        data : {
          _category_name : category_name,
          _category_id : category_id
        },
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          $("#edit-cat").val("");
          displayCategories();


          if(data.nameHint)
          {
            $("#errorNameEditCat").text(data.nameHint);
          }
          $(".spinner").fadeOut();
        },
        error : function(xhr, status, reponseText)
        {
          console.log(status);
        }
      });
      $("#hidden-cat").val("");
      document.querySelector("#edit-btn-cat").disabled = true;
      document.querySelector("#edit-btn-cat").classList.add("disabledCat");
  }

  else {
    $("#errorNameEditCat").text("A-z");
  }


    }




  });



});

// CATEGORIES - DELETE
$(document).ready(function(){
  // document.querySelector("#edit-btn-cat").disabled = true;
  // document.querySelector("#edit-btn-cat").classList.add("disabledCat");
  $(document).on("click", ".remove-item", function(e){

    e.preventDefault();


    let category_id = $(this).data("id");
    $("#edit-cat").val("");

    $.ajax({
      url : "models/categories/delete_by_id.php",
      method : "post",
      dataType : "JSON",
      data : {
        _category_id : category_id
      },
      beforeSend : function()
      {

        $(".spinner").show();
      },
      success : function()
      {
        displayCategories();
        fillCategoryValues();
        $(".spinner").fadeOut();

      },
      error : function(xhr, status, reponseText)
      {
        console.log(status);
      }
    });


  });



});

// CATEGORIES - ADD
$(document).ready(function(){
  $(document).on("click", "#add-cat", function(e){

    e.preventDefault();


    let value = $("#add-cat-value").val();

    let reValue = /^[A-z]{1,}(\s([A-z]{1,}))*$/;

    if(reValue.test(value))
    {
      $("#errorNameCat").text("");
      $.ajax({
        url : "models/categories/add_category.php",
        method : "post",
        dataType : "JSON",
        data : {
          _name : value
        },
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          $("#add-cat-value").val("");
          displayCategories();
          fillCategoryValues();



          if(data.nameHint)
          {
            $("#errorNameCat").text(data.nameHint);
          }
          $(".spinner").fadeOut();
        },
        error : function(xhr, status, reponseText)
        {
          console.log(status);
        }
      });
    }

    else {
      $("#errorNameCat").text("A-z");
    }




  });



});

function editCategory(data)
{
  $("#edit-cat").focus();
  $("#hidden-cat").val(data.category_ID);
  $("#edit-cat").val(data.name);
}
function editProduct(data)
{
  $("#edit-prod").focus();

  $("#hidden-prod").val(data.product_ID);

  $("#edit-prod").val(data.name);
  $("#edit-descr").val(data.description);
  $("#edit-price").val(data.price);
  if(typeof data.price_old == 'object' )
  {
    $("#edit-old-price").val('');
  }
  else {
    $("#edit-old-price").val(data.price_old);
  }

  $("#edit-color").val(data.color);
  $("#big-image-path").text(data.image_big);
  $("#small-image-path").text(data.image);
  document.querySelector("#cat_val").value = data.nameCat;
  document.querySelector("#cat_val").dataset.id = data.category_ID;
  document.querySelector("#cat_val").disabled = true;
  document.querySelector("#cat_val").classList.add("disabledCat");
}

function displayCategories()
{
  $.ajax({
    url : "models/categories/all_categories.php",
    method : "GET",
    dataType : "JSON",
    beforeSend : function()
    {

      $(".spinner").show();
    },
    success : function(data)
    {
      printCategories(data);
      $(".spinner").fadeOut();
    },
    error : function(xhr, status, reponseText)
    {
      console.log(status);
    }
  });
}

function printCategories(data)
{
  let x = "";
  let q = "<button  data-id='0' class='is-checked'>All</button>";
  let counter = 1;
  for(let d of data){
  x += `
  <tr>
    <input type="hidden" id="hiddenCat" value="${d.category_ID}">
     <td class="organisationnumber">${counter++}</td>
     <td class="organisationname">${d.name}</td>
     <td class="actions">
        <a href="#" data-id = "${d.category_ID}" class="edit-item" title="Edit">Edit </a> -
        <a href="#" data-id = "${d.category_ID}" class="remove-item" title="Remove">Remove</a>
     </td>
  </tr>

  `;
}
  for(let d of data){

  q += `
      <button data-id="${d.category_ID}">${d.name}</button>
  `;
  }

$("#category-table").html(x);
$("#category-buttons").html(q);
}



// PRODUCTS - FILE
$(document).ready(function(){
  $(document).on("change", "#small-image", function(){
    let img_path = $("#small-image").val();

    let img_name = img_path.split("\\");

    $("#small-image-path").text(img_name[2]);

    if($("#small-image-path").text() == "")
    {

      $("#errorSmallImgEditProd").text("Choose small image...");
    }
    else {
      $("#errorSmallImgEditProd").text("");
    }

  });


  $(document).on("change", "#big-image", function(){
    let img_path = $("#big-image").val();

    let img_name = img_path.split("\\");

    $("#big-image-path").text(img_name[2]);

    if($("#big-image-path").text() == "")
    {

      $("#errorBigImgEditProd").text("Choose cover image...");
    }
    else {
      $("#errorBigImgEditProd").text("");
    }

  });
});

// PRODUCTS - EDIT
$(document).ready(function(){
  $(document).on("click", ".edit-item-product", function(e){

    e.preventDefault();

    $("#form-prod").show();
    $("#add-product").hide();
    // $("#edit-values-product").show();


    $("#errorNameEditProd").hide();
    $("#errorDescrEditProd").hide();
    $("#errorPriceEditProd").hide();
    $("#errorOldPriceEditProd").hide();
    $("#errorColorEditProd").hide();
    $("#errorChooseCatEditProd").hide();
    $("#errorBigImgEditProd").hide();
    $("#errorSmallImgEditProd").hide();


    let product_id = $(this).data("id");

    $.ajax({
      url : "models/products/product_by_id.php",
      method : "post",
      dataType : "JSON",
      data : {
        _id : product_id
      },
      beforeSend : function()
      {

        $(".spinner").show();
      },
      success : function(data)
      {
        editProduct(data);
        $(".spinner").fadeOut();
      },
      error : function(xhr, status, reponseText)
      {
        console.log(status);
      }
    });


  });

  $(document).on("click", "#edit-values-product", function(e){
    e.preventDefault();



    // VALUES
    let product = $("#hidden-prod").val();
    let name = $("#edit-prod").val();
    let descr = $("#edit-descr").val();
    let price = $("#edit-price").val();
    let old_price = $("#edit-old-price").val();
    let color = $("#edit-color").val();
    let small_image = $("#small-image-path").text();
    let big_image = $("#big-image-path").text();

    // let big_image_exists = $("#big-image-path").text();
    // let small_image_exists = $("#small-image-path").text();

    //let flag_cat = 101;
    let cat = document.querySelector("#cat_val").dataset;
    let cat_id = document.querySelector("#cat_val").dataset.id;

    // if(document.querySelector("#cat_val").value == "")
    // {
    //   flag_cat = 00;
    //   console.log(flag_cat);
    // }

    let reName = /^[A-z]{1,}(\s([A-z]{1,}))*$/;

    let rePrice = /^[1-9]{1}[0-9]{1,}\.[0-9][0-9]$/;

    let error = true;

    if(!reName.test(name))
    {
      error = false;
      $("#errorName-Edit-Edit-Prod").text("A-z");
    }
    else{

      $("#errorNameEditProd").text("");
    }

    if(!reName.test(descr))
    {
      error = false;
      $("#errorDescr-Edit-Edit-Prod").text("A-z");
    }
    else{

      $("#errorDescr-Edit-Edit-Prod").text("");
    }
    if(!reName.test(color))
    {
      error = false;
      $("#errorColor-Edit-Edit-Prod").text("A-z");
    }
    else{

      $("#errorColor-Edit-Edit-Prod").text("");
    }
    if(!rePrice.test(price))
    {
      error = false;
      $("#errorPrice-Edit-Edit-Prod").text("nn.nn");
    }
    else{

      $("#errorPrice-Edit-Edit-Prod").text("");
    }
    if(old_price != "")
    {
      if(!rePrice.test(old_price))
      {
        error = false;
        $("#errorOldPrice-Edit-Edit-Prod").text("nn.nn");
      }
      else{

        $("#errorOldPrice-Edit-Edit-Prod").text("");
      }
    }


    if(small_image == "")
    {
      error = false;
      $("#errorSmallImg-Edit-Edit-Prod").text("Choose small image...");
    }

    if(big_image == "")
    {
      error = false;
      $("#errorBigImg-Edit-Edit-Prod").text("Choose cover image...");
    }

    if(document.querySelector("#cat_val").value == "")
    {
      error = false;
      $("#errorChooseCat-Edit-Edit-Prod").text("Please choose...");
    }

    else {
      $("#errorChooseCat-Edit-Edit-Prod").text("");
    }


    if(error == true)
    {

      let formNewProduct =  document.getElementById("form-prod");

      let request = new XMLHttpRequest();

      let formData = new FormData();

      formData.append('_name', name);
      formData.append('_descr', descr);
      formData.append('_price', price);
      formData.append('_old_price', old_price);
      formData.append('_color', color);
      formData.append('_product_id', product);
      formData.append('_category', cat_id);

      let big_image_file =  document.querySelector("#big-image");
      let small_image_file =  document.querySelector("#small-image");


      let small_image = $("#small-image-path").text();
      let big_image = $("#big-image-path").text();


      //console.log(big_image_file.files[0]);
      if(big_image_file.files[0] != undefined)
      {
        formData.append('big_image_file', big_image_file.files[0]);
      }

      if(small_image_file.files[0] != undefined)
      {
        formData.append('small_image_file', small_image_file.files[0]);
      }



      // if(flag_cat == 00)
      // {
      //   formData.append('_category', flag_cat);
      // }
      // else {
      //   formData.append('_category', cat_id);
      // }

      request.open('post', 'models/products/update_product.php');
      request.responseType = 'json';
      request.send(formData);



      request.onload = function()
      {


        $("#errorName-Edit-Edit-Prod").text(request.response.errorName);


        $("#errorDescr-Edit-Edit-Prod").text(request.response.errorDescr);
        $("#errorColor-Edit-Edit-Prod").text(request.response.errorColor);
        $("#errorPrice-Edit-Edit-Prod").text(request.response.errorPrice);
        $("#errorOldPrice-Edit-Edit-Prod").text(request.response.errorOldPrice);
        $("#errorSmallImg-Edit-Edit-Prod").text(request.response.errorSmallImage);
        $("#errorBigImg-Edit-Edit-Prod").text(request.response.errorBigImage);
        $("#errorChooseCat-Edit-Edit-Prod").text(request.response.errorCat);

      }
      $("#big-image").val("");
      $("#small-image").val("");
      $("#hidden-prod").val("");
      $("#edit-prod").val("");
      $("#edit-descr").val("");
      $("#edit-price").val("");
      $("#edit-old-price").val("");
      $("#edit-color").val("");
      $("#small-image-path").text("");
      $("#big-image-path").text("");
      document.querySelector("#cat_val").value = "";
    }



  });












});









// PRODUCTS - DELETE
$(document).ready(function(){
  $(document).on("click", ".remove-item-product", function(e){

    e.preventDefault();


    let prod_id = $(this).data("id");
    $.ajax({
      url : "models/products/delete_prod_by_id.php",
      method : "post",
      dataType : "JSON",
      data : {
        _prod_id : prod_id
      },
      success : function()
      {
        $.ajax({
          url : "models/products/count_products.php",
          method : "post",
          dataType : "json",
          beforeSend : function()
          {

            $(".spinner").show();
          },
          success : function(data)
          {

            displayProdPag(data);
            fillPaginationLinks(data);
            $(".spinner").fadeOut();

          },
          error : function(xhr, status, responseText)
          {
            console.log(responseText);
          }
        });


      },
      error : function(xhr, status, reponseText)
      {
        console.log(status);
      }
    });



  });





});



// PRODUCTS - ADD
$(document).ready(function(){

  $(document).on("click", "#add-prod-btn", function(){


    $("#form-prod").show();
    $("#add-product").show();
    $("#edit-values-product").hide();
    document.querySelector("#cat_val").disabled = false;
    document.querySelector("#cat_val").classList.remove("disabledCat");

    $("#edit-prod").val("");
    $("#edit-descr").val("");
    $("#edit-price").val("");
    $("#edit-old-price").val("");
    $("#edit-color").val("");
    $("#big-image-path").text("");
    $("#small-image-path").text("");
    document.querySelector("#cat_val").value = "";




    $("#edit-prod").focus();


    $("#edit-btn-descr").hide();
    $("#edit-btn-price").hide();
    $("#edit-btn-oldprice").hide();
    $("#edit-btn-color").hide();
    $("#edit-btn-cover").hide();
    $("#edit-btn-small").hide();




  });







  $(document).on("click", "#add-product", function(e){
    e.preventDefault();


    // VALUES
    let name = $("#edit-prod").val();
    let descr = $("#edit-descr").val();
    let price = $("#edit-price").val();
    let old_price = $("#edit-old-price").val();
    let color = $("#edit-color").val();


    let small_image = $("#small-image-path").text();
    let big_image = $("#big-image-path").text();

    let extensionSmall = small_image.split(".")[1];
    let extensionBig = big_image.split(".")[1];



    let cat = document.querySelector("#cat_val").dataset;
    let cat_id = document.querySelector("#cat_val").dataset.id;





    let reName = /^[A-z]{1,}(\s([A-z]{1,}))*$/;
    let reDescr = /[\w\d\W\D]/;

    let rePrice = /^[1-9]{1}[0-9]{1,}\.[0-9][0-9]$/;

    let error = true;

    if(!reName.test(name))
    {
      error = false;
      $("#errorNameEditProd").text("A-z");
    }
    else{

      $("#errorNameEditProd").text("");
    }

    if(!reDescr.test(descr))
    {
      error = false;
      $("#errorDescrEditProd").text("(words, numbers, special symbols)");
    }
    else{

      $("#errorDescrEditProd").text("");
    }
    if(!reName.test(color))
    {
      error = false;
      $("#errorColorEditProd").text("A-z");
    }
    else{

      $("#errorColorEditProd").text("");
    }
    if(!rePrice.test(price))
    {
      error = false;
      $("#errorPriceEditProd").text("nn.nn");
    }
    else{

      $("#errorPriceEditProd").text("");
    }

    if(old_price != "")
    {
      if(!rePrice.test(old_price))
      {
        error = false;
        $("#errorOldPriceEditProd").text("nn.nn");
      }
      else{

        $("#errorOldPriceEditProd").text("");
      }
    }



    if(small_image != "")
    {
      if(extensionSmall != "jpg" && extensionSmall != "jpeg" && extensionSmall != "png")
      {
        error = false;
        $("#errorSmallImgEditProd").text("JPG / JPEG / PNG");
      }
    }
    else {
      error = false;
      $("#errorSmallImgEditProd").text("Choose small image...");
    }

    if(big_image != "")
    {
      if(extensionBig != "jpg" && extensionBig != "jpeg" && extensionBig != "png")
      {
        error = false;
        $("#errorBigImgEditProd").text("JPG / JPEG / PNG");
      }
    }
    else {
      error = false;
      $("#errorBigImgEditProd").text("Choose cover image...");
    }

    if(!cat.hasOwnProperty('id'))
    {
      error = false;
      $("#errorChooseCatEditProd").text("Please choose...");
    }

    else {
      $("#errorChooseCatEditProd").text("");
    }


    if(error == true)
    {

      $.ajax({
        url : "models/products/count_products.php",
        method : "post",
        dataType : "json",
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {



          fillPaginationLinks(data);
          fillPagination(data);
          $(".spinner").fadeOut();


        },
        error : function(xhr, status, responseText)
        {
          console.log(responseText);
        }
      });


      let formNewProduct =  document.getElementById("form-prod");

      let request = new XMLHttpRequest();

      let formData = new FormData();
      let big_image =  document.querySelector("#big-image");
      let small_image =  document.querySelector("#small-image");
      formData.append('big_image', big_image.files[0]);
      formData.append('small_image', small_image.files[0]);

      formData.append('_name', name);
      formData.append('_descr', descr);
      formData.append('_price', price);
      formData.append('_old_price', old_price);
      formData.append('_color', color);
      formData.append('_category', cat_id);

      request.open('post', 'models/products/insert_product.php');
      request.responseType = 'json';
      request.send(formData);


      // request.onload = function(e)
      // {
      //
      //     $("#errorNameEditProd").text(request.response.errorName);
      //     $("#errorDescrEditProd").text(request.response.errorDescr);
      //     $("#errorColorEditProd").text(request.response.errorColor);
      //     $("#errorPriceEditProd").text(request.response.errorPrice);
      //     $("#errorOldPriceEditProd").text(request.response.errorOldPrice);
      //     $("#errorSmallImgEditProd").text(request.response.errorSmallImage);
      //     $("#errorBigImgEditProd").text(request.response.errorBigImage);
      //     $("#errorChooseCatEditProd").text(request.response.errorCat);
      // }

      $("#big-image").val("");
      $("#small-image").val("");
      $("#hidden-prod").val("");
      $("#edit-prod").val("");
      $("#edit-descr").val("");
      $("#edit-price").val("");
      $("#edit-old-price").val("");
      $("#edit-color").val("");
      $("#small-image-path").text("");
      $("#big-image-path").text("");
      document.querySelector("#cat_val").value = "";
    }
  });

});





// *******************************************
// * PAGINATION *
$(document).ready(function(){

  $(document).on("click", ".list-inline-item", function(){

    let page = $(this).data("id");
    displayProdPag(page);




  });


});
function displayProdPag(page)
{
  $.ajax({
    url : "models/products/pagination.php",
    method : "post",
    dataType : "json",
    data  : {
      _page : page
    },
    beforeSend : function()
    {

      $(".spinner").show();
    },
    success : function(data)
    {
      fillPagination(data);

      $(".spinner").fadeOut();
    },
    error : function(xhr, status, reponseText)
    {
      console.log(status);
    }
  });
}
function fillPaginationLinks(data)
{
  displayProdPag(data);
  let x = "";
  for(let i = 1; i <= data; i++){
    if(i === data)
    {
      x += `
         <li class="list-inline-item active_pagination_li" data-id = "${i}">${i}</li>

       `;
    }
    else if(i !== data)
    {
      x += `
         <li class="list-inline-item" data-id = "${i}">${i}</li>

       `;
    }

    }
    $("#nav_pagination").html(x);




}




function fillPagination(data)
{

  let x = "";


  //console.log(data);
  for(let i = 0; i < data.length; i++)
  {
    if(i == 0)
    {
      x += `
      <tr>
        <input type="hidden" id="hiddenProd" value="${data[i].product_ID}">
         <td class="organisationnumber">${data[i].product_ID}</td>
         <td class="organisationname">${data[i].name}</td>
         <td> <img class="img-size-optimize" src="assets/${data[i].image}"/></td>
         <td> <img class="img-size-optimize" src="assets/${data[i].image_big}"/></td>
         <td class="organisationname">&dollar;${data[i].price}</td>
         <td class="organisationname">`;

         if(typeof data[i].price_old == 'object')
         {
           x += `/`;
         }
         else {
           x += `&dollar;${data[i].price_old}`;
         }


         x += `</td>
         <td class="organisationname resize-descr border-edit-2 no_top_border">${data[i].description}</td>
         <td class="organisationname">${data[i].color}</td>
         <td class="organisationname">${data[i].catName}</td>
         <td class="actions">
            <a href="#" data-id="${data[i].product_ID}" class="edit-item-product" title="Edit">Edit </a> -
            <a href="#" data-id="${data[i].product_ID}" class="remove-item-product" title="Remove">Remove</a>
         </td>
      </tr>
      `;
    }

    else {
      x += `
      <tr>
        <input type="hidden" id="hiddenProd" value="${data[i].product_ID}">
         <td class="organisationnumber">${data[i].product_ID}</td>
         <td class="organisationname">${data[i].name}</td>
         <td> <img class="img-size-optimize" src="assets/${data[i].image}"/></td>
         <td> <img class="img-size-optimize" src="assets/${data[i].image_big}"/></td>
         <td class="organisationname">&dollar;${data[i].price}</td>
         <td class="organisationname">`;

         if(typeof data[i].price_old == 'object')
         {
           x += `/`;
         }
         else {
           x += `&dollar;${data[i].price_old}`;
         }


         x += `
         </td>
         <td class="organisationname resize-descr border-edit-2">${data[i].description}</td>
         <td class="organisationname">${data[i].color}</td>
         <td class="organisationname">${data[i].catName}</td>
         <td class="actions">
            <a href="#" data-id="${data[i].product_ID}" class="edit-item-product" title="Edit">Edit </a> -
            <a href="#" data-id="${data[i].product_ID}" class="remove-item-product" title="Remove">Remove</a>
         </td>
      </tr>
      `;
    }






  }

  $("#pagination_products").html(x);

}


// pagination - active link
$(document).ready(function(){


  let pagination_links = $(".list-inline-item");
  let first_el = pagination_links[0];
  $(first_el).addClass("active_pagination_li");


});

$(document).on("click", ".list-inline-item", function(){
  $(this).addClass("active_pagination_li").siblings().removeClass("active_pagination_li");


});

  $(document).on("click", ".edit-item-user", function(e){
    e.preventDefault();

    let user_id = this.dataset.id;

    $.ajax({
      url : "models/users/role.php",
      method : "post",
      dataType : "json",
      data : {
        _user_id : user_id,
      },
      beforeSend : function()
      {

        $(".spinner").show();
      },
      success : function(data)
      {
          fillRole(data);
          $(".spinner").fadeOut();
      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


  });

});

function fillRole(data)
{
  $("#user-role").focus();
  $("#user-role").val(data.roleName);
  document.querySelector("#user-role").dataset.id = data.user_ID;

}
$(document).on("click", "#submit-user-role", function(e){

  let user_id = document.querySelector("#user-role").dataset.id;
  let value_role = document.querySelector("#user-role").value;


    if(value_role != 'admin' && value_role != 'user')
    {
      $("#errorRoleUser").text("admin / user");
    }
    else if(value_role == 'admin' || value_role == 'user'){
      $("#errorRoleUser").text("");

      //console.log(user_id);

      $.ajax({
        url : "models/users/change_role.php",
        method : "post",
        dataType : "json",
        data : {
          _user_id : user_id,
          _role_name : value_role
        },
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          // console.log(data);
            updateUsers();
            $(".spinner").fadeOut();
        },
        error : function(xhr, status, responseText)
        {
          console.log(status);
        }


    });


    }





});

function updateUsers()
{
  $.ajax({
    url : "models/users/all_users.php",
    method : "post",
    dataType : "json",
    beforeSend : function()
    {

      $(".spinner").show();
    },
    success : function(data)
    {
        fillUsers(data);
        $(".spinner").fadeOut();
    },
    error : function(xhr, status, responseText)
    {
      console.log(status);
    }


});
}

function fillUsers(data)
{
  let months_array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

  let x = "";
  let counter = 1;
  for(let d of data)
  {
    // let user_date = new Date().toLocaleString("en-US", {timeZone: "Europe/Belgrade"});
    let user_date = new Date(d.last_visit);
    let converted_date = user_date.getDate() + "/" + months_array[user_date.getMonth()] + "/" + user_date.getFullYear() + " " +user_date.getHours() + ":" + user_date.getMinutes() + ":" + user_date.getSeconds();
    x += `
    <tr>
      <input type="hidden" id="hiddenUser" value="${d.user_ID}">
       <td class="organisationnumber">${counter++}</td>
       <td class="organisationname">`;
       if(d.role_ID == 1){
         x += `<p style = 'color: red'> ${d.username}</p>`;
       }
       else {
         x += `${d.username}`;
       }
       x += `</td>
       <td class="organisationname">${d.e_mail}</td>

       <td>`;

       if(d.active == 1)
       {
         x += `<div class="circle green"></div>`;
       }
       else {
         x += `<div class="circle red"></div>`;
       }


       x += `</td>
       <td data-id = "${d.role_ID}" class="organisationname">${d.role}</td>
       <td class="organisationname">${converted_date}</td>
       <td class="actions">
          <a href="?" data-id="${d.user_ID}" class="edit-item-user" title="Edit">Edit </a>
       </td>
    </tr>

    `
  }

  $("#users-panel").html(x);

}
// *******************************************
// * REGISTRATION *

$(document).on("click", "#btnRegister", function(){
  let regUsername = document.querySelector("#signup-username").value;
  let regEmail = document.querySelector("#signup-email").value;
  let regPassword = document.querySelector("#signup-password").value;



  let reUsername = /^[a-z]{3,8}(\_[a-z]{0,8})*$/;
  let reEmail = /^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/;
  let rePassword = /([\w\W\D\d]){7,}/;

  let flag = true;

  if(!reUsername.test(regUsername))
  {
    flag = false;
    $("#regErrorUsername").html("begin with letters (3-8 characters), underscore");
    $("#regErrorUsername").css("visibility", "visible");
  }
  else {
    $("#regErrorUsername").html("");
    $("#regErrorUsername").css("visibility", "hidden");
  }

  if(!reEmail.test(regEmail))
  {
    flag = false;
    $("#regErrorEmail").html("xx (. xx) @ xx . xx (. xx)");
    $("#regErrorEmail").css("visibility", "visible");
  }
  else {
    $("#regErrorEmail").html("");
    $("#regErrorEmail").css("visibility", "hidden");
  }

  if(!rePassword.test(regPassword))
  {
    flag = false;
    $("#regErrorPassword").html("at least 7 characters");
    $("#regErrorPassword").css("visibility", "visible");

  }
  else {
    $("#regErrorPassword").html("");
    $("#regErrorPassword").css("visibility", "hidden");
  }

  if(flag == true)
  {
    $(document).ready(function(){
      $.ajax({
        url : "models/users/register.php",
        method : "post",
        dataType : "json",
        beforeSend : function()
        {

          $(".spinner").show();
        },
        data : {
          _username : regUsername,
          _email : regEmail,
          _password  : regPassword
        },
        success : function(data)
        {


          if(data.errorUsername)
          {
            $("#regErrorUsername").html(data.errorUsername);
            $("#regErrorUsername").css("visibility", "visible");
          }
          else
          {
            $("#regErrorUsername").html("");
            $("#regErrorUsername").css("visibility", "hidden");
          }
          if(data.errorEmail)
          {
            $("#regErrorEmail").html(data.errorEmail);
            $("#regErrorEmail").css("visibility", "visible");
          }
          else
          {
            $("#regErrorEmail").html("");
            $("#regErrorEmail").css("visibility", "hidden");
          }
          if(data.errorPassword)
          {
            $("#regErrorPassword").html(data.errorPassword);
            $("#regErrorPassword").css("visibility", "visible");
          }
          else
          {
            $("#regErrorPassword").html("");
            $("#regErrorPassword").css("visibility", "hidden");
          }

          if(data.inserted == 1)
          {
            window.location.href = "index.php";
          }
          $(".spinner").fadeOut();

        },
        error : function(xhr, status, responseText)
        {
          console.log(status);
        }
      });
    });
  }
});

// * LOGIN *

$(document).on("click", "#btnLogin", function(){
  let logEmail = document.querySelector("#signin-email").value;
  let logPassword = document.querySelector("#signin-password").value;


  let reEmail = /^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/;
  let rePassword = /([\w\W\D\d]){7,}/;

  let flag = true;

  if(!reEmail.test(logEmail))
  {
    flag = false;
    $("#logErrorEmail").html("xx (. xx) @ xx . xx (. xx)");
    $("#logErrorEmail").css("visibility", "visible");
  }

  else {
    $("#logErrorEmail").html("");
    $("#logErrorEmail").css("visibility", "hidden");
  }

  if(!rePassword.test(logPassword))
  {
    flag = false;
    $("#logErrorPassword").html("at least 7 characters");
    $("#logErrorPassword").css("visibility", "visible");
  }

  else {
    $("#logErrorPassword").html("");
    $("#logErrorPassword").css("visibility", "hidden");
  }

  if(flag == true)
  {
    $(document).ready(function(){
      $.ajax({
        url : "models/users/login.php",
        method : "post",
        dataType : "json",
        data : {
          _email : logEmail,
          _password  : logPassword
        },
        beforeSend : function()
        {

          $(".spinner").show();
        },
        success : function(data)
        {
          if(data.errorEmail)
          {
            $("#logErrorEmail").html(data.errorEmail);
            $("#logErrorEmail").css("visibility", "visible");
          }
          else
          {
            $("#logErrorEmail").html("");
            $("#logErrorEmail").css("visibility", "hidden");
          }
          if(data.errorPassword)
          {
            $("#logErrorPassword").html(data.errorPassword);
            $("#logErrorPassword").css("visibility", "visible");
          }
          else {
            $("#logErrorPassword").html("");
            $("#logErrorPassword").css("visibility", "hidden");
          }

          if(data.newPassword)
          {
            $("#logErrorPassword").html(data.newPassword);
            $("#logErrorPassword").css("visibility", "visible");

            setTimeout(function() {
                window.location.href = "index.php";
              }, 2500);



          }

          if(data.admin == 1)
          {
            window.location.href = "index.php";
          }

          else if(data.user == 2)
          {
            window.location.href = "index.php";
          }
          $(".spinner").fadeOut();
        },
        error : function(xhr, status, responseText)
        {
          console.log(status);
        }
      });
    });
  }


});


// CONTACT FORM
$(document).on("click", "#btn-contact", function(e){
  e.preventDefault();

  let name = document.querySelector("#contact-name").value;
  let subject = document.querySelector("#contact-subject").value;
  let message = document.querySelector("#contact-message").value;
  let email = document.querySelector("#contact-email").value;

  let name_error = document.querySelector("#error-contact-name");
  let subject_error = document.querySelector("#error-contact-subject");
  let message_error = document.querySelector("#error-contact-message");
  let email_error = document.querySelector("#error-contact-email");


  let reName = /^[A-Z][a-z]{1,}(\s[A-Z][a-z]{1,})*$/;
  let reSubject = /^[A-z]{2,}(\s[A-z]{3,})*$/;
  let reMessage = /^[A-z]{2,}(\W\D\d\s)*/;
  let reEmail = /^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/;

  let error = true;

  if(!reName.test(name))
  {
    error = false;
    name_error.textContent = "A-z (at least 2 letters)";
  }
  else {
    name_error.textContent = "";
  }

  if(!reSubject.test(subject))
  {
    error = false;
    subject_error.textContent = "A-z (at least 2 letters)";
  }
  else {
    subject_error.textContent = "";
  }

  if(!reMessage.test(message))
  {
    error = false;
    message_error.textContent = "Start at least with 2 letters...";
  }
  else {
    message_error.textContent = "";
  }

  if(!reEmail.test(email))
  {
    error = false;
    email_error.textContent = "xx (. xx) @ xx . xx (. xx)";
  }
  else {
    email_error.textContent = "";
  }

  if(error == true)
  {
    $.ajax({
      url : "models/users/contact_form.php",
      method : "post",
      dataType : "json",
      data : {
        _name : name,
        _subject : subject,
        _message : message,
        _email : email
      },
      beforeSend : function()
      {

        $(".spinner").show();
      },
      success : function(data)
      {
        if(data.errorName != "")
        {
          name_error.textContent = data.errorName ;
        }
        else {
          name_error.textContent = '';
        }

        if(data.errorMessage != "")
        {
          message_error.textContent = data.errorMessage ;
        }
        else {
          message_error.textContent = '';
        }

        if(data.errorSubject != "")
        {
          subject_error.textContent = data.errorSubject ;
        }
        else {
          subject_error.textContent = '';
        }

        if(data.errorEmail != "")
        {
          email_error.textContent = data.errorEmail ;
        }
        else {
          email_error.textContent = '';
        }

            document.querySelector(".form-message").textContent = data.response;
            document.querySelector("#contact-name").value = "";
            document.querySelector("#contact-email").value = "";
            document.querySelector("#contact-subject").value = "";
            document.querySelector("#contact-message").value = "";

            $(".spinner").fadeOut();

      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }
    });
  }


});






























/*-----------------------------------------------------------------------------------

  Template Name: Uniqlo-Minimalist eCommerce HTML5 Template.
  Template URI: #
  Description: Uniqlo is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: HasTech
  Author URI: https://themeforest.net/user/hastech/portfolio
  Version: 1.1

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------
  01. jQuery MeanMenu
  02. wow js active
  03. Portfolio  Masonry (width)
  04. Sticky Header
  05. ScrollUp
  06. Tooltip
  07. ScrollReveal Js Init
  08. Fixed Footer bottom script ( Newsletter )
  09. Search Bar
  10. Toogle Menu
  11. Shopping Cart Area
  12. Filter Area
  13. User Menu
  14. Overlay Close
  15. Home Slider
  16. Popular Product Wrap
  17. Testimonial Wrap
  18. Magnific Popup
  19. Price Slider Active
  20. Plus Minus Button
  21. jQuery scroll Nav



/*--------------------------------
[ End table content ]
-----------------------------------*/
// $(function(){
//   $(".slide slider__full--screen").slick({
//     speed: 1000,
//     dots: true,
//     prevArrow: '<div class="owl-page left"><span class></span></div>',
//     nextArrow: '<div class="owl-page right"><span class></span></div>'
//   });
// });



$(document).ready(function(){
  $(".prevNext").html('<div class="owl-page left"><span class></span></div><div class="owl-page right"><span class></span></div>');

  $(".owl-page span").click(function(){
      $(".owl-page span.activeSlide").removeClass("activeSlide");
      $(this).addClass("activeSlide");
  });

  $('.contact__details a').click(function(e){
    e.preventDefault();
})
});

// SCROLL
  $(document).ready(function() {
    $('.main__menu li a').click(function(e){
  e.preventDefault();
  var target = $($(this).attr('href'));
  if(target.length){
    var scrollTo = target.offset().top;
    $('body, html').animate({scrollTop: scrollTo+'px'}, 800);
  }
});
$('.search__open a').click(function(e){
e.preventDefault();
var target = $($(this).attr('href'));
if(target.length){
var scrollTo = target.offset().top;
$('body, html').animate({scrollTop: scrollTo+'px'}, 800);
}
});
  });

  $(document).ready(function() {
    $('.mobile_menu li a').click(function(e){
  e.preventDefault();
  var target = $($(this).attr('href'));
  if(target.length){
    var scrollTo = target.offset().top;
    $('body, html').animate({scrollTop: scrollTo+'px'}, 800);
  }
});
  });

// Newsletter class - focus & blur
$(document).ready(function(){
  $("#mce-EMAIL").on('focus',function(){
    $("#mc-embedded-subscribe").addClass("btnBorderLeft");

  });

  $("#mce-EMAIL").on('blur',function(){
    $("#mc-embedded-subscribe").removeClass("btnBorderLeft");
  });
});

(function($) {
    'use strict';


/*-------------------------------------------
  01. jQuery MeanMenu
--------------------------------------------- */

$('.mobile-menu nav').meanmenu({
    meanMenuContainer: '.mobile-menu-area',
    meanScreenWidth: "991",
    meanRevealPosition: "right",
});

/*-------------------------------------------
  02. wow js active
--------------------------------------------- */

  new WOW().init();



/*-------------------------------------------
  03. Product  Masonry (width)
--------------------------------------------- */

$('.htc__product__container').imagesLoaded( function() {

    // filter items on button click
    $('.product__menu').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });
    // init Isotope
    var $grid = $('.product__list').isotope({
      itemSelector: '.single__pro',
      percentPosition: true,
      transitionDuration: '0.7s',
      layoutMode: 'fitRows',
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: 1,
      }
    });

});

$('.product__menu button').on('click', function(event) {
    $(this).siblings('.is-checked').removeClass('is-checked');
    $(this).addClass('is-checked');
    event.preventDefault();
});



/*-------------------------------------------
  04. Sticky Header
--------------------------------------------- */


  var win = $(window);
  var sticky_id = $("#sticky-header-with-topbar");
  win.on('scroll',function() {
    var scroll = win.scrollTop();
    if (scroll < 245) {
      sticky_id.removeClass("scroll-header");
    }else{
      sticky_id.addClass("scroll-header");
    }
  });





/*--------------------------
  05. ScrollUp
---------------------------- */
$.scrollUp({
    scrollText: '<i class="zmdi zmdi-chevron-up"></i>',
    easingType: 'linear',
    scrollSpeed: 900,
    animation: 'fade'
});



/*---------------------------
  06. Tooltip
------------------------------*/
$('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'top',
    container: 'body'
});



/*-----------------------------------
  07. ScrollReveal Js Init
-------------------------------------- */

  window.sr = ScrollReveal({ duration: 800 , reset: false });
    sr.reveal('.foo');
    sr.reveal('.bar');



/*-------------------------------------------------------
  08. Fixed Footer bottom script ( Newsletter )
--------------------------------------------------------*/

var $newsletter_height = $(".htc__foooter__area");
$('.fixed__footer').css({'margin-bottom': $newsletter_height.height() + 'px'});




/*------------------------------------
  09. Search Bar
--------------------------------------*/

  $( '.search__open' ).on( 'click', function () {
    $( 'body' ).toggleClass( 'search__box__show__hide' );
    return false;
  });

  $( '.search__close__btn .search__close__btn_icon' ).on( 'click', function () {
    $( 'body' ).toggleClass( 'search__box__show__hide' );
    return false;
  });




/*------------------------------------
  10. Toogle Menu
--------------------------------------*/

  $('.toggle__menu').on('click', function() {
    $('.offsetmenu').addClass('offsetmenu__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.offsetmenu__close__btn').on('click', function() {
      $('.offsetmenu').removeClass('offsetmenu__on');
      $('.body__overlay').removeClass('is-visible');
  });



/*------------------------------------
  11. Shopping Cart Area
--------------------------------------*/

  $('.cart__menu').on('click', function() {
    $('.shopping__cart').addClass('shopping__cart__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.offsetmenu__close__btn').on('click', function() {
      $('.shopping__cart').removeClass('shopping__cart__on');
      $('.body__overlay').removeClass('is-visible');
  });


/*------------------------------------
  12. Filter Area
--------------------------------------*/

  $('.filter__menu').on('click', function() {
    $('.filter__wrap').addClass('filter__menu__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.filter__menu__close__btn').on('click', function() {
      $('.filter__wrap').removeClass('filter__menu__on');
      $('.body__overlay').removeClass('is-visible');
  });



/*------------------------------------
  13. User Menu
--------------------------------------*/

  $('.user__menu').on('click', function() {
    $('.user__meta').addClass('user__meta__on');
    $('.body__overlay').addClass('is-visible');

  });

  $('.offsetmenu__close__btn').on('click', function() {
      $('.user__meta').removeClass('user__meta__on');
      $('.body__overlay').removeClass('is-visible');
  });



/*------------------------------------
  14. Overlay Close
--------------------------------------*/
  $('.body__overlay').on('click', function() {
    $(this).removeClass('is-visible');
    $('.offsetmenu').removeClass('offsetmenu__on');
    $('.shopping__cart').removeClass('shopping__cart__on');
    $('.filter__wrap').removeClass('filter__menu__on');
    $('.user__meta').removeClass('user__meta__on');
  });



/*-----------------------------------------------
  15. Home Slider
-------------------------------------------------*/

  if ($('.slider__activation__wrap').length) {
    $('.slider__activation__wrap').owlCarousel({
      loop: true,
      margin:0,
      nav:true,
      autoplay: false,
      navText: [ '<i class="zmdi zmdi-chevron-left"></i>', '<i class="zmdi zmdi-chevron-right"></i>' ],
      autoplayTimeout: 10000,
      items:1,
      dots: false,
      lazyLoad: true,
      responsive:{
        0:{
          items:1
        },
        1920:{
          items:1
        }
      }
    });
  }

  if ($('.slider__activation__02').length) {
    $('.slider__activation__02').owlCarousel({
      loop: true,
      margin:0,
      nav:false,
      autoplay: false,
      autoplayTimeout: 10000,
      items:1,
      dots: false,
      lazyLoad: true,
      responsive:{
        0:{
          items:1
        },
        1920:{
          items:1
        }
      }
    });
  }




/*-----------------------------------------------
  16. Popular Product Wrap
-------------------------------------------------*/


  $('.popular__product__wrap').owlCarousel({
      loop: true,
      margin:0,
      nav:true,
      autoplay: false,
      navText: [ '<i class="zmdi zmdi-chevron-left"></i>', '<i class="zmdi zmdi-chevron-right"></i>' ],
      autoplayTimeout: 10000,
      items:3,
      dots: false,
      lazyLoad: true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:2
        },
        800:{
          items:2
        },
        1024:{
          items:3
        },
        1200:{
          items:3
        },
        1400:{
          items:3
        },
        1920:{
          items:3
        }
      }
    });



/*-----------------------------------------------
  17. Testimonial Wrap
-------------------------------------------------*/


  $('.testimonial__wrap').owlCarousel({
      loop: true,
      margin:0,
      nav:false,
      autoplay: false,
      navText: false,
      autoplayTimeout: 10000,
      items:1,
      dots: false,
      lazyLoad: true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:1
        },
        800:{
          items:1
        },
        1024:{
          items:1
        },
        1200:{
          items:1
        },
        1400:{
          items:1
        },
        1920:{
          items:1
        }
      }
    });




/*--------------------------------
  18. Magnific Popup
----------------------------------*/

$('.video-popup').magnificPopup({
  type: 'iframe',
  mainClass: 'mfp-fade',
  removalDelay: 160,
  preloader: false,
  zoom: {
      enabled: true,
  }
});

$('.image-popup').magnificPopup({
  type: 'image',
  mainClass: 'mfp-fade',
  removalDelay: 100,
  gallery:{
      enabled:true,
  }
});





/*-------------------------------
  19. Price Slider Active
--------------------------------*/
  $("#slider-range").slider({
      range: true,
      min: 10,
      max: 500,
      values: [110, 400],
      slide: function(event, ui) {
          $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
  });
  $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));




/*-------------------------------
  20.  Plus Minus Button
--------------------------------*/


    $(".cart-plus-minus").append('<div class="dec qtybutton">-</i></div><div class="inc qtybutton">+</div>');

    $(".qtybutton").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });


/*--------------------------
  21. jQuery scroll Nav
---------------------------- */
    $('.onepage--menu').onePageNav({
        scrollOffset: 0
    });








})(jQuery);
