<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class statusController extends CI_Controller
	{
	  	public function __construct()
	    {
	    	parent::__construct();
	    }

		public function index()
		{

		}

        ///////////////////////////////////Wyświetlanie Statusów///////////////////////////////////////
        public function statusView()
        {
            if($this->mainlib->czyZalogowany()) {
                $statusID = array('1', '2', '3', '4', '5');
                $transakcje = $this->transModel->szukanieKilkuTransakcji($this->session->userID, $statusID);

                $data['numerTrans'] = 1;
                $dane['content'] = ' ';
                foreach ($transakcje as $transakcja) {
                    $produkty = $this->productsModel->getUserProducts($transakcja->IDtransakcje);

                    $data['data'] = $transakcja->data;
                    $data['opisTrans'] = $this->transModel->nazwaStatusu($transakcja->IDstatus);
                    $data['content'] = '';
                    $data['kosztTow'] = '0';
                    for ($i = 0; $i < count($produkty); $i++) {
                        $data['content'] = $data['content'] . $this->load->view('oneTransProductView', $produkty[$i], TRUE);
                    }
                    foreach ($produkty as $produkt) {
                        $data['kosztTow'] = $data['kosztTow'] + $produkt->iloscElementow * ($produkt->cenaNetto + ($produkt->cenaNetto * $produkt->VAT));
                    }
                    $data['kosztWys'] = '15';//Tutaj jak coś podpiąć wybieranie
                    $data['kosztSum'] = $data['kosztTow'] + $data['kosztWys'];

                    $dane['content'] = $dane['content'] . $this->load->view('oneTransView', $data, true);
                    $data['numerTrans'] = $data['numerTrans'] + 1;
                }

                $strona['content'] = $this->load->view('statusView', $dane, true);
                $this->mainlib->info($strona);
            }else $this->mainlib->brakUprawnień();
        }

        ///////////////////////////////////Edycja Statusów///////////////////////////////////////
        public function statusEditView()
        {
            if($this->mainlib->czyAdmin()) {
                $statusID = array('1', '2', '3', '4', '5');
                $users = $this->transModel->wszystkieOkresloneTransakcje($statusID);

                $usersStatus['content'] = ' ';
                foreach ($users as $i => $user) 
                {
                    if ($i != 0)
                    {
                        if (($users[$i]->IDuzytkownicy) == ($users[$i - 1]->IDuzytkownicy)) continue;
                    }

                    $transakcje = $this->transModel->szukanieKilkuTransakcji($user->IDuzytkownicy , $statusID);

                    $data['numerTrans'] = 1;
                    $dane['content'] = ' ';
                    $dane['user'] = $user;
                    foreach ($transakcje as $transakcja) {
                        $produkty = $this->productsModel->getUserProducts($transakcja->IDtransakcje);

                        $data['data'] = $transakcja->data;
                        $data['opisTrans'] = $this->transModel->nazwaStatusu($transakcja->IDstatus);
                        $data['statusID'] = $transakcja->IDtransakcje;
                        $data['content'] = '';
                        $data['user'] = $user->login;
                        $data['kosztTow'] = '0';
                        for ($i = 0; $i < count($produkty); $i++) {
                            $data['content'] = $data['content'] . $this->load->view('oneTransProductView', $produkty[$i], TRUE);
                        }
                        foreach ($produkty as $produkt) {
                            $data['kosztTow'] = $data['kosztTow'] + $produkt->iloscElementow * ($produkt->cenaNetto + ($produkt->cenaNetto * $produkt->VAT));
                        }
                        $data['kosztWys'] = '15';//Tutaj jak coś podpiąć wybieranie
                        $data['kosztSum'] = $data['kosztTow'] + $data['kosztWys'];
                        $data['disable'] = ' ';
                        if($transakcja->IDstatus==4)
                        {
                            $data['disable'] = 'disabled';
                        }
                        $data['status'] = '<option selected value="' . $transakcja->IDstatus . '">' . $data['opisTrans'] . '</option>';
                        for ($i = 1; $i < 6; $i++) {
                            if ($i != $transakcja->IDstatus)
                                $data['status'] = $data['status'] . '<option value="' . $i . '">' . $this->transModel->nazwaStatusu($i) . '</option>';
                        }

                        $dane['content'] = $dane['content'] . $this->load->view('oneTransEditView', $data, true);
                        $data['numerTrans'] = $data['numerTrans'] + 1;
                    }

                    $usersStatus['content'] = $usersStatus['content'] . $this->load->view('oneUserStatusView', $dane, true);
                }

                $strona['content'] = $this->load->view('statusView', $usersStatus, true);

                $this->mainlib->info($strona);
            }else $this->mainlib->brakUprawnień();
        }

        public function statusEdit()
        {
            if($this->mainlib->czyAdmin()) {
                $data = date('Y-m-d H:i:s');
                $transID = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;;
                if($transID  == NULL || $transID  == 0)
                {
                    $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                    $this->mainlib->info($data);
                }
                else {
                    if ($this->input->get('statusN') == 4) {
                        $this->transModel->updateIloscTowarowTransaction($transID, $data, $this->input->get('statusN'));
                    } else {
                        $this->transModel->updateTrans($transID, $data, $this->input->get('statusN'));
                    }
                    header('Location:' . site_url() . '/editStatus');
                }
            }else $this->mainlib->brakUprawnień();
        }
	}
?>