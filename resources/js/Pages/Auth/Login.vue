<template>
    <GuestLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <div class="flex items-center justify-between">
                    <h1 :class="{ 'font-bold': !form.isEnteringPassword }" class="text-4xl py-2">
                        {{ form.isEnteringPassword ? 'Введите пароль' : 'Добро пожаловать' }}
                    </h1>
                    <button v-if="form.isEnteringPassword" @click="goBack" class="text-sm text-gray-600">Назад</button>
                </div>

                <div>
                    <span v-if="!form.isEnteringPassword" class="py-2">
                        Войдите
                    </span>
                    <span v-if="form.isEnteringPassword" class="py-2">
                        Чтобы войти, вам необходимо ввести пароль
                    </span>
                </div>

                <div v-if="!form.isEnteringPassword" class="py-4">
                    <InputLabel for="email" value="Почта"/>

                    <TextInput
                        id="email"
                        type="email"
                        class="w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>

                <div v-if="form.isEnteringPassword" class="py-4">
                    <InputLabel for="password" value="Password"/>

                    <TextInput
                        id="password"
                        type="password"
                        class="w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="py-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember"/>
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="mt-5 flex">
                    <PrimaryButton
                        @click="submit"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ form.isEnteringPassword ? 'Войти' : 'Продолжить с почтой' }}
                    </PrimaryButton>
                </div>
                <div class="border-b-2 border-[#C6C6C6] relative py-4">
                    <div class="bg-white absolute left-1/2 transform -translate-x-1/2 px-4 py-1">
                        <h1>или</h1>
                    </div>
                </div>
            </div>
        </form>
        <h1 class="text-sm text-gray-400 mt-5">Регистрируясь вы принимаете условия пользовательского соглашения и политику безопасности нашего сайта</h1>
    </GuestLayout>
</template>


<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
    isEnteringPassword: false,
});

const submit = () => {
    if (form.isEnteringPassword) {
        form.post(route('login'), {
            onFinish: () => {
                form.reset('password');
            },
        });
    } else {
        form.isEnteringPassword = true;
    }
};

const goBack = () => {
    form.isEnteringPassword = false;
};
</script>
