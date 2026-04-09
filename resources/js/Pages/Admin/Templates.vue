<template>
    <Head title="Admin — Modèles" />
    <AdminLayout title="Modèles de contrats">

        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-gray-500">{{ templates.length }} modèles au total</p>
            <Link :href="route('admin.templates.create')"
                  class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                + Nouveau modèle
            </Link>
        </div>

        <!-- Category filter -->
        <div class="flex flex-wrap gap-2 mb-5">
            <button v-for="cat in allCategories" :key="cat"
                    @click="activeCategory = cat"
                    :class="activeCategory === cat ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'"
                    class="px-3 py-1.5 rounded-full text-xs font-medium transition">
                {{ cat }}
            </button>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Modèle</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Catégorie</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Slug</th>
                        <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Statut</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tpl in filtered" :key="tpl.id"
                        class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 text-sm">{{ tpl.name_fr }}</div>
                            <div class="text-xs text-gray-400 mt-0.5" dir="rtl">{{ tpl.name_ar }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-medium bg-gray-100 text-gray-700 px-2 py-1 rounded-full">
                                {{ tpl.category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-400 font-mono">{{ tpl.slug }}</td>
                        <td class="px-6 py-4 text-center">
                            <button @click="toggleActive(tpl)"
                                    :class="tpl.is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600'"
                                    class="text-xs font-semibold px-2.5 py-1 rounded-full hover:opacity-80 transition">
                                {{ tpl.is_active ? 'Actif' : 'Inactif' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <Link :href="route('admin.templates.edit', tpl.id)"
                                  class="text-sm text-blue-600 hover:underline font-medium">
                                Modifier
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import axios from 'axios';
import AdminLayout from './Layout.vue';

const props = defineProps({ templates: Array });

const activeCategory = ref('Tous');
const templates = ref([...props.templates]);

const allCategories = computed(() => ['Tous', ...new Set(templates.value.map((t) => t.category))]);

const filtered = computed(() =>
    activeCategory.value === 'Tous'
        ? templates.value
        : templates.value.filter((t) => t.category === activeCategory.value)
);

async function toggleActive(tpl) {
    const res = await axios.patch(route('admin.templates.toggle', tpl.id));
    tpl.is_active = res.data.is_active;
}
</script>
