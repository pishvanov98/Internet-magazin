<?php
$action = $_POST['action'];

require_once 'function.php';

switch ($action) {
    case 'init':
        init();
        break;
    case 'initUser':
        initUser();
        break;
    case 'initUserMess':
        initUserMess();
        break;
    case 'initUserOrder':
        initUserOrder();
        break;
    case "selectOneGoods":
        selectOneGoods();
        break;
    case "selectOneUser":
        selectOneUser();
        break;
    case "selectOneUserMess":
        selectOneUserMess();
        break;
    case "selectOneUserOrder":
        selectOneUserOrder();
        break;
    case 'updateGoods':
        updateGoods();
        break;
    case 'updateUser':
        updateUser();
        break;
    case 'updateUserOrder':
        updateUserOrder();
        break;
    case 'newGoods':
        newGoods();
        break;
    case 'newOrder':
        newOrder();
        break;
    case 'loadGoods':
        loadGoods();
        break;
    case 'loadGoods_costa':
        loadGoods_costa();
        break;
    case 'loadGoods_costb':
        loadGoods_costb();
        break;
    case 'loadGoods_namea':
        loadGoods_namea();
        break;
    case 'loadGoods_nameb':
        loadGoods_nameb();
        break;
	case 'loadGoodsAll':
        loadGoodsAll();
        break;
    case 'loadGoodsKom_ras':
        loadGoodsKom_ras();
        break;
    case 'loadGoodsPalm':
        loadGoodsPalm();
        break;
    case 'loadGoodsWood':
        loadGoodsWood();
        break;
    case 'loadSingleGoods':
        loadSingleGoods();
        break;
    case 'delGoods':
        delGoods();
        break;
    case 'delUser':
        delUser();
        break;
    case 'delUserMess':
        delUserMess();
        break;
    case 'delUserOrder':
        delUserOrder();
        break;
}
?>
