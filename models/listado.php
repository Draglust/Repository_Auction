<?php
class Listado extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
     
    function lista($categoria,$subcategoria)
  {
    $cat=$categoria;
    $subcat=$subcategoria;
    $this->load->helper('url');
    if($subcat!='99' and $cat=='99')
    {
      //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
      $sqlsubcat="select lista_categorias.id_categoria as catid,nombre,subcategoria_nombre,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from lista_categorias inner join timeprice on lista_categorias.id_categoria=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where lista_categorias.subcategoria_nombre=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, lista_categorias.id_categoria desc";
      $query=$this->db->query($sqlsubcat, $subcat);
    }
    elseif($subcat!='99' and $cat!='99')
    {
      //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
      $sqlcatsubcat="select lista_categorias.id_categoria as catid,nombre,subcategoria_nombre,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from lista_categorias inner join timeprice on lista_categorias.id_categoria=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where lista_categorias.categoria_nombre=? and lista_categorias.subcategoria_nombre=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, lista_categorias.id_categoria desc";
      $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
    }
    elseif ($subcat=='99' and $cat!='99')
     {
      //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
      $sqlcat="select lista_categorias.id_categoria as catid,nombre,subcategoria_nombre,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from lista_categorias inner join timeprice on lista_categorias.id_categoria=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where lista_categorias.categoria_nombre=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, lista_categorias.id_categoria desc";
      $query=$this->db->query($sqlcat, $cat);
    }
    else
    {
      echo "Categoria y subcategoria vacias";
    }

   if ($query->num_rows() > 0)
   {
    return $query->result_array();

   }
   else
   {
    //show_error('Database is empty!');
   }
  }

  function listacategoria()
  {
    $sqllistcat='select distinct subcategoria_nombre,categoria_nombre from lista_categorias order by categoria_nombre asc';
    $query=$this->db->query($sqllistcat);
    
     
    return $query->result();
  }
  function datosgrafica($idgraph)
  {
    $id=$idgraph;
    $sql7="select id,min(priceAuction) as priceAuction,dateAuction,numericDate from wowhead inner join timeprice on wowhead.id=timeprice.idwow where datediff(curdate(),dateauction)<15 and idwow=? group by dateauction";
    $query=$this->db->query($sql7, $id);
    return $query->result();
  }

   function expansion0($categoria,$subcategoria,$parche)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $patch=$parche;
      $this->load->helper('url');
      //echo "1:Categoria:".$cat.":subcategoria:".$subcat.":".$patch;
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select lista_categorias.id_categoria as catid,nombre,subcategoria_nombre,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from lista_categorias inner join timeprice on lista_categorias.id_categoria=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=? and lista_categorias.subcategoria_nombre=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, lista_categorias.id_categoria desc";
        $query=$this->db->query($sqlsubcat, array($patch,$subcat));
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select lista_categorias.id_categoria as catid,nombre,subcategoria_nombre,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from lista_categorias inner join timeprice on lista_categorias.id_categoria=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=? and lista_categorias.categoria_nombre=? and lista_categorias.subcategoria_nombre=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, lista_categorias.id_categoria desc";
        $query=$this->db->query($sqlcatsubcat, array($patch,$cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select lista_categorias.id_categoria as catid,nombre,subcategoria_nombre,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from lista_categorias inner join timeprice on lista_categorias.id_categoria=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=? and lista_categorias.categoria_nombre=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, lista_categorias.id_categoria desc";
        $query=$this->db->query($sqlcat, array($patch,$cat));
      }
      else
      {
        echo "Categoria y subcategoria vacias";
      }

     if ($query->num_rows() > 0)
     {
      
      return $query->result_array();

     }
     else
     {
      //show_error('Database is empty!');
     }
    }

    function calculoclase($retornado)
    {
      $resultado=$retornado;
      foreach ($resultado['result'] as &$each) {

      $grafic['result']=$this->datosgrafica($each['catid']);
      $precioMax=0;
      $precioMin=1000000000;
      $contador=0;
      foreach ($grafic['result'] as $valor) {
        
        $util=$valor->priceAuction/10000;
       
        if($precioMax<$util)
          {
            $precioMax=$util;
            $precioMax=round($precioMax,2,PHP_ROUND_HALF_UP);
            $dateMax=$valor->numericDate;
            
          }
        if($precioMin>$util)
          {
            $precioMin=$util;
            $precioMin=round($precioMin,2,PHP_ROUND_HALF_UP);
            $dateMin=$valor->numericDate; 
          } 
      }
        $diffecha=$dateMax-$dateMin;
        if($precioMax==0){$precioMax=0.0001;}
        if($precioMin==0){$precioMin=0.0001;}
        if($diffecha<0)
        {
          $precioAvg=round(((($precioMax)/$precioMin)*100)-100,2,PHP_ROUND_HALF_UP);
        }
        else
        {
          $precioAvg=round(((($precioMin)/$precioMax)*100)-100,2,PHP_ROUND_HALF_UP);
        }
        if($precioAvg>=500){
          $clase='up';
        }
        elseif ($precioAvg<500 and $precioAvg>200) {
          $clase='inclinate';
        }
        elseif ($precioAvg<0) {
          $clase='down';
        }
        else{
          $clase='nochange';
        }
     $each['clase']=$clase;  
     //echo $each['clase']."<br>";   
    }
    return $resultado; 
    }
    function graficos($idgraph)
    {
      $id=$idgraph;
      $sql7="select id,nombre,priceAuction,numericDate,dateAuction,quantity from wowhead inner join timeprice on wowhead.id=timeprice.idwow where datediff(curdate(),dateauction)<7 and idwow=? group by dateauction";
      $query7=$this->db->query($sql7, $id);

      foreach ($query7->result_array() as $row)
      {
          $precioAjustado=round($row['priceAuction']/10000,2,PHP_ROUND_HALF_UP);
          $fechaAjustada=$row['numericDate'];
          $precios[]=$precioAjustado;
          $fechas[]="'".date('d-m H:i',$fechaAjustada)."'";
          $cantidades[]=$row['quantity'];
          $nombre=$row['nombre'];


      }
      
      $dats['precio7']=join(",",$precios);
      $dats['fecha7']= join(",",$fechas);
      $dats['cantidades7']=join(",",$cantidades);


      return $dats;
    }

}
?>