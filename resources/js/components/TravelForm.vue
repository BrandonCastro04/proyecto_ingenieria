<template>
  <div class="map-form-container">
    <h3>Solicitar Viaje</h3>
    <div class="content">
      <!-- Mapa Leaflet -->
      <div ref="mapContainer" class="map"></div>

      <!-- Formulario de Agregar Viaje -->
      <form @submit.prevent="addViaje" class="travel-form">
        <h1>Marque en el Mapa un Origen y un Destino</h1>
        <div class="form-group">
          <label for="origen">Origen</label>
          <input v-model="origen" type="text" id="origen" class="form-control" placeholder="Origen" readonly>
        </div>
        <div class="form-group">
          <label for="destino">Destino</label>
          <input v-model="destino" type="text" id="destino" class="form-control" placeholder="Destino" readonly>
        </div>
        <div class="form-group">
          <label for="fecha">Fecha</label>
          <input v-model="fecha" type="date" id="fecha" class="form-control">
        </div>
        <div class="form-group">
          <label for="metodo_pago">Seleccione el método de pago</label>
          <select v-model="metodo_pago_id" id="metodo_pago" class="form-control">
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar</button>
      </form>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default {
  setup() {
    const origen = ref('');
    const destino = ref('');
    const fecha = ref('');
    const metodo_pago_id = ref('');

    // Referencias
    const mapContainer = ref(null);
    let map = null;
    let markerOrigen = null;
    let markerDestino = null;

    // Coordenadas iniciales para Costa Rica
    const costaRicaCoords = { lat: 9.9281, lng: -84.0907 };

    // Función para inicializar el mapa
    const initializeMap = () => {
      map = L.map(mapContainer.value).setView([costaRicaCoords.lat, costaRicaCoords.lng], 8);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      // Manejo de clics en el mapa para seleccionar origen y destino
      map.on('click', (e) => {
        if (!markerOrigen) {
          // Primer clic: establecer origen
          markerOrigen = L.marker(e.latlng).addTo(map).bindPopup('Origen').openPopup();
          origen.value = `${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}`;
        } else if (!markerDestino) {
          // Segundo clic: establecer destino
          markerDestino = L.marker(e.latlng).addTo(map).bindPopup('Destino').openPopup();
          destino.value = `${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}`;
        } else {
          // Si ya hay origen y destino, eliminar el destino y establecer uno nuevo
          map.removeLayer(markerDestino);
          markerDestino = L.marker(e.latlng).addTo(map).bindPopup('Destino').openPopup();
          destino.value = `${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}`;
        }
      });
    };

    // Función para añadir viaje
    const addViaje = async () => {
      if (!origen.value || !destino.value) {
        alert('Por favor, marque tanto el origen como el destino en el mapa.');
        return;
      }

      // Lógica para procesar el viaje, se puede ajustar según sea necesario
      alert(`Viaje confirmado:\nOrigen: ${origen.value}\nDestino: ${destino.value}\nMétodo de Pago: ${metodo_pago_id.value}`);

      // Limpiar marcadores y campos después de agregar viaje
      if (markerOrigen) {
        map.removeLayer(markerOrigen);
        markerOrigen = null;
      }
      if (markerDestino) {
        map.removeLayer(markerDestino);
        markerDestino = null;
      }
      origen.value = '';
      destino.value = '';
      fecha.value = '';
      metodo_pago_id.value = '';
    };

    onMounted(() => {
      initializeMap();
    });

    return {
      origen,
      destino,
      fecha,
      metodo_pago_id,
      addViaje,
      mapContainer
    };
  },
};
</script>

<style scoped>
body {
  font-family: Arial, sans-serif;
  background-color: #ecf0f1; 
  color: #333;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.map-form-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100vw;
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
  border-radius: 10px;
  background-color: #ffffff; 
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.content {
  display: flex;
  flex-direction: row;
  width: 100%;
  justify-content: space-between;
}

.map {
  width: 45%;
  height: 400px;
  margin-right: 20px;
}

.travel-form {
  width: 50%; 
}

.form-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 100%;
  margin-bottom: 15px; 
}

label {
  margin-bottom: 6px; 
  color: #6a1b9a; 
  font-weight: bold;
  font-size: 14px; 
}

.form-control {
  width: 100%;
  padding: 10px; 
  font-size: 16px; 
  border: 1px solid #6a1b9a; 
  border-radius: 5px;
  box-sizing: border-box;
  background-color: #f0f4f8;
  color: #333;
}

.form-control::placeholder {
  color: #6a1b9a; 
}

.btn-primary {
  padding: 12px;
  background-color: #6a1b9a; 
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px; 
  transition: background-color 0.3s ease, transform 0.2s;  
  width: 100%; 
}

.btn-primary:hover {
  background-color: #4a148c; 
  transform: scale(1.05); 
}
</style>
