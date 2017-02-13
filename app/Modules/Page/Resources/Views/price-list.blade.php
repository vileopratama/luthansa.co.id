@extends('luthansa::main')
@section('content')
<!-- INNER-BANNER -->
<div class="inner-banner">
		<img class="center-image" src="{!! asset('themes/luthansa/assets/img/detail/bg_2.jpg') !!}" alt="">
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
	<div class="container-fluid">
       	<div class="row">
       		<div class="col-xs-12 col-md-12">
				<!--<div class="detail-content-block">
					<h3 class="small-title">Tarif Sewa Bus Pariwisata</h3>
					<div class="confirm-label bg-dr-blue-2 radius-5">
						<img class="confirm-img" src="img/thx_icon.png" alt="">
						<div class="confirm-title color-white">Thank You. Your Booking Order is Confirmed Now.</div>
						<div class="confirm-text color-white-light">A confirmation email has been sent to your provided email address.</div>
						<a href="#" class="confirm-print c-button b-40 bg-white hv-white-o">print details</a>
					</div>
				</div>-->
				<div class="detail-content-block">
					<h3 class="small-title">Tarif Sewa Bus Pariwisata Per Tahun 2017</h3>
					<div class="table-responsive">
						<table class="table style-1 type-2 striped">
							<thead>
								<tr>
									<th rowspan="2" class="col-md-2 col-lg-2 text-center valign">Tujuan</th>
									<th class="col-md-2 text-center">Commuter Hi-Ace</th>
									<th class="col-md-2 text-center">Elf Short</th>	
									<th class="col-md-2 text-center">Elf Long</th>
									<th class="col-md-2 text-center">Medium Bus</th>	
									<th class="col-md-2 text-center">Big Bus</th>	
								</tr>
								<tr>
									<th class="text-center">10 - 15 seats</th>
									<th class="text-center">12 - 15 seats</th>
									<th class="text-center">17 - 21 seats</th>
									<th class="text-center">25 - 33 seats</th>
									<th class="text-center">40 - 59 seats</th>	
								</tr>	
							</thead>
							<tbody>
								<tr>
									<td colspan="6" class="text-center"><strong>Tarif Sewa 1 Hari (tidak Menginap)</strong></td>
								</tr>
								<tr>
									<td>Transfer Dalam Kota Jakarta/Airport Soekarno Hatta <br/>(One Way Trip Satu Arah)</td>
									<td>1.000.000</td>
									<td>950.000</td>
									<td>1.000.000</td>
									<td>1.400.000</td>
									<td>1.900.000</td>	
								</tr>
								<tr>
									<td>Wisata Dalam Kota Jakarta</td>
									<td>1.300.000</td>
									<td>1.100.000</td>
									<td>1.300.000</td>
									<td>1.700.000</td>	
									<td>2.500.000</td>	
								</tr>
								<tr>
									<td>Cikupa/Balaraja/Cikarang/Karawaci/Tangerang</td>
									<td>1.500.000</td>
									<td>1.300.000</td>
									<td>1.500.000</td>
									<td>1.900.000</td>
									<td>2.800.000</td>	
								</tr>
								<tr>
									<td>Bogor/Sentul/Taman Safari/Lido/Mega Mendung/Gunung Mas/<br/>Cinangneng/Cimelati/Leuwiliang/Karawang/Gn.Salak/<br/>Tapos/Ciawi/Rancamaya/Curug/Nangka/Highland</td>
									<td>1.600.000</td>
									<td>1.350.000</td>
									<td>1.600.000</td>
									<td>2.400.000</td>
									<td>3.200.000</td>	
								</tr>
								<tr>
									<td>Cipanas/Cibodas/Ciloto/Cimacan/Jatiluhur/Purwakarta/Cikampek/<br/>Quiling</td>
									<td>1.700.000</td>
									<td>1.450.000</td>
									<td>1.700.000</td>
									<td>2.500.000</td>
									<td>3.400.000</td>	
								</tr>
								<tr>
									<td>Cilegon/Serang/Carita/Anyer/KarangBolong/Florida/Sukabumi</td>
									<td>1.800.000</td>
									<td>1.500.000</td>
									<td>1.800.000</td>
									<td>2.500.000</td>
									<td>3.500.000</td>	
								</tr>
								<tr>
									<td>Bandung Kota/Maribaya/Ciateur/Tangkuban Parahu/Indramayu/Banten/<br/>Citatih/Pelabuhan Ratu/Citarik/Cianjur</td>
									<td>1.900.000</td>
									<td>1.600.000</td>
									<td>1.900.000</td>
									<td>2.800.000</td>
									<td>3.900.000</td>	
								</tr>
								<tr>
									<td>Sipatutenggang/Jatinangor/Pangalengan/Sumedang/Suryalaya/<br/>Cileunyi/Tj Lesung/Labuan</td>
									<td>2.100.000</td>
									<td>1.750.000</td>
									<td>2.100.000</td>
									<td>3.000.000</td>
									<td>4.400.000</td>	
								</tr>
								<tr>
									<td>Cirebon/Kuningan/Garut Kota/Kamojang/Darajat Pass</td>
									<td>2.600.000</td>
									<td>1.900.000</td>
									<td>2.800.000</td>
									<td>3.600.000</td>
									<td>4.800.000</td>	
								</tr>
								<tr>
									<td colspan="6" class="text-center"><b>Tarif Sewa 2 Hari (Menginap)</b></td>
								</tr>
								<tr>
									<td>Bogor/Sentul/Taman Safari/Lido/Mega Mendung/Gunung Mas/<br/>Cinangneng/Cimelati/Leuwiliang/Karawang/Gn.Salak/<br/>Tapos/Ciawi</td>
									<td>3.200.000</td>
									<td>2.700.000</td>
									<td>3.200.000</td>
									<td>4.600.000</td>
									<td>6.200.000</td>	
								</tr>
								<tr>
									<td>Cipanas/Cibodas/Ciloto/Cimacan/Jatiluhur/Purwakarta/Cikampek/<br/>Quilling</td>
									<td>3.400.000</td>
									<td>2.900.000</td>
									<td>3.400.000</td>
									<td>4.800.000</td>
									<td>6.400.000</td>	
								</tr>
								<tr>
									<td>Cilegon/Serang/Carita/Anyer/Karang Bolong/Florida/Sukabumi</td>
									<td>3.600.000</td>
									<td>3.000.000</td>
									<td>3.600.000</td>
									<td>5.000.000</td>
									<td>7.000.000</td>	
								</tr>
								<tr>
									<td>Bandung Kota/Maribaya/Ciateur/Tangkuban Parahu/Indramayu/<br/>Banten/Citatih/Pelabuhan Ratu/Citarik/Cianjur
									</td>
									<td>3.800.000</td>
									<td>3.200.000</td>
									<td>3.800.000</td>
									<td>5.600.000</td>
									<td>7.800.000</td>	
								</tr>
								<tr>
									<td>Cirebon/Kuningan/Situpatenggang/Jatinangor/Garut/Ciamis/<br/>Pangalengan/Sumedang/Tasikmalaya/Suryalaya/Cileunyi/<br/>Majalengka/Drajat Pass 
									</td>
									<td>4.100.000</td>
									<td>3.500.000</td>
									<td>4.100.000</td>
									<td>6.000.000</td>
									<td>8.500.000</td>	
								</tr>
								<tr>
									<td>Cikajang Garut/Pamengpeuk/Santolo/Sawarna/Ujung Genteng 
									</td>
									<td>4.800.000</td>
									<td>3.900.000</td>
									<td>4.800.000</td>
									<td>6.500.000</td>
									<td>9.300.000</td>	
								</tr>
								<tr>
									<td colspan="6" class="text-center"><b>Tarif Sewa > 3 Hari (Menginap)</b></td>
								</tr>	
								<tr>
									<td>Pangandaraan/Sawarna/Cilacap/Pamijahan/Pulau Umang/Guci/<br/>Baturaden/Tegal/Bagedur (<span><i class="text-danger">3 hari</i></span>)
									</td>
									<td>5.400.000</td>
									<td>4.700.000</td>
									<td>5.400.000</td>
									<td>8.100.000</td>
									<td>10.800.000</td>	
								</tr>
								<tr>
									<td>Jawa Tengah (<span><i class="text-danger">3 hari</i></span>)(Dieng,Purwekerto,Pekalongan,Tegal,Brebes,Slawi,Cilacap)
									</td>
									<td>6.600.000</td>
									<td>5.800.000</td>
									<td>6.700.000</td>
									<td>9.200.000</td>
									<td>12.500.000</td>	
								</tr>
								<tr>
									<td>Jawa Tengah (<span><i class="text-danger">4 hari</i></span>) <i> (Wonosari/Kaliurang +500.000)</i></td>
									<td>7.200.000</td>
									<td>6.000.000</td>
									<td>7.200.000</td>
									<td>11.200.000</td>
									<td>15.000.000</td>	
								</tr>
								<tr>
									<td>Jawa Timur (Surabaya,Mojokerto,Malang,Batu,Madiun,Pasuruan) (<span><i class="text-danger">5 hari</i></span>)</td> 
									<td>9.000.000</td>
									<td>7.500.000</td>
									<td>9.000.000</td>
									<td>14.200.000</td>
									<td>19.000.000</td>	
								</tr>
								<tr>
									<td>Jawa Timur (Situbondo,Banyuwangi,Jember,Madura)(<span><i class="text-danger">6 hari</i></span>) </td>
									<td>10.800.000</td>
									<td>9.000.000</td>
									<td>10.800.000</td>
									<td>16.800.000</td>
									<td>22.800.000</td>	
								</tr>	
								<tr>
									<td>Bali(<span><i class="text-danger">8 hari</i></span>) </td>
									<td>14.400.000</td>
									<td>12.000.000</td>
									<td>14.400.000</td>
									<td>22.400.000</td>
									<td>30.400.000</td>	
								</tr>
								<tr>
									<td>Bali,Lombok,Sumbawa(<span><i class="text-danger">10 hari</i></span>) </td>
									<td>18.000.000</td>
									<td>15.000.000</td>
									<td>18.000.000</td>
									<td>28.000.000</td>
									<td>38.000.000</td>	
								</tr>
								<tr>
									<td>Lampung(<span><i class="text-danger">3 hari</i></span>) </td>
									<td>5.500.000</td>
									<td>4.500.000</td>
									<td>5.500.000</td>
									<td>8.400.000</td>
									<td>12.500.000</td>	
								</tr>
								<tr>
									<td>Palembang (<span><i class="text-danger">5 hari</i></span>) , Bengkulu  (<span><i class="text-danger">6 hari</i></span>), Jambi (<span><i class="text-danger">7 hari</i></span>), Pekanbaru (<span><i class="text-danger">10 hari</i></span>) , Padang (<span><i class="text-danger">11 hari</i></span>) , Medan (<span><i class="text-danger">14 hari</i></span>) , Aceh (<span><i class="text-danger">15 hari</i></span>)
									</td>
									<td colspan="5" class="text-center" style="background:#FF6600;color:#fff">Harga Dapat Berubah Sewaktu-waktu</td>
								</tr>
								<tr>
									<td colspan="6" class="text-center"><b>Tambahan Biaya Kelebihan Waktu</b></td>
								</tr>
								<tr>
									<td>Per jam</td>
									<td>165.000</td>
									<td>150.000</td>
									<td>175.000</td>
									<td>275.000</td>
									<td>375.000</td>	
								</tr>
								<tr>
									<td>Per Hari</td>
									<td>1.750.000</td>
									<td>1.500.000</td>
									<td>1.800.000</td>
									<td>2.750.000</td>
									<td>3.800.000</td>	
								</tr>
								<tr>
									<td colspan="6" class="text-center"><b>Tambahan Biaya Penjemputan di luar kota</b></td>
								</tr>
								<tr>
									<td>Bekasi, Depok, Pamulang
									</td>
									<td>150.000</td>
									<td>150.000</td>
									<td>150.000</td>
									<td>200.000</td>
									<td>300.000</td>	
								</tr>
								<tr>
									<td>Cibitung, Cikarang
									</td>
									<td>250.000</td>
									<td>250.000</td>
									<td>250.000</td>
									<td>400.000</td>
									<td>500.000</td>	
								</tr>
								<tr>
									<td>Balaraja/Karawang/Bogor/Cikupa
									</td>
									<td>500.000</td>
									<td>500.000</td>
									<td>500.000</td>
									<td>900.000</td>
									<td>1.100.000</td>	
								</tr>
								<tr>
									<td>Serang/Anyer/Cilegon/Purwakarta/Sukabumi
									</td>
									<td>1.250.000</td>
									<td>1.200.000</td>
									<td>1.250.000</td>
									<td>1.700.000</td>
									<td>2.200.000</td>	
								</tr>			
							</tbody>
						</table>
				    </div>					
				</div>
				<div class="detail-content-block">
					<div class="simple-text">
						<h3>Syarat & Ketentuan</h3>
						<ul>
							<li>Harga tidak berlaku untuk Lebaran, Natal & Tahun Baru</li>
							<li>Harga sewa SUDAH TERMASUK bahan bakar dan jasa pengemudi.</li>
							<li>Harga Sewa BELUM TERMASUK tiket masuk obyek wisata, biaya tol, parkir, retribusi daerah, makan crew, biaya penyeberangan (ferry) serta TIPS pengemudi & kenek.</li>
							<li>Pemesanan dianggap sah apabila sudah ada pembayaran uang muka (DP) sebesar 50% dari harga sewa.</li>
							<li>Pembayaran diharapkan dilunasi 3 hari sebelum hari keberangkatan.</li>
							<li>Uang muka yang telah dibayarkan TIDAK DAPAT dikembalikan jika terjadi pembatalan sewa.</li>
							<li>Kehilangan barang atau tertukar di dalam bus bukan tanggung jawab pengelola bus dan crew.</li>
							<li>Biaya Sewa dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</li>
							<li>Pengemudi berhak menolak jalan yang tidak memadai / dilarang petugas / membahayakan keselamatan.</li>
							<li>Semua penumpang dilindungi dengan asuransi sesuai dengan ketentuan yang berlaku.</li>
							<li>Batas waktu pemakaian Bus paling pagi mulai dari pukul 05.00 WIB sampai dengan maksimal pukul 23.00 WIB (<i>1 Hari</i>).</li>
							<li>Pemakaian melebihi pukul 23.00 WIB dikenakan biaya Overtime Charge  sesuai dengan harga tersebut diatas.</li>
							<li>Penjemputan untuk area dalam kota Jakarta <strong>GRATIS</strong></li>
							<li>Penyewa bertanggung jawab apabila merusak Kendaraan / Bus.</li>	
						</ul>
						
					</div>
				</div>
				<!---
				<div class="detail-content-block">
					<div class="simple-text">
						<h3>View Booking Details</h3>
						<p class="color-grey">Pellentesque ac turpis egestas, varius justo et, condimentum augue. Praesent aliquam, nisl feugiat vehicula condimentum, justo tellus scelerisque metus. Pellentesque ac turpis egestas, varius justo et, condimentum augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<div class="custom-panel bg-grey-2 radius-4">
							<a class="color-dr-blue-2 link-dark-2" href="#">https://www.letstravel.com/booking-details/?=f4acb19f-9542-4a5c-b8ee</a>
						</div>
					</div>
				</div>
					-->
       		</div>
       		
       	</div>
	</div>
</div>
@endsection		