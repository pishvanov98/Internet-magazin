function init() {
    $.post(
        "core.php",
        {
            "action" : "init"
        },
        showGoods
    );
}

function showGoods(data) {
    data = JSON.parse(data);
    console.log(data);
    var out='<select>';
    out +='<option data-id="0">Добавление нового товара</option>';
    for (var id in data) {
        out +=`<option data-id="${id}">${data[id].name} : Индификатор ${data[id].id}</option>`;
    }
    out +='</select>';
    $('.out').html(out);
    $('.out select').on('change', selectGoods);

}



function selectGoods() {
  //Получаем тот товар который выбран
  var id = $('.out select option:selected').attr('data-id');
  console.log(id);
  $.post(
    "core.php",
    {
      "action" : "selectOneGoods",
      "gid" : id
    },
    function(data){

      data = JSON.parse(data);
        $('#gname').val(data.name);
        $('#gcost').val(data.cost);
        $('#gfilter').val(data.filter);
        $('#gdescr').val(data.description);
        $('#gdescrtwo').val(data.descriptiontwo);
        $('#gimg').val(data.img);
        $('#gid').val(data.id);
    }
  );
}

function saveToDb() {
  //обновление, передача данных на сервер
  var id = $('#gid').val();
  if (id!==""){
    $.post(
      "core.php",
      {
        "action" : "updateGoods",
        "id" : id,
        "gname" : $('#gname').val(),
        "gcost" : $('#gcost').val(),
        "gfilter" : $('#gfilter').val(),
        "gdescr" : $('#gdescr').val(),
        "gdescrtwo" : $('#gdescrtwo').val(),
        "gimg" : $('#gimg').val()
      },
      function(data){
          swal('Товар изменен');
		  
		  setTimeout(function(){
        $('.confirm').click();
    }, 1500);
			  setTimeout(function(){
        window.location.reload();
          init();
    }, 500);

		 
        }

    );
  }
  else {
    $.post(
      "core.php",
      {
        "action" : "newGoods",
        "id" : 0,
        "gname" : $('#gname').val(),
        "gcost" : $('#gcost').val(),
        "gfilter" : $('#gfilter').val(),
        "gdescr" : $('#gdescr').val(),
        "gdescrtwo" : $('#gdescrtwo').val(),
        "gimg" : $('#gimg').val()
      },
      function(data){
          swal('Товар добавлен');
		  
		  setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
			  setTimeout(function(){
        window.location.reload();
          init();
    }, 500);
        }
    );
  }
}

function delitGoods() {
  //обновление, передача данных на сервер
  var id = $('#gid').val();
  if (id!==""){
    $.post(
      "core.php",
      {
        "action" : "delGoods",
        "id" : id,
        "gname" : $('#gname').val(),
        "gcost" : $('#gcost').val(),
        "gfilter" : $('#gfilter').val(),
        "gdescr" : $('#gdescr').val(),
        "gdescrtwo" : $('#gdescrtwo').val(),
        "gimg" : $('#gimg').val()
      },
      function(data){
          swal('Товар удален');
		  
		  setTimeout(function(){
        $('.confirm').click();
    }, 1500);
	
 			  setTimeout(function(){
        window.location.reload();
          init();
    }, 500);
        }
    );
  }
    else {
      swal('Выберите товар');
	  
	  setTimeout(function(){
        $('.confirm').click();
    }, 1500);
    }
}

$(document).ready(function () {
   init();
   $('.add-to-db').on('click', saveToDb);
   $('.del-to-db').on('click', delitGoods);
   //Вызов события
});
