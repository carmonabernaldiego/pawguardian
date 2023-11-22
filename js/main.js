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

// Función para generar un rango de fechas
function getDates(startDate, endDate) {
  const dates = [];
  let currentDate = new Date(startDate);
  while (currentDate <= endDate) {
    dates.push(new Date(currentDate));
    currentDate.setDate(currentDate.getDate() + 1);
  }
  return dates;
}

// Función para formatear la fecha
function formatDatepH(date) {
  const day = date.getDate().toString().padStart(2, "0");
  const month = (date.getMonth() + 1).toString().padStart(2, "0");
  const year = date.getFullYear().toString().slice(-2); // Obtiene los dos últimos dígitos del año
  return `${day}/${month}/${year}`;
}

// Función para clasificar el nivel de pH
function clasificarPh(ph) {
  if (ph < 5.0) return "Bajo";
  if (ph > 6.5) return "Alto";
  return "Normal";
}

// Generar datos de pH
const startDate = new Date("2023-10-23");
const endDate = new Date("2023-11-21");
const phData = getDates(startDate, endDate).map((date) => {
  const phValue = (Math.random() * (8.5 - 6) + 6).toFixed(1);
  return {
    fecha: formatDatepH(date),
    ph: phValue,
    clasificacion: clasificarPh(phValue),
  };
});

// Configurar la gráfica
const ctx = document.getElementById("phChart").getContext("2d");
const phChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: phData.map((d) => d.fecha),
    datasets: [
      {
        label: "Nivel de pH",
        data: phData.map((d) => d.ph),
        backgroundColor: "rgba(255, 99, 132, 0.2)",
        borderColor: "rgba(255, 99, 132, 1)",
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: false,
            suggestedMin: 5, // Mínimo sugerido para pH
            suggestedMax: 9, // Máximo sugerido para pH
          },
        },
      ],
    },
  },
});

// Agregar los datos a la tabla cuando el contenido del DOM esté cargado
document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("phTable");
  phData.forEach((data) => {
    const row = table.insertRow();
    const cellDate = row.insertCell();
    const cellPh = row.insertCell();
    const cellClasificacion = row.insertCell();
    cellDate.textContent = data.fecha;
    cellPh.textContent = data.ph;
    cellClasificacion.textContent = data.clasificacion;
  });

  // Calcular y mostrar estadísticas
  const media = calcularMedia(phData);
  const moda = calcularModa(phData);
  const mediana = calcularMediana(phData);
  const varianza = calcularVarianza(phData, media);
  const desviacionEstandar = calcularDesviacionEstandar(varianza);

  const statsDiv = document.getElementById("phStats");
  statsDiv.innerHTML = `
    <h4>Media: ${media}</h4>
    <h4>Moda: ${moda.join(", ")}</h4>
    <h4>Mediana: ${mediana}</h4>
    <h4>Varianza: ${varianza}</h4>
    <h4>Desviación Estándar: ${desviacionEstandar}</h4>
  `;
});

// Función para calcular la media
function calcularMedia(data) {
  const sum = data.reduce((acc, val) => acc + parseFloat(val.ph), 0);
  return (sum / data.length).toFixed(2);
}

// Función para calcular la moda
function calcularModa(data) {
  const frequency = {};
  let maxFreq = 0;
  let modes = [];

  data.forEach((item) => {
    if (frequency[item.ph]) {
      frequency[item.ph]++;
    } else {
      frequency[item.ph] = 1;
    }

    if (frequency[item.ph] > maxFreq) {
      maxFreq = frequency[item.ph];
      modes = [item.ph];
    } else if (frequency[item.ph] === maxFreq) {
      modes.push(item.ph);
    }
  });

  return modes;
}

// Función para calcular la mediana
function calcularMediana(data) {
  const phValues = data
    .map((item) => parseFloat(item.ph))
    .sort((a, b) => a - b);
  const mid = Math.floor(phValues.length / 2);

  return phValues.length % 2 !== 0
    ? phValues[mid]
    : ((phValues[mid - 1] + phValues[mid]) / 2).toFixed(2);
}

// Función para calcular la varianza
function calcularVarianza(data, media) {
  const sum = data.reduce((acc, val) => acc + Math.pow(val.ph - media, 2), 0);
  return (sum / data.length).toFixed(2);
}

// Función para calcular la desviación estándar
function calcularDesviacionEstandar(varianza) {
  return Math.sqrt(varianza).toFixed(2);
}
