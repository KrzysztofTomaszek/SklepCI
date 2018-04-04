<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mainlib
{
    public $CI;

    public function __construct()
    {
        $this->CI=& get_instance();
        $this->CI->load->helper('url_helper');
        $this->CI->load->library('session');
        $this->CI->load->model('productsModel');
        $this->CI->load->model('categoryModel');
        $this->CI->load->model('userModel');
    }

    public function info($data=NULL)
    {
        if (!isset($data['menu']))
        {
            $data['menu'] = $this->menu();
        }
        $data['footer'] = $this->CI->load->view('footer','',TRUE);
        $data['header'] = $this->CI->load->view('header','',TRUE);

        $this->CI->load->view('infoView',$data);
    }

    public function menu($k=1,$pk=1)
    {
        $dane['category']=$this->displayKategorie($k,$pk);
        $upr=$this->CI->userModel->checkUpr($this->CI->session->userID);
        if($upr=='Administrator')
        {
            $data = $this->CI->load->view('menuAdminView',$dane ,TRUE);
        }
        elseif ($upr=='Uzytkownik')
        {
            $data = $this->CI->load->view('menuUserView',$dane ,TRUE);
        }
        else
        {
            $data = $this->CI->load->view('menuView',$dane ,TRUE);
        }
        return $data;
    }

    public function displayKategorie($kat=1,$podKat=1,$ver=1)
    {
        $data['kategorie'] = $this->kategorie($kat);
        $data['podKategorie'] = '';
        $data['podKategorie'] = $this->podKategorie($kat,$podKat,FALSE);
        if($ver==1)$Kat = $this->CI->load->view('categoryView',$data,TRUE);
        else $Kat = $this->CI->load->view('categorySecondView',$data,TRUE);

        return $Kat;
    }

    public function kategorie($katID=1)
    {
        $dane=$this->CI->categoryModel->allKategorie();
        $data='';
        foreach ($dane as $kat)
        {
            if($katID==$kat->IDkategoria)
            {
                $data=$data.'<option value="'.$kat->IDkategoria.'" selected>'.$kat->nazwaKategorii.'</option>';
            }
            else
            {
                $data=$data.'<option value="'.$kat->IDkategoria.'">'.$kat->nazwaKategorii.'</option>';
            }
        }
        return $data;
    }

    public function podKategorie($idKat=1,$podKatID=1)
    {
        $dane=$this->CI->categoryModel->podKategorie($idKat);
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
        return $data;
    }

    //////////////////Sprawdzanie Uprawinien/////////////////////////////////
    public function czyAdmin()
    {
        if($this->CI->session->userGroup=='Administrator')
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function czyUser()
    {
        if($this->CI->session->userGroup=='Uzytkownik')
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function czyZalogowany()
    {
        return $this->CI->session->zalogowany;
    }

    public function brakUprawnień()
    {
        $strona['content'] = '<h2>Nie posiadasz wystarczających uprawnień by uzyskać tu dostęp.</h2>';

        $this->info($strona);
    }
}