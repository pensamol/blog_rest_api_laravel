import { defineStore } from 'pinia'
import instanceAxios from "@/utils/axios"
import router from '@/router';

type User = {
    id: number; 
    first_name: string; 
    last_name: string; 
    gender_id: number;
    role_id: number;
    gender: {
      id: number;
      name: string
    }; 
    role: {
      id: number;
      name: string
    }; 
    email: string; 
    password: string; 
}

export const useAdminUserStore = defineStore('useAdminUserStore', {
  state: () => ({
    users: [] as User[],
    user: {} as User

  }),
  getters: {
    getUsers(state){
        return state.users
    },
    getUser(state){
        return state.user
    }
  },
  actions: {
    async fetchUsers() {
        try{
            const response = await instanceAxios.get(`/users`)
            if(response.data.success === true){
              this.users = response.data.data
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async onSaveUser() {
        try{
            const response = await instanceAxios.post(`/users`, this.user)
            if(response.data.success === true){
              this.user = response.data.data
              alert("Success")
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async fetchUser(){
      try{
        const param = router.currentRoute.value
        const response = await instanceAxios.get(`/users/${param.params.id}`)
        console.log("response", response);
        
        if(response.data.success === true){
          this.user = response.data.data
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    },
    async onUpdateUser() {
      try{
        const param = router.currentRoute.value
          const response = await instanceAxios.put(`/users/${param.params.id}`, this.user)
          if(response.data.success === true){
            this.user = response.data.data
            this.fetchUsers()
            alert("Success")
          }
          
      }catch(error){
          console.log("Error", error);
          
      }
    },
    async onDeleteUser(id: number){
      try{
        const response = await instanceAxios.delete(`/users/${id}`)
        if(response.data.success === true){
          this.fetchUsers()
          alert("Success")
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    }
  }

})