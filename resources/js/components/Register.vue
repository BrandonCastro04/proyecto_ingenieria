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
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store = useStore();
    const router = useRouter();

    const formData = ref({
      username: '',
      phone: '',
      email: '',
      password: '',
      password_confirmation: ''
    });

    const errors = ref({});

    const register = async () => {
      try {
        const response = await axios.post('/register', formData.value);
        console.log('Respuesta del backend:', response.data);
        store.commit('setPasajeroId', response.data.id);
        router.push('/login');
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
      register
    };
  },
};
</script>

<style scoped>
body {
  font-family: Arial, sans-serif;
  background-color: #2c3e50; 
  color: #ecf0f1; 
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  overflow: hidden;
}

.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100vw;
  height: 100vh;
  overflow-y: auto; 
}

h2 {
  text-align: center;
  color: #ecf0f1; 
  margin-bottom: 20px;
  font-size: 24px;
}

.form-wrapper {
  width: 90%; 
  max-width: 500px;
  padding: 30px;
  background-color: #34495e; 
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 10px; 
}

.register-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.form-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 100%;
  margin-bottom: 20px;
}

label {
  margin-bottom: 8px;
  color: #ecf0f1; 
  font-weight: bold;
  font-size: 16px;
}

.form-control {
  width: 100%;
  padding: 12px;
  font-size: 18px;
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
  padding: 15px;
  background-color: #6a1b9a; 
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
  width: 100%;
}

.btn-primary:hover {
  background-color: #4a148c; 
}

.error-message {
  color: red;
  margin-top: 5px;
  font-size: 14px;
}
</style>

