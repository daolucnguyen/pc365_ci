var ctx = document.getElementById('myChart');
var list_timely_min = [0, 0, 0, 0, 0, 0];
var list_early = [0, 0, 0, 0, 0, 0];
var list_late = [0, 0, 0, 0, 0, 0];
var list_staff_no_sheet = [0, 0, 0, 0, 0, 0];
$(document).ready(function() {
    $(".l_show").click(function() {
        $(this).next(".l_drop").slideToggle(250);
    });
    var form_data = new FormData();

    $.ajax({
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        // enctype: 'multipart/form-data',
        url: '/company/Company_controller/getWeeday',
        data: form_data,
        dataType: "JSON",
        async: false,
        success: function(data) {
            list_timely_min = data.list_timely_min;
            list_early = data.list_early;
            list_late = data.list_late;
            list_staff_no_sheet = data.list_staff_no_sheet;
        }
    });
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
            datasets: [{
                backgroundColor: "#206AA9",
                data: list_timely_min,
                label: "Chấm công đúng giờ",
                borderRadius: 15,
                Width: 10
            }, {
                backgroundColor: "#D4E7F7",
                data: list_late,
                label: "Đi muộn/ Về sớm",
                borderRadius: 15,
            }, {
                backgroundColor: "#E0E0E0",
                data: list_staff_no_sheet,
                label: "Không chấm công",
                borderRadius: 15,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            // responsive: true,
            // maintainAspectRatio: true
        }
    });
});