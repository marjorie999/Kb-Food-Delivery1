<template>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row section-1">
                <div class="col-md-6">
                    <h1 class="text-center text-white mb-5">It's the food and groceries you love, delivered</h1>
                    <div class="search-container">
                        <input type="text" class="search-input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                        
                    </div>
                    
                    
                </div>
                <div class="col-md-6 overflow-hidden">
                    <img class="burger2" src='../../assets/images/burger2.png' alt="">
                </div>
            </div>
            <div class="row section-2">
                <h1 class="sec-header">Popular</h1>
                <div class="col-md-6">
                    <div class="section-image">
                        <img class="sec-image" src="../../assets/images/sisig.webp" alt="">
                        <!-- <h1>Pizza</h1>
                        <button class="btn btn-danger"><font-awesome-icon icon="fa-solid fa-cart-shopping" />Oder now</button> -->
                    </div>
                    <h1 class="sec-header">Sisig</h1>
                    <button class="btn btn-danger sec-button"><font-awesome-icon icon="fa-solid fa-cart-shopping" />Order now</button>
                </div>
                <div class="col-md-6">
                    <div class="section-image">
                        <img class="sec-image" src="../../assets/images/section-image-2.jpg" alt="">
                        <!-- <h1>Chicken</h1>
                        <button class="btn btn-danger"><font-awesome-icon icon="fa-solid fa-cart-shopping" />Oder now</button> -->
                    </div>
                    <h1 class="sec-header">Wings</h1>
                    <button class="btn btn-danger sec-button"><font-awesome-icon icon="fa-solid fa-cart-shopping" />Order now</button>
                </div>
            </div>
            <div class="row section-3">
                <div class="col-md-6 d-flex justify-content-center">
                    <img class="seafood" src='../../assets/images/seafood.png' alt="">
                </div>
                <div class="col-md-6">
                    <h1 class="text-center text-white mb-5">Try our seafood platter.</h1>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
import img from '../../assets/images/food.png'
export default {
        data(){
          return{
            images: img
          }
        },
        created(){
    this.currentRoute;
    //this.nombreRuta = this.$route.name;
},
computed: {
    currentRouteName() {
        return this.$route.name;
    }
}
      }
</script>