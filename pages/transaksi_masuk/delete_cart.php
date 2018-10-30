<?php
	session_start();
	$cart = unserialize(serialize($_SESSION['cart_masuk']));
	unset($cart[$_POST['index']]);
	$cart = array_values($cart);
	$_SESSION['cart_masuk'] = $cart;
?>