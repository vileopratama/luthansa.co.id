<?php
if (!function_exists('be_regarded')) {
	function be_regarded($x) {
        $number = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
		if ($x < 12)
			return " " . $number[$x];
		elseif ($x < 20)
			return be_regarded($x - 10) . " Belas";
		elseif ($x < 100)
			return be_regarded($x / 10) . " Puluh" . be_regarded($x % 10);
		elseif ($x < 200)
			return "seratus" . be_regarded($x - 100);
		elseif ($x < 1000)
			return be_regarded($x / 100) . " Ratus" . be_regarded($x % 100);
		elseif ($x < 2000)
			return "seribu" . be_regarded($x - 1000);
		elseif ($x < 1000000)
			return be_regarded($x / 1000) . " Ribu" . be_regarded($x % 1000);
		elseif ($x < 1000000000)
			return be_regarded($x / 1000000) . " Juta" . be_regarded($x % 1000000);
	}
}

