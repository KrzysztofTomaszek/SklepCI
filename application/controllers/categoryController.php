<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class categoryController extends CI_Controller
	{
	  	public function __construct()
	    {
	    	parent::__construct();
	    }

		public function index()
		{

		}

        ///////////////Edytowanie i Dodawanie Kategorii i Podkategori///////////////////////
		public function editCatPage()
		{
            if($this->mainlib->czyAdmin()) {
                $data['kategorie'] = $this->mainlib->kategorie();
                $data['kategorieS'] = $this->mainlib->displayKategorie(1, 1, 2);
                $dane['content'] = $this->load->view('editCategoryView', $data, TRUE);
                $this->mainlib->info($dane);
            }else $this->mainlib->brakUprawnień();
		}

        public function dodKategorie()
        {
            if($this->mainlib->czyAdmin()) {
                $kat = $this->input->get('Kategoria');
                if((!($this->categoryModel->existKategoria($kat))) && $kat != '  ')
                {
                    if ($this->categoryModel->dodKategorie($kat)) {
                        $info['content'] = '<h2>Dodano Nową Kategorie</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    } else {
                        $info['content'] = '<h2>Dodanie Nie Udało Się</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    }
                }else {
                    $info['content'] = '<h2>Dodanie Nie Udało Się</h2><h3>Taka kategoria już istnieje</h3> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                    $this->mainlib->info($info);
                }
            }else $this->mainlib->brakUprawnień();
        }

        public function dodPodKategorie()
        {
            if($this->mainlib->czyAdmin()) {
                $kat = $this->input->get('Kategoria');
                $podKat = $this->input->get('PodKategoria');
                if((!($this->categoryModel->existPodkategoria($kat,$podKat))) && $podKat != '  ')
                {
                    if ($this->categoryModel->dodPodKategorie($kat, $podKat)) {
                        $info['content'] = '<h2>Dodano Nową Podkategorie</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    } else {
                        $info['content'] = '<h2>Dodanie Nie Udało Się</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    }
                }else {
                    $info['content'] = '<h2>Dodanie Nie Udała Się</h2><h3>Taka kategoria już istnieje</h3> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                    $this->mainlib->info($info);
                }
            }else $this->mainlib->brakUprawnień();
        }

        public function editKategorie()
        {
            if($this->mainlib->czyAdmin()) {
                $kat = $this->input->get('nKategoria');
                $sKatID = $this->input->get('stKategoria');
                if((!($this->categoryModel->existKategoria($kat))) && $kat != '  ')
                {
                    if ($this->categoryModel->editKategorie($kat, $sKatID)) {
                        $info['content'] = '<h2>Edycja Kategori Udana</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    } else {
                        $info['content'] = '<h2>Edycja Nie Udała Się</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    }
                }else {
                    $info['content'] = '<h2>Edycja Nie Udała Się</h2><h3>Taka kategoria już istnieje</h3> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                    $this->mainlib->info($info);
                }
            }else $this->mainlib->brakUprawnień();
        }

        public function editPodKategorie()
        {
            if($this->mainlib->czyAdmin()) {
                $sKat = $this->input->get('Kat');
                $sPodKat = $this->input->get('podKat');
                $nPodKat = $this->input->get('nPodkategoria');
                if((!($this->categoryModel->existPodkategoria($sKat,$nPodKat))) && $nPodKat != '  ')
                {
                    if ($this->categoryModel->editPodKategorie($nPodKat, $sPodKat)) {
                        $info['content'] = '<h2>Edytowanie Podkategori Udało Się</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    } else {
                        $info['content'] = '<h2>Edycja Nie Udała Się</h2> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                        $this->mainlib->info($info);
                    }
                }else {
                    $info['content'] = '<h2>Edycja Nie Udała Się</h2><h3>Taka podkategoria już istnieje</h3> <a href="' . site_url() . '/editKatPage"><button class="btn">Wróć do Edycji</button></a><br>';
                    $this->mainlib->info($info);
                }
            }else $this->mainlib->brakUprawnień();
        }

        public function getPodKategorie()
        {
            $podKatID=1;
            $idKat=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;;

            $dane=$this->categoryModel->podKategorie($idKat);
            $data='';
            foreach ($dane as $podKat)
            {
                if($podKatID==$podKat->IDpodkategoria)
                {
                    $data=$data.'<option value="'.$podKat->IDpodkategoria.'" selected>'.$podKat->nazwaPodkategorii.'</option>';
                }
                else
                {
                    $data=$data.'<option value="'.$podKat->IDpodkategoria.'">'.$podKat->nazwaPodkategorii.'</option>';
                }
            }
            return print_r($data);
        }
	}
?>