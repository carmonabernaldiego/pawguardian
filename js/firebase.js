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

var gridLineColor = "rgba(77, 138, 240, .1)";

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

// Función para formatear la fecha y hora
function formatDate(dateString) {
  const date = new Date(dateString);
  const day = date.getDate().toString().padStart(2, "0");
  const month = (date.getMonth() + 1).toString().padStart(2, "0");
  const year = date.getFullYear().toString().slice(-2); // Obtiene los dos últimos dígitos del año
  const hours = date.getHours().toString().padStart(2, "0");
  const minutes = date.getMinutes().toString().padStart(2, "0");

  return `${day}/${month}/${year} ${hours}:${minutes}`;
}

// Referencia a los sensores en Firebase
const temperatureRef = ref(db, "TemperatureSensor");
const humidityRef = ref(db, "HumiditySensor");

// Crear el gráfico de temperatura
let myChart;
const temperatureChart = document
  .getElementById("temperature-chart")
  .getContext("2d");

// Crear el círculo de progreso para la humedad
let humidityBar;
if (document.getElementById("humidityChart")) {
  humidityBar = new ProgressBar.Circle(humidityChart, {
    color: colors.primary,
    trailColor: gridLineColor,
    strokeWidth: 4,
    trailWidth: 1,
    easing: "easeInOut",
    duration: 1400,
    text: {
      autoStyleContainer: false,
    },
    from: { color: colors.primary, width: 1 },
    to: { color: colors.primary, width: 4 },
    step: function (state, circle) {
      circle.path.setAttribute("stroke", state.color);
      circle.path.setAttribute("stroke-width", state.width);
      var value = Math.round(circle.value() * 100);
      if (value === 0) {
        circle.setText("");
      } else {
        circle.setText(value + "%");
      }
    },
  });
  humidityBar.text.style.fontFamily = "'Overpass', sans-serif";
  humidityBar.text.style.fontSize = "3rem";
}

// Escucha cambios en los datos de temperatura
onValue(temperatureRef, (snapshot) => {
  const data = snapshot.val();
  let temperaturaData = [];
  if (data) {
    Object.entries(data).forEach(([key, entry]) => {
      temperaturaData.push({
        fecha: formatDate(entry.Date),
        temperatura: entry.Value,
      });
    });

    // Asegúrate de que temperaturaData tenga solo los últimos 24 registros
    if (temperaturaData.length > 24) {
      temperaturaData = temperaturaData.slice(temperaturaData.length - 12);
    }

    if (!myChart) {
      myChart = new Chart(temperatureChart, {
        type: "line",
        data: {
          labels: temperaturaData.map((d) => d.fecha),
          datasets: [
            {
              label: "Temperatura",
              data: temperaturaData.map((d) => d.temperatura),
              backgroundColor: colors.primary,
              fill: false,
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

// Escucha cambios en los datos de humedad
onValue(humidityRef, (snapshot) => {
  const data = snapshot.val();
  if (data) {
    const lastEntry = Object.entries(data).pop();
    if (lastEntry) {
      const humidityValue = lastEntry[1].Value;
      humidityBar.animate(humidityValue / 100); // Asume que Value es un porcentaje
    }
  }
});
