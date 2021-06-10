function initUser() {
    $.post(
        "core.php",
        {
            "action" : "initUser"
        },
        showUser
    );
  }

  function initUserMess() {
    $.post(
        "core.php",
        {
            "action" : "initUserMess"
        },
        showUserMess
    );
  }

  function initUserOrder() {
    $.post(
        "core.php",
        {
            "action" : "initUserOrder"
        },
        showUserOrder
    );
  }

  function showUser(data) {
    data = JSON.parse(data);
    console.log(data);
    var out='<select>';
    out +='<option data-id="0">Изменение пользователей</option>';
    for (var id in data) {
        out +=`<option data-id="${id}">${data[id].login}</option>`;
    }
    out +='</select>';
    $('.out').html(out);
    $('.out select').on('change', selectUser);
  
  }

  function showUserMess(data) {
    data = JSON.parse(data);
    console.log(data);
    var ou='<select>';
    ou +='<option data-id="0">Отзывы пользователей</option>';
    for (var id in data) {
      ou +=`<option data-id="${id}">${data[id].name} оставил отзыв на товаре № ${data[id].sort}</option>`;
    }
    ou +='</select>';
    $('.ou').html(ou);
    $('.ou select').on('change', selectUserMess);
  
  }

  function showUserOrder(data) {
    data = JSON.parse(data);
    console.log(data);
    var ot='<select>';
    ot +='<option data-id="0">Заказы пользователей</option>';
    for (var id in data) {
      ot +=`<option data-id="${id}">${data[id].name} : ${data[id].phone}</option>`;
    }
    ot +='</select>';
    $('.ot').html(ot);
    $('.ot select').on('change', selectUserOrder);
  
  }

  function selectUser() {
    //Получаем того пользователя который выбран
    var id = $('.out select option:selected').attr('data-id');
    console.log(id);
    $.post(
      "core.php",
      {
        "action" : "selectOneUser",
        "gidUser" : id
      },
      function(data){
  
        data = JSON.parse(data);
          $('#loginUser').val(data.login);
          $('#emailUser').val(data.email);
          $('#discountsUser').val(data.discounts);
          $('#gidUser').val(data.id);
      }
    );
  }

  function selectUserMess() {
    //Получаем того пользователя который выбран
    var id = $('.ou select option:selected').attr('data-id');
    console.log(id);
    $.post(
      "core.php",
      {
        "action" : "selectOneUserMess",
        "gidUserMess" : id
      },
      function(data){
  
        data = JSON.parse(data);
          $('#MessUser').val(data.message);
          $('#gidUserMess').val(data.id);
      }
    );
  }

  function selectUserOrder() {
    //Получаем заказ того пользователя который выбран
    var id = $('.ot select option:selected').attr('data-id');
    console.log(id);
    $.post(
      "core.php",
      {
        "action" : "selectOneUserOrder",
        "gidUserOrder" : id
      },
      function(data){
  
        data = JSON.parse(data);
          $('#OrderUser').val(data.name);
          $('#OrderEmail').val(data.email);
	  $('#Adres').val(data.adres);
          $('#Orders').val(data.product);
          $('#OrderCost').val(data.price);
          $('#gidUserOrder').val(data.id);
          $('#filterOrder').val(data.status);
          $('#dataOrder').val(data.date_at);
      }
    );
  }

  function saveToDbUser() {
    //обновление, передача данных на сервер
    var id = $('#gidUser').val();
    if (id!==""){
      $.post(
        "core.php",
        {
          "action" : "updateUser",
          "id" : id,
          "loginUser" : $('#loginUser').val(),
          "emailUser" : $('#emailUser').val(),
          "discountsUser" : $('#discountsUser').val(),
        },
        function(data){
            swal('Пользователь изменен');
			
			setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
            initUser();
          }
  
      );
      } 
      else {
        swal('Выберите пользователя');
		
		setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
      }
  }

  function saveToDbOrder() {
    //обновление, передача данных на сервер
    var id = $('#gidUserOrder').val();
    if (id!==""){
      $.post(
        "core.php",
        {
          "action" : "updateUserOrder",
          "id" : id,
           "OrderUser" : $('#OrderUser').val(),
          "OrderEmail" : $('#OrderEmail').val(),
	  "Adres" : $('#Adres').val(),
          "Orders" : $('#Orders').val(),
          "OrderCost" : $('#OrderCost').val(),
          "filterOrder" : $('#filterOrder').val(),
          "dataOrder" : $('#dataOrder').val(),
        },
        function(data){
            swal('Заказ изменен');
			
			setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
            initUserOrder();
          }
  
      );
      } 
      else {
        swal('Выберите пользователя');
		
		setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
      }
  }

  function delitUser() {
    //обновление, передача данных на сервер
    var id = $('#gidUser').val();
    if (id!==""){
      $.post(
        "core.php",
        {
          "action" : "delUser",
          "id" : id,
          "loginUser" : $('#loginUser').val(),
          "emailUser" : $('#emailUser').val(),
          "discountsUser" : $('#discountsUser').val(),
        },
        function(data){
            swal('Пользователь удален');
			
			setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
            //setTimeout(function(){ location.reload() }, 500)
            initUser();
            document.getElementById("loginUser").value = "";
            document.getElementById("emailUser").value = "";
            document.getElementById("discountsUser").value = "";
          }
      );
    }
      else {
        swal('Выберите пользователя');
		
		setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
      }
  }

  function delitUserMess() {
    //обновление, передача данных на сервер
    var id = $('#gidUserMess').val();
    if (id!==""){
      $.post(
        "core.php",
        {
          "action" : "delUserMess",
          "id" : id,
          "MessUser" : $('#MessUser').val(),
        },
        function(data){
            swal('Отзыв удален');
			
			setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
           // setTimeout(function(){ location.reload() }, 500)
           initUserMess();
           document.getElementById("MessUser").value = "";
          }
      );
    }
      else {
        swal('Выберите пользователя');
		
		setTimeout(function(){
        $('.confirm').click();
    }, 1500);
      }
  }

  function delitUserOrder() {
    //обновление, передача данных на сервер
    var id = $('#gidUserOrder').val();
    if (id!==""){
      $.post(
        "core.php",
        {

          "action" : "delUserOrder",
          "id" : id,
          "OrderUser" : $('#OrderUser').val(),
          "OrderEmail" : $('#OrderEmail').val(),
	  "Adres" : $('#Adres').val(),
          "Orders" : $('#Orders').val(),
          "OrderCost" : $('#OrderCost').val(),
          "filterOrder" : $('#filterOrder').val(),
          "dataOrder" : $('#dataOrder').val(),
          
        },
        function(data){
            swal('Заказ удален');
			
			setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
           // setTimeout(function(){ location.reload() }, 500)
           initUserOrder();
           document.getElementById("OrderUser").value = "";
           document.getElementById("OrderEmail").value = "";
	   document.getElementById("Adres").value = "";
           document.getElementById("Orders").value = "";
           document.getElementById("OrderCost").value = "";
           document.getElementById("filterOrder").value = "";
           document.getElementById("dataOrder").value = "";
          }
      );
    }
      else {
        swal('Выберите заказ');
		
		setTimeout(function(){
        $('.confirm').click();
    }, 1500);
      }
  }

  $(document).ready(function () {
    initUser();
    initUserMess();
    initUserOrder();
    $('.add-to-dbUser').on('click', saveToDbUser);
    $('.add-to-dbOrder').on('click', saveToDbOrder);
    $('.del-to-dbUser').on('click', delitUser);
    $('.del-to-dbUserMess').on('click', delitUserMess);
    $('.del-to-dbUserOrder').on('click', delitUserOrder);
    //Вызов события
 });