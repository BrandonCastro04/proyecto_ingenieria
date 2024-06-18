<template>
  <div>
    <h2 v-if="user">Bienvenido, {{ user.username }}</h2>
    <h2 v-else>Cargando...</h2> <!-- Mensaje predeterminado mientras se carga el usuario -->
   <div class="button-container">
    <button @click="goToTravelForm" class="btn btn-primary">Buscar Uber</button>
  </div>
  </div>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const user = computed(() => store.state.user);

    const goToTravelForm = () => {
      // Redirige siempre a /travel-form
      router.push('/travel-form');
    };

    return { user, goToTravelForm };
  }
};
</script>

<style scoped>
.button-container {
  display: flex;
  justify-content: center; 
  align-items: center;  
  height: 50px;  
  text-align: center; 
}

/* Estilo del botón */
.btn-primary {
  padding: 20px 40px;  
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;  
  cursor: pointer;
  font-size: 1.25rem;  /* Tamaño de la fuente */
  transition: background-color 0.3s ease, transform 0.2s;  /* Animaciones para hover */
}

.btn-primary:hover {
  background-color: #0056b3; /* Color de fondo en hover */
  transform: scale(1.05); /* Pequeño aumento en el tamaño */
}


.btn-primary:hover {
  background-color: #0056b3;
}
</style>
