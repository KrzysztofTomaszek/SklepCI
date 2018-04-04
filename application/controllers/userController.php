<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class userController extends CI_Controller 
	{
	  	public function __construct()
	    {
	    	parent::__construct();
	    }

		public function index()
		{

		}

		public function  userList()//////Wyświetlanie użytkowników//////////////
        {
            $this->load->library('pagination');

            $config['base_url'] = base_url().'users/';
            $config['total_rows'] = $this->userModel->allUserCount();
            $config['per_page'] = 4;

            $config['cur_tag_open'] = '<b>';
            $config['cur_tag_close'] = '</b>';
            $config['full_tag_open'] = '<p style="background-color:red;">';
            $config['full_tag_close'] = '</p>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data['uzytkownicy'] = $this->userModel->pageUser($page);
            $data['pagin'] = $this->pagination->create_links();

            $dane['content'] = $this->load->view('userView',$data,TRUE);
            $this->mainlib->info($dane);
        }

        ///////////////////////////////Logowanie i Wylogowywanie/////////////////////////////////////
        public function loginFormUser()
        {
            $data['content']=$this->load->view('loginUserView','',true);
            $this->mainlib->info($data);
        }

        public function login()
        {
            $login=$this->input->post('login');
            $password=$this->input->post('password');
            $loginInfo=$this->userModel->login($login,$password);
            if($loginInfo['IDuzytkownicy'])
            {
                    $session = array(
                        'zalogowany'  => TRUE,
                        'userID'     => $loginInfo['IDuzytkownicy'],
                        'userLogin'     => $loginInfo['login'],
                        'userGroup' => $loginInfo['uprawnienia']
                    );
                    $this->session->set_userdata($session);

                    if($loginInfo['uprawnienia']=='Administrator')
                    {
                        header('Location: '.site_url());
                    }
                    elseif($loginInfo['uprawnienia']=='Uzytkownik')
                    {
                        header('Location: '.site_url());
                    }
                    else
                    {
                        header('Location: '.site_url());
                    }
            }
            else
            {
                $session = array(
                    'zalogowany'  => FALSE,
                    'userID'     => '',
                    'userLogin'     => '',
                    'userGroup' => ''
                );
                $this->session->set_userdata($session);
                $data['content']="<div><h1>Błąd Logowania</h1></div><div>Podano złe hasło lub login</div>";
                $this->mainlib->info($data);
            }
        }

        public function wyloguj()
        {
            $session = array(
                'zalogowany'  => FALSE,
                'userID'     => '',
                'userLogin'     => '',
                'userGroup' => ''
            );
            $this->session->set_userdata($session);
            header('Location: '.site_url());
        }

        /////////////////Dodawanie Użytkownika///////////////////////////////////
        public function addFormUser()
        {
            $data['content']=$this->load->view('addUserView','',true);
            $this->mainlib->info($data);
        }

        public function addUser()
        {
            $exist=$this->userModel->userExist($this->input->post('login'));
            if($exist)
            {
                $data['content']="<div><h1>Błąd Rejestracji</h1></div><div>Użytkownik o takim loginie już istnieje.</div>";

            }
            else
            {
                $this->userModel->addUser($this->input->post('login'),$this->input->post('password'),$this->input->post('imie'),$this->input->post('nazwisko'),$this->input->post('plec'),$this->input->post('wiek'),$this->input->post('ulica'),$this->input->post('kod'),$this->input->post('poczta'),$this->input->post('miejscowosc'),$this->input->post('adres'),$this->input->post('woj'));

                $data['content']="<div><h1>Rejestracja Dokonana Pomyślnie</h1></div>";
            }
            $this->mainlib->info($data);
        }

        ////////////////////////Edytowanie Użytkownika//////////////////////////////////////
        public function editFormUser()
        {
            if($this->mainlib->czyZalogowany()) {
                $dane['userID'] = $this->session->userID;
                $dane['tab'] = $this->userModel->oneUser($this->session->userID);
                $data['content'] = $this->load->view('editUserView', $dane, true);
                $this->mainlib->info($data);
            }else
            {
                $strona['content'] = '<h2>Nie posiadasz wystarczających uprawnień by uzyskać tu dostęp.</h2>';
                $this->mainlib->info($strona);
            }
        }

        public function editUser()
        {
            if($this->mainlib->czyZalogowany()) {
                $user=$this->userModel->oneUser($this->session->userID);
                if($this->input->post('passwordS')==$user['haslo']) {

                    if ($this->input->post('loginS') == $this->input->post('login')) {
                        $exist = 0;
                    } else {
                        $exist = $this->userModel->userExist($this->input->post('login'));
                    }
                    if ($exist) {
                        $data['content'] = "<div><h1>Błąd Edycji</h1></div><div>Użytkownik o takim loginie już istnieje.</div>";

                    } else {
                        $this->userModel->editUser($this->input->post('userID'), $this->input->post('login'), $this->input->post('passwordN'), $this->input->post('imie'), $this->input->post('nazwisko'), $this->input->post('plec'), $this->input->post('wiek'), $this->input->post('ulica'), $this->input->post('kod'), $this->input->post('poczta'), $this->input->post('miejscowosc'), $this->input->post('adres'), $this->input->post('woj'));
                        $data['content'] = "<div><h1>Edycja Dokonana Pomyślnie</h1></div>";
                    }
                    $this->mainlib->info($data);
                }
                else{
                    $strona['content'] = '<h2>Podałeś złe stare hasło.</h2>';
                    $this->mainlib->info($strona);
                }
            }else{
            $strona['content'] = '<h2>Nie posiadasz wystarczających uprawnień by uzyskać tu dostęp.</h2>';
            $this->mainlib->info($strona);
            }
        }
	}
?>