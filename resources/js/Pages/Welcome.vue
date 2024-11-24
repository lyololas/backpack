<script setup>
import { defineProps, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import { Head } from '@inertiajs/vue3';

const modalOpen = ref(false);
const selectedProject = ref(null); // Reactive variable to hold the selected project

const formatCreatedAt = (createdAt) => {
  const date = new Date(createdAt);
  return date.toLocaleString();
};

// Update showModal to accept project data
const showModal = (project) => {
  selectedProject.value = project; // Set the selected project
  modalOpen.value = true; // Open the modal
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="p-4 bg-[#F3F3F3] flex grid grid-cols-5">
                            <h1>ТИП</h1>
                            <h1>НАЗВАНИЕ</h1>
                            <h1>ОПИСАНИЕ</h1>
                            <h1>ДОКУМЕНТЫ</h1>
                            <h1>ДАТА СОЗДАНИЕ</h1>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900 space-y-5">
                        <div v-for="project in $page.props.projects" :key="project.id" 
                             class="flex grid grid-cols-5" 
                             @click="showModal(project)"> <!-- Pass the project to showModal -->
                            <h1>{{ project.type === 'idea' ? 'Идея' : 'Проект' }}</h1>
                            <h1>{{ project.title }}</h1>
                            <h1>{{ project.description }}</h1>
                            <div v-for="(doc, index) in JSON.parse(project.docs)" :key="index">
                                <h1>
                                    <a v-if="doc.includes('pdf')" :href="`/storage/${doc}`" target="_blank">Open Document</a>
                                    <span v-else>{{ doc }}</span>
                                </h1>
                            </div>
                            <h1>{{ formatCreatedAt(project.created_at) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </AuthenticatedLayout>
    <Modal :isOpen="modalOpen" :project="selectedProject" @close="modalOpen = false" /> <!-- Pass the selected project -->
</template>