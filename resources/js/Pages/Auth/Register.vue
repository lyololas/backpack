<template>
    <GuestLayout>
      <div class="flex items-center justify-between relative">
        <div>

        
        <h1 class="font-bold text-2xl">
          {{ currentStep.step === 1 ? 'Зарегистрируйтесь!' : currentStep.step === 2 ? 'Введите имя' : 'Придумайте пароль' }}
        </h1>
        <span class="">
          {{ currentStep.step === 1 ? 'Рекомендуем использовать электронную почту. Это намного удобнее' : currentStep.step === 2 ? 'Для начала, как вас зовут?' : 'Теперь, придумайте пароль от 8ми символов' }}
        </span>
    </div>
    <div class="absolute right-0" v-if="currentStep.step > 1">

<button

    type="button"

    @click="goBack"

>

    Назад

    </button>

</div>
    <div>
        
    </div>
      </div>
      
      <Head title="Register" />
  
      <form @submit.prevent="proceedToNextStep">
  
        <!-- Step 1: Email Input -->
        <div v-if="currentStep.step === 1" class="mt-4">
          <InputLabel for="email" value="Почта" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autocomplete="username"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>
  
        <!-- Step 2: Name Input -->
        <div v-if="currentStep.step === 2" class="mt-4">
          <InputLabel for="name" value="Имя" />
          <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            required
            autofocus
            autocomplete="name"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
  
        <!-- Step 3: Password Input -->
        <div v-if="currentStep.step === 3" class="mt-4">
          <InputLabel for="password" value="Пароль" />
          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>
  
        <div v-if="currentStep.step === 3" class="mt-4">
          <InputLabel for="password_confirmation" value="Подтверждение пароля" />
          <TextInput
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>
  
        <!-- Button to proceed -->
        <div class="mt-4">
          <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            {{ currentStep.step === 3 ? 'Зарегистрироваться' : 'Далее' }}
          </PrimaryButton>
        </div>
  
        <div v-if="currentStep.step === 1" class="border-b-2 border-[#C6C6C6] relative py-4">
          <div class="bg-white absolute left-1/2 transform -translate-x-1/2 px-4 py-1">
            <h1>или</h1>
          </div>
          
        </div>
        <h1 v-if="currentStep.step === 1" class="text-sm text-gray-400 mt-5">Регистрируясь вы принимаете условия пользовательского соглашения и политику безопасности нашего сайта</h1>
      </form>
      
    </GuestLayout>
  </template>
  

  
  <script setup>
  import { reactive } from 'vue';
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  
  const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });
  
  const currentStep = reactive({
    step: 1,
  });
  
  // Function to proceed to the next step
  const proceedToNextStep = () => {
    if (currentStep.step === 1) {
      if (form.email.trim() !== '') {
        currentStep.step = 2; // Move to the next step
      }
    } else if (currentStep.step === 2) {
      if (form.name.trim() !== '') {
        currentStep.step = 3; // Move to the next step
      }
    } else if (currentStep.step === 3) {
      if (form.password !== '' && form.password_confirmation !== '' && form.password === form.password_confirmation) {
        submit(); // Submit the form if all validations pass
      }
    }
  };
  
  // Function to go back to the previous step
  const goBack = () => {
    if (currentStep.step > 1) {
      currentStep.step--; // Decrease step to go back
    }
  };
  
  // Function to submit the form
  const submit = () => {
    form.post(route('register'), {
      onFinish: () => form.reset('password', 'password_confirmation'),
    });
  };
  </script>
  