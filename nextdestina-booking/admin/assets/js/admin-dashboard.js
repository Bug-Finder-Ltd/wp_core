jQuery(document).ready(function($) {

    function loadChart(month = 'current') {
        $.post(ndChartData.ajaxurl, {
            action: 'nd_get_transaction_chart',
            month: month
        }, function(response) {

            if (!response || !response.labels || !response.data) {
                console.error('Invalid response:', response);
                return;
            }

            $('#nd-total-deposit').text(`$${response.total}`);

            if (window.ndChart) {
                window.ndChart.destroy();
            }

            const canvas = document.getElementById('nd-transaction-chart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');

            //const ctx = document.getElementById('nd-transaction-chart').getContext('2d');

            window.ndChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: response.labels,
                    datasets: [{
                        label: 'Deposit',
                        data: response.data,
                        fill: false,
                        borderColor: 'rgb(0,123,255)',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true },
                        title: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            });

        });
    }

    // Initial load
    loadChart('current');

    $('#nd-chart-months button').on('click', function() {
        $('#nd-chart-months button').removeClass('active');
        $(this).addClass('active');
        const month = $(this).data('month');
        loadChart(month);
    });

    // Button tab

    $('#nd-packages-months button').on('click', function() {
        $('#nd-packages-months button').removeClass('active');
        $(this).addClass('active');
        $('.nd-top-tours-this-month').toggle($(this).data('month') === 'current');
        $('.nd-top-tours-last-month').toggle($(this).data('month') === 'last');
    });

    $('#nd-destination-months button').on('click', function() {
        $('#nd-destination-months button').removeClass('active');
        $(this).addClass('active');
        $('.nd-top-dest-this-month').toggle($(this).data('month') === 'current');
        $('.nd-top-dest-last-month').toggle($(this).data('month') === 'last');
    });


});




