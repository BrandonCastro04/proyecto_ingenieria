<template>
  <div class="login-container">
    <div class="form-wrapper">
      <h2>Iniciar Sesión</h2>
      <form @submit.prevent="login" class="login-form">
        <div v-if="loginError" class="error-message">{{ loginError }}</div>
        <div class="form-group">
          <label for="username">Nombre de usuario</label>
          <input v-model="username" type="text" id="username" class="form-control" placeholder="Nombre de usuario">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input v-model="password" type="password" id="password" class="form-control" placeholder="Contraseña">
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
      </form>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore();
    const username = ref('');
    const password = ref('');
    const loginError = computed(() => store.getters.loginError);

    const login = () => {
      store.dispatch('login', {
        username: username.value,
        password: password.value
      });
    };

    return { username, password, login, loginError };
  },
};
</script>

<style scoped>
body {
  font-family: Arial, sans-serif;
  background-color: #2c3e50; 
  color: #ecf0f1; 
  margin: 0;
  padding: 0;
  height: 100vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100vw;
  height: 100vh; 
  background-color: #2c3e50; 
}

h2 {
  text-align: center;
  color: #ecf0f1; 
  margin-bottom: 20px;
  font-size: 24px; 
}

.form-wrapper {
  width: 100%;
  max-width: 400px;
  padding: 30px;
  background-color: #34495e; 
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.login-form {
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
  margin: 5px 0; 
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
  margin-bottom: 20px;
  text-align: center;
  font-size: 16px; 
}
</style>
