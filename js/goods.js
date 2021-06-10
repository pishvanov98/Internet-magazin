var cart = {}; // корзина

function init() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  var hash = window.location.hash.substring(1);

  $.post(
      "admin/core.php",
      {
          "action" : "loadSingleGoods",
          "id" : hash
      },
      goodsOut
  );
}

function goodsOut(data) {
    // вывод на страницу
    if (data!=0) {
        data = JSON.parse(data);
        var out='';
        out +='<div id="gods_dark" class="cart-gods">';
        out +=`<button class="later" data-id="${data.id}">&hearts;</button>`;
        out +=`<p class="name">${data.name}</p>`;
        out +=`<img class="img" src="images/${data.img}" alt="">`;
        out +=`<div class="cost">${data.cost} Рублей</div>`;
        out +=`<button class="add-to-cart" data-id="${data.id}">Купить</button>`;
        out +='</div>';
        out +=`<textarea rows="14" cols="70" class="description" readonly>${data.description}</textarea>`;
        out +=`<textarea.oninput = function(){this.style.height = this.scrollHeight+"px"}  class="descriptiontwo" readonly>${data.descriptiontwo}</textarea >`;
        $('.goods-out-g').html(out);
        $('.add-to-cart').on('click', addToCart);
        $('.later').on('click', addToLater);
      }
      else{
          $('.goods-out-g').html('Такого товара не существует');
      }
}

function addToLater(){
//добавляю товар в "желания"
var later = {};
if (localStorage.getItem('later')) {
    // если есть - расширфровываю и записываю в переменную 
    later = JSON.parse(localStorage.getItem('later'));
}
swal('Добавлено в Желания');

setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
var id = $(this).attr('data-id');
later[id] = 1;
localStorage.setItem('later', JSON.stringify(later)); //корзину в строку
}

function addToCart() {
    //добавляем товар в корзину
    var id = $(this).attr('data-id');
    // console.log(id);
    if (cart[id]==undefined) {
        cart[id] = 1; //если в корзине нет товара - делаем равным 1
    }
    else {
        cart[id]++; //если такой товар есть - увеличиваю на единицу
    }
	swal('Добавлено в корзину');
	
	setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
    showMiniCart();
    saveCart();
}

function saveCart() {
    //сохраняю корзину в localStorage
    localStorage.setItem('cart', JSON.stringify(cart)); //корзину в строку
}

function showMiniCart() {
    //показываю мини корзину
    var out="";
    for (var key in cart) {
        out += key +' --- '+ cart[key]+'<br>';
    }

    $('.mini-cart').html(out);
}

function loadCart() {
    //проверяю есть ли в localStorage запись cart
    if (localStorage.getItem('cart')) {
        // если есть - расширфровываю и записываю в переменную cart
        cart = JSON.parse(localStorage.getItem('cart'));
        showMiniCart();
    }
}

$(function() {
    refresh_shoutbox();
    setInterval("refresh_shoutbox()", 15000);

    $("#submit").click(function() {
        
        var sort = window.location.hash.substring(1);
        var name    = $("#name").val();
        var message = $("#message").val();
        var data            = 'name='+ name +'&message='+ message +'&sort='+ sort;

        $.ajax({
            type: "POST",
            url: "shout.php",
            data: data,
            success: function(html){
                $("#shout").slideToggle(500, function(){
                    $(this).html(html).slideToggle(500);
                    $("#message").val("");
                });
          }
        });    
        return false;
    });
});

function refresh_shoutbox() {
    var sort = window.location.hash.substring(1);
    var data = 'refresh=1'+'&sort='+ sort;
    
    $.ajax({
            type: "POST",
            url: "shout.php",
            data: data,
            success: function(html){
                $("#shout").html(html);
            }
        });
}



$(document).ready(function () {
    init();
    loadCart();
});
