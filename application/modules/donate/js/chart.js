var elem = document.getElementById('paypal-chart');

var paypalChart = new Chart(elem, {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
      label: 'Donations',
      backgroundColor: 'rgba(0, 6, 53, 0.3)',
      borderColor: '#000635',
      data: JSON.parse(elem.dataset.stats),
      fill: 'origin',
      pointBackgroundColor: '#000635'
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false
      },
      tooltip: {
        callbacks: {
          label: function(context) {
            var label = context.dataset.label || '';

            if (label) {
              label += ': ';
            }

            if (context.parsed.y !== null) {
              label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
            }

            return label;
          }
        }
      }
    },
    scales: {
      y: {
        ticks: {
          callback: function(value, index, values) {
            return '$' + value;
          }
        }
      }
    }
  }
});