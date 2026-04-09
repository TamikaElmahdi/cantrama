<template>
    <Head title="ContratMA — Contrats professionnels marocains en PDF" />

    <div class="min-h-screen bg-white font-sans">

        <!-- ═══════════════════ NAVBAR ═══════════════════ -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-gray-900">Contrat<span class="text-blue-600">MA</span></span>
                </div>

                <div class="hidden md:flex items-center gap-8 text-sm text-gray-600">
                    <a href="#templates" class="hover:text-blue-600 transition">Modèles</a>
                    <a href="#how" class="hover:text-blue-600 transition">Comment ça marche</a>
                    <a href="#pricing" class="hover:text-blue-600 transition">Tarifs</a>
                </div>

                <div class="flex items-center gap-3 text-sm">
                    <template v-if="$page.props.auth.user">
                        <Link :href="route('contracts.history')" class="text-gray-600 hover:text-blue-600 transition font-medium">Mes contrats</Link>
                        <Link v-if="$page.props.auth.user.is_admin" :href="route('admin.dashboard')" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Admin</Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')" class="text-gray-600 hover:text-blue-600 transition font-medium">Connexion</Link>
                        <Link :href="route('register')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">S'inscrire</Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- ═══════════════════ HERO ═══════════════════ -->
        <section class="pt-24 pb-16 overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50/40 to-white relative">
            <!-- Background decorations -->
            <div class="absolute top-20 right-0 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-100/40 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                    <!-- Left text -->
                    <div>
                        <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-full px-4 py-1.5 text-xs font-semibold text-blue-700 mb-6">
                            <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                            Nouveau · 12 modèles de contrats marocains
                        </div>

                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-5">
                            Générez vos<br>
                            <span class="text-blue-600">contrats marocains</span><br>
                            en PDF en 2 min
                        </h1>

                        <p class="text-lg text-gray-500 mb-8 leading-relaxed">
                            Modèles bilingues Français / Arabe, conformes au droit marocain (D.O.C.). Remplissez, prévisualisez, téléchargez.
                        </p>

                        <div class="flex flex-wrap gap-4 mb-10">
                            <a href="#templates" class="bg-blue-600 text-white px-7 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-md shadow-blue-200 flex items-center gap-2">
                                Choisir un modèle
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            <a href="#how" class="bg-white text-gray-700 px-7 py-3 rounded-xl font-semibold hover:bg-gray-50 transition border border-gray-200 shadow-sm">
                                Comment ça marche ?
                            </a>
                        </div>

                        <!-- Social proof -->
                        <div class="flex items-center gap-6 text-sm text-gray-500">
                            <div class="flex items-center gap-1.5">
                                <div class="flex -space-x-1">
                                    <div class="w-7 h-7 rounded-full bg-blue-400 border-2 border-white flex items-center justify-center text-white text-xs font-bold">A</div>
                                    <div class="w-7 h-7 rounded-full bg-green-400 border-2 border-white flex items-center justify-center text-white text-xs font-bold">M</div>
                                    <div class="w-7 h-7 rounded-full bg-purple-400 border-2 border-white flex items-center justify-center text-white text-xs font-bold">Y</div>
                                </div>
                                <span>500+ utilisateurs</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span>4.9 / 5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right floating cards -->
                    <div class="relative h-80 lg:h-96 hidden lg:block">
                        <!-- Main card -->
                        <div class="absolute top-4 right-4 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-5">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">Contrat de bail</div>
                                    <div class="text-xs text-gray-400">عقد الإيجار</div>
                                </div>
                                <span class="ml-auto bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full">Prêt</span>
                            </div>
                            <div class="space-y-2">
                                <div class="h-2 bg-gray-100 rounded w-full"></div>
                                <div class="h-2 bg-gray-100 rounded w-4/5"></div>
                                <div class="h-2 bg-blue-100 rounded w-3/5"></div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-xs text-gray-400">Casablanca · Aujourd'hui</span>
                                <button class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg font-medium">Télécharger</button>
                            </div>
                        </div>

                        <!-- Stats card -->
                        <div class="absolute top-0 left-0 bg-white rounded-2xl shadow-lg border border-gray-100 p-4 w-44">
                            <div class="text-xs text-gray-500 mb-1">Contrats générés</div>
                            <div class="text-2xl font-bold text-gray-900">2,840</div>
                            <div class="text-xs text-green-600 font-medium flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                +18% ce mois
                            </div>
                        </div>

                        <!-- Notification card -->
                        <div class="absolute bottom-10 left-8 bg-white rounded-xl shadow-lg border border-gray-100 p-3 flex items-center gap-3 w-56">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-gray-900">PDF généré !</div>
                                <div class="text-xs text-gray-400">Contrat de travail CDI</div>
                            </div>
                        </div>

                        <!-- Languages badge -->
                        <div class="absolute bottom-0 right-8 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow-lg p-3 text-center">
                            <div class="text-xs font-bold">FR / العربية</div>
                            <div class="text-xs opacity-80">Bilingue</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marquee platforms (templates names) -->
            <div class="mt-14 overflow-hidden">
                <div class="text-center text-xs text-gray-400 mb-4 uppercase tracking-widest font-semibold">Modèles disponibles</div>
                <div class="flex gap-6 animate-marquee whitespace-nowrap px-6">
                    <span v-for="t in [...templates, ...templates]" :key="t.id + Math.random()" class="inline-flex items-center gap-2 bg-white border border-gray-200 rounded-full px-4 py-2 text-xs font-medium text-gray-700 shadow-sm flex-shrink-0">
                        📄 {{ t.name_fr }}
                    </span>
                </div>
            </div>
        </section>

        <!-- ═══════════════════ STATS ═══════════════════ -->
        <section class="py-12 bg-white border-y border-gray-100">
            <div class="max-w-4xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-gray-900">12+</div>
                    <div class="text-sm text-gray-500 mt-1">Modèles de contrats</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900">2,840</div>
                    <div class="text-sm text-gray-500 mt-1">PDFs générés</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900">99%</div>
                    <div class="text-sm text-gray-500 mt-1">Satisfaction client</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-gray-900">2 min</div>
                    <div class="text-sm text-gray-500 mt-1">Pour générer un contrat</div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════ HOW IT WORKS ═══════════════════ -->
        <section id="how" class="py-20 bg-slate-50">
            <div class="max-w-5xl mx-auto px-6">
                <div class="text-center mb-14">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Comment ça marche ?</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">Votre contrat en <span class="text-blue-600">3 étapes</span></h2>
                    <p class="text-gray-500 mt-3 max-w-xl mx-auto">Pas besoin d'avocat pour les contrats courants. ContratMA vous guide pas à pas.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl p-7 border border-gray-100 shadow-sm relative">
                        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center mb-5 text-white font-bold text-lg">1</div>
                        <h3 class="font-bold text-gray-900 mb-2 text-lg">Choisissez un modèle</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Parcourez nos 12+ modèles de contrats marocains : bail, travail, prestation, NDA, vente...</p>
                        <div class="absolute top-7 right-7 text-2xl opacity-20">📋</div>
                    </div>
                    <div class="bg-blue-600 rounded-2xl p-7 text-white shadow-lg shadow-blue-200 relative">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-5 font-bold text-lg">2</div>
                        <h3 class="font-bold mb-2 text-lg">Remplissez le formulaire</h3>
                        <p class="text-sm text-blue-100 leading-relaxed">Formulaire guidé, aperçu en temps réel. Les champs sont adaptés à chaque type de contrat.</p>
                        <div class="absolute top-7 right-7 text-2xl opacity-30">✏️</div>
                    </div>
                    <div class="bg-white rounded-2xl p-7 border border-gray-100 shadow-sm relative">
                        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center mb-5 text-white font-bold text-lg">3</div>
                        <h3 class="font-bold text-gray-900 mb-2 text-lg">Téléchargez votre PDF</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">PDF professionnel A4 bilingue, prêt à imprimer et à signer. Archivé dans votre espace.</p>
                        <div class="absolute top-7 right-7 text-2xl opacity-20">⬇️</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════ TEMPLATES GRID ═══════════════════ -->
        <section id="templates" class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-12">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Bibliothèque</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">Tous nos modèles de contrats</h2>
                    <p class="text-gray-500 mt-3">Conformes au droit marocain · Bilingues FR/AR · Mise à jour régulière</p>
                </div>

                <!-- Category filter -->
                <div class="flex flex-wrap justify-center gap-3 mb-10">
                    <button
                        v-for="cat in categories"
                        :key="cat"
                        @click="activeCategory = cat"
                        :class="activeCategory === cat
                            ? 'bg-blue-600 text-white shadow-md shadow-blue-200'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-full text-sm font-medium transition"
                    >{{ cat }}</button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    <div
                        v-for="template in filteredTemplates"
                        :key="template.id"
                        class="group border border-gray-200 rounded-2xl p-5 hover:border-blue-300 hover:shadow-lg transition-all cursor-pointer bg-white"
                        @click="$router.push ? null : (window.location.href = '/contrat/' + template.slug)"
                    >
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 text-xl"
                             :class="categoryColor(template.category)">
                            {{ categoryIcon(template.category) }}
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm mb-1 leading-snug">{{ template.name_fr }}</h3>
                        <p class="text-xs text-gray-400 mb-4" dir="rtl">{{ template.name_ar }}</p>
                        <Link
                            :href="route('contract.builder', { slug: template.slug })"
                            class="text-xs text-blue-600 font-semibold group-hover:underline flex items-center gap-1"
                        >
                            Utiliser ce modèle
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </Link>
                    </div>

                    <!-- Coming soon placeholder -->
                    <div class="border border-dashed border-gray-200 rounded-2xl p-5 flex flex-col items-center justify-center text-center opacity-60">
                        <div class="text-2xl mb-2">🔜</div>
                        <p class="text-xs text-gray-400 font-medium">Nouveau modèle bientôt</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════ FEATURE HIGHLIGHT ═══════════════════ -->
        <section class="py-20 bg-gradient-to-br from-blue-600 to-indigo-700 text-white overflow-hidden relative">
            <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute left-0 bottom-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="max-w-4xl mx-auto px-6 text-center relative">
                <h2 class="text-3xl font-bold mb-4">Conforme au droit marocain</h2>
                <p class="text-blue-100 text-lg mb-10 max-w-2xl mx-auto">
                    Tous nos modèles respectent le Dahir des Obligations et des Contrats (D.O.C.), le Code du travail marocain, et la loi sur les baux d'habitation.
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                        <div class="text-2xl mb-2">⚖️</div>
                        <div class="text-sm font-semibold">D.O.C.</div>
                        <div class="text-xs text-blue-200 mt-1">Dahir des obligations</div>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                        <div class="text-2xl mb-2">👷</div>
                        <div class="text-sm font-semibold">Code du travail</div>
                        <div class="text-xs text-blue-200 mt-1">Loi n° 65-99</div>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                        <div class="text-2xl mb-2">🏠</div>
                        <div class="text-sm font-semibold">Loi sur les baux</div>
                        <div class="text-xs text-blue-200 mt-1">Dahir 6246</div>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                        <div class="text-2xl mb-2">🌍</div>
                        <div class="text-sm font-semibold">Bilingue</div>
                        <div class="text-xs text-blue-200 mt-1">Français / العربية</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════ PRICING ═══════════════════ -->
        <section id="pricing" class="py-20 bg-slate-50">
            <div class="max-w-5xl mx-auto px-6">
                <div class="text-center mb-12">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Tarifs</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">Simple et transparent</h2>
                    <p class="text-gray-500 mt-3">Sans abonnement forcé. Payez à l'usage ou abonnez-vous.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Free -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-7 shadow-sm">
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">Gratuit</div>
                        <div class="text-4xl font-bold text-gray-900 mb-1">0 <span class="text-lg text-gray-400">MAD</span></div>
                        <div class="text-sm text-gray-400 mb-6">1 contrat à l'inscription</div>
                        <ul class="space-y-3 text-sm text-gray-600 mb-8">
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> 1 crédit offert</li>
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Aperçu PDF gratuit</li>
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Tous les modèles visibles</li>
                            <li class="flex items-center gap-2"><span class="text-red-400">✗</span> Filigrane ContratMA</li>
                        </ul>
                        <Link :href="route('register')" class="block text-center bg-gray-100 text-gray-800 py-3 rounded-xl font-semibold hover:bg-gray-200 transition text-sm">
                            S'inscrire gratuitement
                        </Link>
                    </div>

                    <!-- Pay per use -->
                    <div class="bg-blue-600 rounded-2xl border-2 border-blue-600 p-7 shadow-xl shadow-blue-200 relative">
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-yellow-400 text-gray-900 text-xs font-bold px-4 py-1.5 rounded-full shadow-md">⭐ POPULAIRE</div>
                        <div class="text-sm font-bold text-blue-200 uppercase tracking-wide mb-1">Par contrat</div>
                        <div class="text-4xl font-bold text-white mb-1">9 <span class="text-lg text-blue-200">MAD</span></div>
                        <div class="text-sm text-blue-200 mb-6">par téléchargement</div>
                        <ul class="space-y-3 text-sm text-white mb-8">
                            <li class="flex items-center gap-2"><span class="text-green-300 font-bold">✓</span> Sans filigrane</li>
                            <li class="flex items-center gap-2"><span class="text-green-300 font-bold">✓</span> PDF haute qualité A4</li>
                            <li class="flex items-center gap-2"><span class="text-green-300 font-bold">✓</span> Tous les modèles</li>
                            <li class="flex items-center gap-2"><span class="text-green-300 font-bold">✓</span> Sauvegardé dans votre espace</li>
                        </ul>
                        <a href="#templates" class="block text-center bg-white text-blue-600 py-3 rounded-xl font-bold hover:bg-blue-50 transition text-sm shadow">
                            Choisir un modèle
                        </a>
                    </div>

                    <!-- Pro -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-7 shadow-sm">
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-1">Pro</div>
                        <div class="text-4xl font-bold text-gray-900 mb-1">99 <span class="text-lg text-gray-400">MAD/mois</span></div>
                        <div class="text-sm text-gray-400 mb-6">Pour les professionnels</div>
                        <ul class="space-y-3 text-sm text-gray-600 mb-8">
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Contrats illimités</li>
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Sans filigrane</li>
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Tous les modèles</li>
                            <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Support prioritaire</li>
                        </ul>
                        <button class="w-full bg-gray-900 text-white py-3 rounded-xl font-semibold hover:bg-gray-700 transition text-sm">
                            S'abonner Pro
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════ CTA ═══════════════════ -->
        <section class="py-16 bg-white">
            <div class="max-w-2xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Prêt à générer votre contrat ?</h2>
                <p class="text-gray-500 mb-8">Inscrivez-vous gratuitement et obtenez 1 contrat offert dès aujourd'hui.</p>
                <Link :href="route('register')" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 text-lg">
                    Commencer gratuitement →
                </Link>
            </div>
        </section>

        <!-- ═══════════════════ FOOTER ═══════════════════ -->
        <footer class="bg-gray-900 text-gray-400 py-10">
            <div class="max-w-5xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-blue-600 rounded flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-white font-semibold">ContratMA</span>
                </div>
                <p>© 2024 ContratMA.ma — Contrats professionnels pour le Maroc</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition">Mentions légales</a>
                    <a href="#" class="hover:text-white transition">Contact</a>
                </div>
            </div>
        </footer>

    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    templates: Array,
});

const activeCategory = ref('Tous');

const categories = computed(() => {
    const cats = ['Tous', ...new Set(props.templates.map((t) => t.category || 'Autres'))];
    return cats;
});

const filteredTemplates = computed(() => {
    if (activeCategory.value === 'Tous') return props.templates;
    return props.templates.filter((t) => (t.category || 'Autres') === activeCategory.value);
});

function categoryIcon(cat) {
    const icons = {
        'Travail': '👷',
        'Immobilier': '🏠',
        'Commercial': '💼',
        'Société': '🏢',
        'Personnel': '👤',
        'Autres': '📄',
    };
    return icons[cat] || '📄';
}

function categoryColor(cat) {
    const colors = {
        'Travail': 'bg-orange-100',
        'Immobilier': 'bg-green-100',
        'Commercial': 'bg-blue-100',
        'Société': 'bg-purple-100',
        'Personnel': 'bg-pink-100',
        'Autres': 'bg-gray-100',
    };
    return colors[cat] || 'bg-gray-100';
}
</script>

<style scoped>
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-marquee {
    animation: marquee 30s linear infinite;
    display: inline-flex;
}
</style>
