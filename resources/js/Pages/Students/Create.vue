<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head, Link } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const form = useForm({
    name: '',
    lastname: '',
    email: '',
    birthday: '',
});

const submit = () => {
    form.post(route('students.store'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Create Student">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('students.index')">Students</Link>
                <span class="text-indigo-400 font-medium"> / </span>Create
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                    <FlashMessage class="mb-4" />

                    <JetValidationErrors class="mb-4" />

                    <form @submit.prevent="submit">
                        <div>
                            <JetLabel for="name" value="Name" />
                            <JetInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                            />
                        </div>

                        <div class="mt-4">
                            <JetLabel for="lastname" value="Last name" />
                            <JetInput
                                id="lastname"
                                v-model="form.lastname"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                        </div>

                        <div class="mt-4">
                            <JetLabel for="email" value="Email" />
                            <JetInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                            />
                        </div>

                        <div class="mt-4">
                            <JetLabel for="birthday" value="Birthday" />
                            <JetInput
                                id="birthday"
                                v-model="form.birthday"
                                type="date"
                                class="mt-1 block w-full"
                                required
                            />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </JetButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
