<?php
 class Profesiones extends CI_Controller{
  public $id_registro;

  function index()
  {
   $this->load->model('helloworld_model');
 
   $data['result'] = $this->helloworld_model->getData();
   $data['page_title'] = "Pagina de prueba!";
 
   $this->load->view('helloworld_view',$data);
     }

  function showplants()
  {
   $this->load->model('plantas_model');
 
   $data['result'] = $this->plantas_model->getData();
   $data['raizruta']="http://wow.zamimg.com/images/wow/icons/medium/";
   $data['extension']=".jpg";
   //$datos['result']=$this->plantas_model->createGrafics($data[]);
   $data['bench']='Benchmark:'.$this->benchmark->elapsed_time();
   foreach ($data['result'] as $fila) 
   {
       $id_registro=$fila->catid;
       $tarea=$this->plantas_model->createGrafics7($id_registro);
   /* PARTE A EDITAR*/



/*----------------------------------------------------*/
    }
    $data['head_content']=$this->load->view('cabecera_view',TRUE);
    $this->load->view('plantas_view',$data);
    $this->load->view('footer_view');

  }
  function showgrafics(){
    
    $this->load->model('plantas_model',$datos);
    $datos['result']=$this->plantas_model->createGrafics();


  }
 }
?>