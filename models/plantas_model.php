<?php
class Plantas_model extends CI_Model {
    public $customValue;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
     
    function getData()
  {
    $this->load->helper('url');
    $sql_experimental='select *,sum(quantity) from timeprice where idwow=118675 and dateauction in(select max(dateauction) from timeprice)';
   $sql1="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by category.idWow desc";
   $query=$this->db->query($sql1, array('Objetos Comerciables', 'Hierbas'));
    
   if ($query->num_rows() > 0)
   {
    return $query->result();
    
    //$sql2="select id,nombre,priceAuction,numericDate,dateAuction,quantity from wowhead inner join timeprice on wowhead.id=timeprice.idwow where datediff(curdate(),dateauction)<7 and idwow=? group by dateauction";
    //$query2=$this->query($sql2,)

   }else{
    //show_error('Database is empty!');
   }
  }

   function createGrafics7($id_registro)
  {
    
      $sql2="select id,nombre,priceAuction,numericDate,dateAuction,quantity from wowhead inner join timeprice on wowhead.id=timeprice.idwow where datediff(curdate(),dateauction)<7 and idwow=? group by dateauction";
      $query2=$this->db->query($sql2, $id_registro);

    foreach ($query2->result_array() as $row)
    {
        $precioAjustado=round($row['priceAuction']/10000,2,PHP_ROUND_HALF_UP);
        $fechaAjustada=$row['numericDate'];
        $precios[]=$precioAjustado;
        $fechas[]="'".date('d-m H:i',$fechaAjustada)."'";
        $cantidades[]=$row['quantity'];
        $valores[]=$row['priceAuction'];
    }
    $vals=$this->customValue=$valores;
    $dats['precio']=$precios;
    $dats['fecha']= $fechas;
    $dats['cantidade']=$cantidades;
    return $dats;
    
  }

  function precioMedio($valores)
  {
    $precioMax=0;
    $precioMin=1000000000;
    $dateMax=0;
    $dateMin=0;
    foreach ($this->customValue as $valor) {

    if($precioMax<$valor){
      $precioMax=$valor/10000;
      $precioMax=round($precioMax,2,PHP_ROUND_HALF_UP);
      $dateMax=$innerRow[4];
    }
    elseif($precioMin>$valor){
      $precioMin=$valor/10000;
      $precioMin=round($precioMin,2,PHP_ROUND_HALF_UP);
      $dateMin=$innerRow[4];
    }
    }
  }
 
}
?>