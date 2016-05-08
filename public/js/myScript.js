
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
	//									alert(data);
										$("#insert-input-to-export").html(data);
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