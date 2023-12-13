<template>
    <div class="container mt-4">
      <div class="w-50">
        <div class="card">
            <div class="card-header">
                <h2>Edit Menu</h2>
            </div>
            <div class="card-body">
                
                <form @submit.prevent="updateFood">
                    <div class="form-group">
                    <label for="category">Category:</label>
                    <select v-model="food.category_id" class="form-control" id="category">
                        <!-- Options for categories -->
                        <option value="1">Sisig</option>
                        <option value="2">Wings</option>
                        <option value="3">Burger</option>
                        <!-- Add more options as needed -->
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="foodName">Food Name:</label>
                    <input v-model="food.food_name" type="text" class="form-control" id="foodName">
                    </div>
                    <div class="form-group">
                    <label for="foodPrice">Food Price:</label>
                    <input v-model="food.food_price" type="number" class="form-control" id="foodPrice">
                    </div>
                    <div class="form-group">
                    <label for="foodDescription">Food Description:</label>
                    <textarea v-model="food.food_description" class="form-control" id="foodDescription"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="foodImage">Food Image URL:</label>
                    <input v-model="food.food_image" type="text" class="form-control" id="foodImage">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Food</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        food: {
          category_id: '',
          food_name: '',
          food_price: '',
          food_description: '',
          food_image: ''
        }
      };
    },
    mounted() {
      // Fetch the food details using an API call or from a Vuex store
      // For example, assuming you have a method called fetchFoodDetails
      this.fetchFoodDetails();
    },
    methods: {
      fetchFoodDetails() {
        // Simulate fetching food details - Replace with your actual API call
        // Assuming a food ID is passed as a prop
        const foodId = this.$route.params.id; // Get the ID from route params
            
            // Making an HTTP POST request using Fetch API
            fetch('http://localhost:8080/getMenu/'+ foodId)
                .then(response => {
                    response.json().then((data) => {
                        console.log(data, 'fsdfd')
                        this.food = data.data;
                    });
                    
                })
                .catch(error => {
                    // Handle errors here
                    console.error('Error:', error);
                });
        
      },
      updateFood() {
        
        
      }
    }
  };
  </script>
  
  <style>
  /* Add any custom styles here */
  </style>
  