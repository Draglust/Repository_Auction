<?php
 class Mostrar extends CI_Controller{
  public $id_registro;

  function index()
  {
   $this->load->model('listado');
   $this->load->model('expansiones');
   $data['result'] = $this->listado->lista('15',$subcategoria);
   $data['page_title'] = "Pagina por defecto";
 
  //$this->load->view('defecto',$data);
     }

  function show()
  {
    $this->load->helper('url');
    $this->load->model('listado');
 // $this->load->model('expansiones');

    $categoria=$this->uri->segment(3,99);
    $subcategoria=$this->uri->segment(4,99);

    $dataexp[1]='World of Warcraft';
    $dataexp[2]='The Burning Crusade';
    $dataexp[3]='The Lich King';
    $dataexp[4]='Cataclysm';
    $dataexp[5]='Mysts of Pandaria';
    $dataexp[6]='Warlords of Draenor';
    $dato['urlb']=base_url();
   $dato['result']=$this->listado->listacategoria();
   
   /*$datac0=$this->listado->calculoclase($data0);
   $datac0['expansion']='World of Warcraft';
   $data1['result']=$this->listado->expansion0($categoria,$subcategoria,2);
   $datac1=$this->listado->calculoclase($data1);
   $datac1['expansion']='The Burning Crusade';
   $data2['result']=$this->listado->expansion0($categoria,$subcategoria,3);
   $datac2['result']=$this->listado->calculoclase($data2['result']);
   $datac2['expansion']='The Lich King';
   $data3['result']=$this->listado->expansion0($categoria,$subcategoria,4);
   $datac3['result']=$this->listado->calculoclase($data3['result']);
   $datac3['expansion']='Cataclysm';
   $data4['result']=$this->listado->expansion0($categoria,$subcategoria,5);
   $datac4['result']=$this->listado->calculoclase($data4['result']);
   $datac4['expansion']='Mysts of Pandaria';
   $data5['result']=$this->listado->expansion0($categoria,$subcategoria,6);
   $datac['result']=$this->listado->calculoclase($data5['result']);
   $datac5['expansion']='Warlords of Draenor';*/
   //$data['result'] = $this->listado->lista($categoria,$subcategoria);

   
  /*---------------------------------------------------------------------------*/ 
    //print_r($datac0);

   /*-------------------------------------------------------------------------------*/ 

  $this->load->view('cabecera_view');
  $this->load->view('lateral_view',$dato);
  $this->load->view('abrecolumn_view');
  for ($i=6; $i > 0 ; $i--) { 
     $data0['result']=$this->listado->expansion0($categoria,$subcategoria,$i);
     $datac=$this->listado->calculoclase($data0);
     $datac['expansion']=$dataexp[$i];
     $datac['raizruta']="http://wow.zamimg.com/images/wow/icons/small/";
     $datac['extension']=".jpg";
     $datac['urlb']=base_url();
     $this->load->view('expansion_view',$datac);
   }
  /*$this->load->view('expansion_view',$datac0);
  $this->load->view('expansion_view',$datac1);
  $this->load->view('expansion_view',array($datac2,$data));
  $this->load->view('expansion_view',array($datac3,$data));
  $this->load->view('expansion_view',array($datac4,$data));
  $this->load->view('expansion_view',array($datac5,$data));*/
  $this->load->view('footer_view');
  }
 
  function grafico()
  {
    $this->load->helper('url');
    $this->load->model('listado');
    $idrow=$this->uri->segment(3,NULL);
    $data=$this->listado->graficos($idrow);
    $this->load->view('grafica_view',$data);
    
  }
 

  }?>
