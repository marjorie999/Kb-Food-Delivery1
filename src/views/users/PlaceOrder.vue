<template>
    <div class="wrapper md-center p-3">
        <div class="container">
        <div class="card p-4 mb-3">
            <div class="p-2">
                <h5>Select Address</h5>
                    <input type="text" class="form-control" :value="user_info.address">
                    <br>
                    <h5>Name</h5>
                    <input type="text" class="form-control" :value="fullName">
                    <br>
                    <h5>Payment Method</h5>
                    <select class="form-select">
                        <option>Cash on Delivery</option>
                        <option>Gcash</option>
                    </select>
            </div>
            <div class="p-2" style="background-color: antiquewhite; border-radius: 20px;">
                <h5>Selected Order</h5>
                <div class="p-1" v-for="data in details">
                    <div class="d-flex">
                        <div class="p-0"><img class="food-menu" :src="data.food_image" alt=""></div>
                        <div class="p-2 flex-grow-1">
                            <p class="food-menu-title" style="margin-bottom: 0 !important;">{{ data.food_name }}</p>
                            <p class="food-menu-description" >{{ data.food_description }}</p>
                            <div class="d-flex justify-content-between">
                                <div class="p-0">
                                    <p>Price</p>
                                </div>
                                <div class="p-0">
                                    <p class="" style="font-weight: bold ;">₱{{ data.food_price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 mt-5" style="font-size:20px; border: 1px solid black;">
                <div class="d-flex justify-content-between">
                    <div class="p-0">
                        <p class="m-0">Delivery fee</p>
                    </div>
                    <div class="p-0">   
                        <p class="mb-0" style="font-weight: bold ;">₱64.00</p>
                    </div>
                </div>
            </div>
            <div class="p-2 mt-1" style="font-size:20px; border: 1px solid black;">
                <div class="d-flex justify-content-between">
                    <div class="p-0">
                        <p class="m-0">Order Total</p>
                    </div>
                    <div class="p-0">   
                        <p class="mb-0" style="font-weight: bold ;">₱{{ total_price }}</p>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <button class="btn btn-danger float-end" @click="pushOrder()">Place Order</button>
            </div>
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
            fullName: '',
            user_info: []
        }
    },
    methods: {
        fetchData(id) {
            fetch('http://localhost:8080/fetchFoodDetails/'+id, {
        method: "GET"
      })
        .then((response) => {
          response.json().then((data) => {
            this.details = data.data;
            this.total_price = (this.details.reduce((total, food) => total + parseFloat(food.food_price), 0)+64).toFixed(2);
          });
        })
        .catch((err) => {
          console.error(err);
        });
        },
        pushOrder() {
            // const foodIdData = { food_id: '1' };
            const formData = new FormData()

            formData.append("food_id", JSON.stringify(this.$route.params.id.split('/')))
            formData.append("customer_id",this.user_info.user_id)
            formData.append("address",this.user_info.address)
            formData.append("total_price",this.total_price)

            // Making an HTTP POST request using Fetch API
            fetch('http://localhost:8080/placeOrder', {
                method: 'POST',
                
                body: formData, // Convert data to JSON
            })
                .then(response => {
                    response.json().then((data) => {
                        
                        this.$router.push({
                            name: "WaitingPage",
                            params: {id: data.order_id}
                        })
                    });
                    
                })
                .catch(error => {
                    // Handle errors here
                    console.error('Error:', error);
                });
        }
    },
    beforeMount() {
        var id = this.$route.params.id;
        console.log(JSON.stringify(this.$route.params.id.split('/')), 'route')
            this.fetchData(id);

            // var user = { user_id: "1", firstname: 'Coco', lastname: "Martin", phone_number: "09123456789", address: 'Lazareto' }
        
            // localStorage.setItem('user_info', JSON.stringify(user));
            var user = JSON.parse(localStorage.user_info);
            this.user_info = user[0];
            this.fullName = this.user_info.first_name + ' ' + this.user_info.last_name
            console.log(this.user_info, 'info')
    }
}
</script>