// resources/js/store/index.js
import { createStore } from 'vuex';
import axios from 'axios';
import router from '../router';

const store = createStore({
  state() {
    return {
      user: null,
      pasajeroId: null, 
      loginError: null,
    };
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setPasajeroId(state, id) { 
      state.pasajeroId = id;
    },
   setLoginError(state, error) { 
      state.loginError = error;
    },
    clearLoginError(state) { 
      state.loginError = null;
    },
  },
  actions: {
    async register({ commit }, userData) {
      try {
        const response = await axios.post('/register', userData);
        // Suponiendo que el backend devuelve el ID del pasajero creado
        commit('setPasajeroId', response.data.id); // Guardar el ID del pasajero
        router.push('/login'); // Redirigir al login después del registro
      } catch (error) {
        console.error(error);
      }
    },
    async login({ commit }, credentials) {
      try {
        commit('clearLoginError');
        const response = await axios.post('/login', credentials);
    
        if (response.data.user) {
          commit('setUser', response.data.user);
        } else {
          commit('setUser', null); 
          commit('setLoginError', 'Datos de usuario no válidos');
        }
        
        
        router.push('/travel-form');
      } catch (error) {
        commit('setUser', null); 
        commit('setLoginError', 'Nombre de usuario o contraseña incorrectos');
        console.error(error);
        router.push('/dashboard'); 
      }
    },
    
    
  
    async addPaymentMethod({ state }, paymentData) { 
      try {
        await axios.post('/pagos', {
          ...paymentData,
          pasajero_id: state.pasajeroId, 
        });
       
      } catch (error) {
        console.error(error);
      }
    },
    async addViaje({ state }, viajeData) {
      try {
        await axios.post('/viajes', {
          ...viajeData,
          pasajero_id: state.pasajeroId,
        });
      } catch (error) {
        console.error(error);
      }
    },
   
  },
  getters: {
    loginError: (state) => state.loginError, 
  }
});

export default store;
