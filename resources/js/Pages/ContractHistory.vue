<template>
    <Head title="Mes contrats — ContratMA" />

    <div class="min-h-screen bg-gray-50">
        <!-- Nav -->
        <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <Link :href="route('home')" class="font-bold text-xl text-gray-900">
                ContratMA<span class="text-blue-600">.ma</span>
            </Link>
            <div class="flex items-center gap-4 text-sm">
                <Link :href="route('profile.edit')" class="text-gray-600 hover:text-gray-900">Profil</Link>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto px-6 py-10">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Mes contrats</h1>
                <Link :href="route('home')" class="text-sm text-blue-600 hover:underline">+ Nouveau contrat</Link>
            </div>

            <!-- Loading -->
            <div v-if="loading" class="text-center py-20 text-gray-400">Chargement...</div>

            <!-- Empty -->
            <div v-else-if="contracts.length === 0" class="bg-white rounded-xl border border-gray-200 p-16 text-center">
                <div class="text-4xl mb-3">📄</div>
                <p class="text-gray-600 font-medium">Aucun contrat pour le moment</p>
                <p class="text-sm text-gray-400 mt-1">Générez votre premier contrat en choisissant un modèle.</p>
                <Link :href="route('home')" class="mt-5 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    Voir les modèles
                </Link>
            </div>

            <!-- Table -->
            <div v-else class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Modèle</th>
                            <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</th>
                            <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Statut</th>
                            <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="contract in contracts"
                            :key="contract.id"
                            class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition"
                        >
                            <td class="px-5 py-4">
                                <div class="font-medium text-gray-900 text-sm">{{ contract.template.name_fr }}</div>
                                <div class="text-xs text-gray-400 mt-0.5" dir="rtl">{{ contract.template.name_ar }}</div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-600">
                                {{ formatDate(contract.created_at) }}
                            </td>
                            <td class="px-5 py-4">
                                <span :class="statusClass(contract.payment_status)" class="text-xs font-medium px-2.5 py-1 rounded-full">
                                    {{ statusLabel(contract.payment_status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a
                                    v-if="contract.has_pdf"
                                    :href="`/api/contracts/${contract.id}/pdf`"
                                    target="_blank"
                                    class="text-sm text-blue-600 font-medium hover:underline"
                                >
                                    ⬇ Télécharger
                                </a>
                                <span v-else class="text-sm text-gray-400">—</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- User plan info -->
            <div class="mt-6 bg-white border border-gray-200 rounded-xl p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-800">
                        Plan actuel :
                        <span class="capitalize font-bold" :class="planClass">{{ $page.props.auth.user?.plan || 'free' }}</span>
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        Crédits restants : <strong>{{ $page.props.auth.user?.credits ?? 0 }}</strong>
                    </p>
                </div>
                <Link :href="route('home')" class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                    Passer Pro — 99 MAD/mois
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import axios from 'axios';

const contracts = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const res = await axios.get('/api/contracts/history');
        contracts.value = res.data.data ?? res.data;
    } catch {
        contracts.value = [];
    } finally {
        loading.value = false;
    }
});

function formatDate(iso) {
    if (!iso) return '—';
    return new Date(iso).toLocaleDateString('fr-MA', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
    });
}

function statusLabel(status) {
    return { free: 'Gratuit', paid: 'Payé', subscription: 'Abonnement' }[status] ?? status;
}

function statusClass(status) {
    return {
        free: 'bg-gray-100 text-gray-600',
        paid: 'bg-green-100 text-green-700',
        subscription: 'bg-blue-100 text-blue-700',
    }[status] ?? 'bg-gray-100 text-gray-500';
}

const planClass = computed(() => {
    const plan = window.__page?.props?.auth?.user?.plan ?? 'free';
    return { free: 'text-gray-600', pro: 'text-blue-600', agency: 'text-purple-600' }[plan] ?? 'text-gray-600';
});
</script>
