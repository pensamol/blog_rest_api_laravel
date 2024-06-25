import router from '@/router';
import axios from 'axios';
import { defineStore } from 'pinia'

const BASE_URL = import.meta.env.VITE_BASE_URL
type iLogin = {
    email: string; 
    password: string; 
}

export const useLoginStore = defineStore('useLoginStore', {
  state: () => ({
    user: {} as iLogin,

  }),
  getters: {
    getUser(state){
        return state.user
    }
  },
  actions: {
    async onSubmitLogin() {
        try{
          console.log("BASE_URL", BASE_URL);
          
            const response = await axios.post(`http://localhost:8000/api/v1/auth/login`, this.user)

            if(response.data.success === true){
                const token = response.data.data.token
                localStorage.setItem('accessToken', token)
                localStorage.setItem('isAuth', "true")
                router.push({name: 'admin.dashboard.index'})
    
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    }
  },
})