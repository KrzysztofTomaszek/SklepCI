<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class categoryModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        //////////////////////// Wysyłanie Kategori i Podkategorii///////////////////////////
        public function allKategorie()
        {
            $query = $this->db->get('kategoria');
            return $query->result();
        }

        public function podKategorie($idKat)
        {
            $this->db->select(' * ');
            $this->db->from('podkategoria');
            $this->db->where('IDkategoria', $idKat);
            $query = $this->db->get();

            return $query->result();
        }

        ////////////////////////////Sprawdzanie czy podkategoria lub kategoria istnieje//////////////////////////

       public function  existKategoria($kat)
        {
            $this->db->select('count(IDkategoria) AS liczba');
            $this->db->from('kategoria');
            $this->db->where('nazwaKategorii', $kat);
            $query = $this->db->get();

            return $query->row('liczba');
        }

        public function  existPodkategoria($kat,$podKat)
        {
            $this->db->select('count(IDpodkategoria) AS liczba');
            $this->db->from('podkategoria');
            $this->db->where('IDkategoria', $kat);
            $this->db->where('nazwaPodkategorii', $podKat);
            $query = $this->db->get();

            return $query->row('liczba');
        }

        //////////////////////// Dodawanie Kategori i Podkategorii///////////////////////////
        public function dodKategorie($kat)
        {
            $data = array(
            'IDkategoria' => '',
            'nazwaKategorii' => $kat
            );
            $this->db->insert('kategoria', $data);

            return $this->db->insert_id();
        }
        public function dodPodKategorie($Kat,$podKat)
        {
            $data = array(
            'IDpodkategoria' => '',
            'nazwaPodkategorii' => $podKat,
            'IDkategoria' => $Kat
            );
            $this->db->insert('podkategoria', $data);

            return $this->db->insert_id();
        }

        //////////////////////// Edytowanie Kategori i Podkategorii///////////////////////////
        public function editKategorie($katName, $katID)
        {
            $data = array(
              'nazwaKategorii' => $katName
            );
            $this->db->where('IDkategoria', $katID);
            $this->db->update('kategoria', $data);

            return $this->db->insert_id();
        }

        public function editPodKategorie($podKatName, $podKatID)
        {
            $data = array(
                'nazwaPodkategorii' => $podKatName
            );
            $this->db->where('IDpodkategoria', $podKatID);
            $this->db->update('podkategoria', $data);

            return  $this->db->insert_id();
        }
        ////////////////////////Dane Pierwszej Podkategorii///////////////////////////
        public function firstPodKat($idKat)
        {
            $this->db->select_min('IDpodkategoria');
            $this->db->where('IDkategoria', $idKat);
            $query = $this->db->get('podkategoria');

            return $query->row('IDpodkategoria');
        }
    }
