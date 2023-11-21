import { initializeApp } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import {
  getDatabase,
  ref,
  onValue,
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-database.js";

// Configuración de Firebase
const firebaseConfig = {
  apiKey: "AIzaSyD4mLUtCZWOmd9pd_J6cQoFwSguSL8dMNY",
  authDomain: "paw-guardian.firebaseapp.com",
  databaseURL: "https://paw-guardian-default-rtdb.firebaseio.com",
  projectId: "paw-guardian",
  storageBucket: "paw-guardian.appspot.com",
  messagingSenderId: "430138885292",
  appId: "1:430138885292:web:86a92a2fdfde91226f8b09",
  measurementId: "G-X12BZP96NW",
};

// Iniciar Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

const dbRef = ref(db, "TemperatureSensor");

var colors = {
  primary: "#727cf5",
  secondary: "#7987a1",
  success: "#42b72a",
  info: "#68afff",
  warning: "#fbbc06",
  danger: "#ff3366",
  light: "#ececec",
  dark: "#282f3a",
  muted: "#686868",
};

// Función para formatear la fecha
function formatDate(dateString) {
  const date = new Date(dateString);
  return `${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`;
}

// Crear el gráfico (fuera del listener de Firebase)
let myChart;
const temperatureChart = document
  .getElementById("temperature-chart")
  .getContext("2d");

// Escucha cambios en los datos de Firebase en tiempo real
onValue(dbRef, (snapshot) => {
  const data = snapshot.val();
  const temperaturaData = [];

  if (data) {
    Object.entries(data).forEach(([key, entry]) => {
      temperaturaData.push({
        fecha: formatDate(entry.Date),
        temperatura: entry.Value,
      });
    });

    // Actualizar el gráfico con los nuevos datos
    if (!myChart) {
      myChart = new Chart(temperatureChart, {
        type: "bar",
        data: {
          labels: temperaturaData.map((d) => d.fecha),
          datasets: [
            {
              label: "Temperatura",
              data: temperaturaData.map((d) => d.temperatura),
              backgroundColor: colors.primary,
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          scales: {
            xAxes: [
              {
                ticks: {
                  fontColor: "#8392a5",
                  fontSize: 10,
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  fontColor: "#8392a5",
                  fontSize: 10,
                },
              },
            ],
          },
        },
      });
    } else {
      myChart.data.labels = temperaturaData.map((d) => d.fecha);
      myChart.data.datasets.forEach((dataset) => {
        dataset.data = temperaturaData.map((d) => d.temperatura);
      });
      myChart.update();
    }
  }
});
