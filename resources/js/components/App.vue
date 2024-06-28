<template>
  <div id="app">
    <header>
      <h1>Bienvenido a Uber</h1>
      <nav>
        <router-link to="/register">Registrarse</router-link>
        <router-link to="/login">Iniciar Sesión</router-link>
      </nav>
    </header>
    <router-view></router-view> <!-- Renderiza el componente correspondiente -->
  </div>
</template>

<script>
export default {
  name: 'App',
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

#app {
  width: 100vw;
  height: 100vh;
  padding: 20px;
  background-color: #34495e; 
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

header {
  text-align: center;
  margin-bottom: 20px;
}

h1 {
  color: #ecf0f1; 
  font-size: 36px; 
}

nav a {
  margin: 0 15px;
  text-decoration: none;
  color: #ecf0f1;
  font-weight: bold;
  font-size: 18px; 
}

nav a:hover {
  color: #4a148c; 
}
</style>
