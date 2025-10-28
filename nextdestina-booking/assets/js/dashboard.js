"use strict";
// Preloader area
const preloader = document.getElementById("preloader");
const preloaderFunction = () => {
    preloader.style.display = "none";
};

// toggleSideMenu start
const toggleSideMenu = () => {
    document.body.classList.toggle("toggle-sidebar");
};
// toggleSideMenu end

// input file preview & reset start

// if (document.querySelector('.account-settings-profile-section')) {
//     const originalImageSrc = document.getElementById('profile-img').src;
//     function previewImage() {
//         const fileInput = document.getElementById('formFile');
//         if (fileInput.files && fileInput.files[0]) {
//             document.getElementById('profile-img').src = URL.createObjectURL(fileInput.files[0]);
//         }
//     }

//     function resetPreviewImage() {
//         document.getElementById('profile-img').src = originalImageSrc;
//     }
// }

// input file preview & reset end

// Tooltip
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));






$(document).ready(function () {
    // owl carousel dashboard card
    $('.card-carousel').owlCarousel({
        loop: false,
        // autoplay: true,
        margin: -20,
        nav: false,
        dots: false,
        // rtl:true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 3
            },
            1600: {
                items: 4
            }
        }
    });

    // Bootstrap datepicker start
    if ($('.date').length) {
        $('.date').datepicker({
            // options here
            format: 'dd/mm/yyyy',
        });
    }
    // Bootstrap datepicker end
    //Multi step progress section start

    // Nice select start
    if ($('.nice-select').length) {
        $('.nice-select').niceSelect();

    }
    // Nice select end


    // cmn select2 start
    // $(document).ready(function () {
    //     $('.cmn-select2').select2();
    // });
    // cmn select2 end

    // cmn-select2-modal
    // $(".modal-select").select2({
    //     dropdownParent: $("#formModal"),
    // });

    // cmn-select2 with image start
    // $(document).ready(function () {
    //     $('.cmn-select2-image').select2({
    //         templateResult: formatState,
    //         templateSelection: formatState
    //     });
    // });

    // select2 function
    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var baseUrl = "assets/img/mini-flag";
        var $state = $(
            '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.svg" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    };
    // cmn-select2 with image start

    // RichTextEditor start
    if ($('#div_editor1').length) {
        var editor1cfg = {}
        editor1cfg.toolbar = "basic";
        var editor1 = new RichTextEditor("#div_editor1", editor1cfg);
    }
    // RichTextEditor end
    // flatpickr start
    flatpickr("#myID", {});
    // flatpickr end
});



// select to input focus start
document.addEventListener("DOMContentLoaded", function () {
    function handleInput(inputAmountBox, inputAmountBoxInner) {
        if (inputAmountBox && inputAmountBoxInner) {
            const inputField = inputAmountBoxInner.querySelector('input');

            inputField.addEventListener("focus", function () {
                inputAmountBox.classList.add("active");
            });

            inputField.addEventListener("blur", function () {
                inputAmountBox.classList.remove("active");
            });

            inputField.addEventListener("click", function () {
                inputField.setSelectionRange(inputField.value.length, inputField.value.length);
            });

            inputAmountBox.addEventListener("click", function (event) {
                if (!event.target.closest('.icon-area') && !event.target.closest('.currency-name')) {
                    inputField.focus();
                    inputField.setSelectionRange(inputField.value.length, inputField.value.length);
                }
            });
        }
    }

    const inputAmountBox = document.getElementById("inputAmountBox");
    const inputAmountBoxInner = document.getElementById("inputAmountBoxInner");
    handleInput(inputAmountBox, inputAmountBoxInner);

    const inputAmountBox2 = document.getElementById("inputAmountBox2");
    const inputAmountBoxInner2 = document.getElementById("inputAmountBoxInner2");
    handleInput(inputAmountBox2, inputAmountBoxInner2);
});
// select to input focus end


// Filter section start
function filterItems(inputId) {
    var input, filter, items, title, subtitle, i, txtValue;
    input = document.getElementById(inputId);
    filter = input.value.toUpperCase();
    items = document.querySelectorAll("#currency-list .item");

    items.forEach(function (item) {
        title = item.querySelector(".title");
        subtitle = item.querySelector(".sub-title");

        txtValue = title.textContent || title.innerText;
        txtValue += " " + (subtitle.textContent || subtitle.innerText);

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });
}

function filterItems2(inputId) {
    var input, filter, items, title, subtitle, i, txtValue;
    input = document.getElementById(inputId);
    filter = input.value.toUpperCase();
    items = document.querySelectorAll("#currency-list2 .item");

    items.forEach(function (item) {
        title = item.querySelector(".title");
        subtitle = item.querySelector(".sub-title");

        txtValue = title.textContent || title.innerText;
        txtValue += " " + (subtitle.textContent || subtitle.innerText);

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });
}
// Filter section end

// Apexcharts start
// Column chart
if ($('#columnChart').length) {
    var options = {
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
        chart: {
            type: 'bar',
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#columnChart"), options);
    chart.render();
}

// Line chart
if ($('#lineChart').length) {
    var options = {
        series: [
            {
                name: "High - 2013",
                data: [28, 29, 33, 36, 32, 32, 33]
            },
            {
                name: "Low - 2013",
                data: [12, 11, 14, 18, 17, 13, 13]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#77B6EA', '#545454'],
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: 'Average High & Low Temperature',
            align: 'left'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Temperature'
            },
            min: 5,
            max: 40
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };


    var chart = new ApexCharts(document.querySelector("#lineChart"), options);
    chart.render();
}

// Apexcharts end



// Dark theme start
const toggleBtn = document.getElementById("toggle-btn");
const body = document.querySelector("body");
toggleBtn.addEventListener("click", function () {
    document.body.classList.toggle("dark-theme");
    if (document.body.classList.contains("dark-theme")) {
        localStorage.setItem("dark-theme", 1);
    } else {
        localStorage.setItem("dark-theme", 0);
    }
    setTheme();
});

function setTheme() {
    const isDarkTheme = localStorage.getItem("dark-theme");
    if (isDarkTheme == 1) {
        document.querySelector('body').classList.add('dark-theme');
        document.getElementById("moon").style.display = "none";
        document.getElementById("sun").style.display = "block";
    } else {
        document.querySelector('body').classList.remove('dark-theme');
        document.getElementById("moon").style.display = "block";
        document.getElementById("sun").style.display = "none";
    }
}
setTheme();
// Dark theme end

