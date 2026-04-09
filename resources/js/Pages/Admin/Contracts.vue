<template>
    <Head title="Admin — Contrats" />
    <AdminLayout title="Contrats générés">

        <div class="flex items-center gap-4 mb-5">
            <div class="flex gap-2">
                <button v-for="s in ['Tous', 'free', 'paid', 'subscription']" :key="s"
                        @click="filter = s"
                        :class="filter === s ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border border-gray-200'"
                        class="px-3 py-1.5 rounded-full text-xs font-medium hover:opacity-80 transition">
                    {{ s === 'Tous' ? 'Tous' : statusLabel(s) }}
                </button>
            </div>
            <span class="text-sm text-gray-400 ml-auto">{{ contracts.total }} contrats</span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Utilisateur</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Modèle</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Statut</th>
                        <th class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase">PDF</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in filteredContracts" :key="c.id"
                        class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition text-sm">
                        <td class="px-5 py-3 text-gray-400 text-xs font-mono">#{{ c.id }}</td>
                        <td class="px-5 py-3">
                            <div class="font-medium text-gray-800">{{ c.user_name }}</div>
                            <div class="text-xs text-gray-400">{{ c.user_email }}</div>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ c.template_name }}</td>
                        <td class="px-5 py-3 text-center">
                            <span :class="statusClass(c.payment_status)"
                                  class="text-xs font-semibold px-2.5 py-1 rounded-full">
                                {{ statusLabel(c.payment_status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <a v-if="c.has_pdf" :href="`/api/contracts/${c.id}/pdf`" target="_blank"
                               class="text-xs text-blue-600 hover:underline">⬇ PDF</a>
                            <span v-else class="text-xs text-gray-300">—</span>
                        </td>
                        <td class="px-5 py-3 text-xs text-gray-400">{{ formatDate(c.created_at) }}</td>
                    </tr>
                    <tr v-if="filteredContracts.length === 0">
                        <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">Aucun contrat.</td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div v-if="contracts.last_page > 1" class="px-5 py-4 border-t border-gray-100 flex items-center gap-2 text-sm">
                <Link v-if="contracts.prev_page_url" :href="contracts.prev_page_url"
                      class="px-3 py-1.5 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition">
                    ← Préc.
                </Link>
                <span class="text-gray-500 text-xs">Page {{ contracts.current_page }} / {{ contracts.last_page }}</span>
                <Link v-if="contracts.next_page_url" :href="contracts.next_page_url"
                      class="px-3 py-1.5 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition">
                    Suiv. →
                </Link>
            </div>
        </div>

    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AdminLayout from './Layout.vue';

const props = defineProps({ contracts: Object });

const filter = ref('Tous');

const filteredContracts = computed(() =>
    filter.value === 'Tous'
        ? props.contracts.data
        : props.contracts.data.filter((c) => c.payment_status === filter.value)
);

function statusLabel(s) {
    return { free: 'Gratuit', paid: 'Payé', subscription: 'Abonnement' }[s] ?? s;
}
function statusClass(s) {
    return {
        free: 'bg-gray-100 text-gray-600',
        paid: 'bg-green-100 text-green-700',
        subscription: 'bg-blue-100 text-blue-700',
    }[s] ?? 'bg-gray-100 text-gray-500';
}
function formatDate(iso) {
    return new Date(iso).toLocaleDateString('fr-MA', { day: '2-digit', month: 'short', year: 'numeric' });
}
</script>
