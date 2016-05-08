
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});

$("div.alert-success").delay(3000).slideUp();

function deleteConfirm (messages) {
    if(window.confirm(messages)) {
        return true;
    }
    return false;
}

function checkTenHang() {
	var idHang = $("#TenHang").val();
	var idBenh = $("#TenBenh").val();
	if (idHang == "" && idBenh == "") {
		var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Vui lòng chọn Tên hãng sản xuất thuốc.</li><li>Vui lòng chọn Tên bệnh.</li></ul></div></div>';
		$("#errors").html(errors);
	} else if (idHang == "") {
		var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Vui lòng chọn Tên hãng sản xuất thuốc.</li></ul></div></div>';
		$("#errors").html(errors);
		$("#insert-input-drug-export").html("");
	}
}

function exportDrug() {
	$(document).ready(function() {
		$("#TenBenh").click(function (){ 
			var idHang = $("#TenHang").val();
			var idBenh = $("#TenBenh").val();
			if (idHang == "" && idBenh == "") {
				var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Vui lòng chọn Tên hãng sản xuất thuốc.</li><li>Vui lòng chọn Tên bệnh.</li></ul></div></div>';
				$("#errors").html(errors);
			} else if (idHang == "") {
				var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Vui lòng chọn Tên hãng sản xuất thuốc.</li></ul></div></div>';
				$("#errors").html(errors);
				
			} else if (idBenh == "") {
				var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Vui lòng chọn Tên bệnh.</li></ul></div></div>';
				$("#errors").html(errors);
			} else {
				var url = 'ControllerXuatThuoc.php?action=getthuoc';
				$.ajax({
					url: url,
					type: 'post',
					cache: false,
					async: false,
					data: {"idBenh": idBenh, "idHang": idHang},
					success: function (data) {
						$("#insert-input-drug-export").html(data);
						
						$("#TenThuoc").change(function() {
							var idThuoc = $("#TenThuoc").val();
							if (idThuoc == "") {
								var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Vui lòng chọn Tên thuốc.</li></ul></div></div>';
								$("#errors").html(errors);
								$("#insert-input-to-export").html("");
							} else {
								var url = 'ControllerXuatThuoc.php?action=getsoluongthuoc';
								$.ajax({
									url: url,
									type: 'post',
									cache: false,
									async: false,
									data: {"idThuoc": idThuoc},
									success: function (data) {
										$("#insert-input-to-export").html(data);
										
										$("#exportdrug").click(function () {
											var soLuongXuat = parseInt($("#soluongxuat").val());
											console.log(soLuongXuat);
											var soLuongTonKho = parseInt($("#tonkho").val());
											console.log(soLuongTonKho);
											var soTien = parseInt($("#sotien").val());
											console.log(soTien);
											
											if (soLuongXuat > soLuongTonKho) {
												var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Số lượng thuốc xuất đi không thể lớn hơn số lượng thuốc tồn kho.</li></ul></div></div>';
												$("#errors").html(errors);
												console.log("aaaa")
											}else if (soLuongXuat <= 0) {
												var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Số lượng thuốc xuất đi phải lớn hơn 0.</li></ul></div></div>';
												$("#errors").html(errors);
												console.log("bbbb")
											}else if (soTien <= 0) {
												var errors = '<div class="col-lg-7"><div class="alert alert-danger" ><ul><li>Số tiền trên một đơn vị phải lớn hơn 0.</li></ul></div></div>';
												$("#errors").html(errors);
												console.log("cccc")
											}else {
												var idThuoc = parseInt($('#TenThuoc').val());
												console.log(idThuoc)
												var action = $('#action').val();
												console.log(action);
												var url = 'ControllerXuatThuoc.php';
												$.ajax({
													url: url,
													type: 'post',
													cache: false,
													async: false,
													data: {"action": action, "idThuoc": idThuoc, "soLuongXuat": soLuongXuat, "soTien": soTien},
													success: function (data) {
														if (data != "success")
															$("#errors").html(data);
														else 
															window.location="/cap-phat-thuoc/view-list-xuat-thuoc.php"
													}
												});
											}
										});
										
									}
								});
							}
						});
					}
				});
			}
		});
	});
}