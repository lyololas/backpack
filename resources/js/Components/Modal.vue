<template>
    <div v-if="isOpen" class="modal">

        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
        

        <div class="fixed top-0 right-0 bottom-0  h-screen flex items-center justify-center p-4 text-center w-2/5">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all w-full h-full">
                <div class="bg-white px-8 py-6 w-full h-full"> 
                    <div class="justify-end">
                        <h1 class="text-2xl font-bold">{{ project.title }}</h1>
                            <button @click="closeModal" class="mt-4  font-bold py-2 px-4 rounded">X</button>
                    </div>
                    <img :src="getFullImagePath(project.image)" alt="" class="rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-[#F3F3F3] p-8 rounded-lg flex items-center space-x-4">
                            <div class="bg-white p-2 rounded-lg">
                                <Icon icon="icon-park:list-add" width="1.2em" height="1.2em" class="text-black"/>
                            </div>
                            <div class="">
                            <h1 class="text-gray-400">Статус проекта</h1>
                            <h1>{{ project.type === 'idea' ? 'Идея' : 'Проект' }}</h1>
                        </div>
                        </div>
                        <div class="bg-[#F3F3F3] p-8 rounded-lg flex items-center space-x-4">
                            <div class="bg-white p-2 rounded-lg">
                                <Icon icon="icon-park:list-add" width="1.2em" height="1.2em" class="text-black"/>
                            </div>
                            <div class="">
                            <h1 class="text-gray-400">Стоимость</h1>
                            <h1>700 000</h1>
                        </div>
                        </div>
                        <div class="bg-[#F3F3F3] p-8 rounded-lg flex items-center space-x-4">
                            <div class="bg-white p-2 rounded-lg">
                                <Icon icon="icon-park:list-add" width="1.2em" height="1.2em" class="text-black"/>
                            </div>
                            <div class="">
                            <h1 class="text-gray-400">Сроки выполнения</h1>
                            <h1>7 месяцев</h1>
                        </div>
                        </div>
                        <div class="bg-[#F3F3F3] p-8 rounded-lg flex items-center space-x-4">
                            <div class="bg-white p-2 rounded-lg">
                                <Icon icon="icon-park:list-add" width="1.2em" height="1.2em" class="text-black"/>
                            </div>
                            <div class="">
                            <h1 class="text-gray-400">Площадь проекта</h1>
                            <h1>700м</h1>
                        </div>
                        </div>
                    </div>
                    <div class="bg-[#F3F3F3] p-8 rounded-lg flex items-center space-x-4 mt-4">
                            <div class="bg-white p-2 rounded-lg">
                                <Icon icon="icon-park:list-add" width="1.2em" height="1.2em" class="text-black"/>
                            </div>
                            <div class="">
                            <h1 class="text-gray-400">Документ</h1>
                            <div v-for="(doc, index) in JSON.parse(project.docs)" :key="index">
                                <h1>
                                    <a v-if="doc.includes('pdf')" :href="`/storage/${doc}`" target="_blank">Просмотреть документ</a>
                                    <span v-else>{{ doc }}</span>
                                </h1>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal {
    z-index: 50; 
}
</style>

<script>
import { Icon } from '@iconify/vue';
const baseURL = 'http://127.0.0.1:8000/storage/'
export default {
    props: {
        isOpen: Boolean,
        project: Object,
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        getFullImagePath(imagePath) {

return baseURL + imagePath;

}
    },
    components: {

Icon,

},
};
</script>
