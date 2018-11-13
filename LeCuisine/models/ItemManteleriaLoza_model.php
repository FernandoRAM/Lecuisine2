<?php

  /**
   *
   */
  class ItemManteleriaLoza_model extends Model
  {

    function selectItems()
    {
      //uso, itemL, itemM, cate, color
      $select = "uso.fechaPedido AS 'FechaPedido', uso.fechaUso AS 'FechaUso', il.loza AS 'Loza', il.inventario AS 'InventarioLoza',
                il.restante AS 'RestanteLoza', im.mantel AS 'Mantel',
                im.inventario AS 'InventarioMantel', im.restante AS 'RestanteMantel',
                cm.color AS 'ColorMantel', 	cl.categoria AS 'CategoriaMantel'";
      $table = "usoitem uso, itemloza iL, itemmanteleria iM, colormanteleria cM, categorialoza cL";
      return $this->db->selectStrict($select, $table, "1=1");
    }
  }


?>
