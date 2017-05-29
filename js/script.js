        $(document).ready(function() {
		    cekTotal();
		});

        $( "#berat" ).keyup(function() {					
			// $('.operator').html('+');	
			sums();		
			cekTotal();			
		});
		$( "#jumlah" ).keyup(function() {
			// $('.operator').html('-');	
			sums();				
		});
		$( "#checkDiskon" ).click(function() {
			// $('.operator').html('x');
			sums();			
		});
		$( "#paket" ).click(function() {
			// $('.operator').html('x');
			sums();					
		});
	
		function sums(){		
			varBerat =  parseFloat($( "#berat" ).val());	
			varJumlah =  parseFloat($( "#jumlah" ).val());	
			var beratAwal = parseFloat(inputBeratAwal); 
			var varHarga;
			beratTotal = varBerat + beratAwal;
			
			paket =  $( "#paket" ).val();	
			sum = varBerat * 1;
			switch (paket) { 
				case '1': 
					// $("#hargaSatuan").hide();
					sum = varBerat * 7000;
					break;
				case '2': 
					// $("#hargaSatuan").hide();
					sum = varBerat * 10000;
					break;
				case '3': 
					// $("#hargaSatuan").show();
					varHarga =  parseInt($( "#harga" ).val());	
					sum = varHarga;
					break;		
				default:
					$("#hargaSatuan").hide();
					sum = varBerat * 1;
			}	

			if (beratTotal > 30) {
				if (varBerat > 2) {
					$("#diskon").val(2);
					$(".diskon-help").text("Total laundry pelanggan sudah > 30 kg, anda dapat menggunakan diskon");
					$("#checkDiskon").removeAttr("disabled","disabled");
					if ($("#checkDiskon").is(':checked')) {
						sum = sum - 14000;	
					}
				}
			}else{	
					$("#checkDiskon").attr("disabled","disabled");
					$(".diskon-help").text("Belum dapat diskon, total laundry pelanggan belum 30 kg");
					$("#diskon").val(0);
			}				
			 $( "#harga" ).val(sum);
		}