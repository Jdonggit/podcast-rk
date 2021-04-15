<template>

    <div class="bg-fixed grid grid-cols-2 gap-4">
        <div class="flex flex-col mb-8 divide-y text-base text-gray-800 w-full border">
            <div class="p-1.5"><h2 class="font-bold">Apple Itunes podcast</h2></div>
                
            <div class="py-3 px-6" v-for="(item, k) in applePodcasts" :key="k">
                <div class="grid grid-rows-2 grid-flow-col auto-cols-max gap-4">
                    <div class="col-span-1">{{ item.rank }}</div>
                    <div class="col-span-1">{{ item.updown }}</div>
                    <div class="row-span-2"><div class="box-border h-32 w-32 border-4"><img class="float-left"  :src="item.img_src"></div></div>
                    <div class="col-span-1">{{ item.name }}</div>
                    <div class="col-span-1">{{ item.author }}</div>
                   
                </div>
            </div>
        </div>
        <div class="flex flex-col mb-8 divide-y text-base text-gray-800 w-full border">
            <div class="p-1.5"><h2 class="font-bold">Spotify podcast</h2></div>
            <div class="py-3 px-6" v-for="(item, k) in spotifyPodcasts" :key="k">
                <div class="grid grid-rows-2 grid-flow-col auto-cols-max gap-4">
                    <div class="col-span-1">{{ item.rank }}</div>
                    <div class="col-span-1">{{ item.updown }}</div>
                     <div class="row-span-2"><div class="box-border h-32 w-32 border-4"><img class="float-left"  :src="item.img_src"></div></div>
                    
                    <div class="col-span-1">{{ item.name }}</div>
                    <div class="col-span-1">{{ item.author }}</div>
                   
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    mounted: function () {
        axios.get('api/podcast')
        .then((res) => { 
            this.spotifyPodcasts = res.data.data.spotify
            this.applePodcasts = res.data.data.apple
        })
        .catch((error) => { console.error(error) })
        .finally(() => { /* 不論失敗成功皆會執行 */ })
    },
    data() {
        return {
            spotifyPodcasts:[],

            applePodcasts:[]
        }
    }
}
</script>>