<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <div class="p-4 bg-[#F3F3F3] flex grid grid-cols-5">
                            <h1>
                                ТИП
                            </h1>
                            <h1>
                                СРОКИ
                            </h1>
                            <h1>
                                СТОИМОСТЬ
                            </h1>
                            <h1>
                                  ПЛОЩАДЬ
                            </h1>
                            <h1>
                                ДАТА
                            </h1>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <div v-for="project in $page.props.projects" :key="project.id">

<!-- Display project details -->

<h1>{{ project.type }}</h1>


<h1>{{ project.cost }}</h1>

<h1>{{ project.area }}</h1>

<h1>{{ project.date }}</h1>

</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
