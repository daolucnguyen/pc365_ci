var ctx = document.getElementById('myChart');
var list_timely_min = [];
var di_muon_ve_som = [];
var dung_gio = [];
var khong_diem_danh = [];
$(document).ready(function() {

    var form_data = new FormData();

    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/staff/StaffController/getWeeday',
        data: form_data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            // list_timely_min = data.list_timely_min;
            di_muon_ve_som = data.di_muon_ve_som;
            dung_gio = data.dung_gio;
            khong_diem_danh = data.khong_diem_danh;
        }
    });
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
            datasets: [{
                backgroundColor: "#206AA9",
                data: dung_gio,
                label: "Chấm công đúng giờ",
                borderRadius: 15,
                Width: 10
            }, {
                backgroundColor: "#D4E7F7",
                data: di_muon_ve_som,
                label: "Đi muộn/ Về sớm",
                borderRadius: 15,
            }, {
                backgroundColor: "#E0E0E0",
                data: khong_diem_danh,
                label: "Không chấm công",
                borderRadius: 15,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            responsive: true,
            maintainAspectRatio: true
        }
    });
});