<template>
    

    <div class="p-4">
        <nav class="p-2" style="--bs-breadcrumb-divider: '>'; background-color: whitesmoke;" aria-label="breadcrumb">
            <div class="row">
                <div class="col-2">
                    <!--  -->
                </div>
                <div class="col-6">
                    <h4>Manage Menu</h4>
                </div>
                <div class="col">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Menu</li>
                    </ol>
                </div>
            </div>
           
 
</nav>
       
    </div>
        
    <div class="container-fluid">
        <div class="row align-items-center">
    <div class="col-2">
      <!--  -->
    </div>
    <div class="col-8"  >
      <router-link type="button" class="btn btn-success" to="/create_menu" exact>Add Menu</router-link>
      &nbsp;
        <table class="table table-hover"  >
  <thead class="table-dark" >
    <tr >
      <th scope="col">#</th>
      <th scope="col" >Image</th>
      <th scope="col" >Menu</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody v-for="(data, index) in foods">
    <tr>
      <th  scope="row" >{{ index + 1 }}</th>
      <td><img style="height: 100px;" :src="data.food_image" alt=""></td>
      <td>
        <div class="row">

        </div>
        
        <h5>{{ data.food_name }}</h5>
                                
                                </td>
      <td><h5 >₱{{ data.food_price }}</h5></td>
      <td><h5>{{ data.food_description }}</h5></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn btn-warning">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
        </div>
      
    </td>
      
    </tr>
 
   
  </tbody>
</table>

      
    </div>
    <div class="col-2">
      <!--  -->
    </div>
  </div>
    </div>
</template>


<script>
import json from '../../jsonData/food.json'
import categoryJSON from '../../jsonData/category.json'
export default {
    data() {
    return {
      foods: [],
      category: [],
      selectedItems: [],
      total: 0
    };
  },
  methods: {
    fetchMenuData() {
      fetch('http://localhost:8080/fetchFood', {
        method: "GET"
      })
        .then((response) => {
          response.json().then((data) => {
            this.foods = data.data;
            // console.log(this.foods[0].food_id, 'lol');
          });
        })
        .catch((err) => {
          console.error(err);
        });
    },
    fetchCategoryData() {
      fetch('http://localhost:8080/fetchCategory', {
        method: "GET"
      })
        .then((response) => {
          response.json().then((data) => {
            this.category = data.data;
            
          });
        })
        .catch((err) => {
          console.error(err);
        });
    },
    addToOrder(value) {
      if(!this.selectedItems.includes(value))
      {
        if(this.doesFoodIdExist(value)){
          return null
        }
        
        for (let i = 0; i < this.foods.length; i++) {
          if (this.foods[i].food_id === value) {
            this.selectedItems.push(this.foods[i]);
          }
        }
      }
      this.total = this.selectedItems.reduce((total, food) => total + parseFloat(food.food_price), 0);
      
      
    },
    removeToOrder(id){
      this.selectedItems = this.selectedItems.filter(food => food.food_id !== id)
      this.total = this.selectedItems.reduce((total, food) => total + parseFloat(food.food_price), 0);
    },
    doesFoodIdExist(id) {
      return this.selectedItems.some(food => food.food_id === id);
    },
    checkOut() {
      var ids = this.selectedItems.map(e => e.food_id);
      var strId = JSON.stringify(ids);
      
      strId = strId.replace(/[\[\]"]+/g, '').replace(/,/g, '/');

      this.$router.push({
        name: "PlaceOrder",
        params: {id: strId}
      })
    }
    
},
  beforeMount() {
    this.fetchCategoryData();
    this.fetchMenuData();
  }
   
}
</script>