<?php
	session_start();
	$cart = unserialize(serialize($_SESSION['cart_keluar']));
	unset($cart[$_POST['index']]);
	$cart = array_values($cart);
	$_SESSION['cart_keluar'] = $cart;
?>