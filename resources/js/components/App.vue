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
nav a {
  margin: 0 10px;
  text-decoration: none;
}
h1{
  text-align: center;
}
</style>


  