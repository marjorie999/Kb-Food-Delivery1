<template>
    <div class="container mt-4">
      <div class="w-50">
        <div class="card">
            <div class="card-header">
                <h2>Create Menu</h2>
            </div>
            <div class="card-body">
                
      <form @submit.prevent="submitForm">
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
          <input v-model="food.food_name" type="text" class="form-control" id="foodName" required>
        </div>
        <div class="form-group">
          <label for="foodPrice">Food Price:</label>
          <input v-model="food.food_price" type="number" class="form-control" id="foodPrice" required>
        </div>
        <div class="form-group">
          <label for="foodDescription">Food Description:</label>
          <textarea v-model="food.food_description" class="form-control" id="foodDescription" required></textarea>
        </div>
        <div class="form-group">
          <label for="foodImage">Food Image URL:</label>
          <input v-model="food.food_image" type="text" class="form-control" id="foodImage" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Food</button>
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
  methods: {
    submitForm() {
      // Simulating an API call to save the food data
      this.saveFood(this.food)
        
    },
    saveFood(foodData) {
            const formData = new FormData();

            formData.append('category_id', foodData.category_id)
            formData.append('food_name', foodData.food_name)
            formData.append('food_price', foodData.food_price)
            formData.append('food_description', foodData.food_description)
            formData.append('food_image', foodData.food_image)

            
            // Making an HTTP POST request using Fetch API
            fetch('http://localhost:8080/create_menu', {
                method: 'POST',
                
                body: formData, // Convert data to JSON
            })
                .then(response => {
                    response.json().then((data) => {
                        console.log(data)
                        this.$router.push({
                            name: "AdminMenu"
                            
                        })
                    });
                    
                })
                .catch(error => {
                    // Handle errors here
                    console.error('Error:', error);
                });
        
        },
  }
};
</script>
  
  <style>
  /* Add any custom styles here */
  </style>
  