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
      $query = $connect->query("SELECT nm_logistik,harga_satuan FROM logistik WHERE id_logistik='$id'");
      foreach($query as $data){
            $nama[$i] = $data['nm_logistik'];
            $harga[$i] = $data['harga_satuan'];
            $total += $harga[$i] * $cart[$i]->qty;
      }
      ?>
      <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $nama[$i]; ?></td>
            <td><?php echo "Rp. ".number_format($harga[$i],2,',','.'); ?></td>
            <td><?php echo $cart[$i]->qty; ?></td>
            <td><?php echo "Rp. ".number_format($data['harga_satuan']*$cart[$i]->qty,2,',','.'); ?></td>
            <td><button type="button" onclick="deleteCart(<?php echo $index ?>)" class="btn btn-sm btn-outline-danger"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></button></td>
      </tr>

<?php  
      $index++;
      } 
?>
      <tr>
            <td colspan="4">Grand Total</td>
            <td><?php echo "Rp. ".number_format($total,2,',','.'); ?></td>
      </tr>