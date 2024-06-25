import { defineStore } from 'pinia'
import instanceAxios from "@/utils/axios"
import router from '@/router';

type Role = {
    id: number; 
    name: string; 
}

export const useAdminRoleStore = defineStore('useAdminRoleStore', {
  state: () => ({
    roles: [] as Role[],
    role: {} as Role

  }),
  getters: {
    getRoles(state){
        return state.roles
    },
    getRole(state){
        return state.role
    }
  },
  actions: {
    async fetchRoles() {
        try{
            const response = await instanceAxios.get(`/roles`)
            if(response.data.success === true){
              this.roles = response.data.data
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async onSaveRole() {
        try{
            const response = await instanceAxios.post(`/roles`, this.role)
            if(response.data.success === true){
              this.role = response.data.data
              alert("Success")
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async fetchRole(){
      try{
        const param = router.currentRoute.value
        const response = await instanceAxios.get(`/roles/${param.params.id}`)
        console.log("response", response);
        
        if(response.data.success === true){
          this.role = response.data.data
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    },
    async onUpdateRole() {
      try{
        const param = router.currentRoute.value
          const response = await instanceAxios.put(`/roles/${param.params.id}`, this.role)
          if(response.data.success === true){
            this.role = response.data.data
            this.fetchRoles()
            alert("Success")
          }
          
      }catch(error){
          console.log("Error", error);
          
      }
    },
    async onDeleteRole(id: number){
      try{
        const response = await instanceAxios.delete(`/roles/${id}`)
        if(response.data.success === true){
          this.fetchRole()
          alert("Success")
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    }
  }

})