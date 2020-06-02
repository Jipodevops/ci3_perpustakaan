<?php

class Fakultas extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        $this->load->model(array('fakultas_model'));
    }

    public function index(){
        $this->read();
    }

    public function read(){
        $data_fakultas = $this->fakultas_model->read();
            $data = array(
                'theme_page' => 'fakultas/fakultas',
                'judul' => 'Fakultas',
                'data_fakultas' => $data_fakultas
            );

            $this->load->view('theme/index', $data);
    }

    public function insert(){
        $data_fakultas = $this->fakultas_model->read();

        $data = array(
            'theme_page' => 'fakultas/insert_fakultas',
            'judul' => 'Fakultas',
            'data_fakultas' => $data_fakultas
        );

        $this->load->view('theme/index', $data);
    }

    public function insert_submit(){
        $nama_fakultas = $this->input->post('nama_fakultas');

        $data = array(
            'nama_fakultas' => $nama_fakultas
           
        );
        $this->fakultas_model->insert($data);
        redirect('fakultas');
    }

    public function update(){
        $id = $this->uri->segment(3);

        $single_row = $this->fakultas_model->rowRead($id);

        $data = array(
            'judul' => 'Fakultas',
            'theme_page' => 'fakultas/update_fakultas',
            'single_row' => $single_row
        );

        $this->load->view('theme/index', $data);
        
    }

    public function insert_update(){
        $id = $this->uri->segment(3);

        $nama_fakultas = $this->input->post('nama_fakultas');

        $data = array(
            'nama_fakultas' => $nama_fakultas
           
        );
        $this->fakultas_model->update($data, $id);
        redirect('fakultas');
    }

    public function delete(){
        $id = $this->uri->segment(3);
        $this->fakultas_model->delete($id);

        redirect('fakultas');
    }
}