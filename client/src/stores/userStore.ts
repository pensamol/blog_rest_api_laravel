import { defineStore } from 'pinia'
type iUser = {
    id: number;
    first_name: string; 
    last_name: string; 
    email: string; 
    phone: string; 
}

export const useUserStore = defineStore('useUserStore', {
  state: () => ({
    users: [
        {
            id: 1,
            first_name: "Pen",
            last_name: "Samol",
            email: "pensamol@gmail.com",
            phone: "078574007",
        },
        {
            id: 2,
            first_name: "Da",
            last_name: "Vin",
            email: "davin@gmail.com",
            phone: "123456789",
        },
        {
            id: 3,
            first_name: "Da",
            last_name: "Dav",
            email: "dadav@gmail.com",
            phone: "123456789",
        }
    ] as iUser[],

  }),
  getters: {
    getUsers(state){
        return state.users
    }
  },
  actions: {
    async fetchUsers() {
        try{
            this.users
        }catch(error){
            console.log("Error", error);
            
        }
    }
  },
})