<?php
class Expansiones extends CI_Model
  {
   function __construct()
    {
          parent::__construct();
    }

  function expansion0($categoria,$subcategoria)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $this->load->helper('url');
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=1 and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlsubcat, $subcat);
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=1 and category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=1 and category.categoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
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
  function expansion1($categoria,$subcategoria)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $this->load->helper('url');
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=2 and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlsubcat, $subcat);
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=2 and category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=2 and category.categoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
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
  function expansion2($categoria,$subcategoria)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $this->load->helper('url');
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=3 and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlsubcat, $subcat);
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=3 and category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=3 and category.categoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
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

    function expansion3($categoria,$subcategoria)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $this->load->helper('url');
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=4 and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlsubcat, $subcat);
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=4 and category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=4 and category.categoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
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

    function expansion4($categoria,$subcategoria)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $this->load->helper('url');
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=5 and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlsubcat, $subcat);
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=5 and category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=5 and category.categoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
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

    function expansion5($categoria,$subcategoria)
    {
      $cat=$categoria;
      $subcat=$subcategoria;
      $this->load->helper('url');
      if($subcat!='99' and $cat=='99')
      {
        //echo "1:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=6 and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlsubcat, $subcat);
      }
      elseif($subcat!='99' and $cat!='99')
      {
        //echo "2:Categoria".$categoria.":subcategoria:".$subCategoria.":";
        $sqlcatsubcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=6 and category.categoria=? and category.subcategoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
        $query=$this->db->query($sqlcatsubcat, array($cat,$subcat));
      }
      elseif ($subcat=='99' and $cat!='99')
       {
        //echo "3:Categoria".$cat.":subcategoria:".$subcat.":";
        $sqlcat="select category.idWow as catid,nombre,subCategoria,priceAuction,dateAuction,sum(quantity) as cantidad,ruta from category inner join timeprice on category.idWow=timeprice.idWow inner join wowhead on timeprice.idWow=wowhead.id where parche=6 and category.categoria=? and dateauction in(select max(dateauction) from timeprice) group by nombre order by wowhead.parche desc, category.idWow desc";
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

}?>