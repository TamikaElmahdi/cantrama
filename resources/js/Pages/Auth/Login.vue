<template>
    <Head title="Connexion — ContratMA" />

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/40 to-white flex">

        <!-- Left panel (hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 flex-col justify-between p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

            <Link :href="route('home')" class="flex items-center gap-2 relative z-10">
                <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="font-bold text-xl text-white">ContratMA</span>
            </Link>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-4 leading-tight">
                    Vos contrats marocains,<br>en 2 minutes chrono.
                </h2>
                <p class="text-blue-100 text-lg mb-8">
                    Bilingues FR/AR, conformes au droit marocain, prêts à signer.
                </p>

                <!-- Testimonial -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5">
                    <p class="text-white text-sm leading-relaxed mb-3">
                        "ContratMA m'a sauvé des heures de travail. J'ai généré mes contrats de prestation en quelques minutes !"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center text-white font-bold text-sm">Y</div>
                        <div>
                            <div class="text-white text-sm font-semibold">Youssef B.</div>
                            <div class="text-blue-200 text-xs">Consultant, Casablanca</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-blue-200 text-xs relative z-10">© 2024 ContratMA.ma</div>
        </div>

        <!-- Right panel: form -->
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">

                <!-- Mobile logo -->
                <Link :href="route('home')" class="flex items-center gap-2 mb-8 lg:hidden">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-gray-900">Contrat<span class="text-blue-600">MA</span></span>
                </Link>

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Bon retour 👋</h1>
                <p class="text-gray-500 text-sm mb-8">Connectez-vous à votre espace ContratMA</p>

                <div v-if="status" class="mb-5 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Adresse email</label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="vous@exemple.ma"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.email ? 'border-red-400 bg-red-50' : ''"
                        />
                        <p v-if="form.errors.email" class="text-xs text-red-500 mt-1.5">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <Link v-if="canResetPassword" :href="route('password.request')"
                                  class="text-xs text-blue-600 hover:underline">
                                Mot de passe oublié ?
                            </Link>
                        </div>
                        <input
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.password ? 'border-red-400 bg-red-50' : ''"
                        />
                        <p v-if="form.errors.password" class="text-xs text-red-500 mt-1.5">{{ form.errors.password }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="remember" type="checkbox" v-model="form.remember"
                               class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                        <label for="remember" class="text-sm text-gray-600 cursor-pointer">Se souvenir de moi</label>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold text-sm hover:bg-blue-700 transition shadow-md shadow-blue-100 disabled:opacity-60"
                    >
                        {{ form.processing ? 'Connexion...' : 'Se connecter' }}
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Pas encore de compte ?
                    <Link :href="route('register')" class="text-blue-600 font-semibold hover:underline">S'inscrire gratuitement</Link>
                </p>

            </div>
        </div>

    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({ canResetPassword: Boolean, status: String });

const form = useForm({ email: '', password: '', remember: false });
const submit = () => form.post(route('login'), { onFinish: () => form.reset('password') });
</script>
