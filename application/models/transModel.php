<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class transModel extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        ////////////////////////Tworzenie transakcji i jej edycja///////////////////////////
        public function sprTransakcji($userID,$status)
        {
            $this->db->select(' count(*) as Liczba ');
            $this->db->from('transakcje');
            $this->db->where('IDuzytkownicy', $userID);
            $this->db->where('IDstatus', $status);
            $query = $this->db->get();

            return $query->row('Liczba');
        }

        public function createTrans($userID,$data,$status)
        {
            $date = array(
                'IDtransakcje' => ' ',
                'IDuzytkownicy' => $userID,
                'data' => $data,
                'IDstatus' => $status
            );

            $this->db->insert('transakcje', $date);

            return  $this->db->insert_id();
        }

        public function updateTrans($IDtrans,$data,$status)
        {
            $date = array(
                'data' => $data,
                'IDstatus' => $status
            );

            $this->db->where('IDtransakcje', $IDtrans);
            $this->db->update('transakcje', $date);

            return  $this->db->insert_id();
        }

        public function szukanieTransakcji($userID,$status)
        {
            $this->db->select(' * ');
            $this->db->from('transakcje');
            $this->db->where('IDuzytkownicy', $userID);
            $this->db->where_in('IDstatus', $status);
            $query = $this->db->get();

            return $query->row('IDtransakcje');
        }

        public function szukanieKilkuTransakcji($userID,$status)
        {
            $this->db->select(' * ');
            $this->db->from('transakcje');
            $this->db->where('IDuzytkownicy', $userID);
            $this->db->where_in('IDstatus', $status);
            $query = $this->db->get();

            return $query->result();
        }

        public function wszystkieOkresloneTransakcje($status)
        {
            $this->db->select(' * ');
            $this->db->from('transakcje');
            $this->db->join('uzytkownicy', 'transakcje.IDuzytkownicy = uzytkownicy.IDuzytkownicy');
            $this->db->where_in('IDstatus', $status);
            $this->db->order_by('transakcje.IDuzytkownicy', 'ASC');
            $query = $this->db->get();

            return $query->result();
        }

        public function nazwaStatusu($statusID)
        {
            $this->db->select(' * ');
            $this->db->from('status');
            $this->db->where('IDstatus', $statusID);            
            $query = $this->db->get();

            return $query->row('status');
        }

        ////////////////////////Tworzenie ElemętówTransakcji i jej edycja///////////////////////////
        public function createTransElem($transID,$idProd,$ileSztuk,$status)
        {
            $data = array(
                'IDelementy_transakcji' => ' ',
                'IDtransakcje' => $transID,
                'iloscElementow' => $ileSztuk,
                'IDprodukty' => $idProd,
                'IDstatus' => $status
            );

            $this->db->insert('elementy_transakcji', $data);

            return  $this->db->insert_id();
        }

        public function sprTransElem($transID,$idProd)
        {
            $this->db->select(' count(*) as Liczba ');
            $this->db->from('elementy_transakcji');
            $this->db->where('IDtransakcje', $transID);
            $this->db->where('IDprodukty', $idProd);
            $query = $this->db->get();

            return $query->row('Liczba');
        }

        public function szukanieTransElem($transID,$idProd)
        {
            $this->db->select(' * ');
            $this->db->from('elementy_transakcji');
            $this->db->where('IDtransakcje', $transID);
            $this->db->where('IDprodukty', $idProd);
            $query = $this->db->get();

            return $query->row('IDelementy_transakcji');
        }

        public function iloscTransElem($transID)
        {
            $this->db->select(' count(*) as Liczba ');
            $this->db->from('elementy_transakcji');
            $this->db->where('IDtransakcje', $transID);
            $query = $this->db->get();

            return $query->row('Liczba');
        }

        public function updateTransElem($transElemID,$idProd,$ileSztuk,$status)
        {
            $data = array(
                'iloscElementow' => $ileSztuk,
                'IDstatus' => $status
            );

            $this->db->where('IDelementy_transakcji', $transElemID);
            $this->db->where('IDprodukty', $idProd);
            $this->db->update('elementy_transakcji', $data);

            return  $this->db->insert_id();
        }

        public function sztukiTransElem($transElemID)
        {
            $this->db->select(' * ');
            $this->db->from('elementy_transakcji');
            $this->db->where('IDelementy_transakcji', $transElemID);
            $query = $this->db->get();

            return $query->row('iloscElementow');
        }

        public function removeTransElem($transElemID,$idProd)
        {
            $this->db->delete('elementy_transakcji', array('IDprodukty' => $idProd, 'IDelementy_transakcji' => $transElemID));

            return  1;
        }

        ////////////////////////Transakcja Zakupu//////////////////////////
        public function buyTransaction($transID,$data,$status)
        {
            $this->load->model('productsModel');
            $produkty=$this->productsModel->getUserProducts($transID);

            $this->db->trans_begin();
            $this->updateTrans($transID,$data,$status);
            $this->load->model('productsModel');
            foreach ($produkty as $produkt)
            {
                $prod=$this->productsModel->oneProduct($produkt->IDprodukty);
                $pZar=$prod['ilosc_zarezerwowana']+$produkt->iloscElementow;
                if($pZar<=$prod['ilosc_cala'])
                {
                    $this->productsModel->editProductRezerw($produkt->IDprodukty,$pZar);
                }
                else
                {
                    $this->db->trans_rollback();
                    return 0;
                }
            }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }

            return 1;
        }

        ////////////////////////Transakcja Wysyłki//////////////////////////
        public function updateIloscTowarowTransaction($transID,$data,$status)
        {
            $this->load->model('productsModel');
            $produkty=$this->productsModel->getUserProducts($transID);

            $this->db->trans_begin();
            $this->updateTrans($transID,$data,$status);
            foreach ($produkty as $produkt)
            {
                $prod=$this->productsModel->oneProduct($produkt->IDprodukty);
                $pZar=$prod['ilosc_zarezerwowana']-$produkt->iloscElementow;
                $pCal=$prod['ilosc_cala']-$produkt->iloscElementow;
                if($pZar>=0 && $pCal>=0)
                {
                    $this->productsModel->editProductRezerw($produkt->IDprodukty,$pZar);
                    $this->productsModel->editProductIlosc($produkt->IDprodukty,$pCal);
                }
                else
                {
                    $this->db->trans_rollback();
                    return 0;
                }
            }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $this->updateTrans($transID,$data,5);
            }
            else
            {
                $this->db->trans_commit();
            }

            return 1;
        }
    }