var cart = {};
function loadCart() {
    //проверяю есть ли в localStorage запись cart
    if (localStorage.getItem('cart')) {
        // если есть - расширфровываю и записываю в переменную cart
        cart=JSON.parse(localStorage.getItem('cart'));

        showCart();

        }
    else {
        $('.main-cart').html('Корзина пуста!');
    }
}

function showCart() {
    //вывод корзины
    if (!isEmpty(cart)) {
        $('.main-cart').html('Корзина пуста!');
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
             	var itog = 0;
		var sum = 0;
		document.cookie = "price="+sum;
        var discounts = document.cookie;
		var discounts = discounts.split('').reverse().join('') ;// сделал реверс
		var discounts = discounts.split('d')[0];//удалил с помощью split всё что шло после ;            	
		discounts = discounts.split('').reverse().join('') ;// сделал реверс
		var discounts = discounts.split(';')[0];//удалил с помощью split всё что шло после ;
		var discounts = discounts.replace(/[^0-9]/g, '');// удалил все буквы
            for (var id in cart) {
                out += `<div class="cart-position">`;
                out += `<div>`;
                out += `<button data-id="${id}" title="Удалить" class="del-goods"><img src="img/Delete.png" width="20px" height="20px" alt="Удалить" title="Удалить"></button>`;
                out += ` ${goods[id].name  }`;
                out += `</div>`;
                out += `<div>`;
                out += `  <button data-id="${id}" title="Уменьшить" class="minus-goods"><img src="img/Minus.png" width="20px" height="20px" alt="Уменьшить" title="Уменьшить"></button>  `;
                out +=  ' Количество ' + ` ${cart[id]}`;
                out += `  <button data-id="${id}" title="Увеличить" class="plus-goods"><img src="img/Plus.png" width="20px" height="20px" alt="Увеличить" title="Увеличить"></button>  `;
                out += `</div>`;
                out += cart[id]*goods[id].cost + ' Рублей';
                itog += cart[id]*goods[id].cost;
                out += '<br>';
                out += `</div>`;
                
            }
            if(itog >= 1000){
                if(discounts == 0){
                    sum = itog
                    out += 'Общая стоимость заказа: '+sum+' Рублей';
                    document.cookie = "price="+sum;
                }
                else{
                    sum= itog - discounts;
                    out += 'Общая стоимость заказа c учётом скидки: '+sum+' Рублей';
                    document.cookie = "price="+sum;
                }
            }
            else{
                sum = itog;
                out += 'Общая стоимость заказа: '+sum+' Рублей';
                document.cookie = "price="+sum;
            }
	
            
            $('.main-cart').html(out);
            $('.del-goods').on('click', delGoods);
            $('.plus-goods').on('click', plusGoods);
            $('.minus-goods').on('click', minusGoods);
  });
    }
}



function delGoods() {
    //удаляем товар из корзины
    var id = $(this).attr('data-id');
    delete cart[id];
    saveCart();
    showCart();
}
function plusGoods() {
    //добавляет товар в корзине
    var id = $(this).attr('data-id');
    cart[id]++;
    saveCart();
    showCart();
}
function minusGoods() {
    //уменьшаем товар в корзине
    var id = $(this).attr('data-id');
    if (cart[id]==1) {
        delete cart[id];
    }
    else {
        cart[id]--;
    }
    saveCart();
    showCart();
}

function saveCart() {
    //сохраняю корзину в localStorage
    localStorage.setItem('cart', JSON.stringify(cart)); //корзину в строку
}

function isEmpty(object) {
    //проверка корзины на пустоту
    for (var key in object)
    if (object.hasOwnProperty(key)) return true;
    return false;
}

function sendEmail() {
    var ename = $('#ename').val();
    var email = $('#email').val();
    var ephone = $('#ephone').val();
    var eadres = $('#eadres').val();
    if (ename!='' && email!='' && ephone!='' && eadres !='') {
        if (isEmpty(cart)) {
            $.post(
                "core/mail.php",
                {
                    "ename" : ename,
                    "email" : email,
                    "ephone" : ephone,
		    "eadres" : eadres,
                    "cart" : cart
                },
                function(data){
                    if (data==1) {
                        swal('Заказ отправлен');
						
						setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
			saveToDbOrder();
                    }
                    else {
                        swal('Повторите заказ');
						
						setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
                    }
                }
            );
            
        }
        else {
            swal('Корзина пуста');
			
			setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
        }
    }
    else {
        swal('Заполните поля');
		
		setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
    }


}
 

function saveToDbOrder() {
	 var cart = ('Индификатор товара и его количество' + localStorage.cart);
   	 var price = document.cookie;
   	 var price = price.split('').reverse().join('') ;// сделал реверс
   	 var price = price.split(';')[0];//удалил с помощью split всё что шло после ; и ниже удалил все буквы
   	 var price = price.replace(/[^0-9]/g, '');// удалил все буквы
  	 var price = price.split('').reverse().join('') ;// сделал обратный реверс

	$.post(
                "admin/core.php",
                {
                "action" : "newOrder",
                "ename" : $('#ename').val(),
                "email" : $('#email').val(),
                "ephone" : $('#ephone').val(),
		"eadres" : $('#eadres').val(),
                "cart" : cart,
                "price" : price
                },
	);
}




$(document).ready(function () {
   loadCart();
   $('.send-email').on('click', sendEmail); // отправить письмо с заказом
});
