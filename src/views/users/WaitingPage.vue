<template>
   

    <div class="container-md">
        <div class="p-4">

        </div>
        <div class="row align-items-center justify-content-center">
    <div class="col-3">
      <!--  -->
    </div>
    <div class="col-6 ">
        <div class="card text-center">
    <div class="card-header" style="background-color: rgb(164, 33, 13); font-size: 30px; color: white; font-weight: bold; font-family:'Poppins' ;">
        Your order has been placed!
    </div>
    <div class="text-center p-2" style="background-color:whitesmoke">
      <svg style="fill: green" xmlns="http://www.w3.org/2000/svg" height="80px" width="100px" viewBox="0 0 512 512">
        <font-awesome-icon icon="fa-solid fa-" style="color: green;"/></svg>
    </div>
    <div class="card-body" style="background-color:whitesmoke">
        <h5 class="card-title">Please wait while your order is being deliver...</h5>
        <p style="font-weight: bold;">Order Details</p>
        <p>Name: {{ user_info.first_name }} {{ user_info.last_name }}</p>
        <p>Address: {{ user_info.address }}</p>
        <p>Contact: {{ user_info.phone_number }}</p>
        <hr>
        <template v-for="data in details">
          <p>Menu: {{ data.food_name }} ₱{{ data.food_price }}</p>
        </template>
        <p>Delivery Fee: ₱64.00</p>
        <p>total_price: ₱{{ total_price }}</p>
        <button class="btn btn-warning" @click="OrderReceived">Order received</button>
    </div>
  
</div>
    </div>
    <div class="col-3">
      
    </div>
  </div>
    </div>
</template>


<script>
  export default {
    data() {
        return {
            details: [],
            total_price : 0,
            user_info: []
        }
    },
    methods: {
        fetchData(id) {
            fetch('http://localhost:8080/fetchOrderDetails/'+id, {
        method: "GET"
      })
        .then((response) => {
          response.json().then((data) => {
            console.log(data.data, 'hgh')
            this.details = data.data;
            this.total_price = (this.details.reduce((total, food) => total + parseFloat(food.food_price), 0)+64).toFixed(2);
          });
        })
        .catch((err) => {
          console.error(err);
        });
        },
        OrderReceived() {
          const formData = new FormData();
          formData.append("order_id",this.$route.params.id);

          fetch('http://localhost:8080/orderDelivered', {
                method: 'POST',
                
                body: formData, // Convert data to JSON
            })
                .then(response => {
                    response.json().then((data) => {
                        
                        this.$router.push({
                            name: "OrderReceived"
                            
                        })
                    });
                    
                })
                .catch(error => {
                    // Handle errors here
                    console.error('Error:', error);
                })
        }
    },
    beforeMount() {
        var id = this.$route.params.id;
            this.fetchData(id);

            var data = JSON.parse(localStorage.user_info);
            this.user_info = data[0]
;            console.log(this.user_info, 'info')
    }
}
</script>
