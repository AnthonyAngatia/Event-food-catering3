<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->library('session');
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Taste of Africa</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:300&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0px;
            font-family: 'Montserrat', sans-serif;
            color: #333333;
        }

        header {
            display: flex;
            justify-content: flex-end;


        }

        header a {
            margin-top: -10px;
            margin-right: auto;
        }

        .logo {
            height: 60px;
            width: 60px;

        }

        .header h1 {
            margin-right: auto;
            margin-top: 15px;
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

        .nav button {
            border: 1px solid aliceblue;
            border-radius: 20px;
            background-color: #003366;
            padding: 7px;
            color: white;
            cursor: pointer;
        }

        .nav button:hover {
            color: white;
            border-color: #5a6268;
            border: 2px solid white;
        }
        #session-data{
            cursor: pointer;
        }
        .btn-primary{
            background-color: #003366;
       color: white; 
       text-align: center; 
       padding: 5px 5px; 
       border: none; 
       height: 40px; 
       min-width: 90px;
        }
        .btn-primary:hover{
        cursor:pointer;
      border-radius:10px;
      
      font-size:11pt;
        }

        .form-group button {
            border: 1px solid aliceblue;
            border-radius: 10px;
            background-color: #6c757d;
            padding: 7px;
            color: white;
            cursor: pointer;
        }

        .form-group button:hover {
            color: white;
            border-color: #5a6268;
        }


        /*  @media (min-width: 768px) */





        footer {
            margin-top: 1em;
            background-color: #003366;
            color: white;
            text-align: center;
            font-size: 24px;
        }

        .form-group {
            font-family: "Source Sans Pro", sans-serif;
            font-size: 28px;
            border: 2px solid black;
            margin: 2em 15em;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            min-width: 300px;
        }

        .form-group label,
        input,
        button {
            padding: 5px;
        }

        .form-group>* {
            padding: 1px;
            margin: 5px 0px;

        }

        .food-types-wrapper {
            display: flex;
            border: 2px solid grey;
            justify-content: space-around;
            display: none;
            margin: 5em 1em;

        }

        .food_types {
            min-width: 150px;
            /* border: 1px solid; */
            margin: 2em;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form action="http://localhost/Event-food-catering3/index.php/Users/putting_data2" method="post">

            <div class="form-group" id="form-group">
                <?php ;?>
                <input type="hidden" name="id" value="<?php  print_r($userID);  ?>">
                <label>Number of Attendees</label>
                <input type="number" name="No_of_people" id="No_of_people" value="9" min="9" style="font-size:18pt;height:42px;width:250px;" onkeypress="false" />
                <button type="button" onclick="openMenu();" id="menu-btn" style="font-size:18pt;height:42px;width:250px;">
                     Menu
                </button>
                <script>
                    function openMenu() {
                        const menu = (document.querySelector(".food-types-wrapper").style.display = "flex");
                        document.getElementById('form-group').style.display = "none";


                    }

                    function closeMenu() {
                        const menu = (document.querySelector(".food-types-wrapper").style.display = "none");
                        document.getElementById('form-group').style.display = "flex";
                    }
                </script>


                <label>Location</label>
                <input onclick="closeMenu();" type="textfield" class="form-control" name="Location" placeholder="location" style="font-size:18pt;height:42px;width:250px;" />
                <label>Start Time</label>
                <input type="time" class="form-control" name="Start_time" style="font-size:18pt;height:42px;width:250px;" />
                <label>End Time</label>
                <input type="time" class="form-control" name="End_time" style="font-size:18pt;height:42px;width:250px;" />
                <label onclick = "getValueOfItems();">Description</label>
                <input type="textfield" class="form-control" name="Description" placeholder="describe your event here" style="font-size:18pt;height:42px;width:250px;" />
                <button type="button" onclick = "sumTotal();"  style="font-size:18pt; height:42px; width:250px;">
                    Check Price
                </button>
                <input type="submit" class="btn-primary" name="caterSubmit" value="SUBMIT" onclick = "getValueOfItems();"/>
                <input type="hidden" name="price" id="Price" value = "1" >
            </div>

    </div>

    <div class="food-types-wrapper">
        <div class="food_types">
            <h3>Carbohydrates</h3>
            <input type="checkbox" name="Carbohydrates[]" value="Rice" id="carb1" data-value="100" />
            Rice<br />
            <input type="checkbox" name="Carbohydrates[]" value="Potatoes" id="carb2" data-value="200" />
            Potatoes<br />
            <input type="checkbox" name="Carbohydrates[]" value="Ugali" id="carb3" data-value="300" />
            Ugali<br />
            <input type="checkbox" name="Carbohydrates[]" value="Spaghetti" id="carb4" data-value="400" />
            Spaghetti<br />
            <input type="checkbox" name="Carbohydrates[]" value="Chips" id="carb5" data-value="500" />
            Chips<br />
        </div>
        <script>
            const value = document.getElementById('carb1').getAttribute('data-value');
            // alert(value);
        </script>

        <div class="food_types">
            <h3>Proteins</h3>
            <input type="checkbox" name="Proteins[]" value="Beef" id="prot1" data-value="100" />
            Beef<br />
            <input type="checkbox" name="Proteins[]" value="Pork" id="prot2" data-value="200" />
            Pork<br />
            <input type="checkbox" name="Proteins[]" value="Chicken" id="prot3" data-value="300" />
            Chicken<br />
            <input type="checkbox" name="Proteins[]" value="Fish" id="prot4" data-value="400" />
            Fish<br />
            <input type="checkbox" name="Proteins[]" value="Meat Ball" id="prot5" data-value="500" />
            Meat Ball<br />
        </div>

        <div class="food_types">
            <h3>Salad</h3>
            <input type="checkbox" name="Salads[]" value="Fruit salad" id="salad1" data-value="100" />
            Salad 1<br />
            <input type="checkbox" name="Salads[]" value="Veg salad" id="salad2" data-value="200" />
            Salad 2<br />
            <input type="checkbox" name="Salads[]" value="Kachumbari" id="salad3" data-value="300" />
            Salad 3<br />
            <input type="checkbox" name="Salads[]" value="200" id="salad4" data-value="400" />
            Salad 4<br />
            <input type="checkbox" name="Salads[]" value="200" id="salad5" data-value="500" />
            Salad 5<br />
        </div>
        <div class="food_types">
            <h3>Drinks</h3>
            <input type="checkbox" name="Drinks[]" value="Soda" id="drink1" data-value="100" />
            Soda<br />
            <input type="checkbox" name="Drinks[]" value="Beer" id="drink2" data-value="100" data-value="200" />
            Beer<br />
            <input type="checkbox" name="Drinks[]" value="Cocktail" id="drink3" data-value="300" />
            Cocktail<br />
            <input type="checkbox" name="Drinks[]" value="Wine" id="drink4" data-value="400" />
            Wine<br />
            <input type="checkbox" name="Drinks[]" value="Water" id="drink5" data-value="500" />
            Water<br />
        </div>
    
        </form>
        <a onclick="closeMenu();" style="display:unset; position:absolute; margin-top:9em; cursor:pointer;">Close</a>
    </div>
    <script>
        //!For now you cannot miss to pick a food item and submit
        function getCarbValue() {
            //TODO:One Carb
            var carb1 = document.getElementById('carb1');
            var carb1Value = '';
            if (carb1.checked) {
                carb1Value = parseInt(carb1.getAttribute('data-value'));
                //alert(carb1Value);

            } else {
                carb1Value = parseInt(0);
            }
            //TODO:END
            var carb2 = document.getElementById('carb2');
            var carb2Value = '';
            if (carb2.checked) {
                carb2Value = parseInt(carb2.getAttribute('data-value'));
                //  alert(carb2Value);
            } else {
                carb2Value = parseInt(0);
            }

            var carb3 = document.getElementById('carb3');
            var carb3Value = '';
            if (carb3.checked) {
                carb3Value = parseInt(carb3.getAttribute('data-value'));
            } else {
                carb3Value = parseInt(0);
            }

            var carb4 = document.getElementById('carb4');
            var carb4Value = '';
            if (carb4.checked) {
                carb4Value = parseInt(carb4.getAttribute('data-value'));
            } else {
                carb4Value = parseInt(0);
            }

            var carb5 = document.getElementById('carb5');
            var carb5Value = '';
            if (carb5.checked) {
                carb5Value = parseInt(carb5.getAttribute('data-value'));
            } else {
                carb5Value = parseInt(0);
            }

            var totalCarbPrice = parseInt(0);
            totalCarbPrice = parseInt(carb1Value + carb2Value + carb3Value + carb4Value + carb5Value);
            var totalCarbPrice = parseInt(totalCarbPrice);
            //  alert("Carbprice"+totalCarbPrice);
            return totalCarbPrice;
        }

        function getProtValue() {
            //TODO:One Prot
            var prot1 = document.getElementById('prot1');
            var prot1Value = '';
            if (prot1.checked) {
                prot1Value = parseInt(prot1.getAttribute('data-value'));
            } else {
                prot1Value = parseInt(0);
            }
            //TODO:END
            var prot2 = document.getElementById('prot2');
            var prot2Value = '';
            if (prot2.checked) {
                prot2Value = parseInt(prot2.getAttribute('data-value'));
            } else {
                prot2Value = parseInt(0);
            }

            var prot3 = document.getElementById('prot3');
            var prot3Value = '';
            if (prot3.checked) {
                prot3Value = parseInt(prot3.getAttribute('data-value'));
            } else {
                prot3Value = parseInt(0);
            }

            var prot4 = document.getElementById('prot4');
            var prot4Value = '';
            if (prot4.checked) {
                prot4Value = parseInt(prot4.getAttribute('data-value'));
            } else {
                prot4Value = parseInt(0);
            }

            var prot5 = document.getElementById('prot5');
            var prot5Value = '';
            if (prot5.checked) {
                prot5Value = parseInt(prot5.getAttribute('data-value'));
            } else {
                prot5Value = parseInt(0);
            }

            var totalProtPrice = parseInt(0);
            totalProtPrice = parseInt(prot1Value + prot2Value + prot3Value + prot4Value + prot5Value);
            var totalProtPrice = parseInt(totalProtPrice);
            // alert(totalProtPrice);
            return totalProtPrice;

        }

        function getSaladValue() {
            //TODO:One Salad
            var salad1 = document.getElementById('salad1');
            var saladValue = '';
            if (salad1.checked) {
                salad1Value = parseInt(salad1.getAttribute('data-value'));
            } else {
                salad1Value = parseInt(0);
            }
            //TODO:END
            var salad2 = document.getElementById('salad2');
            var salad2Value = '';
            if (salad2.checked) {
                salad2Value = parseInt(salad2.getAttribute('data-value'));
            } else {
                salad2Value = parseInt(0);
            }

            var salad3 = document.getElementById('salad3');
            var salad3Value = '';
            if (salad3.checked) {
                salad3Value = parseInt(salad3.getAttribute('data-value'));
            } else {
                salad3Value = parseInt(0);
            }

            var salad4 = document.getElementById('salad4');
            var salad4Value = '';
            if (salad4.checked) {
                salad4Value = parseInt(salad4.getAttribute('data-value'));
            } else {
                salad4Value = parseInt(0);
            }

            var salad5 = document.getElementById('salad5');
            var salad5Value = '';
            if (salad5.checked) {
                salad5Value = parseInt(salad5.getAttribute('data-value'));
            } else {
                salad5Value = parseInt(0);
            }

            var totalSaladPrice = parseInt(0);
            totalSaladPrice = parseInt(salad1Value + salad2Value + salad3Value + salad4Value + salad5Value);
            var totalSaladPrice = parseInt(totalSaladPrice);
            //alert(totalSaladPrice);
            return totalSaladPrice;
        }

        function getDrinkValue(){
            //TODO:One Drink
            var drink1 = document.getElementById('drink1');
            var drinkValue = '';
            if (drink1.checked) {
                drink1Value = parseInt(drink1.getAttribute('data-value'));
            } else {
                drink1Value = parseInt(0);
            }
            //TODO:END
            var drink2 = document.getElementById('drink2');
            var drink2Value = '';
            if (drink2.checked) {
                drink2Value = parseInt(drink2.getAttribute('data-value'));
            } else {
                drink2Value = parseInt(0);
            }

            var drink3 = document.getElementById('drink3');
            var drink3Value = '';
            if (drink3.checked) {
                drink3Value = parseInt(drink3.getAttribute('data-value'));
            } else {
                drink3Value = parseInt(0);
            }

            var drink4 = document.getElementById('drink4');
            var drink4Value = '';
            if (drink4.checked) {
                drink4Value = parseInt(drink4.getAttribute('data-value'));
            } else {
                drink4Value = parseInt(0);
            }

            var drink5 = document.getElementById('drink5');
            var drink5Value = '';
            if (drink5.checked) {
                drink5Value = parseInt(drink5.getAttribute('data-value'));
            } else {
                drink5Value = parseInt(0);
            }

            var totalDrinkPrice = parseInt(0);
            totalDrinkPrice = parseInt(drink1Value + drink2Value + drink3Value + drink4Value + drink5Value);
            var totalDrinkPrice = parseInt(totalDrinkPrice);
            //alert(totalDrinkPrice);
            return totalDrinkPrice;
        }

        function sumTotal() {
            var people = document.getElementById('No_of_people').value;
            var sumTotalPrice = getCarbValue() + getProtValue() + getSaladValue() + getDrinkValue();
            var sumTotalPrice = parseInt(sumTotalPrice) * people;
            alert("Total Price "+sumTotalPrice);
            return parseInt(sumTotalPrice);
        }
        function getValueOfItems(){
            // alert('xdfcgbh');
            var price = document.getElementById('Price');
            price.value = sumTotal();
            alert(document.getElementById('Price').value);
        }
    </script>
</body>

</html>