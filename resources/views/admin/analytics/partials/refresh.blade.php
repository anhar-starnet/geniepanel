<script>

const chartCtx = document
    .getElementById('onlineChart')
    .getContext('2d');

let dashboardChart = new Chart(chartCtx,{

    type:'line',

    data:{

        labels:[],

        datasets:[

            {

                label:'Online',

                data:[],

                borderColor:'#28a745',

                fill:false,

                tension:.3

            },

            {

                label:'Offline',

                data:[],

                borderColor:'#dc3545',

                fill:false,

                tension:.3

            }

        ]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false

    }

});

async function refreshDashboard(){

    const response = await fetch('/api/dashboard/analytics');

    const json = await response.json();

    document.getElementById('card-online').innerHTML =
        json.summary.online;

    document.getElementById('card-offline').innerHTML =
        json.summary.offline;

    document.getElementById('card-rx').innerHTML =
        json.summary.rxCritical;

    document.getElementById('card-temp').innerHTML =
        json.summary.tempCritical;

    dashboardChart.data.labels = json.charts.labels;

dashboardChart.data.datasets[0].data =
    json.charts.online;

dashboardChart.data.datasets[1].data =
    json.charts.offline;

    dashboardChart.update();

}

refreshDashboard();

setInterval(
    refreshDashboard,
    30000
);

</script>