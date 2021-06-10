<?php
$servername = "localhost";

$username = "host1828673";

$password = "RpC29dOecz";

$dbname = "host1828673";

function connect(){
    $conn = mysqli_connect("localhost", "host1828673", "RpC29dOecz", "host1828673");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
  mysqli_set_charset($conn, "utf8");
    return $conn;
}

function init(){
    //вывожу список товаров
    $conn = connect();
    $sql = "SELECT id, name FROM goods";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
}

function initUser(){
    //вывожу список пользователей
    $conn = connect();
    $sql = "SELECT id, login FROM users";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
}

function initUserMess(){
    //вывожу список пользователей
    $conn = connect();
    $sql = "SELECT id, name, sort FROM shoutbox";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
}

function initUserOrder(){
    //вывожу список пользователей
    $conn = connect();
    $sql = "SELECT id, phone, name, adres FROM orders";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
}

function selectOneGoods(){
  $conn = connect();
  $id = $_POST['gid'];
  $sql = "SELECT * FROM goods WHERE id='$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      echo json_encode($row);
  } else {
      echo "0";
  }
  mysqli_close($conn);
}

function selectOneUser(){
    $conn = connect();
    $id = $_POST['gidUser'];
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
  
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo "0";
    }
    mysqli_close($conn);
  }

  function selectOneUserMess(){
    $conn = connect();
    $id = $_POST['gidUserMess'];
    $sql = "SELECT * FROM shoutbox WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
  
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo "0";
    }
    mysqli_close($conn);
  }

  function selectOneUserOrder(){
    $conn = connect();
    $id = $_POST['gidUserOrder'];
    $sql = "SELECT * FROM orders WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
  
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo "0";
    }
    mysqli_close($conn);
  }
  

function updateGoods(){
    $conn = connect();
      $id = $_POST['id'];
      $name = $_POST['gname'];
      $cost = $_POST['gcost'];
      $filter = $_POST['gfilter'];
      $descr = $_POST['gdescr'];
      $descrtwo = $_POST['gdescrtwo'];
      $img = $_POST['gimg'];

      $sql = "UPDATE goods SET name = '$name', cost = '$cost', filter = '$filter', description = '$descr', descriptiontwo = '$descrtwo', img = '$img' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "1";
} else {
    echo "Error updating record: " . $conn->error;
}
    mysqli_close($conn);
    
}

function updateUser(){
    $conn = connect();
      $id = $_POST['id'];
      $login = $_POST['loginUser'];
      $email = $_POST['emailUser'];
      $discounts = $_POST['discountsUser'];
      $sql = "UPDATE users SET login = '$login', email = '$email', discounts = '$discounts' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "1";
} else {
    echo "Error updating record: " . $conn->error;
}
    mysqli_close($conn);
   
}

function updateUserOrder(){
    $conn = connect();
      $id = $_POST['id'];
      $name = $_POST['OrderUser'];
      $email = $_POST['OrderEmail'];
      $adres = $_POST['Adres'];
      $product = $_POST['Orders'];
      $price = $_POST['OrderCost'];
      $status = $_POST['filterOrder'];
      $date_at = $_POST['dataOrder'];

      $sql = "UPDATE orders SET name = '$name', email = '$email', adres = '$adres', product = '$product', price = '$price', status = '$status', date_at = '$date_at' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "1";
} else {
    echo "Error updating record: " . $conn->error;
}
    mysqli_close($conn);
   
}


function newGoods(){
    $conn = connect();
      $name = $_POST['gname'];
      $cost = $_POST['gcost'];
      $filter = $_POST['gfilter'];
      $descr = $_POST['gdescr'];
      $descrtwo = $_POST['gdescrtwo'];
      $img = $_POST['gimg'];

      $sql = "INSERT INTO goods(name, cost, filter, description, descriptiontwo, img)
  VALUES ('$name', '$cost', '$filter', '$descr', '$descrtwo', '$img')";

  if (mysqli_query($conn, $sql)) {
    echo "1";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
    mysqli_close($conn);
    
}

function newOrder(){
    $conn = connect();
      $name = $_POST['ename'];
      $email = $_POST['email'];
      $phone = $_POST['ephone'];
      $adres = $_POST['eadres'];
      $product = $_POST['cart'];
      $price = $_POST['price'];

      $sql = "INSERT INTO orders(name, email, phone, adres, product, price)
  VALUES ('$name', '$email', '$phone', '$adres', '$product', '$price')";
  echo $sql;

  if (mysqli_query($conn, $sql)) {
    echo "1";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
    mysqli_close($conn);
}


function loadGoods(){

    if ($_COOKIE['kategory'] == "Kom_ras"){
        loadGoodsKom_ras();
        
    }
    elseif ($_COOKIE['kategory'] == "Palm"){
        loadGoodsPalm();
        
    }
    elseif ($_COOKIE['kategory'] == "Wood"){
        loadGoodsWood();
        
    }
    elseif ($_COOKIE['kategory'] == "all"){
        loadGoodsAll();

    }
    else {

    $conn = connect();
    $sql = "SELECT * FROM goods ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);

    setcookie("kategory", "all",  time() + 3600, '/');
    }
}

function loadGoodsAll(){

    $conn = connect();
    $sql = "SELECT * FROM goods ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);

    setcookie("kategory", "all",  time() + 3600, '/');
}

function loadGoods_costa(){
    if ($_COOKIE['kategory'] == "Kom_ras"){
        $sort = 1;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "Palm"){
        $sort = 2;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }

    elseif ($_COOKIE['kategory'] == "Wood"){
        $sort = 3;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }

    elseif ($_COOKIE['kategory'] == "all"){
        $conn = connect();
            $sql = "SELECT * FROM goods ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }

  }

  function loadGoods_costb(){

    if ($_COOKIE['kategory'] == "Kom_ras"){
        $sort = 1;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
            $revers = array_reverse ($out);
        }
        echo json_encode($revers);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "Palm"){
        $sort = 2;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
            $revers = array_reverse ($out);
        }
        echo json_encode($revers);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }

    elseif ($_COOKIE['kategory'] == "Wood"){
        $sort = 3;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
            $revers = array_reverse ($out);
        }
        echo json_encode($revers);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }

    elseif ($_COOKIE['kategory'] == "all"){
        $conn = connect();
            $sql = "SELECT * FROM goods ";
            $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["cost"]] = $row;
            $revers = array_reverse ($out);
        }
        echo json_encode($revers);
    } else {
        echo "0";
    }
    mysqli_close($conn);
        
    }
  }

    function loadGoods_namea(){

    if ($_COOKIE['kategory'] == "Kom_ras"){
        $sort = 1;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ORDER BY name  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "Palm"){
        $sort = 2;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ORDER BY name  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "Wood"){
        $sort = 3;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ORDER BY name  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "all"){
        $conn = connect();
            $sql = "SELECT * FROM goods ORDER BY name  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
       }
    }

  function loadGoods_nameb(){
  
    if ($_COOKIE['kategory'] == "Kom_ras"){
        $sort = 1;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ORDER BY name DESC  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "Palm"){
        $sort = 2;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ORDER BY name DESC  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "Wood"){
        $sort = 3;
        $conn = connect();
            $sql = "SELECT * FROM goods WHERE filter = '$sort' ORDER BY name DESC  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
    elseif ($_COOKIE['kategory'] == "all"){
        $conn = connect();
            $sql = "SELECT * FROM goods ORDER BY name DESC  ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $out = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $out[$row["name"]] = $row;
                }
                echo json_encode($out);
            } else {
                echo "0";
            }
            mysqli_close($conn);
        
    }
  }

function loadGoodsKom_ras(){
  $conn = connect();
  $sql = "SELECT * FROM goods WHERE filter='1' ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $out = array();
      while($row = mysqli_fetch_assoc($result)) {
          $out[$row["id"]] = $row;
      }
      echo json_encode($out);
  } else {
      echo "0";
  }
  mysqli_close($conn);

  setcookie("kategory", "Kom_ras", time() + 3600, '/');
}

function loadGoodsPalm(){
  $conn = connect();
  $sql = "SELECT * FROM goods WHERE filter='2' ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $out = array();
      while($row = mysqli_fetch_assoc($result)) {
          $out[$row["id"]] = $row;
      }
      echo json_encode($out);
  } else {
      echo "0";
  }
  mysqli_close($conn);

  setcookie("kategory", "Palm", time() + 3600, '/');
}

function loadGoodsWood(){
  $conn = connect();
  $sql = "SELECT * FROM goods WHERE filter='3' ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $out = array();
      while($row = mysqli_fetch_assoc($result)) {
          $out[$row["id"]] = $row;
      }
      echo json_encode($out);
  } else {
      echo "0";
  }
  mysqli_close($conn);

  setcookie("kategory", "Wood",  time() + 3600, '/');
}


function loadSingleGoods () {
  $id = $_POST['id'];
  $conn = connect();
  $sql = "SELECT * FROM goods WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      echo json_encode($row);
  } else {
      echo "0";
  }
  mysqli_close($conn);
  }

  function delGoods(){
      $conn = connect();
        $id = $_POST['id'];
        $name = $_POST['gname'];
        $cost = $_POST['gcost'];
        $filter = $_POST['gfilter'];
        $descr = $_POST['gdescr'];
        $descrtwo = $_POST['gdescrtwo'];
        $img = $_POST['gimg'];

        $sql = "DELETE FROM goods WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
      echo "1";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
      mysqli_close($conn);
      
  }

  function delUser(){
    $conn = connect();
    $id = $_POST['id'];
    $login = $_POST['loginUser'];
    $email = $_POST['emailUser'];
    $discounts = $_POST['discountsUser'];

      $sql = "DELETE FROM users WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "1";
} else {
    echo "Error deleting record: " . $conn->error;
}
    mysqli_close($conn);
}

function delUserMess(){
    $conn = connect();
    $id = $_POST['id'];
    $message = $_POST['MessUser'];

      $sql = "DELETE FROM shoutbox WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "1";
} else {
    echo "Error deleting record: " . $conn->error;
}
    mysqli_close($conn);
}

function delUserOrder(){
    $conn = connect();
    $id = $_POST['id'];
    $message = $_POST['OrderUser'];
    $message = $_POST['OrderEmail'];
    $message = $_POST['Orders'];
    $message = $_POST['Orders'];
    $message = $_POST['OrderCost'];
    $message = $_POST['filterOrder'];
    $message = $_POST['dataOrder'];

      $sql = "DELETE FROM orders WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "1";
} else {
    echo "Error deleting record: " . $conn->error;
}
    mysqli_close($conn);
}