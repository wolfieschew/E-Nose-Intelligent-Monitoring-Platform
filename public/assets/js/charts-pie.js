document.addEventListener('DOMContentLoaded', function () {
  const pieCanvas = document.getElementById('pie');

  const values = JSON.parse(pieCanvas.dataset.values);
  const labels = JSON.parse(pieCanvas.dataset.labels);


  const pieConfig = {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        label: 'Total Sampel per Device',
        data: values,
        backgroundColor: [
          '#0694a2', '#1c64f2', '#7e3af2',
          '#facc15', '#f43f5e', '#10b981',
        ],
      }],
    },
    options: {
      responsive: true,
      cutout: '80%',
      plugins: {
        legend: {
          display: false, // Matikan legend bawaan
        },
      },
    },
  };

  const pieCtx = pieCanvas.getContext('2d');
  new Chart(pieCtx, pieConfig);
});
