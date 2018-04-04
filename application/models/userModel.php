<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class userModel extends CI_Model
  {
        public function __construct()
        {
          parent::__construct();
          $this->load->database();
        }

        ////////////////////////Wysyłanie Wszystkich Użytkowników Liczenie i Strony///////////////////////////
        public function allUser()
        {
          $query = $this->db->get('uzytkownicy');
          return $query->result();
        }

        public function allUserCount()
        {
          $this->db->select('count(*) AS liczba');
          $query = $this->db->get('uzytkownicy');

          return $query->row('liczba');
        }

        public function pageUser($fIndex)
        {
          $query = $this->db->get('uzytkownicy', 4, $fIndex);
          return $query->result();
        }

        ////////////////////////Logowanie Użytkowników///////////////////////////
        public function login($login,$password)
        {
            $this->db->select('*');
            $this->db->from('uzytkownicy');
            $this->db->join('uprawnienia', 'uprawnienia.IDuprawnienia = uzytkownicy.IDuprawnienia');
            $this->db->where('uzytkownicy.login ', $login);
            $this->db->where('uzytkownicy.haslo', $password);
            $query = $this->db->get();
            $result=$query->result_array();
            if(!(isset($result[0])))
            {
                $result[0]=0;
            }
            return $result[0];
        }

        ////////////////////////Dodawanie i Edycja Użytkowników///////////////////////////
        public function addUser($login,$password,$name,$surrname,$sex,$age,$street,$zip,$post,$city,$adress,$woj)
        {
            $data = array(
                'IDuzytkownicy' => ' ',
                'login' => $login,
                'haslo' => $password,
                'IDuprawnienia' => '1',
                'imie' => $name,
                'nazwisko' => $surrname,
                'plec' => $sex,
                'wiek' => $age,
                'ulica' => $street,
                'kodPocztowy' => $zip,
                'poczta' => $post,
                'miejscowosc' => $city,
                'adres' => $adress,
                'wojewodztwo' => $woj
                );
            $this->db->insert('uzytkownicy', $data);

            return $this->db->insert_id();
        }

        public function editUser($userID, $login,$password,$name,$surrname,$sex,$age,$street,$zip,$post,$city,$adress,$woj)
        {
            $data = array(
                'login' => $login,
                'haslo' => $password,
                'imie' => $name,
                'nazwisko' => $surrname,
                'plec' => $sex,
                'wiek' => $age,
                'ulica' => $street,
                'kodPocztowy' => $zip,
                'poczta' => $post,
                'miejscowosc' => $city,
                'adres' => $adress,
                'wojewodztwo' => $woj
            );

            $this->db->where('IDuzytkownicy', $userID);
            $this->db->update('uzytkownicy', $data);

            return $this->db->insert_id();
        }

        public function userExist($login)
        {
            $this->db->select('count(*) AS liczba');
            $this->db->from('uzytkownicy');
            $this->db->where('login ', $login);
            $query = $this->db->get();

            return $query->row('liczba');
        }

        ////////////////////////Sprawdzanie Uprawnień Użytkowników///////////////////////////
        public function checkUpr($usersID)
        {
            $this->db->select('uprawnienia.uprawnienia');
            $this->db->from('uzytkownicy');
            $this->db->join('uprawnienia', 'uprawnienia.IDuprawnienia = uzytkownicy.IDuprawnienia');
            $this->db->where('uzytkownicy.IDuzytkownicy', $usersID);
            $query = $this->db->get();

            return $query->row('uprawnienia');
        }

        ////////////////////////Wysyłanie Jednego Użytkownika///////////////////////////
        public function oneUser($userID)
        {
          $this->db->select('*');
          $this->db->from('uzytkownicy');
          $this->db->where('IDuzytkownicy', $userID);
          $query = $this->db->get();
          $result=$query->result_array();
          return $result[0];
        }
  }
?>