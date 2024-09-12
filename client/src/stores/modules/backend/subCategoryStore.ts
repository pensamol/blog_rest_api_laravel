import { defineStore } from 'pinia'
import instanceAxios from "@/utils/axios"
import router from '@/router';

type SubCategory = {
  id: number; 
  name: string;
  category_id: number;
  category: {
    id:number;
    name: string
  };
}

export const useAdminSubCategoryStore = defineStore('useAdminSubCategoryStore', {
  state: () => ({
    subcategories: [] as SubCategory[],
    subcategory: {} as SubCategory,
    formData: {} as SubCategory

  }),
  getters: {
    getSubCategories(state){
      return state.subcategories
    },
    getSubCategory(state){
      return state.subcategory
    }
  },
  actions: {
    async fetchSubCategories() {
        try{
            const response = await instanceAxios.get(`/sub-categories`)
            if(response.data.success === true){
              this.subcategories = response.data.data
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async onSaveSubCategory() {
        try{
            const response = await instanceAxios.post(`/sub-categories`, this.formData)
            if(response.data.success === true){
              this.formData = response.data.data
              alert("Success")
              this.fetchSubCategories()
            }
            
        }catch(error){
            console.log("Error", error);
            
        }
    },
    async fetchSubCategory(){
      try{
        const param = router.currentRoute.value
        const response = await instanceAxios.get(`/sub-categories/${param.params.id}`)
        if(response.data.success === true){
          this.subcategory = response.data.data
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    },
    async onUpdateSubCategory() {
      try{
        const param = router.currentRoute.value
          const response = await instanceAxios.put(`/sub-categories/${param.params.id}`, this.subcategory)
          if(response.data.success === true){
            this.subcategory = response.data.data
            this.fetchSubCategories()
            alert("Success")
          }
          
      }catch(error){
          console.log("Error", error);
          
      }
    },
    async onDeleteSubCategory(id: number){
      try{
        const response = await instanceAxios.delete(`/sub-categories/${id}`)
        if(response.data.success === true){
          this.fetchSubCategories()
          alert("Success")
        }
        
      }catch(error){
        console.log("error", error);
        
      }
    }
  }

})