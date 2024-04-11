<template>
	<div class="card text-center m-3">
    <h5 class="card-header">GET Request with Async/Await</h5>
    <h5 class="btn btn-primary" @click="getRecordTotal">GET Total Records</h5>
    <div class="card-body">Total Vue packages: {{obj.totalPackages.count}}</div>
    <div class="card-body">{{ inOptionsFromComposition }}</div>
    <br>
  </div>
	<button @click.prevent="count++">
	{{ count }}
	</button>
	<input v-model="changeLocation">
	<h1>{{ first }} <em v-if="first">-</em> {{ last }}</h1>
	<spna> {{ num }}</spna>
	<ProvideInjectView
		v-model:firstname="first"
		v-model:lastname="last"
		@increase-by="increaseCount"
	/>
</template>


<script>
import { ref, computed } from 'vue'
import { count } from '../store.js'
import ProvideInjectView from '@/views/ProvideInjectView.vue' 

export default{
	components:{ ProvideInjectView },
	data(){
		const obj = ref({
			totalPackages: { count: 0 },
			arr: []
		});
		
		return {
			obj,
			count,
			location:'India',
			changeLocation:'',
			first :"Divyesh",
			last: "Solanki",
			num:0

		}
	},

  computed: {
  inOptionsFromComposition () {
    return this.obj.arr.length > 0 ? 'Yes' : 'No';
  }
},

	methods: {
		async getRecordTotal() {
			const response = await fetch("https://dummyjson.com/products");
			const data = await response.json();
			console.log(data.total);
			this.obj.totalPackages.count = data.total;
			// await nextTick()
			this.obj.arr.push(data.results);
		},
		updatedLocation(){
			this.location = computed( () => this.changeLocation )
		},
		increaseCount(n) {
   this.num += n
  }
	},

	provide(){
		return{
			location : computed( () => this.location),
			updateLocation : this.updatedLocation
		}
	}
	
};
</script>
