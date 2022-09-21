/*  ---------------------------------------------------
    Template Name: Fashi
    Description: Fashi eCommerce HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Product Slider
    --------------------*/
    $(".product-slider").owlCarousel({
        loop: false,
        margin: 25,
        nav: true,
        items: 4,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /*------------------
       logo Carousel
    --------------------*/
    $(".logo-carousel").owlCarousel({
        loop: false,
        margin: 30,
        nav: false,
        items: 5,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        mouseDrag: false,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
            },
            768: {
                items: 5,
            }
        }
    });

    /*-----------------------
       Product Single Slider
    -------------------------*/
    $(".ps-slider").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 3,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if (mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end

    console.log(timerdate);


    // Use this for real timer date
    /* var timerdate = "2020/01/01"; */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));
    });


    /*----------------------------------------------------
     Language Flag js
    ----------------------------------------------------*/
    $(document).ready(function (e) {
        //no use
        try {
            var pages = $("#pages").msDropdown({
                on: {
                    change: function (data, ui) {
                        var val = data.value;
                        if (val != "")
                            window.location = val;
                    }
                }
            }).data("dd");

            var pagename = document.location.pathname.toString();
            pagename = pagename.split("/");
            pages.setIndexByValue(pagename[pagename.length - 1]);
            $("#ver").html(msBeautify.version.msDropdown);
        } catch (e) {
            // console.log(e);
        }
        $("#ver").html(msBeautify.version.msDropdown);

        //convert
        $(".language_drop").msDropdown({
            roundedBorder: false
        });
        $("#tech").data("dd");
    });
    /*-------------------
		Range Slider
	--------------------- */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max'),
        minValue = rangeSlider.data('min-value') !== '' ? rangeSlider.data('min-value') : minPrice,
        maxValue = rangeSlider.data('max-value') !== '' ? rangeSlider.data('max-value') : maxPrice;

    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minValue, maxValue],
        slide: function (event, ui) {
            minamount.val('$' + ui.values[0]);
            maxamount.val('$' + ui.values[1]);
        }
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));

    /*-------------------
		Radio Btn
	--------------------- */
    $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").on('click', function () {
        $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Nice Select
    --------------------- */
    $('.sorting, .p-show').niceSelect();

    /*------------------
		Single Product
	--------------------*/
    $('.product-thumbs-track .pt').on('click', function () {
        $('.product-thumbs-track .pt').removeClass('active');
        $(this).addClass('active');
        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product-big-img').attr('src');
        if (imgurl != bigImg) {
            $('.product-big-img').attr({
                src: imgurl
            });
            $('.zoomImg').attr({
                src: imgurl
            });
        }
    });

    $('.product-pic-zoom').zoom();

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);

        //Update cart:
        var rowId = $button.parent().find('input').data('rowid');
        updateCart(rowId,newVal);
    });

    /*-------------------
        Bộ lọc sản phẩm ở trang chủ
    -------------------*/

    const product_men = $(".product-slider.men");
    const product_women = $(".product-slider.women");

    $('.filter-control').on('click', '.item', function () {
        const $item = $(this);
        const filter = $item.data('tag');
        const category = $item.data('category');

        $item.siblings().removeClass('active');
        $item.addClass('active');

        if (category === 'men') {
            product_men.owlcarousel2_filter(filter);
        }

        if (category === 'women') {
            product_women.owlcarousel2_filter(filter);
        }
    })

})(jQuery);

function addCart(productId) {
    $.ajax({
        type: "GET",
        url: "cart/add",
        data: {
            productId: productId
        },
        success: function (res) {
            $('.cart-count').text(res['count']);
            $('.cart-price').text('$' + res['total']);

            var cartHover_tbody = $('.select-items tbody');
            var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + res['cart'].rowId + "']");

            if(cartHover_existItem.length){
                cartHover_existItem.find('.product-selected p').text('$' + res['cart'].price.toFixed(2) + ' x ' + res['cart'].qty);
            }else{
                var newItem =
                '<tr data-rowId="'+ res['cart'].rowId +'">\n ' +
                    '<td class="si-pic"><img style="height:70px" src="front/img/products/'+res['cart'].options.images[0].path +'" alt=""></td> \n ' +
                    '<td class="si-text"> \n ' +
                        '<div class="product-selected"> \n ' +
                            '<p>$'+ res['cart'].price.toFixed(2) + ' x ' + res['cart'].qty +'\n ' +
                            '<h6>'+ res['cart'].name +'</h6> \n ' +
                        '</div> \n ' +
                    '</td> \n ' +
                    '<td class="si-close"> \n ' +
                        '<i onclick="removeCart(\'' + res['cart'].rowId +'\')" class="ti-close"></i>\n ' +
                    '</td> \n ' +
                '</tr>';
                cartHover_tbody.append(newItem);
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function removeCart(rowId){
    $.ajax({
        type: "GET",
        url: "cart/delete",
        data: {
            rowId: rowId
        },
        success: function (res) {
            //Xử lý phần cart hover(trang master-page)
            $('.cart-count').text(res['count']);
            $('.cart-price').text('$' + res['total']);

            var cartHover_tbody = $('.select-items tbody');
            var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + rowId + "']");

            cartHover_existItem.remove();

            //Xử lý trong trang "shop/cart"
            var cart_tbody = $('.cart-table tbody');
            var cart_existItem = cart_tbody.find("tr" + "[data-rowId='" + rowId + "']");

            cart_existItem.remove();

            console.log(res);
        },
        error: function (err) {
            alert('Delete failed !');
            console.log(err);
        },
    });
}

function destroyCart(){
    $.ajax({
        type: "GET",
        url: "cart/destroy",
        data: {},
        success: function (res) {
            //Xử lý phần cart hover(trang master-page)
            $('.cart-count').text('0');
            $('.cart-price').text('0');

            var cartHover_tbody = $('.select-items tbody');
            cartHover_tbody.children().remove();

            //Xử lý trong trang "shop/cart"
            var cart_tbody = $('.cart-table tbody');
            cart_tbody.children().remove();

            $('.subtotal span').text('0');
            $('.cart-total span').text('0');
            location.reload();
            console.log(res);
        },
        error: function (err) {
            alert('Delete failed !');
            console.log(err);
        },
    });
}

function updateCart(rowId, qty){
    $.ajax({
        type: "GET",
        url: "cart/update",
        data: {
            qty: qty,
            rowId: rowId,
        },
        success: function (res) {
            //Xử lý phần cart hover(trang master-page)
            $('.cart-count').text(res['count']);
            $('.cart-price').text('$' + res['total']);

            var cartHover_tbody = $('.select-items tbody');
            var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + rowId + "']");
            if(qty === 0){
                cartHover_existItem.remove();
            }else{
                cartHover_existItem.find('.product-selected p').text('$' + res['cart'].price.toFixed(2) + ' x ' + res['cart'].qty)
            }

            //Xử lý trong trang "shop/cart"
            var cart_tbody = $('.cart-table tbody');
            var cart_existItem = cart_tbody.find("tr" + "[data-rowid='" + rowId + "']");
            if(qty === 0){
                cart_existItem.remove();
            }else{
                cart_existItem.find('.total-price').text('$' + (res['cart'].price * res['cart'].qty).toFixed(2));
            }

            $('.subtotal span').text('$' + res['subtotal']);
            $('.cart-total span').text('$' + res['total']);


            console.log(res);
        },
        error: function (err) {

            console.log(err);
        },
    });
}
