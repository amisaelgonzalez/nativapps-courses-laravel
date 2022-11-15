<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import JetButton from '@/Jetstream/Button.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm();

const props = defineProps({
    students: Object,
});

function create() {
    form.get(route('students.create'));
}

function edit(id) {
    form.get(route('students.edit', id));
}

function destroy(id) {
    if (confirm("Are you sure you want to delete the record?")) {
        form.delete(route('students.destroy', id));
    }
}

function courses(id) {
    console.log(id);
    form.get(route('student.courses.index', id));
}
</script>

<template>
    <AppLayout title="Students">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Students
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-3">
                            <JetButton @click="create()">
                                Add Record
                            </JetButton>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-900 uppercase bg-gray-5">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Last name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Age
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="student in students.data"
                                        :key="student.id"
                                        class="bg-white border-b"
                                    >
                                        <th class="px-6 py-4 font-medium">
                                            {{ student.id }}
                                        </th>
                                        <th class="px-6 py-4 font-medium">
                                            {{ student.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ student.lastname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ student.email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ student.age }}
                                        </td>
                                        <td class="px-6 py-4">

                                            <JetButton class="m-1" @click="courses(student.id)">
                                                Courses
                                            </JetButton>
                                            <JetSecondaryButton class="m-1" @click="edit(student.id)">
                                                Edit
                                            </JetSecondaryButton>
                                            <JetDangerButton class="m-1" @click="destroy(student.id)">
                                                Delete
                                            </JetDangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <Pagination :data="students"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
