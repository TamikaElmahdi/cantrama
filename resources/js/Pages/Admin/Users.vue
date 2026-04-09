<template>
    <Head title="Admin — Utilisateurs" />
    <AdminLayout title="Utilisateurs">

        <div class="flex items-center justify-between mb-5">
            <div class="flex gap-2">
                <button v-for="p in ['Tous', 'free', 'pro', 'agency']" :key="p"
                        @click="planFilter = p"
                        :class="planFilter === p ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border border-gray-200'"
                        class="px-3 py-1.5 rounded-full text-xs font-medium hover:opacity-80 transition capitalize">
                    {{ p === 'Tous' ? 'Tous' : p }}
                </button>
            </div>
            <span class="text-sm text-gray-400">{{ users.total }} utilisateurs</span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Utilisateur</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Plan</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Crédits</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Contrats</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Admin</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Inscrit le</th>
                        <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="u in filteredUsers" :key="u.id"
                        class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition text-sm">
                        <td class="px-5 py-3">
                            <div class="font-medium text-gray-800">{{ u.name }}</div>
                            <div class="text-xs text-gray-400">{{ u.email }}</div>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span :class="planClass(u.plan)"
                                  class="text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                                {{ u.plan }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center text-sm font-medium text-gray-700">{{ u.credits }}</td>
                        <td class="px-5 py-3 text-center text-sm text-gray-500">{{ u.contracts_count }}</td>
                        <td class="px-5 py-3 text-center">
                            <span v-if="u.is_admin" class="text-xs font-bold text-purple-700 bg-purple-100 px-2 py-0.5 rounded-full">Admin</span>
                            <span v-else class="text-xs text-gray-300">—</span>
                        </td>
                        <td class="px-5 py-3 text-xs text-gray-400">{{ formatDate(u.created_at) }}</td>
                        <td class="px-5 py-3 text-right">
                            <button @click="openEdit(u)"
                                    class="text-xs text-blue-600 hover:underline font-medium">
                                Modifier
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div v-if="users.last_page > 1" class="px-5 py-4 border-t border-gray-100 flex items-center gap-2 text-sm">
                <Link v-if="users.prev_page_url" :href="users.prev_page_url"
                      class="px-3 py-1.5 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition">← Préc.</Link>
                <span class="text-gray-500 text-xs">Page {{ users.current_page }} / {{ users.last_page }}</span>
                <Link v-if="users.next_page_url" :href="users.next_page_url"
                      class="px-3 py-1.5 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition">Suiv. →</Link>
            </div>
        </div>

        <!-- Edit modal -->
        <div v-if="editing" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6">
                <h3 class="font-bold text-gray-900 mb-4">Modifier — {{ editing.name }}</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Plan</label>
                        <select v-model="editForm.plan"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="free">Free</option>
                            <option value="pro">Pro</option>
                            <option value="agency">Agency</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Crédits</label>
                        <input v-model.number="editForm.credits" type="number" min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-medium text-gray-700 cursor-pointer">
                            <input type="checkbox" v-model="editForm.is_admin" class="rounded" />
                            Administrateur
                        </label>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button @click="saveEdit" :disabled="saving"
                            class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-semibold text-sm hover:bg-blue-700 transition disabled:opacity-50">
                        {{ saving ? 'Enregistrement...' : 'Enregistrer' }}
                    </button>
                    <button @click="editing = null" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-semibold text-sm hover:bg-gray-200 transition">
                        Annuler
                    </button>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import axios from 'axios';
import AdminLayout from './Layout.vue';

const props = defineProps({ users: Object });

const planFilter = ref('Tous');
const editing = ref(null);
const editForm = ref({});
const saving = ref(false);

const filteredUsers = computed(() =>
    planFilter.value === 'Tous'
        ? props.users.data
        : props.users.data.filter((u) => u.plan === planFilter.value)
);

function openEdit(u) {
    editing.value = u;
    editForm.value = { plan: u.plan, credits: u.credits, is_admin: u.is_admin };
}

async function saveEdit() {
    saving.value = true;
    try {
        await axios.patch(route('admin.users.update', editing.value.id), editForm.value);
        Object.assign(editing.value, editForm.value);
        editing.value = null;
    } finally {
        saving.value = false;
    }
}

function planClass(p) {
    return {
        free: 'bg-gray-100 text-gray-600',
        pro: 'bg-blue-100 text-blue-700',
        agency: 'bg-purple-100 text-purple-700',
    }[p] ?? 'bg-gray-100 text-gray-500';
}
function formatDate(iso) {
    return new Date(iso).toLocaleDateString('fr-MA', { day: '2-digit', month: 'short', year: 'numeric' });
}
</script>
