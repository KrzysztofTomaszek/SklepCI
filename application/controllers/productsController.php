<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class productsController extends CI_Controller 
	{

	  	public function __construct()
	    {
	    	parent::__construct();
	    }

		public function index()
		{
			$this->startPage();
		}

        //////////////Strona Startowa////////////////////////
		public function startPage()
        {            
            $data['footer'] = $this->load->view('footer','',TRUE);
            $data['header'] = $this->load->view('header','',TRUE);
            $data['menu'] = $this->mainlib->menu();
            $data['pagin'] = ' ';

            $produkty=$this->productsModel-> startProduct();

            $data['content']='<h1>Produkty Polecane</h1>';
            for($i=0;$i<count($produkty);$i++)
            {
                $data['content']= $data['content'].$this->load->view('pageOneProductView',$produkty[$i],TRUE);
            }

            $this->load->view('pageProductsView',$data);
        }

        //////////////////////////Dodawanie i Edycja Produktów/////////////////////////
        public function addFormProduct()
        {
            if($this->mainlib->czyAdmin()) {
                $dane['category'] = $this->mainlib->displayKategorie(1, 1, 2);
                $data['content'] = $this->load->view('addProductView', $dane, true);
                $this->mainlib->info($data);
            }else $this->mainlib->brakUprawnień();
        }

        public function editFormProduct()
        {
            if($this->mainlib->czyAdmin()) {
                $prID = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $dane['tab'] = $this->productsModel->oneProduct($prID);
                if ($dane['tab'] == NULL) {
                    $data['content'] = '<h2>Błąd Edycji</h2><div>Taki produkt nie istnieje.</div>';
                } else {
                    $dane['tab']['VAT'] = $dane['tab']['VAT'] * 100;
                    $dane['category'] = $this->mainlib->displayKategorie($dane['tab']['IDkategoria'], $dane['tab']['IDpodkategoria']);
                    $data['content'] = $this->load->view('editProductView', $dane, true);
                }
                $this->mainlib->info($data);
            }else $this->mainlib->brakUprawnień();
        }

        public function addProduct()
        {
            if($this->mainlib->czyAdmin()) {
                $exist = $this->productsModel->productExist($this->input->post('Kat'), $this->input->post('podKat'), $this->input->post('name'));
                if ($exist) {
                    $data['content'] = "<div><h1>Błąd Dodawania</h1></div><div>Produkt o takiej nazwie już istnieje.</div>";

                } else {
                    $vat = $this->input->post('vat') / 100;
                    $this->productsModel->addProduct($this->input->post('name'), $this->input->post('opis'), $this->input->post('Kat'), $this->input->post('podKat'), $this->input->post('netto'), $vat, $this->input->post('ile'));

                    $err = $this->dodZdj($this->input->post('name'), $this->input->post('Kat'), $this->input->post('podKat'));
                    if (!$err) {
                        $data['content'] = "<div><h1>Produkt dodano pomyślnie</h1></div>";
                    } else {
                        $data['content'] = "<div><h1>Produkt dodano ale nastąpił problem z załadowaniem zdjęcia.</h1></div>" . print_r($err['content']);
                    }

                }
                $this->mainlib->info($data);
            }else $this->mainlib->brakUprawnień();
        }

        public function editProduct()
        {
            if($this->mainlib->czyAdmin()) {
                if ($this->input->post('nameS') == $this->input->post('name')) {
                    $exist = 0;
                } else {
                    $exist = $this->productsModel->productExist($this->input->post('Kat'), $this->input->post('podKat'), $this->input->post('name'));
                }
                if ($exist) {
                    $data['content'] = "<div><h1>Błąd Edycji</h1></div><div>Towar o takiej nazwie istniał już wcześniej.</div>";

                } else {
                    $vat = $this->input->post('vat') / 100;
                    $this->productsModel->editProduct($this->input->post('name'), $this->input->post('opis'), $this->input->post('Kat'), $this->input->post('podKat'), $this->input->post('netto'), $vat, $this->input->post('ile'), $this->input->post('IDproduktu'), $this->input->post('ileZar'), $this->input->post('ileZar'));
                    if ($_FILES['zdj']['name'] == NULL) {
                        $err = 0;
                    } else {
                        $err = $this->dodZdj($this->input->post('name'), $this->input->post('Kat'), $this->input->post('podKat'));
                    }

                    if (!$err) {
                        $data['content'] = "<div><h1>Edycja Dokonana Pomyślnie</h1></div>";
                    } else {
                        $data['content'] = "<div><h1>Edycja Dokonana Pomyślnie ale nastąpił problem z załadowaniem zdjęcia.</h1></div>" . $err['content'];
                    }
                }
                $this->mainlib->info($data);
            }else $this->mainlib->brakUprawnień();
        }

        /////////////////////Dodawanie Zdjęć////////////////////////////////
        public function dodZdj($name,$kat,$podKat)
        {
            if($this->mainlib->czyAdmin()) {
                if ($_FILES['zdj']['error'] > 0) {
                    $data['content'] = '<h2>Nie wysłano pliku.</h2>';
                    return $data;
                }

                if ($_FILES['zdj']['type'] != 'image/jpeg' && $_FILES['zdj']['type'] != 'image/png' && $_FILES['zdj']['type'] != 'image/bmp') {
                    $data['content'] = '<h2>Plik nie jest w odpowiednim formacie.</h2>';
                    return $data;
                }

                $roz = substr($_FILES['zdj']['type'], 6);
                $imgName = $this->productsModel->productIMG($name, $kat, $podKat);
                $xamppDir=getcwd();
                $dirLocal = '\\files\\images\\';
                $lokalizacje = $xamppDir . $dirLocal . $imgName . '.' . $roz;

                $max_rozmiar = 2 * 1024 * 1024; //MB na bajty
                if (is_uploaded_file($_FILES['zdj']['tmp_name'])) {
                    if ($_FILES['zdj']['size'] > $max_rozmiar) {
                        $data['content'] = '<h2>Błąd! Plik jest za duży!</h2>';
                        return $data;
                    } elseif (!move_uploaded_file($_FILES['zdj']['tmp_name'], $lokalizacje)) {
                        $data['content'] = '<h2>Plik nie może zostac skopiowany do katalogu.</h2>';
                        return $data;
                    } else {
                        $link = 'files/images/' . $imgName . '.' . $roz;
                        $this->productsModel->addLinkProductIMG($imgName, $link);
                        return 0;
                    }
                } else {
                    $data['content'] = '<h2>Wystąpił problem podczas przesyłania pliku.</h2>';
                    return $data;
                }
            }else $this->mainlib->brakUprawnień();
        }



        ///////////////////////Wyświetlanie Stron Z Produktami//////////////////////////////////
        public function productCategoryPage()
        {
            $data['footer'] = $this->load->view('footer','',TRUE);
            $data['header'] = $this->load->view('header','',TRUE);

            $kat = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $podKat = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            if($kat == 0 || $podKat == 0 )
            {
                $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                $this->mainlib->info($data);
            }
            else{
                if($page == 0 || $page == 1) {
                    $page = 1;
                    $page = $page - 1;
                }
                $data['menu'] = $data['menu'] = $this->mainlib->menu($kat,$podKat);

                $this->load->library('pagination');
                $config['base_url'] = site_url().'/categoryPage/'.$kat.'/'.$podKat.'/';
                $config['total_rows'] = $this->productsModel->allProductsCategoryCount($kat,$podKat);
                $config['per_page'] = 6;

                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '<li>';

                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';

                $config['prev_tag_open'] ='<li>';
                $config['prev_tag_close'] ='</li>';

                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $config['full_tag_open'] = '<center><div class="container" style=""><ul class="pagination">';
                $config['full_tag_close'] = '</ul></div></center>';

                $this->pagination->initialize($config);
                $data['pagin'] = $this->pagination->create_links();

                $produkty=$this->productsModel-> pageProductsCategory($kat,$podKat,$page);

                $data['content']='';
                for($i=0;$i<count($produkty);$i++)
                {
                    $data['content']= $data['content'].$this->load->view('pageOneProductView',$produkty[$i],TRUE);
                }

                $this->load->view('pageProductsView',$data);
            }
        }

        public function productCategoryPageLinkGenerator()
        {
            header('Location: '.site_url().'/categoryPage/'.$this->input->get('Kat').'/'.$this->input->get('podKat').'/1');
        }

        ////////////////////////////////////Pojedynczy Produkt///////////////////////////////////////
        public function singleProduct()
        {
            $IDprod = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $dane=$this->productsModel->oneProduct($IDprod);
            if($dane == 0)
            {
                $data['content'] = "<div><h1>Źle spreparowany link.</h1></div>";
                $this->mainlib->info($data);
            }else {
                $dane['buy'] = ' ';
                if ($this->session->userGroup == "Administrator" || $this->session->userGroup == "Uzytkownik") {
                    $dane['buy'] = $this->load->view('addToCartFormView', $dane, TRUE);
                }
                $data['content'] = $this->load->view('onlyProductView', $dane, TRUE);
                $this->mainlib->info($data);
            }
        }

        ////////////////////////////////////Wybór Towaru Do Edycji//////////////////////////////////////////
        public function selectProduct()
        {
            if($this->mainlib->czyAdmin()) {
                $data['kategorie'] = $this->mainlib->displayKategorie(1,1,2);

                $data['produkty']=$this->produktySel(1,1,FALSE);
                $dane['content']=$this->load->view('selectProductView',$data,TRUE);
                $this->mainlib->info($dane);
            }else $this->mainlib->brakUprawnień();
        }

        public function produktySel($idKat=1,$podKatID=1,$wys=TRUE)
        {
            if($wys)
            {
                $idKat=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;;
                $podKatID=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;;
                if($podKatID==0)
                {
                    $podKatID=$this->categoryModel->firstPodKat($idKat);
                }
            }
            $dane=$this->productsModel->produkty($idKat,$podKatID);
            $data='';
            foreach ($dane as $prod)
            {
                $data=$data.'<option value="'.$prod->IDprodukty.'">'.$prod->nazwa.'</option>';
            }
            if($wys)
            {
                return print_r($data);
            }
            else
            {
                return $data;
            }
        }
    }    