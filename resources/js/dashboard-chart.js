import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);
// Primeiro, procuramos pelo elemento do gráfico na página.
const chartCanvas = document.getElementById('projectStatusChart');

// Só executamos o código do gráfico SE o elemento for encontrado.
if (chartCanvas) {
    document.addEventListener('DOMContentLoaded', function () {
        // Função assíncrona para buscar os dados da nossa API
        async function fetchProjectStats() {
            try {
                const response = await fetch('/api/project-stats');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                renderChart(data);
            } catch (error) {
                console.error('Error fetching project stats:', error);
            }
        }

        // Função para renderizar o gráfico com os dados recebidos
        function renderChart(data) {
            const ctx = document.getElementById('projectStatusChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut', // Tipo do gráfico
                data: {
                    labels: Object.keys(data), // Ex: ['Active', 'Completed']
                    datasets: [{
                        label: '# of Projects',
                        data: Object.values(data), // Ex: [2, 1]
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)',  // Blue
                            'rgba(255, 206, 86, 0.7)',  // Yellow
                            'rgba(75, 192, 192, 0.7)',   // Green
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Projects by Status'
                        }
                    }
                }
            });
        }

        // Chamar a função principal para iniciar o processo
        fetchProjectStats();
    });
}
