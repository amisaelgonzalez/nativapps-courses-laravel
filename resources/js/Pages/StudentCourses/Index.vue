<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import JetButton from '@/Jetstream/Button.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3'
import FlashMessage from '@/Components/FlashMessage.vue';
import { ref } from 'vue';

const form = useForm();
const addCourseId = ref(null);

const props = defineProps({
    courses: Object,
    student: Object,
});

function attach() {
    if (addCourseId.value) {
        form.get(route('student.courses.attach', [props.student.id, addCourseId.value]));
        addCourseId.value = null;
    }
}

function detach(id) {
    if (confirm("Are you sure you want to delete the record?")) {
        form.get(route('student.courses.detach', [props.student.id, id]));
    }
}
</script>

<template>
    <AppLayout title="Schedules">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('students.index')">Students</Link>
                <span class="text-indigo-400 font-medium"> / </span>
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('students.edit', props.student.id)">{{ props.student.id }}</Link>
                <span class="text-indigo-400 font-medium"> / </span>Courses
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <FlashMessage class="mb-4" />

                        <div class="mb-3">
                            <div class="flex">
                                <div class="w-72">
                                    <select class="form-select appearance-none last:block last:w-full last:px-3 last:py-1.5 last:text-base last:font-normal last:text-gray-700 last:bg-white bg-clip-padding bg-no-repeat last:border border-solid border-gray-300 last:rounded last:transition last:ease-in-out last:m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example"
                                    v-model="addCourseId"
                                    >
                                        <option selected>Select a course</option>
                                        <option :value="course.id" v-for="course in courses" :key="course.id">{{ course.name }}</option>
                                    </select>
                                </div>

                                <JetButton @click="attach()">
                                    Add
                                </JetButton>
                            </div>
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
                                            Schedules
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Start date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            End date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="course in student.courses"
                                        :key="course.id"
                                        class="bg-white border-b"
                                    >
                                        <th class="px-6 py-4 font-medium">
                                            {{ course.id }}
                                        </th>
                                        <th class="px-6 py-4 font-medium">
                                            {{ course.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <div v-for="schedule in course.schedules" :key="schedule.id">
                                                {{ schedule.range_of_hours }} {{ schedule.days }}
                                                <br>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ course.start_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ course.end_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <JetDangerButton class="m-1" @click="detach(course.id)">
                                                Delete
                                            </JetDangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
