<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class productsModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        //////////////////////// Dodawanie Towaru///////////////////////////
        public function addProduct($name,$opis,$kat,$podKat,$netto,$vat,$ile)
        {
            $data = array(
                'IDprodukty' => ' ',
                'nazwa' => $name,
                'opisProduktu' => $opis,
                'cenaNetto' => $netto,
                'VAT' => $vat,
                'imageLink' => 'files/images/stock.png',
                'IDkategoria' => $kat,
                'IDpodkategoria' => $podKat,
                'ilosc_cala' => $ile,
                'ilosc_zarezerwowana' => '0'
            );
            $this->db->insert('produkty', $data);

            return  $this->db->insert_id();
        }

        ////////////////////////Edytowanie Towaru///////////////////////////
        public function editProduct($name,$opis,$kat,$podKat,$netto,$vat,$ile,$prodID,$ileZar)
        {
            $data = array(
                'IDprodukty' => $prodID,
                'nazwa' => $name,
                'opisProduktu' => $opis,
                'cenaNetto' => $netto,
                'VAT' => $vat,
                'IDkategoria' => $kat,
                'IDpodkategoria' => $podKat,
                'ilosc_cala' => $ile,
                'ilosc_zarezerwowana' => $ileZar
            );

            $this->db->where('IDprodukty', $prodID);
            $this->db->update('produkty', $data);

            return  $this->db->insert_id();
        }

        public function productExist($kat, $podKat, $name)
        {
            $this->db->select('count(*) AS liczba');
            $this->db->from('produkty');
            $this->db->where('IDkategoria', $kat);
            $this->db->where('IDpodkategoria', $podKat);
            $this->db->where('nazwa', $name);
            $query = $this->db->get();

            return $query->row('liczba');
        }

        ////////////////////////Id Towaru//////////////////////////
        public function productIMG($name, $kat, $podKat)
        {
            $this->db->select('*');
            $this->db->from('produkty');
            $this->db->where('IDkategoria', $kat);
            $this->db->where('IDpodkategoria', $podKat);
            $this->db->where('nazwa', $name);
            $query = $this->db->get();

            return $query->row('IDprodukty');
        }

        ////////////////////////Dane Jednego Produktu///////////////////////////
        public function oneProduct($productID)
        {
            $this->db->select('*');
            $this->db->from('produkty');
            $this->db->where('IDprodukty', $productID);
            $query = $this->db->get();
            $result=$query->result_array();

            return $result[0];
        }

        ////////////////////////Liczy Wszystkie Produkty///////////////////////////
        public function allProductsCategoryCount($kat,$podKat)
        {
            $this->db->select('count(*) AS liczba');
            $this->db->from('produkty');
            $this->db->where('IDkategoria', $kat);
            $this->db->where('IDpodkategoria', $podKat);
            $query = $this->db->get();

            return $query->row('liczba');
        }

        ////////////////////////Dane Strony Produktów///////////////////////////
        public function pageProductsCategory($kat,$podKat, $od)
        {
            $this->db->select('*');
            $this->db->where('IDkategoria', $kat);
            $this->db->where('IDpodkategoria', $podKat);
            $query = $this->db->get('produkty', 6, $od);

            return $query->result();
        }

        ////////////////////////Produktu///////////////////////////
        public function produkty($idKat,$podKatID)
        {
            $this->db->select(' * ');
            $this->db->from('produkty');
            $this->db->where('IDkategoria', $idKat);
            $this->db->where('IDpodkategoria', $podKatID);
            $query = $this->db->get();

            return $query->result();
        }

        ////////////////////////Dane Produktów Startowych///////////////////////////
        public function startProduct()
        {
            $this->db->select('*');
            $this->db->order_by('ilosc_zarezerwowana', 'DESC');
            $query = $this->db->get('produkty', 6);

            return $query->result();
        }

        ////////////////////////Dodawanie Linku do Zdjęcia///////////////////////////
        public function addLinkProductIMG($prodID,$link)
        {
            $data = array(
                'imageLink' => $link
            );

            $this->db->where('IDprodukty', $prodID);
            $this->db->update('produkty', $data);

            return  $this->db->insert_id();
        }

        ////////////////////////Dane Produktów Użytkownika i ich edycja///////////////////////////
        public function getUserProducts($koszykID)
        {
            $this->db->select(' * ');
            $this->db->from('elementy_transakcji');
            $this->db->join('produkty', 'elementy_transakcji.IDprodukty = produkty.IDprodukty');
            $this->db->join('kategoria', 'kategoria.IDkategoria = produkty.IDkategoria');
            $this->db->join('podkategoria', 'podkategoria.IDpodkategoria = produkty.IDpodkategoria');
            $this->db->where('elementy_transakcji.IDtransakcje', $koszykID);
            $query = $this->db->get();

            return $query->result();
        }

        public function editProductRezerw($prodID,$ileZar)
        {
            $data = array(
                'ilosc_zarezerwowana' => $ileZar
            );

            $this->db->where('IDprodukty', $prodID);
            $this->db->update('produkty', $data);

            return  $this->db->insert_id();
        }

        public function editProductIlosc($IDprodukt,$pCal)
        {
            $data = array(
                'ilosc_cala' => $pCal
            );

            $this->db->where('IDprodukty', $IDprodukt);
            $this->db->update('produkty', $data);

            return  $this->db->insert_id();
        }
    }