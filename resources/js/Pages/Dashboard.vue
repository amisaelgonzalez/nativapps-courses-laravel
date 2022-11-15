<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    top_courses: Object,
    top_students: Object,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4">
                    <div class="m-3">
                        <h1 class="text-3xl font-bold">Top 3 courses</h1>
                    </div>
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
                                    Students
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="course in top_courses"
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
                                    {{ course.students_count }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4">
                    <div class="m-3">
                        <h1 class="text-3xl font-bold">Top 3 students</h1>
                    </div>
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
                                    Courses
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="student in top_students"
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
                                    {{ student.courses_count }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
