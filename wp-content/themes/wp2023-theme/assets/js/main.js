// JavaScript Document
var queryLongWindow = window.matchMedia("(min-width: 768px)");
var query768 = window.matchMedia("(max-width: 768px)");

// function return_ajax(url, data) {
//     var xmlhttp = new XMLHttpRequest();

// 	xmlhttp.open("POST", url, true);
// 	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xmlhttp.send(data);
//     return xmlhttp;
// }

$(document).ready(function () {
  $("#search-input").keydown(function (event) {
    if (event.keyCode == 13) {
      event.preventDefault();

      search_bar_function();
      return false;
    }
  });
  $("#search-submit").click(function (event) {
    event.preventDefault();

    search_bar_function();
  });
});

function search_bar_function() {
  if ($("#search-input").val() != "") {
    window.location = URL_ROOT + "/search/key=" + $("#search-input").val();
    return false;
  }
}

// Email Subscription
// $("#email-subscription-btn").on("click", function (e) {
//     email_subscribe($("#email-subscription").val());
// })

// function email_subscribe(email) {
//     var data = new FormData();
//     data.append("email", email);
//     fetch(URL_ROOT + "/email_subscribe_ajax", {
//         method: "POST",
//         body: data
//     })
//         .then(response => response.text())
//         .then(response => {
//             if (response == "successful") {
//                 notify("ÄÄƒng kĂ½ email thĂ nh cĂ´ng", 1);
//             }
//         })
// }

//Email
$("#campaign-start").on("click", function (e) {
  e.preventDefault();
  // Disable Button
  $("#campaign-start").addClass("loading");
  $("#campaign-start").attr("disabled", true);
  var recipients = [];

  console.log("start");
  var data = {
    campaign_name: $("#campaign-name").html(),
    sender_name: $("#name").html(),
    subject: $("#subject").html(),
    template: $("#template").html(),
    recipient_count: $("#recipient-count").html(),
  };
  // console.log(data);
  // Get Campaign Recipients
  var input = new FormData();
  input.append("data", JSON.stringify(data));
  fetch(URL_ROOT + "/email/get_campaign_recipients_ajax", {
    method: "POST",
    body: input,
  })
    .then((response) => response.text())
    .then((response) => {
      recipients = JSON.parse(response);
      console.log(JSON.parse(response));
      // throw "stop execution";
      for (var a = 0; a < recipients.length; a++) {
        if (recipients[a].trim() == "") {
          recipients.splice(a, 1);
        }
      }
      console.log(recipients);
      // throw "stop execution";
    })
    .then(function () {
      //Send Email
      var timer = (ms) => new Promise((res) => (time = setTimeout(res, ms)));

      async function load() {
        // We need to wrap the loop into an async function for this to work

        for (var i = 0; i < recipients.length; i++) {
          $("#campaign-stop").on("click", function () {
            clearTimeout(time);
            $("#campaign-start").removeClass("loading");
            $("#campaign-start").attr("disabled", false);
            $("#campaign-stop").attr("disabled", true);
          });
          // In Case Sender Changed
          var sender = $("#sender").val().split(":");
          data["sender_address"] = sender[0];
          data["sender_password"] = sender[1];

          // Send Email
          var date = new Date();
          $("#live-report").append(
            "<p>" +
              date.toLocaleString() +
              "&emsp;|&emsp;Send Email To: " +
              recipients[i] +
              "</p>"
          );
          // console.log("Send Email To: " + recipients[i]);
          data["recipient"] = recipients[i].trim();
          // console.log(JSON.stringify(data));
          var a = return_ajax(
            URL_ROOT + "/email/campaign_start",
            "data=" + JSON.stringify(data)
          );
          a.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
              // $("#live-report").html(this.responseText);
              var res = this.responseText.split("|");
              // console.log(res);
              // $("#live-report").append(res);
              switch (res[0]) {
                case "OK":
                  update_email_stats();
                  $("#live-report").append(
                    "<p class='text-success'>" +
                      res[1] +
                      "&emsp;|&emsp;" +
                      res[2] +
                      "</p>"
                  );
                  break;
                case "failed":
                  clearTimeout(time);
                  // $("#live-report").append(res);
                  if (res[3].includes("Invalid address")) {
                    // console.log("Delete Email");
                    //Delete Email
                    var b = return_ajax(
                      URL_ROOT + "/email/delete_recipient",
                      "data=" + JSON.stringify(data)
                    );
                    b.onreadystatechange = function () {
                      if (this.readyState == 4 && this.status == 200) {
                        // $("#live-report").html(this.responseText);
                        console.log(this.responseText);
                        if (this.responseText == "OK") {
                          $("#live-report").append(
                            "<p class='text-danger'>Recipient Removed: " +
                              res[2] +
                              "</p>"
                          );
                        }
                      }
                    };
                  }
                  $("#live-report").append(
                    "<p class='text-danger'>" +
                      res[1] +
                      "&emsp;|&emsp;" +
                      res[2] +
                      "&emsp;|&emsp;" +
                      res[3] +
                      "</p>"
                  );
                  alert("ÄĂ£ xáº£y ra lá»—i");
                  $("#campaign-start").removeClass("loading");
                  $("#campaign-start").attr("disabled", false);
                  $("#campaign-stop").attr("disabled", true);
                  break;
                case "error":
                  clearTimeout(time);
                  alert("Lá»—i");
                  $("#campaign-start").removeClass("loading");
                  $("#campaign-start").attr("disabled", false);
                  $("#campaign-stop").attr("disabled", true);
                  break;
                case "finished":
                  update_email_stats();
                  // $("#live-report").append("<p class='text-success'>" + res[1] + "&emsp;|&emsp;" + res[2] + "</p>");
                  $("#live-report").append(
                    "<p class='text-success'>HoĂ n táº¥t chiáº¿n dá»‹ch</p>"
                  );
                  clearTimeout(time);
                  alert("HoĂ n táº¥t chiáº¿n dá»‹ch");
                  $("#campaign-start").removeClass("loading");
                  $("#campaign-start").attr("disabled", true);
                  $("#campaign-stop").attr("disabled", true);
                  break;
              }
            }
          };
          // $("#live-report").animate({ scrollTop: $('#live-report').prop("scrollHeight")}, 1000);

          await timer(60000); // then the created Promise can be awaited
        }
      }

      load();
      $("#campaign-stop").attr("disabled", false);
    });
});
function update_email_stats() {
  fetch(
    URL_ROOT +
      "/email/count_campaign_recipient_sent_ajax/c=" +
      $("#campaign-name").html()
  )
    .then((response) => response.text())
    .then((response) => {
      var sent = parseInt(response);
      var total = parseInt($("#recipient-count").html());
      var percentage = Math.ceil((sent / total) * 100);
      $("#campaign-percentage").html(percentage);
      $("#num-of-sent").html(sent);
      // console.log(total);
    });
}

//Tracker
$(".order-search-input").on("keyup", function (e) {
  if (e.keyCode === 13) {
    order_search();
  }
});
$(".order-search-button").on("click", function () {
  order_search();
});

function order_search() {
  if ($(".order-search-input").val() != "") {
    var getOrder = get_order_list($(".order-search-input").val());
    getOrder
      .then((response) => {
        $(".order-list-table-wrapper").html(response);
      })
      .then(() => {
        $(".order-talble-row").on("click", function () {
          var getOrderInfo = get_order_info($(this).data("order-number"));
          getOrderInfo.then((response) => {
            $(".order-detail-wrapper").html(response);
          });
        });
      });
  }
}

function get_order_info(orderNumber) {
  var data = new FormData();
  data.append("orderNumber", orderNumber);
  return fetch(URL_ROOT + "/get_order_info", {
    method: "POST",
    body: data,
  }).then((response) => response.text());
}

function get_order_list(input) {
  var data = new FormData();
  data.append("input", input);
  return fetch(URL_ROOT + "/get_order_list", {
    method: "POST",
    body: data,
  }).then((response) => response.text());
}

// Province On Checkout Page
$("select[name='province']").on("change", function () {
  // alert($(this).val());
  var data = new FormData();
  data.append("province_name_without_tone_mark", $(this).val());
  fetch(URL_ROOT + "/get_district", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      $("select[name='district']").empty();
      $("select[name='district']").append(
        "<option hidden>Chá»n quáº­n/huyá»‡n</option>"
      );
      $("select[name='ward']").empty();
      $("select[name='ward']").append(
        "<option hidden>Chá»n phÆ°á»ng/xĂ£</option>"
      );
      JSON.parse(response).forEach((element) => {
        $("select[name='district']").append(
          "<option value='" +
            element["district_name_without_tone_mark"] +
            "'>" +
            element["district_name"] +
            "</option>"
        );
      });
      // $(".cart-table-body").html(response);
    })
    .then(() => {
      $("select[name='district']").on("change", function () {
        get_ward_checkout($(this).val());
      });
    });
});
// District On Checkout
function get_ward_checkout(district) {
  var data = new FormData();
  data.append("district_name_without_tone_mark", district);
  fetch(URL_ROOT + "/get_ward", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      $("select[name='ward']").empty();
      $("select[name='ward']").append(
        "<option hidden>Chá»n phÆ°á»ng/xĂ£</option>"
      );
      JSON.parse(response).forEach((element) => {
        $("select[name='ward']").append(
          "<option value='" +
            element["ward_name_without_tone_mark"] +
            "'>" +
            element["ward_name"] +
            "</option>"
        );
      });
      // $(".cart-table-body").html(response);
    })
    .then(() => {
      $("select[name='ward']").on("change", function () {
        get_delivery_fee_checkout($(this).val());
      });
    });
}
// Get Delivery Fee On Checkout
function get_delivery_fee_checkout(ward) {
  var data = new FormData();
  data.append(
    "province_name_without_tone_mark",
    $("select[name='province']").val()
  );
  data.append(
    "district_name_without_tone_mark",
    $("select[name='district']").val()
  );
  data.append("ward_name_without_tone_mark", ward);
  fetch(URL_ROOT + "/get_delivery_fee", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      // alert(response);
      // console.log(typeof response);
      $(".delivery_fee").html(priceFormat(response));
      get_order_total_checkout_page();
      // var total = get_order_total();
      // console.log( total);
      // $(".order_total").html(total);
      // $(".order_total").html();
    });
}

// Get Order Total
function get_order_total_checkout_page() {
  fetch(URL_ROOT + "/get_order_total")
    .then((response) => response.text())
    .then((response) => {
      var total = JSON.parse(response);
      // console.log(typeof total["discount"]);
      $(".delivery_fee").html(priceFormat(total["delivery_fee"].toString()));
      $(".discount").html(priceFormat(total["discount"].toString()));
      $(".order_total").html(priceFormat(total["order_total"].toString()));
      // console.log(JSON.parse(response));
      // $(".order_total").html(priceFormat(response));
    });
  // return res;
}

function get_coupon(coupon) {
  var data = new FormData();
  data.append("discount_code", coupon);
  return fetch(URL_ROOT + "/get_coupon", {
    method: "POST",
    body: data,
  }).then((response) => response.text());
}
// Coupon On Checkout Page
$("button[name='coupon_submit']").on("click", function (e) {
  e.preventDefault();
  var get = get_coupon($("input[name='coupon']").val());
  get.then((response) => {
    // alert(response);
    var res = response.split(":");
    console.log(res);
    $(".coupon-notification").empty();
    switch (res[0]) {
      case "coupon_not_found":
        $(".coupon-notification").append(
          "<p class='text-danger'>MĂ£ giáº£m giĂ¡ khĂ´ng há»£p lá»‡</p>"
        );
        break;
      case "collaborator_found":
        $(".coupon-notification").append(
          "<p class='text-success'>NgÆ°á»i giá»›i thiá»‡u: " + res[1] + "</p>"
        );
        break;
      case "coupon_applied":
        $(".coupon-notification").append(
          "<p class='text-success'>Ăp dá»¥ng mĂ£ giáº£m giĂ¡ thĂ nh cĂ´ng</p>"
        );
        break;
    }
    if (response != "coupon_not_found") {
      get_order_total_checkout_page();
    }
  });
});

$(".qtybtn").on("click", function () {
  $(".cart-update").removeAttr("disabled");
});

$(".cart-table-remover").on("click", function (e) {
  $(".cart-update").removeAttr("disabled");
  e.preventDefault();
  var remove = new Promise(() => {
    $(this).parentsUntil("tr").parent().remove();
    console.log("Removed");
  });
  remove.then(() => {
    cart_page_cart_update_btn_function();
  });
});

cart_page_cart_update_btn_function();

function cart_page_cart_update_btn_function() {
  $(".cart-update").on("click", function () {
    var data = new FormData();

    var cartInfo = {};
    $(".cart-product-quantity").map(function () {
      cartInfo[$(this).data("product-id")] = $(this).val();
    });

    data.append("cart_info", JSON.stringify(cartInfo));
    fetch(URL_ROOT + "/cart_page_update", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        $(".cart-table-body").html(response);
      })
      .then(() => {
        cart_page_quantity_change();
        $(".cart-subtotal").html($(".cart-hidden-subtotal").val());
        window.location.href = URL_ROOT + "/gio-hang";
      });
  });
}

$(".add-to-cart").on("click", function () {
  add_to_cart($(this).data("product-id"));
});

$(".product-page-add-to-cart").on("click", function () {
  // console.log($(".product-quantity").val());
  add_to_cart($(this).data("product-id"), $(".product-quantity").val());
});

// function remove_from_cart_table(productId) {
//     var allProductIDs = $('.cart-table-remover').map(function() {
//         return $(this).data('product-id');
//     }).get();
//     if(jQuery.inArray(productId, allProductIDs) !== -1) {
//         var data = new FormData();
//         data.append("product_id", productId);
//         // data.append("page", currentPage);
//         fetch(URL_ROOT + "/remove_from_cart_table", {
//             method: "POST",
//             body: data
//         })
//             .then(response => response.text())
//             .then(response => {
//                 // $(".cart-popup-body").html(response);
//                 // cart_popup_function();
//             })
//             .then(() => {
//                 // $(".count").html($(".cart-quantity").val() ? $(".cart-quantity").val() : 0);
//             })
//     }
// }

function add_to_cart(productId, quantity = 1) {
  // alert("xc,mbvcx,");
  // $.ajax({
  //     type: "POST",
  //     url: "/test",

  //     async: false,
  //     data: "aksldh=xchjkjh",
  // 		// dataType: 'json',
  //     contentType: "application/x-www-form-urlencoded;charset=utf-8",
  //     cache: false,
  //     success: function(data, textStatus) {
  //         alert("Jquery Ajax: " + data);
  //         //doe iets
  //     },
  //     beforeSend: function() {
  //         alert("Go");
  //     }
  // });

  // return;
  // var data = {
  //     product_id : productId,
  //     quantity : quantity
  // };
  // var a = new URLSearchParams(data).toString();
  // var xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function() {
  //     if (this.readyState == 4 && this.status == 200) {
  //         alert(this.responseText);
  //         // object.innerHTML = this.responseText;
  //         return true;
  //     } else {
  //         // object.innerHTML = loaderContent;
  //         return false;
  //     }
  // };
  // xmlhttp.open("POST", URL_ROOT + "/test", true);
  // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xmlhttp.send(a);

  // return;
  // ========================================================
  // var data = {
  //     product_id : productId,
  //     quantity : quantity
  // };
  // alert("yudhkfjbv");
  // var request = $.post(URL_ROOT + "/add_to_cart", data, function(response){
  //     var res = JSON.parse(response);
  //     var name = res["product_name"];

  //     // console.log(JSON.parse(response));
  //     $(".cart-popup-body").html(res["cart_popup_body"]);
  //     cart_popup_function();
  //     alert("pomlj");
  //     return res;

  // });

  // request.done(result => {
  //     alert("zvxcnt");
  //     var res = JSON.parse(result);
  //     if (!res["product_name"]) {
  //         notify("ÄĂ£ xáº£y ra lá»—i. Vui lĂ²ng thá»­ láº¡i sau!", -1);
  //     } else {
  //         notify("ÄĂ£ thĂªm <b>" + res["product_name"] + "</b> vĂ o giá» hĂ ng", 1);

  //         $(".count").html($(".cart-quantity").val() ? $(".cart-quantity").val() : 0);
  //     }
  // })

  // return;

  // ============================================================================

  var data = new FormData();
  data.append("product_id", productId);
  data.append("quantity", quantity);
  // data.append("page", currentPage);
  fetch(URL_ROOT + "/add_to_cart", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((response) => {
      // console.log(response);
      res = JSON.parse(response);

      var name = res["product_name"];
      // console.log(JSON.parse(response));
      $(".cart-popup-body").html(res["cart_popup_body"]);
      cart_popup_function();
    })
    .then(() => {
      if (!res["product_name"]) {
        notify("ÄĂ£ xáº£y ra lá»—i. Vui lĂ²ng thá»­ láº¡i sau!", -1);
      } else {
        notify(
          "ÄĂ£ thĂªm <b>" + res["product_name"] + "</b> vĂ o giá» hĂ ng",
          1
        );

        $(".count").html(
          $(".cart-quantity").val() ? $(".cart-quantity").val() : 0
        );
      }
    });
  // }
}

function remove_from_cart_popup(productId) {
  var allProductIDs = $(".popup-cart-remover")
    .map(function () {
      return $(this).data("product-id");
    })
    .get();
  if (jQuery.inArray(productId, allProductIDs) !== -1) {
    var data = new FormData();
    data.append("product_id", productId);
    // data.append("page", currentPage);
    fetch(URL_ROOT + "/remove_from_cart_popup", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((response) => {
        // console.log(response);
        res = JSON.parse(response);
        var name = res["product_name"];
        console.log(JSON.parse(response));
        $(".cart-popup-body").html(res["cart_popup_body"]);
        cart_popup_function();
      })
      .then(() => {
        notify(
          "ÄĂ£ xĂ³a <b>" + res["product_name"] + "</b> khá»i giá» hĂ ng",
          -1
        );
        $(".count").html(
          $(".cart-quantity").val() ? $(".cart-quantity").val() : 0
        );
      });
  }
}

$(document).ready(function () {
  const cartIcon = document.getElementsByClassName("cart-icon")[0];
  const cartPopupWrapper =
    document.getElementsByClassName("cart-popup-wrapper")[0];

  if (queryLongWindow.matches) {
    // For Long Window
    cartIcon.addEventListener("mouseover", function () {
      cartPopupWrapper.style.maxHeight = cartPopupWrapper.scrollHeight + "px";
      cartPopupWrapper.addEventListener("mouseover", function () {
        this.style.maxHeight = cartPopupWrapper.scrollHeight + "px";
      });
      cartPopupWrapper.addEventListener("mouseout", function () {
        this.style.maxHeight = null;
      });
    });
    cartIcon.addEventListener("mouseout", function () {
      cartPopupWrapper.style.maxHeight = null;
    });
    // For Medium Window
    document.addEventListener("click", function (e) {
      if (!cartIcon.contains(e.target)) {
        if (!cartPopupWrapper.contains(e.target)) {
          if (cartPopupWrapper.style.maxHeight) {
            cartPopupWrapper.style.maxHeight = null;
          }
        }
      } else {
        if (cartPopupWrapper.style.maxHeight) {
          cartPopupWrapper.style.maxHeight = null;
        } else {
          cartPopupWrapper.style.maxHeight =
            cartPopupWrapper.scrollHeight + "px";
        }
      }
    });
  }
  if (query768.matches) {
    document.addEventListener("click", function (e) {
      if (!cartIcon.contains(e.target)) {
        if (!cartPopupWrapper.contains(e.target)) {
          if (cartPopupWrapper.style.maxHeight) {
            cartPopupWrapper.style.maxHeight = null;
          }
        }
      } else {
        if (cartPopupWrapper.style.maxHeight) {
          cartPopupWrapper.style.maxHeight = null;
        } else {
          cartPopupWrapper.style.maxHeight =
            cartPopupWrapper.scrollHeight + "px";
        }
      }
    });
  }
  cart_popup_function();
});

// Cart Popup (Hover)
function cart_popup_function() {
  $(".popup-cart-remover").on("click", function () {
    remove_from_cart_popup($(this).data("product-id"));
  });
}

//== Filter Section Accordion ========
const showChildren = document.getElementsByClassName("show-children");
const categorySubItemsWrapper = document.getElementsByClassName(
  "category-sub-items-wrapper"
);
const categoryItemWrapper = document.getElementsByClassName(
  "category-item-wrapper"
);
const categoryItemTitle = document.getElementsByClassName(
  "category-item-title"
);

for (let a = 0; a < categoryItemTitle.length; a++) {
  categoryItemTitle[a].addEventListener("click", function () {
    var contentWrapper = categorySubItemsWrapper[a];
    if (contentWrapper.style.maxHeight) {
      contentWrapper.style.maxHeight = null;
      showChildren[a].style.transform = null;
    } else {
      for (let b = 0; b < categorySubItemsWrapper.length; b++) {
        categorySubItemsWrapper[b].style.maxHeight = null;
        showChildren[a].style.transform = null;
      }
      contentWrapper.style.maxHeight = contentWrapper.scrollHeight + "px";
      showChildren[a].style.transform = "rotate(180deg)";
    }
  });
  document.addEventListener("click", function (e) {
    if (
      !categorySubItemsWrapper[a].contains(e.target) &&
      !categoryItemWrapper[a].contains(e.target)
    ) {
      categorySubItemsWrapper[a].style.maxHeight = null;
      showChildren[a].style.transform = null;
    }
  });
}

/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

("use strict");

(function ($) {
  /*------------------
        Preloader
    --------------------*/
  $(window).on("load", function () {
    // $(".loader").fadeOut();
    // $("#preloder").delay(200).fadeOut("slow");

    /*------------------
            Gallery filter
        --------------------*/
    $(".featured__controls li").on("click", function () {
      $(".featured__controls li").removeClass("active");
      $(this).addClass("active");
    });
    if ($(".featured__filter").length > 0) {
      var containerEl = document.querySelector(".featured__filter");
      var mixer = mixitup(containerEl);
    }
  });

  /*------------------
        Background Set
    --------------------*/
  $(".set-bg").each(function () {
    var bg = $(this).data("setbg");
    $(this).css("background-image", "url(" + bg + ")");
  });

  //Humberger Menu
  $(".humberger__open").on("click", function () {
    $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
    $(".humberger__menu__overlay").addClass("active");
    $("body").addClass("over_hid");
  });

  $(".humberger__menu__overlay").on("click", function () {
    $(".humberger__menu__wrapper").removeClass(
      "show__humberger__menu__wrapper"
    );
    $(".humberger__menu__overlay").removeClass("active");
    $("body").removeClass("over_hid");
  });

  /*------------------
		Navigation
	--------------------*/
  $(".mobile-menu").slicknav({
    prependTo: "#mobile-menu-wrap",
    allowParentLinks: true,
  });

  /*-----------------------
        Categories Slider
    ------------------------*/
  $(".categories__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 4,
    dots: false,
    nav: true,
    navText: [
      "<span class='fa fa-angle-left'><span/>",
      "<span class='fa fa-angle-right'><span/>",
    ],
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },

      480: {
        items: 2,
      },

      768: {
        items: 3,
      },

      992: {
        items: 4,
      },
    },
  });

  // $('.hero__categories__all').on('click', function(){
  //     $('.hero__categories ul').slideToggle(400);
  // });
  $(document).on("click", function (e) {
    // console.log($(e.target));
    if (
      !$(".hero__categories__all").is(e.target) &&
      !$(".hero__categories__all span").is(e.target)
    ) {
      if (!$(".hero__categories ul").is(e.target)) {
        $(".hero__categories ul").slideUp(400);
      }
    } else {
      $(".hero__categories ul").slideToggle(400);
    }
  });

  /*--------------------------
        Latest Product Slider
    ----------------------------*/
  $(".latest-product__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    dots: false,
    nav: true,
    navText: [
      "<span class='fa fa-angle-left'><span/>",
      "<span class='fa fa-angle-right'><span/>",
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  /*-----------------------------
        Product Discount Slider
    -------------------------------*/
  $(".product__discount__slider").owlCarousel({
    loop: false,
    margin: 0,
    items: 3,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      480: {
        items: 2,
      },

      768: {
        items: 2,
      },

      992: {
        items: 3,
      },
    },
  });

  /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
  $(".product__details__pic__slider").owlCarousel({
    margin: 20,
    items: 4,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  $(".related__product__slider").owlCarousel({
    loop: false,
    margin: 0,
    items: 5,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      480: {
        items: 2,
      },

      768: {
        items: 3,
      },

      992: {
        items: 4,
      },
    },
  });
  $(".viewed__product__slider").owlCarousel({
    loop: false,
    margin: 0,
    items: 5,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      480: {
        items: 2,
      },

      768: {
        items: 3,
      },

      992: {
        items: 4,
      },
    },
  });

  /*-----------------------
		Price Range Slider
	------------------------ */
  var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data("min"),
    maxPrice = rangeSlider.data("max");
  rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
      minamount.val("$" + ui.values[0]);
      maxamount.val("$" + ui.values[1]);
    },
  });
  minamount.val("$" + rangeSlider.slider("values", 0));
  maxamount.val("$" + rangeSlider.slider("values", 1));

  /*--------------------------
        Select
    ----------------------------*/
  // $("select").niceSelect();

  /*------------------
		Single Product
	--------------------*/
  $(".product__details__pic__slider img").on("click", function () {
    var imgurl = $(this).data("imgbigurl");
    var bigImg = $(".product__details__pic__item--large").attr("src");
    if (imgurl != bigImg) {
      $(".product__details__pic__item--large").attr({
        src: imgurl,
      });
    }
  });

  cart_page_quantity_change();
})(jQuery);
/*-------------------
    Quantity change
--------------------- */
// var proQty = $('.pro-qty');
// proQty.prepend('<span class="dec qtybtn">-</span>');
// proQty.append('<span class="inc qtybtn">+</span>');
function cart_page_quantity_change() {
  $(".pro-qty").on("click", ".qtybtn", function () {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.hasClass("inc")) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 0;
      }
    }
    $button.parent().find("input").val(newVal);
  });
}
/*-------------------
    About Page
--------------------- */
$("#certificate-slider").owlCarousel({
  loop: true,
  nav: false,
  margin: 0,
  items: 1,
  smartSpeed: 1200,
  autoHeight: false,
  dots: false,
  // autoplay: true
});
