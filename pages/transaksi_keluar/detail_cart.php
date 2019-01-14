<?php
      session_start();
      error_reporting(0);
      include '../../config/koneksi.php';
      include 'item.php';
      $cart = unserialize(serialize($_SESSION['cart_keluar']));
      $no = 1;
      $index = 0;
      $total = 0;
      for($i=0;$i<count($cart);$i++){
      $id_detail_logistik = $cart[$i]->id_detail_logistik;
      $query = $connect->query("SELECT detail_logistik.id_detail_logistik,detail_logistik.id_logistik,logistik.nm_logistik,detail_logistik.tgl_masuk,jml_detail_stok,harga_satuan,anggaran.asal_anggaran,exp_date FROM detail_logistik JOIN logistik ON detail_logistik.id_logistik=logistik.id_logistik JOIN anggaran ON detail_logistik.id_anggaran=anggaran.id_anggaran WHERE detail_logistik.id_detail_logistik='$id_detail_logistik'");
      foreach($query as $data){
            $nama = $data['nm_logistik'];
            $nm_anggaran = $data['asal_anggaran'];
            $exp_date = $data['exp_date'];
            $harga = $data['harga_satuan'];
            $total += $harga * $cart[$i]->detail_qty_ambil;
      }
      ?>
      <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $nama; ?></td>
            <td><?php echo $nm_anggaran ?></td>
            <td><?php echo $exp_date ?></td>
            <td><?php echo "Rp. ".number_format($harga,2,',','.'); ?></td>
            <td><?php echo $cart[$i]->detail_qty_ambil; ?></td>
            <td><?php echo "Rp. ".number_format($harga*$cart[$i]->detail_qty_ambil,2,',','.'); ?></td>
            <td><button type="button" onclick="deleteCart(<?php echo $index ?>)" class="btn btn-sm btn-outline-danger"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></button></td>
      </tr>

<?php  
      $index++;
      } 
?>
      <tr>
            <td colspan="6" style="text-align:right;font-weight:bold;">Grand Total : </td>
            <td><?php echo "Rp. ".number_format($total,2,',','.'); ?></td>
      </tr>