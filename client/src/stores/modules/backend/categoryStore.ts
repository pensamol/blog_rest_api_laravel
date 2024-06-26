import { defineStore } from 'pinia'
import instanceAxios from "@/utils/axios"
import router from '@/router';

type Category = {
  id: number; 
  name: string; 
}

export const useAdminCategoryStore = defineStore('useAdminCategoryStore', {
  state: () => ({
    categories: [] as Category[],
    category: {} as Category

  }),
  getters: {
    getCategories(state){
        return state.categories
    },
    getCategory(state){
        return state.category
    }
  },
  actions: {
    async fetchCategories() {
        try{
            const response = await instanceAxios.get(`/categories`)
            if(response.data.success === true){
              this.categories = response.data.data
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async onSaveCategory() {
        try{
            const response = await instanceAxios.post(`/categories`, this.category)
            if(response.data.success === true){
              this.category = response.data.data
              alert("Success")
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async fetchCategory(){
      try{
        const param = router.currentRoute.value
        const response = await instanceAxios.get(`/categories/${param.params.id}`)
        console.log("response", response);
        
        if(response.data.success === true){
          this.category = response.data.data
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    },
    async onUpdateCategory() {
      try{
        const param = router.currentRoute.value
          const response = await instanceAxios.put(`/categories/${param.params.id}`, this.category)
          if(response.data.success === true){
            this.category = response.data.data
            this.fetchCategories()
            alert("Success")
          }
          
      }catch(error){
          console.log("Error", error);
          
      }
    },
    async onDeleteCategory(id: number){
      try{
        const response = await instanceAxios.delete(`/categories/${id}`)
        if(response.data.success === true){
          this.fetchCategories()
          alert("Success")
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    }
  }

})