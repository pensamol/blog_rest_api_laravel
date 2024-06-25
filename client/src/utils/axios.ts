import axios from 'axios';
import router from '@/router/index';
const instanceAxios = axios.create({
  baseURL: import.meta.env.VITE_API_ENDPOINT,
  timeout: 10000
});

instanceAxios.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('accessToken');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);


instanceAxios.interceptors.response.use(
  (response) => {
    return response;
    
  },
  (error) => {
    if(error.response.status === 401){
      localStorage.removeItem('accessToken')
      localStorage.removeItem('isAuth')
      router.push({name: 'admin.user.login'});
    }
    
    return Promise.reject(error);
  }
);

export default instanceAxios;