<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard | Chiltepin Restaurant </title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- admin dashboard section starts  -->

   <section class="dashboard">

      <h1 class="heading">Dashboard - Chiltepín Restaurant</h1>

      <div class="box-container">

         <div class="box">
            <h3>¡Bienvenido!</h3>
            <p>
               <?= $fetch_profile['name']; ?>
            </p>
            <a href="update_profile.php" class="btn">Actualizar perfil</a>
         </div>

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pendiente']);
            while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
               $total_pendings += $fetch_pendings['total_price'];
            }
            ?>
            <h3><span>$</span>
               <?= $total_pendings; ?><span>/-</span>
            </h3>
            <p>Pendientes totales</p>
            <a href="placed_orders.php" class="btn">Ver pedidos</a>
         </div>

         <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completado']);
            while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
               $total_completes += $fetch_completes['total_price'];
            }
            ?>
            <h3><span>$</span>
               <?= $total_completes; ?><span>/-</span>
            </h3>
            <p>Completados totales</p>
            <a href="placed_orders.php" class="btn">Ver pedidos</a>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $numbers_of_orders = $select_orders->rowCount();
            ?>
            <h3>
               <?= $numbers_of_orders; ?>
            </h3>
            <p>Pedidos totales</p>
            <a href="placed_orders.php" class="btn">Ver pedidos</a>
         </div>

         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $numbers_of_products = $select_products->rowCount();
            ?>
            <h3>
               <?= $numbers_of_products; ?>
            </h3>
            <p>Productos añadidos</p>
            <a href="products.php" class="btn">Ver productos</a>
         </div>

         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $numbers_of_users = $select_users->rowCount();
            ?>
            <h3>
               <?= $numbers_of_users; ?>
            </h3>
            <p>Cuentas de usuarios</p>
            <a href="users_accounts.php" class="btn">Ver usuarios</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admin`");
            $select_admins->execute();
            $numbers_of_admins = $select_admins->rowCount();
            ?>
            <h3>
               <?= $numbers_of_admins; ?>
            </h3>
            <p>Admins</p>
            <a href="admin_accounts.php" class="btn">Ver admins</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $numbers_of_messages = $select_messages->rowCount();
            ?>
            <h3>
               <?= $numbers_of_messages; ?>
            </h3>
            <p>Mensajes nuevos</p>
            <a href="messages.php" class="btn">Ver mensajes</a>
         </div>

      </div>

   </section>

   <!-- admin dashboard section ends -->









   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>