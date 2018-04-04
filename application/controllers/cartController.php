<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class cartController extends CI_Controller
	{
	  	public function __construct()
	    {
	    	parent::__construct();
	    }

		public function index()
		{

		}

        ///////////////////////////////////Wyświetlanie Koszyka///////////////////////////////////////
        public function cartView($err=' ')
        {
            if($this->mainlib->czyZalogowany()) {
                $koszykID = $this->transModel->szukanieTransakcji($this->session->userID, '0');
                if($koszykID==0)
                {
                    $data['content'] = "<div><h1>Koszyk jest pusty</h1></div>";
                    $this->mainlib->info($data);
                }else {
                    $produkty = $this->productsModel->getUserProducts($koszykID);
                    if ($produkty == NULL) {
                        $data['content'] = "<div><h1>Koszyk jest pusty</h1></div>";
                        $this->mainlib->info($data);
                    } else {
                        $data['error'] = $err;
                        $data['content'] = '';
                        $data['kosztTow'] = '0';
                        for ($i = 0; $i < count($produkty); $i++) {
                            $data['content'] = $data['content'] . $this->load->view('cartOneView', $produkty[$i], TRUE);
                        }
                        foreach ($produkty as $produkt) {
                            $data['kosztTow'] = $data['kosztTow'] + $produkt->iloscElementow * ($produkt->cenaNetto + ($produkt->cenaNetto * $produkt->VAT));
                        }
                        $data['kosztWys'] = '15';//Tutaj jak coś podpiąć wybieranie
                        $data['kosztSum'] = $data['kosztTow'] + $data['kosztWys'];

                        $dane['content'] = $this->load->view('cartView', $data, true);
                        $this->mainlib->info($dane);
                    }
                }
            }else $this->mainlib->brakUprawnień();
        }

        ///////////////////////////////////////Dodawanie do Koszyka/////////////////////////////////////////////
        public function addToCart()
        {
            if($this->mainlib->czyZalogowany()) {
                $idProd = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;;
                if($this->input->get('ile') == NULL || $this->input->get('ile')  == 0)
                {
                    $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                    $this->mainlib->info($data);
                }
                else {
                    $ileSztuk = $this->input->get('ile');
                    $status = $this->transModel->sprTransakcji($this->session->userID, '0');

                    if ($status == 0) {
                        $data = date('Y-m-d H:i:s');
                        $this->transModel->createTrans($this->session->userID, $data, '0');
                    }

                    $transID = $this->transModel->szukanieTransakcji($this->session->userID, '0');
                    $status = $this->transModel->sprTransElem($transID, $idProd);

                    if ($status == 0) {
                        $this->transModel->createTransElem($transID, $idProd, $ileSztuk, '0');
                    } else {
                        $transElemID = $this->transModel->szukanieTransElem($transID, $idProd);
                        $sztukTransElem = $this->transModel->sztukiTransElem($transElemID);
                        $sumaSztuk = $sztukTransElem + $ileSztuk;
                        $this->transModel->updateTransElem($transElemID, $idProd, $sumaSztuk, '0');
                    }

                    header('Location:' . site_url() . '/cart');
                }
            }else $this->mainlib->brakUprawnień();

        }

        ///////////////////////////////////Aktualizowanie Koszyka///////////////////////////////////////
        public function cartActualization()
        {
            if($this->mainlib->czyZalogowany()) {
                $idProd = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;;
                if($this->input->post('ilosc') == NULL)
                {
                    $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                    $this->mainlib->info($data);
                }
                else {
                    $ileSztuk = $this->input->post('ilosc');
                    $transID = $this->transModel->szukanieTransakcji($this->session->userID, '0');

                    $transElemID = $this->transModel->szukanieTransElem($transID, $idProd);

                    if ($ileSztuk == 0) {
                        $this->transModel->removeTransElem($transElemID, $idProd);
                    } else {
                        $this->transModel->updateTransElem($transElemID, $idProd, $ileSztuk, '0');
                    }

                    header('Location:' . site_url() . '/cart');
                }
            }else $this->mainlib->brakUprawnień();
        }

        ////////////////////////////////////Usuwanie z Koszyka///////////////////////////////////////
        public function cartRemove()
        {
            if($this->mainlib->czyZalogowany()) {
                $idProd = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;;
                $transID = $this->transModel->szukanieTransakcji($this->session->userID, '0');
                $transElemID = $this->transModel->szukanieTransElem($transID, $idProd);
                if($transElemID  == NULL || $transElemID  == 0)
                {
                    $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                    $this->mainlib->info($data);
                }
                else {
                    $this->transModel->removeTransElem($transElemID, $idProd);
                    header('Location:' . site_url() . '/cart');
                }
            }else $this->mainlib->brakUprawnień();
        }

        ///////////////////////////////////Zamawianie Koszyka///////////////////////////////////////
        public function cartCheckout()
        {
            if($this->mainlib->czyZalogowany()) {
                $transID = $this->transModel->szukanieTransakcji($this->session->userID, '0');
                if($transID  == NULL || $transID  == 0)
                {
                    $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                    $this->mainlib->info($data);
                }
                else {
                    if ($this->transModel->iloscTransElem($transID)) {

                        $data = date('Y-m-d H:i:s');

                        if ($this->transModel->buyTransaction($transID, $data, '1')) {
                            $dane['content'] = '<h2>Towar Zamówiono.</h2>';
                            $this->mainlib->info($dane);
                        } else {
                            $err = 'Nie posiadamy takiej ilości wybranych przez ciebie towarów.';
                            $this->cartView($err);
                        }

                        ////header('Location:'.site_url().'/cart');
                    } else {
                        $err = 'Brak towarów w koszyku.';
                        $this->cartView($err);
                    }
                }
            }else $this->mainlib->brakUprawnień();
        }
	}
?>