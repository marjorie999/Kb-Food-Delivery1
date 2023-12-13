<template>
    <div class="container-fluid page-body">
        <div class="row menu-section-1">
            <p>MENU</p>
        </div>
        <div class="container" style="padding-top: 2.5rem;">
            <ul class="nav nav-pills mb-3 d-flex justify-content-center menus" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-home" aria-selected="true">ALL</button>
            </li>
            <template v-for="data in category">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" :data-bs-target="'#pills-'+ data.category_name" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ data.category_name }}</button>
                </li>
            </template>
            
            </ul>
            <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row" >
                    <div class="col-md-12 menu-card" v-for="(data, index) in foods">
                        <!-- <router-link v-if="data.food_id" :to="{name:'PlaceOrder', params: {id: data.food_id }}" class="food-menu-link"> -->
                            <div class="d-flex">
                            <div class="p-2">
                                <img class="food-menu" :src="data.food_image" alt="">
                            </div>  
                            <div class="p-2 flex-grow-1">
                                <p class="food-menu-title">{{ data.food_name }}</p>
                                <p class="food-menu-price">₱{{ data.food_price }}</p>
                                <p class="food-menu-description">{{ data.food_description }}</p>
                            </div>
                            <div class="p-2">
                              <button class="btn btn-warning text-white m-1" type="button" @click="addToOrder(data.food_id)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Add to order</button>
                              <router-link v-if="data.food_id" :to="{name:'PlaceOrder', params: {id: data.food_id }}" class="btn btn-danger text-white m-1">Buy</router-link>
                            </div>
                        </div>
                        <!-- </router-link> -->
                    </div>
                </div>
            </div>
            <template v-for="c in category">
                <div class="tab-pane fade" :id="'pills-'+ c.category_name" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="row" >
                    <template v-for="(data, index) in foods">
                    <div class="col-md-12 menu-card" v-if="c.category_id == data.category_id">
                        <!-- <router-link v-if="data.food_id" :to="{name:'PlaceOrder', params: {id: data.food_id }}" class="food-menu-link"> -->
                            <div class="d-flex">
                            <div class="p-2">
                                <img class="food-menu" :src="data.food_image" alt="">
                            </div>
                            <div class="p-2 flex-grow-1">
                                <p class="food-menu-title">{{ data.food_name }}</p>
                                <p class="food-menu-price">₱{{ data.food_price }}</p>
                                <p class="food-menu-description">{{ data.food_description }}</p>
                            </div>
                            <div class="p-2">
                              <button class="btn btn-warning text-white m-1" type="button" @click="addToOrder(data.food_id)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Add to order</button>
                              <router-link v-if="data.food_id" :to="{name:'PlaceOrder', params: {id: data.food_id }}" class="btn btn-danger text-white m-1">Buy</router-link>
                            </div>
                        </div>
                        <!-- </router-link> -->
                    </div></template>
                </div>
                </div>
            </template>
      
            </div>
        </div>
        <div class="bag-container">
          <a class="btn btn-warning position-relative bag-button" v-if="selectedItems.length != 0" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <font-awesome-icon icon="fa-solid fa-bag-shopping" />
                        <span class="position-absolute top-25 start-100 translate-middle badge rounded-pill bg-danger ">
                          {{ this.selectedItems.length }}
                        </span>
                      </a>
        </div>
        
    </div>

    <div class="offcanvas offcanvas-start"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Order</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="d-flex align-items-start flex-column " style="height: 100%;">
      <div class="p-0 mb-auto">
        <div class="order-card d-flex" v-for="data in selectedItems">
          <div class="p-2">
            <img class="order-pic" :src="data.food_image" alt="">
          </div>
          <div class="p-0 flex-grow-1">
            <p class="order-title">{{data.food_name}}</p>
            <p class="order-price">₱{{data.food_price}}</p>
          </div>
          <div class="p-2">
            <button class="btn btn-warning text-white" @click="removeToOrder(data.food_id)">
              <font-awesome-icon icon="fa-solid fa-circle-xmark" />
            </button>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-between" style="width: 100%;">
        <h2>Total</h2>
        <h2>₱{{ total.toFixed(2) }}</h2>

      </div>
      <div class="p-0" style="width: 100%;">
        <button class="btn btn-danger" style="width: 100%;" @click="checkOut()" :disabled="selectedItems.length == 0">Checkout</button>
      </div>
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
      console.log(strId, 'fef')
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