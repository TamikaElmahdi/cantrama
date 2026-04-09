<template>
    <Head :title="template ? 'Modifier le modèle' : 'Nouveau modèle'" />
    <AdminLayout :title="template ? 'Modifier : ' + template.name_fr : 'Nouveau modèle'">

        <form @submit.prevent="submit" class="max-w-2xl space-y-5">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom FR *</label>
                    <input v-model="form.name_fr" type="text" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom AR * <span class="text-gray-400 text-xs">(dir: rtl)</span></label>
                    <input v-model="form.name_ar" type="text" required dir="rtl"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug * <span class="text-gray-400 text-xs">(URL)</span></label>
                    <input v-model="form.slug" type="text" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                    <select v-model="form.category" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description FR</label>
                <textarea v-model="form.description_fr" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Blade path * <span class="text-gray-400 text-xs">(ex: pdf.prestation)</span></label>
                <input v-model="form.pdf_blade_path" type="text" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Champs JSON *
                    <span class="text-gray-400 text-xs font-normal ml-1">— tableau d'objets {name, label_fr, label_ar, type, required}</span>
                </label>
                <textarea v-model="form.fields" rows="12"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y"
                          :class="fieldsError ? 'border-red-400' : ''"
                          @input="validateJson"></textarea>
                <p v-if="fieldsError" class="text-xs text-red-500 mt-1">JSON invalide : {{ fieldsError }}</p>
            </div>

            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700 cursor-pointer">
                    <input type="checkbox" v-model="form.is_active" class="rounded" />
                    Modèle actif (visible sur le site)
                </label>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" :disabled="!!fieldsError || loading"
                        class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-blue-700 transition disabled:opacity-50">
                    {{ loading ? 'Enregistrement...' : (template ? 'Mettre à jour' : 'Créer le modèle') }}
                </button>
                <Link :href="route('admin.templates')" class="text-sm text-gray-500 hover:text-gray-700">Annuler</Link>
            </div>

            <p v-if="successMsg" class="text-sm text-green-600 bg-green-50 p-3 rounded-lg">{{ successMsg }}</p>
        </form>

    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from './Layout.vue';

const props = defineProps({ template: Object });

const categories = ['Commercial', 'Travail', 'Immobilier', 'Société', 'Personnel', 'Autres'];

const form = ref({
    name_fr: props.template?.name_fr ?? '',
    name_ar: props.template?.name_ar ?? '',
    slug: props.template?.slug ?? '',
    category: props.template?.category ?? 'Commercial',
    description_fr: props.template?.description_fr ?? '',
    pdf_blade_path: props.template?.pdf_blade_path ?? 'pdf.generic',
    is_active: props.template?.is_active ?? true,
    fields: props.template ? JSON.stringify(props.template.fields, null, 2) : '[\n  {\n    "name": "field_name",\n    "label_fr": "Libellé FR",\n    "label_ar": "التسمية",\n    "type": "text",\n    "required": true\n  }\n]',
});

const fieldsError = ref('');
const loading = ref(false);
const successMsg = ref('');

function validateJson() {
    try {
        JSON.parse(form.value.fields);
        fieldsError.value = '';
    } catch (e) {
        fieldsError.value = e.message;
    }
}

function submit() {
    validateJson();
    if (fieldsError.value) return;

    loading.value = true;
    const payload = { ...form.value };

    if (props.template) {
        router.put(route('admin.templates.update', props.template.id), payload, {
            onSuccess: () => { successMsg.value = 'Modèle mis à jour avec succès.'; },
            onFinish: () => { loading.value = false; },
        });
    } else {
        router.post(route('admin.templates.store'), payload, {
            onSuccess: () => { successMsg.value = 'Modèle créé avec succès.'; },
            onFinish: () => { loading.value = false; },
        });
    }
}
</script>
