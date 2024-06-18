<!-- Login.vue -->
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
        password: password.value,
      });
    };

    return { username, password, login, loginError };
  },
};
</script>

  <style scoped>
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f0f0;
  }
  h2{
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
  
  .login-form {
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
  .error-message {
  color: red;
  margin-bottom: 15px;
  text-align: center;
}
  </style>
  