var cart = {}; // корзина

function init() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoods"
      },
      goodsOut
  );
}

function loadGoods_costa() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOutCost);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoods_costa"
      },
      goodsOut
  );

}

function loadGoods_costb() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOutCost);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoods_costb"
      },
      goodsOut
  );

}

function loadGoodsAll() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoodsAll"
      },
      goodsOut
  );
}

function loadGoods_namea() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOutCost);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoods_namea"
      },
      goodsOut
  );

}

function loadGoods_nameb() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOutCost);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoods_nameb"
      },
      goodsOut
  );

}

function initKom_ras() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoodsKom_ras"
      },
      goodsOut
  );
}

function initPalm() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoodsPalm"
      },
      goodsOut
  );
}

function initWood() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoodsWood"
      },
      goodsOut
  );
}

function initSort_namea() {
    //вычитуем файл goods.json
  //  $.getJSON("goods.json", goodsOut);
  $.post(
      "admin/core.php",
      {
          "action" : "loadGoodsSort_namea"
      },
      goodsOut
  );
}

function goodsOut(data) {
    // вывод на страницу
    data = JSON.parse(data);
    var out='';
    for (var key in data) {

        out +=`<div class="cart">`;
        out +=`<button class="later" title="Добавить в желания" data-id="${data[key].id}">&hearts;</button>`;
        out +=`<p class="name_href"><a href="goods.php#${data[key].id}">${data[key].name}</a></p>`;
        out +=`<a href="goods.php#${data[key].id}"><img class="img" src="images/${data[key].img}" alt=""></a>`;
        out +=`<div class="cost">${data[key].cost} Рублей</div>`;
        out +=`<button class="add-to-cart" data-id="${data[key].id}">Купить</button>`;
        out +=`</div>`;
    }
    $('.goods-out').html(out);
    $('.add-to-cart').on('click', addToCart);
    $('.later').on('click', addToLater);
}


function addToLater(){
//добавляю товар в "желания"
var later = {};
if (localStorage.getItem('later')) {
    // если есть - расширфровываю и записываю в переменную cart
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
	
    hideContainer();
    showCart();
	showSum();
    saveCart();
}

function saveCart() {
    //сохраняю корзину в localStorage
    localStorage.setItem('cart', JSON.stringify(cart)); //корзину в строку
}



function loadCart() {
    //проверяю есть ли в localStorage запись cart
    if (localStorage.getItem('cart')) {
        // если есть - расширфровываю и записываю в переменную cart
        cart=JSON.parse(localStorage.getItem('cart'));

        showCart();
		showSum();

        }
    else {
        $('.index-cart').html('<span>Корзина пуста!</span>');
    }
}

function hideContainer() {
  //показываю кнопку удаления сод.корзины
  if ($(window).width() < 800){
    document.getElementById("del-to-cart").style.display = "none";
    document.getElementById("del-to-cart-tho").style.display = "block";
}
else{
    document.getElementById("del-to-cart").style.display = "block";
    document.getElementById("del-to-cart-tho").style.display = "none";
}
}


function showCart() {
    //вывод корзины
    if (!isEmpty(cart)) {
        $('.index-cart').html('<span>Корзина пуста!</span>');
    }
    else {
  $.post(
  "admin/core.php",

   {
          "action" : "loadGoods"
   },

   function(data) {
   var goods = JSON.parse(data);
            var out = '';
            out += `<span> В вашей корзине </span><br> `;
            for (var id in cart) {
                out += `<a href="goods.php#${id}" id="name_cart"> ${goods[id].name  }  </a><br> `;

            }
            $('.index-cart').html(out);
            hideContainer();

  });
    }
}

function showSum() {
    //вывод количества добавленных товаров
    
  $.post(
  "admin/core.php",

   {
          "action" : "loadGoods"
   },

   function(data) {
   var goods = JSON.parse(data);
            var out = '';
            var summa = 0;
            for (var id in cart) {
                summa += cart[id];
            }   
                     out += `<span>` +summa+ `</span>`;
    
            $('#check_sum').html(out);
            hideContainer();
            if (summa < 10){
                document.getElementById("check_sum").style.padding = "1px 7px";
              }
              else if(summa >= 10){
                document.getElementById("check_sum").style.padding = "2px 5px";
              }

  });
    
}

function isEmpty(object) {
    //проверка корзины на пустоту
    for (var key in object)
    if (object.hasOwnProperty(key)) return true;
    return false;

}

function delGoods() {
    //удаляем товар из корзины
    localStorage.removeItem("cart");

    location.reload();

}



$(document).ready(function () {
    
    init();
    loadCart();
    $('#del-to-cart').on('click', delGoods);
    $('#del-to-cart-tho').on('click', delGoods);
    $('#all').on('click', loadGoodsAll);
    $('#kom_ras').on('click', initKom_ras);
    $('#palm').on('click', initPalm);
    $('#wood').on('click', initWood);
    $('#sort_namea').on('click', loadGoods_namea);
    $('#sort_nameb').on('click', loadGoods_nameb);
    $('#sort_stok').on('click', init);
    $('#sort_costa').on('click', loadGoods_costa);
    $('#sort_costb').on('click', loadGoods_costb);
});
