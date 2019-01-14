<?php
      session_start();
      error_reporting(0);
      include '../../config/koneksi.php';
      include 'item.php';
      $cart = unserialize(serialize($_SESSION['cart_masuk']));
      $no = 1;
      $index = 0;
      $total = 0;
      for($i=0;$i<count($cart);$i++){
      $id = $cart[$i]->id;
      $query = $connect->query("SELECT nm_logistik FROM logistik WHERE id_logistik='$id'");
      foreach($query as $data){
            $nama[$i] = $data['nm_logistik'];
            $total += $cart[$i]->harga * $cart[$i]->qty;
      }
      ?>
      <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $nama[$i]; ?></td>
            <td><?php echo $cart[$i]->asal_anggaran ?></td>
            <td><?php echo $cart[$i]->exp_date ?></td>
            <td><?php echo $cart[$i]->qty; ?></td>
            <td><?php echo "Rp.".number_format($cart[$i]->harga,'2',',','.'); ?></td>
            <td><?php echo "Rp. ".number_format($cart[$i]->harga * $cart[$i]->qty,2,',','.'); ?></td>
            <td><button type="button" onclick="deleteCart(<?php echo $index ?>)" class="btn btn-sm btn-outline-danger"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></button></td>
      </tr>

<?php  
      $index++;
      } 
?>
      <tr>
            <td colspan="6" style="text-align:center;">Grand Total</td>
            <td><?php echo "Rp. ".number_format($total,2,',','.'); ?></td>
      </tr>