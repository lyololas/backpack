<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { reactive } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';


const form = useForm({
    type: '',
    title: '',
    description: '',
    image: null,
    docs: [],
    userId: '',

});


const handleImageUpload = (event) => {
    form.image = event.target.files[0];
};

const handleFileUpload = (event) => {
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        form.docs.push(files[i]);
    }
};

const submitForm = () => {
    const formData = new FormData();
    formData.append('type', form.type);
    formData.append('title', form.title);
    formData.append('description', form.description);
    formData.append('image', form.image);
    for (let i = 0; i < form.docs.length; i++) {
        formData.append('docs[]', form.docs[i]);
    }
    form.post(route('createproject'), {
        data: formData
    });

};

</script>

<template>
    <Head title="Create Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Создание вашего проекта
            </h2>
        </template>

        <form @submit.prevent="submitForm">
            <!-- Basic information section -->
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 text-gray-900">
                            <span class="font-bold text-xl">Основная информация</span>
                        </div>

                        
                        <div class="px-6 py-2 mx-auto">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Заголовок</label>
                            <input type="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Введите..." v-model="form.title" required />
                            </div>
                            <div class="p-6 mx-auto">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900">Выберите тип</label>
                                <select id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" v-model="form.type" required>
                                    <option selected disabled>Тип</option>

                                    <option value="idea">Идея</option>

                                    <option value="project">Проект</option>

                                </select>
                            </div>
                            <div class="p-6 mx-auto">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Краткое описание</label>
                                <textarea id="description" v-model="form.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Chinazes"></textarea>
                            </div>

                        </div>
                                                
                </div>

                <!-- Image upload section -->
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 mt-6">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 text-gray-900 space-y-4">
                            <span class="font-bold text-xl">Фотографии проекта/идеи</span>
                            <h1>
                                <span>Сделайте ваш проект/идею привлекательнее: загрузите атмосферные фотографии в высоком качестве. 
                                Поддерживаемые форматы: JPG, JPEG, PNG, WEBP. Рекомендуемое минимальное разрешение 960x720 px. Размер файла до 10MB</span>
                            </h1>
                        </div>
                        <div class="flex w-full p-6">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <input id="dropzone-file" type="file" class="hidden" @change="handleImageUpload" />
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Document attachment section -->
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 mt-5">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 text-gray-900">
                            <span class="font-bold text-xl">Прикрепить документ</span>
                            <h1 class="text-gray-400">Документ будет отображаться на странице проекта</h1>
                        </div>
                        <div class="p-6 mx-auto">
                            <label class="mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple files</label>
                            <input class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="multiple_files" type="file" @change="handleFileUpload" multiple>
                            
                            <div v-if="form.docs.length > 0" class="mt-4">
                                <p class="text-gray-900 font-medium">Uploaded Documents:</p>
                                <ul class="list-disc pl-6">
                                    <li v-for="(doc, index) in form.docs" :key="index" class="text-sm text-gray-700">{{ doc.name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <PrimaryButton type="submit" class="mt-5">Отправить на модерацию</PrimaryButton>
                </div>
                
            </div>

            
        </form>
    </AuthenticatedLayout>
</template>
