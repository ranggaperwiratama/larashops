
<!--basic scripts-->

	
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/themes-back/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/themes-back/themes/js/jquery.ui.touch-punch.min.js"></script>
		
		<script src="../assets/themes-back/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/themes-back/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/themes-back/js/jquery.sparkline.min.js"></script>
		
		<script src="../assets/themes-back/js/jquery.flot.min.js"></script>
		<script src="../assets/themes-back/js/jquery.flot.pie.min.js"></script>
		<script src="../assets/themes-back/js/jquery.flot.resize.min.js"></script>

		<!--w8 scripts-->

		<script src="../assets/themes-back/js/w8-elements.min.js"></script>
		<script src="../assets/themes-back/js/w8.min.js"></script>
		<!--<script type="text/javascript" src="../assets/themes-back/js/chart/jquery.min.js"></script>-->
		<script src="../assets/themes-back/js/chart/highcharts.js"></script>
		<!-- javascript untuk menampilkan statistik-->
		<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'area',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Total Transaksi per Bulan',
                x: -20 //center
            },
            subtitle: {
                text: 'LARA Shop',
                x: -20
            },
            xAxis: {
				categories: [
				<?php
					//mengambil data bulan dari invoice
					$a = "SELECT DISTINCT DATE_FORMAT(tanggal, '%M') as bulan FROM invoice";
					$query_a = mysql_query($a) or die(mysql_error());
					$no = mysql_num_rows($query_a);
					while($dt = mysql_fetch_array($query_a)){
						$bulan = $dt['bulan'];
						If($no == 0){
							echo "'".$bulan."'";
						}else{
							echo "'".$bulan."',";
						}
					}
				?>]
            },
            yAxis: {
                title: {
                    text: 'pendapatan dalam Rp'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y ;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [
					{
						name: 'Total Transaksi',
						data: [
						
						
                <?php
				$sql = "SELECT DISTINCT DATE_FORMAT(tanggal, '%M') as bulan FROM invoice";
				$query = mysql_query($sql) or die(mysql_error());
				$no = mysql_num_rows($query);
				while($ret = mysql_fetch_array($query)){
					$bulan =$ret['bulan'];
					$sql_jumlah = "SELECT SUM(totalbayar) as total FROM invoice WHERE DATE_FORMAT(tanggal, '%M') = '$bulan'";
					$query_jumlah = mysql_query($sql_jumlah) or die (mysql_error());
					while($data = mysql_fetch_array($query_jumlah)){
						$jumlah = $data['total'];
						If($no == 0){
							echo $jumlah;
						}else{
							echo $jumlah.",";
						}
					}
					$no--;
				}?>
				]
				},
            ]
        });
    });
    
});
		</script>