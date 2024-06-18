<!-- resources/js/components/AddPaymentMethod.vue -->
<template>
    <div class="payment-method-container">
      <h2>Agregar Método de Pago</h2>
      <form @submit.prevent="addPaymentMethod">
        <input v-model="type" placeholder="Tipo de método de pago" />
        <input v-model="details" placeholder="Detalles del método de pago" />
        <button type="submit">Agregar Método de Pago</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { useStore } from 'vuex';
  
  export default {
    props: {
      pasajeroId: {
        type: Number,
        required: true
      }
    },
    setup(props) {
      const store = useStore();
      const type = ref('');
      const details = ref('');
  
      const addPaymentMethod = async () => {
        try {
          await store.dispatch('addPaymentMethod', {
          pasajero_id: props.pasajeroId,
          type: type.value,
          details: details.value
        });
        alert('Método de pago añadido con éxito.');
      } catch (error) {
        console.error(error);
      }
      };
  
      return { type, details, addPaymentMethod };
    }
  };
  </script>
  