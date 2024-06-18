<template>
  <div class="map-container">
    <h3>Agregar Viaje</h3>

    <!-- Mapa Leaflet -->
    <div ref="mapContainer" class="map"></div>

    <!-- Formulario de Agregar Viaje -->
    <form @submit.prevent="addViaje">
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
        <label for="metodo_pago">Método de Pago</label>
        <select v-model="metodo_pago_id" id="metodo_pago" class="form-control">
          <option v-for="metodo in metodosPago" :key="metodo.id" :value="metodo.id">{{ metodo.tipo }}</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default {
  setup() {
    const store = useStore();
    const origen = ref('');
    const destino = ref('');
    const fecha = ref('');
    const metodo_pago_id = ref('');
    const metodosPago = computed(() => store.state.metodosPago || []);

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

      try {
        await store.dispatch('addViaje', {
          origen: origen.value,
          destino: destino.value,
          fecha: fecha.value,
          metodo_pago_id: metodo_pago_id.value,
        });

        // Mostrar mensaje de confirmación
        alert(`Viaje confirmado:\nOrigen: ${origen.value}\nDestino: ${destino.value}`);

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
      } catch (error) {
        console.error('Error al agregar viaje:', error);
      }
    };

    onMounted(() => {
      initializeMap();
    });

    return {
      origen,
      destino,
      fecha,
      metodo_pago_id,
      metodosPago,
      addViaje,
      mapContainer
    };
  },
};
</script>

<style scoped>
.map-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 800px;
  margin: 0 auto;
}

.map {
  width: 100%;
  height: 400px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-control {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.btn-primary {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0056b3;
}
</style>
