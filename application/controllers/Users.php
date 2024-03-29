<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');

        // Load form validation ibrary & user model 
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->library('session');
        // $this->load->payment();


        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    public function index()
    {
        if ($this->isUserLoggedIn) {
            redirect('users/account');
        } else {
            redirect('users/login');
        }
    }

    public function account()
    {
        $data = array();
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);

            // Pass the user data and load view

            //Getting menu items from db
            $this->load->model("menuM");
            $data["menuItems"] = $this->menuM->returnMenuItems();
            // $this->load->view('elements/header', $data);
            $this->load->view('Navbar2', $data);
            $this->load->view('users/account', $data);
            $this->load->view('elements/footer');
        } else {
            // $this->load->view('Navbar1');
            redirect('users/login');
        }
    }

    public function cater()
    {
        $data = array();
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);

            $this->load->model("orderM");   
            // Pass the user data and load view 
            $this->load->view('NavBar2', $data);
            //$this->load->view('elements/header', $data);
            $data["userID"] = $con['id'];
            //echo $con['id'];
            $this->load->view('users/CateringV', $data);
            $this->load->view('elements/footer');
        } else {
            redirect('users/login');
        }
        /*!Inserting to DB*/
        // putting_data();
    }
    public function putting_data2()
    {
        //?Load the model class
        $this->load->model("Catering_model");
        $data = array(
            "No_of_people" => $this->input->post("No_of_people"),
            "Carbohydrate" => implode(",", $this->input->post("Carbohydrates", TRUE)),
            "Protein" => implode(",", $this->input->post("Proteins", TRUE)),
            "Salad" => implode(",", $this->input->post("Salads", TRUE)),
            "Drink" => implode(",", $this->input->post("Drinks", TRUE)),

            "Total_Price" => $this->input->post("price"),
            "Description" => $this->input->post("Description"),
            "Location" => $this->input->post("Location"),
            "Start_time" => $this->input->post("Start_time"),
            "End_time" => $this->input->post("End_time")
        );
        //?PaymentPage
        // $data2 = array();
        // if ($this->isUserLoggedIn) {
        //     $con = array(
        //         'id' => $this->session->userdata('userId')
        //     );
        //     $data2['user'] = $this->user->getRows($con);
        //     // $this->load->view('NavBar2');
        //     $payment_data = array('planet' => $planet   );

        //     $this->load->view('Payment', $payment_data);
        // }
        
        //?Put the array of data in the model function
        // $this->Catering_model->insert_data($data);
        $totPrice = $data["Total_Price"];
        $this->payment($totPrice);
    }

    public function payment($totPrice)
    {
        $data = array();
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);
            // $this->load->view('NavBar2');
            $data['totPrice'] = $totPrice;
            $this->load->view('Payment', $data);
        }
    }

    public function payParameters(){
        $totPrice = $this->input->post("TotPrice");
        $phoneNo = $this->input->post("PhoneNo");
        $this->load->model('Payment_model');
        $this->Payment_model->mpesaSendMoney($phoneNo, $totPrice);
    }

    public function login()
    {
        //SESSION VARS
        // //Relaying user data to DB
        // $_SESSION["userEmail"] = $this->input->post('email');
        // $this->user->saveSessionVars($_SESSION[" "]);




        $data = array();

        // Get messages from the session 
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        // If login request submitted 
        if ($this->input->post('loginSubmit')) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');

            if ($this->form_validation->run() == true) {
                $con = array(
                    'returnType' => 'single',
                    'conditions' => array(
                        'email' => $this->input->post('email'),
                        'password' => md5($this->input->post('password')),
                        'status' => 1
                    )
                );
                $checkLogin = $this->user->getRows($con);
                if ($checkLogin) {
                    $this->session->set_userdata('isUserLoggedIn', TRUE);
                    $this->session->set_userdata('userId', $checkLogin['id']);
                    $_SESSION["userEmail"] = $this->input->post('email');
                    $this->user->saveSessionVars($_SESSION["userEmail"]);
                    redirect('users/account/');
                } else {
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            } else {
                $data['error_msg'] = 'Please fill all the mandatory fields.';
            }
        }

        // Load view 
        $this->load->view('elements/header', $data);
        $this->load->view('Navbar1.php');
        $this->load->view('users/login', $data);
        $this->load->view('elements/footer');
    }

    public function registration()
    {
        $data = $userData = array();

        // If registration request is submitted 
        if ($this->input->post('signupSubmit')) {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

            $userData = array(
                'first_name' => strip_tags($this->input->post('first_name')),
                'last_name' => strip_tags($this->input->post('last_name')),
                'email' => strip_tags($this->input->post('email')),
                'password' => md5($this->input->post('password')),
                'gender' => $this->input->post('gender'),
                'phone' => strip_tags($this->input->post('phone'))
            );

            if ($this->form_validation->run() == true) {
                $insert = $this->user->insert($userData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.');
                    redirect('users/login');
                } else {
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            } else {
                $data['error_msg'] = 'Please fill all the mandatory fields.';
            }
        }

        // Posted data 
        $data['user'] = $userData;

        // Load view 
        $this->load->view('elements/header', $data);
        $this->load->view('users/registration', $data);
        $this->load->view('elements/footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();

        redirect('users');
    }


    // Existing email check during validation 
    public function email_check($str)
    {
        $con = array(
            'returnType' => 'count',
            'conditions' => array(
                'email' => $str
            )
        );
        $checkEmail = $this->user->getRows($con);
        if ($checkEmail > 0) {
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //SAVING MENU DATA INTO DB
    public function saveMenuData()
    {
        //echo("Harry");
        //Loading model, storing data it returns
        $this->load->model("menuM");
        $menuItems = $this->menuM->returnMenuItems();


        //Checking whether "Add to Cart submit button has been clicked"
        if ($this->input->post("Add_to_Cart")) {

            // //Getting post data
            // $postData = $this->input->post();
            // //print_r($postData);

            //Inserting checked food items into db
            foreach ($menuItems as $row) {
                //Check whether the checkboxes were selected
                if ($this->input->post($row["foodName"]) !== null) {
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
