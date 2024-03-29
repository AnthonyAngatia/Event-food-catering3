<!DOCTYPE html>
<html>
<head>
  <title> MENU</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;s
      padding: 0px;
    }

    h1 {
      text-align: center;
    }

    header {
      display: flex;
      justify-content: flex-end;

    }

    .logo {
      height: 60px;
      width: 60px;
      border: 1px solid tomato;
      margin-right: auto;
      padding: 5px;

    }

    .header h1 {
      font-family: cursive;
      margin-right: auto;
      padding: 5px;

    }

    .Sign-up button {
      border: 1px solid #003366;
      color: #003366;
      padding: 7px;
      border-radius: 50px;
      cursor: pointer;
      background-color: white;
    }

    a {
      padding: 15px;
    }

    .nav {

      display: flex;
      justify-content: space-evenly;
      background-color: #003366;
    }

    button {
      border: 1px solid aliceblue;
      border-radius: 50px;
      background-color: #003366;
      padding: 7px;
      color: white;
      cursor: pointer;
    }

    button:hover {
      color: powderblue;
    }
    .h3
    {
      text-align: center;
    }

  </style>
</head>
<body>

   <header class="header">
      <img class= "logo" src ="<?php echo base_url('Assets/logo.jpg'); ?>" />
    <h1>Taste of Africa</h1>
    <a class="login" href="#" onclick="window.location.replace('users/login');"><button>Login</button></a>

    <a class="Sign-up" href="#" onclick="window.location.replace('users/registration');"><button>Sign up</button></a>
  </header>

  <div class="nav">
    <a class="Category" href=""><button>Category</button></a>
    <a class="Order" href=""><button>Order</button></a>
    <a class="Cart" href=""><button>Cart</button></a>
    <a class="About us" href=""><button>About us</button></a>
  </div>
<br>
<br>
<br>
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Show Entries
  </a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">1</a>
    <a class="dropdown-item" href="#">5</a>
    <a class="dropdown-item" href="#">10</a>
  </div>
</div>
<br>
<br>
     
      <p class="h3">TASTE OF AFRICA MENU</p>
<br>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Food ID</th>
      <th scope="col">Food Price</th>
      <th scope="col">Food Image</th>
      <th scope="col">Food Type</th>
      <th scope="col">Food Duration</th>
      <th scope="col">Food Name</th>

 
    </tr>
  </thead>
  <tbody> 
    <?php   
    $fetch_data = $this-> Menu_model ->fetch_data();
    if($fetch_data->num_rows() > 0)
  {
    foreach($fetch_data -> result() as $row)
    {
  ?>
      <tr>
        <td><?php echo $row -> foodID;?> </td>
        <td> <?php echo $row -> foodPrice; ?> </td>
       
        <td><img src = "<?php echo base_url();?>uploads/<?php echo $row ->foodImage;?>" style = "width :100px; height: 100px;"></td>
        <td> <?php echo $row -> foodType; ?> </td>
        <td> <?php echo $row -> foodDuration; ?> </td>
        <td> <?php echo $row -> foodName; ?> </td>

            </tr>

      <?php

    }
  } 
  else
  {
  ?>
    <tr>
         <td colspan = "3"> No data was entered </td>
     </tr>
     <?php
  

  
  }
  ?>  


    
  
  </tbody>
</table>

<a onclick ="window.location.replace('Ahomepage')" ><button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Edit The Menu </button></a>

<a onclick ="window.location.replace('Admin')" ><button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Add Food To Menu </button></a>


</body>
</html>