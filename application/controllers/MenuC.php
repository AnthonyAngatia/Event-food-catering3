<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class MenuC extends CI_Controller {

        public function index(){
            //Loading model, storing data it returns, loading view with data 
            $this->load->model("menuM");
            $data["menuItems"] = $this->menuM->returnMenuItems();
            //$this->load->view("NavBar2", $data);
            $this->load->view("menuV", $data);
            
        }

        public function saveMenuData(){
            //echo("Harry");
            //Loading model, storing data it returns
            $this->load->model("menuM");
            $menuItems = $this->menuM->returnMenuItems();
            

            //Checking whether "Add to Cart submit button has been clicked"
            if($this->input->post("Add_to_Cart")){
                
                // //Getting post data
                // $postData = $this->input->post();
                // //print_r($postData);

                //Inserting checked food items into db
                foreach ($menuItems as $row){
                    //Check whether the checkboxes were selected
                    if($this->input->post($row["foodName"]) !== null){
                        $this->menuM->saveFoodsPicked($row["foodName"]);
                    }
                }
                redirect("http://localhost/Event-food-catering3/index.php/CartC");


            }
            
            if($this->input->post("Select")){
                
                // //Getting post data
                // $postData = $this->input->post();
                // //print_r($postData);

                //Inserting checked food items into db
                foreach ($menuItems as $row){
                    //Check whether the checkboxes were selected
                    if($this->input->post($row["foodName"]) !== null){
                        $this->menuM->saveFoodsPicked($row["foodName"]);
                    }
                }
                redirect("http://localhost/Event-food-catering3/index.php/CartC");


            }


            //echo("Mithika");
        }
            
    }
        

        /*
        function displayMenuItems(){
            $this->load->model("menuM");
            $data["menuItems"] = $this->load->menuM->returnMenuItems();
            $this->load->view("menuV", $data);
        }
        */

    

?>