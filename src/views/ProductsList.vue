<template>

  <div class="card text-center m-3">
    <h5 class="card-header">List of Products</h5>
  </div>

  <FancyButton>
    <template v-slote="button">
      Click Me !
    </template>
    
    <template #hello>
      <h1> Hello Icreative!!</h1>
    </template>

  </FancyButton>

  <!-- Kilometers : <input type = "text" v-model = "kilometers">
  Meters : <input type = "text" v-model = "meters"> -->
  
  <input type="text" v-model="search" placeholder="Search" ref="input" />
  <br>
    <p> Search Term : {{ search }}</p>
  <br>
    <div>Checked Categories: {{ categories }}</div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" value="home-decoration" id="home-decoration" v-model="categories">
      <label class="form-check-label" for="home-decoration">
        Home Decoration
      </label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" value="skincare" id="skincare"  v-model="categories">
      <label class="form-check-label" for="skincare">
      Skin Care
      </label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" value="groceries" id="groceries" v-model="categories">
      <label class="form-check-label" for="groceries">
        Groceries
      </label>
    </div>

  <br>
  <!-- <button @click="prevPage">Previous</button>  -->
  <!-- <br> -->
    <a href="#" @click="prevPage" class="previous">&laquo; Previous</a>
    <a href="#" @click="nextPage" class="next">Next &raquo;</a>
  <!-- <button @click="nextPage">Next</button> -->
  <br>
  <br>
  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">DiscountPercentage</th>
      <th scope="col">Rating</th>
      <th scope="col">Stock</th>
      <th scope="col">Brand</th>
      <th scope="col">Category</th>
      <th scope="col">Thumbnail</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="item in filterProducts" :key="item.id">
      <td>{{ item.id }}</td>
      <td><a :href="'/product/' + item.id">{{ item.title }}</a></td>
      <td>{{ item.price }}</td>
      <td>{{ item.discountPercentage }}</td>
      <td>{{ item.rating }}</td>
      <td :class="(item.stock <=10) ? OutOfStock : InStock">{{ item.stock }}</td>
      <td>{{ item.brand }}</td>
      <td>{{ item.category }}</td>
      <td><img :src="item.thumbnail"></td>
    </tr>
    <tr>
      <td> Total </td>
      <td colspan="2">{{ priceTotal }}</td>
    </tr>
  </tbody>
</table>
<ProvideInjectView />
</template>

<script>

import { ref } from 'vue'
import FancyButton from '@/components/FancyButton.vue'
import ProvideInjectView from '@/views/ProvideInjectView.vue'

export default{
  components: { FancyButton, ProvideInjectView },
  data(){
    const products = ref([])
    return{
      products,
      InStock : ref('InStock'),
      OutOfStock : ref('outOfStock'),
      LowStock : ref('lowStock'),
      search : ref(''),
      categories: ref([]),
      pageSize:3,
      currentPage:1,
      priceTotal:ref(),
      kilometers : 0,
      meters:0
    }
  },
  async created() {
    const productResponse = await fetch("https://dummyjson.com/products/");
    const productData = await productResponse.json();
    this.products = productData.products;
  },
  methods: {
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace(',', '.')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    },
    nextPage() {
      if( (this.currentPage*this.pageSize) < this.products.length) {
        return this.currentPage++;
      }
    },
    prevPage() {
      if(this.currentPage > 1) {
       this.currentPage--; 
      }
    }
  },
  computed: {
    filterProducts() {
      return this.products.filter(product => {
        if (this.categories.toString()) {
          // return this.categories.toString().toLowerCase().includes(product.category.toLowerCase())
          return product.category.toLowerCase().includes(this.categories.toString().toLowerCase())
        }else{
          return product.title.toLowerCase().includes(this.search.toLowerCase())
        }
      }).filter((row, index) => {
        var total = 0;
        let start = (this.currentPage-1)*this.pageSize;
        let end = this.currentPage*this.pageSize;
        if(index >= start && index < end) {return true;}
        this.products.slice(start, end).forEach(element => {
          total += (element.price);
        });
        this.priceTotal = total;
      });
    }
  },
  watch : {
     kilometers: function(val){
        this.kilometers = val;
        this.meters = val * 1000;
     },
     meters: function(val){
        this.kilometers = val/ 1000;
        this.meters = val;
     }
  },
  mounted() {
    console.log(`the component is now mounted.`);
    this.$refs.input.focus()

  },
  updated() {
  console.log(`the component is now updated.`);
    this.$refs.input.focus()

  }
}

</script>

<style scoped>

.InStock {
  color: green;
}

.outOfStock {
  color: red;
}

.lowStock {
  color :yellow
}

a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #f1f1f1;
  color: black;
}

.next {
  background-color: #04AA6D;
  color: white;
}

.round {
  border-radius: 50%;
}
</style>