<template>
  <div class="register-container">
    <div class="form-wrapper">
      <h2>Registro</h2>
      <form @submit.prevent="register" class="register-form">
        <div class="form-group">
          <label for="username">Nombre de usuario</label>
          <input v-model="formData.username" type="text" id="username" class="form-control" placeholder="Nombre de usuario">
          <span v-if="errors.username" class="error-message">{{ errors.username[0] }}</span>
        </div>
        <div class="form-group">
          <label for="phone">Número de teléfono</label>
          <input v-model="formData.phone" type="text" id="phone" class="form-control" placeholder="Número de teléfono">
          <span v-if="errors.phone" class="error-message">{{ errors.phone[0] }}</span>
        </div>
        <div class="form-group">
          <label for="email">Correo</label>
          <input v-model="formData.email" type="email" id="email" class="form-control" placeholder="Correo">
          <span v-if="errors.email" class="error-message">{{ errors.email[0] }}</span>
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input v-model="formData.password" type="password" id="password" class="form-control" placeholder="Contraseña">
          <span v-if="errors.password" class="error-message">{{ errors.password[0] }}</span>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirmar Contraseña</label>
          <input v-model="formData.password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
          <span v-if="errors.password_confirmation" class="error-message">{{ errors.password_confirmation[0] }}</span>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
      <AddPaymentMethod v-if="pasajeroId" :pasajero-id="pasajeroId" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router'; // Importar useRouter
import AddPaymentMethod from './AddPaymentMethod.vue';

export default {
  components: {
    AddPaymentMethod
  },
  setup() {
    const store = useStore();
    const router = useRouter(); // Obtener la instancia del router

    const formData = ref({
      username: '',
      phone: '',
      email: '',
      password: '',
      password_confirmation: ''
    });

    const errors = ref({});
    const pasajeroId = computed(() => store.state.pasajeroId);

    const register = async () => {
      try {
        const response = await axios.post('/register', formData.value);
        console.log('Respuesta del backend:', response.data);
        store.commit('setPasajeroId', response.data.id);
        router.push('/login'); // Usar router para redirigir
      } catch (error) {
        console.error('Error al registrar:', error.response ? error.response.data : error);
        if (error.response && error.response.data.errors) {
          errors.value = error.response.data.errors;
        } else if (error.request) {
          alert('Error de red. Verifica tu conexión.');
        } else {
          alert('Error al configurar la solicitud: ' + error.message);
        }
      }
    };

    return {
      formData,
      errors,
      register,
      pasajeroId
    };
  },
};
</script>

<style scoped>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f0f0f0;
}
h2 {
  text-align: center;
}
.form-wrapper {
  max-width: 400px;
  width: 100%;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
}
.register-form {
  display: flex;
  flex-direction: column;
}
.form-group {
  margin-bottom: 15px;
}
.label {
  margin-bottom: 5px;
}
.form-control {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
.error-message {
  color: red;
  font-size: 12px;
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
