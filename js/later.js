

function init() {
    $.post(
        "admin/core.php",
        {
            "action" : "loadGoods"
        },
        goodsOut
    );
}

function goodsOut(data) {
    // вывод на страницу
    data = JSON.parse(data);
    var out='';
    var later ={};
    if (localStorage.getItem('later')) {
        // если есть - расширфровываю и записываю в переменную cart
        later = JSON.parse(localStorage.getItem('later'));
        for (var key in later) {
            out +='<div id="cart-later" class="cart">';
            out +=`<p class="name_href"><a href="goods.php#${key}">${data[key].name}</a></p>`;
            out +=`<a href="goods.php#${key}"><img class="img_later" src="images/${data[key].img}" alt="" ></a>`;
            out +=`<div class="cost">${data[key].cost} Рублей</div>`;
            out +=`<p><a class="info_goods"  href="goods.php#${key}">Просмотреть</a></p>`;
            out +='</div>';
        }
        $('.goods-out-g').html(out);
        hideContainer();
    }
    else {
      $('.goods-out-g').html('<span>Добавьте товар</span>');
    }

   }

   function delGoods() {
       //удаляем желания

       localStorage.removeItem("later");

       location.reload();
   }
   function hideContainer() {
     //показываю кнопку удаления сод желания
   document.getElementById("del-to-later").style.display = "block";
   }

$(document).ready(function () {
    init();
    $('#del-to-later').on('click', delGoods);
});
