<template>
  <div class="welcome-container">
    <h2 v-if="user">Bienvenido, {{ user.username }}</h2>
    <h2 v-else>Cargando<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h2> <!-- Mensaje predeterminado mientras se carga el usuario -->
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
@keyframes blink {
  0% { opacity: 0; }
  50% { opacity: 1; }
  100% { opacity: 0; }
}

.dot {
  animation: blink 1s infinite;
}

.dot:nth-child(2) {
  animation-delay: 0.2s;
}

.dot:nth-child(3) {
  animation-delay: 0.4s;
}

body {
  font-family: Arial, sans-serif;
  background-color: #2c3e50; 
  color: #ecf0f1; 
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.welcome-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100vw;
  max-width: 500px;
  padding: 30px;
  border: 3px solid #6a1b9a; 
  border-radius: 10px;
  background-color: #34495e; 
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

h2 {
  color: #ecf0f1;
  margin-bottom: 20px;
  font-size: 24px; 
}

.button-container {
  display: flex;
  justify-content: center; 
  align-items: center;  
  width: 100%;
}

.btn-primary {
  padding: 15px 30px; 
  background-color: #6a1b9a; 
  color: #fff;
  border: none;
  border-radius: 5px;  
  cursor: pointer;
  font-size: 18px;  
  transition: background-color 0.3s ease, transform 0.2s;  
}

.btn-primary:hover {
  background-color: #4a148c; 
  transform: scale(1.05); 
}
</style>
