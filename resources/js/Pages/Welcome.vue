<script setup>
import { Head, Link } from '@inertiajs/vue3';

// Recebe as propriedades de autenticação automáticas do Laravel/Inertia
defineProps({
    canLogin: {
        type: Boolean,
        default: true,
    },
    canRegister: {
        type: Boolean,
        default: true,
    },
});
</script>

<template>

    <Head title="TopRecomendações — Hotéis & Restaurantes" />

    <component :is="'script'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" async>
    </component>

    <div
        class="bg-slate-950 text-slate-100 min-h-screen font-sans antialiased selection:bg-amber-500 selection:text-slate-950">

        <nav class="border-b border-slate-900 bg-slate-950/70 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center gap-2 group">
                    <i
                        class="fa-solid fa-ranking-star text-amber-500 text-2xl transition-transform group-hover:rotate-12"></i>
                    <span
                        class="text-xl font-bold tracking-wider bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">TopRecomendações</span>
                </div>

                <nav class="flex items-center gap-6">


                    <template v-if="$page.props.auth.user">
                        <Link :href="route('dashboard')"
                            class="text-sm bg-slate-900 hover:bg-slate-800 text-amber-400 border border-slate-800 font-semibold px-4 py-2 rounded-xl transition flex items-center gap-2">
                            <i class="fa-solid fa-gauge text-xs"></i> Dashboard
                        </Link>
                    </template>

                    <template v-else>
                        <Link :href="route('login')"
                            class="text-sm text-slate-400 hover:text-amber-400 transition font-medium">Entrar</Link>
                        <Link v-if="canRegister" :href="route('register')"
                            class="text-sm bg-gradient-to-r from-amber-500 to-orange-600 text-slate-950 font-bold px-4 py-2 rounded-xl shadow-lg shadow-orange-500/10 transition transform hover:-translate-y-0.5">
                            Registar
                        </Link>
                    </template>
                </nav>
            </div>
        </nav>

        <header class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center overflow-hidden">
            <div
                class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[250px] bg-amber-500/10 blur-[100px] rounded-full pointer-events-none">
            </div>

            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20 mb-6">
                <i class="fa-solid fa-fire text-[10px]"></i> Top Recomendações

            </span>

            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                Descobre e Partilha os <br>
                <span
                    class="bg-gradient-to-r from-amber-400 via-orange-400 to-amber-500 bg-clip-text text-transparent">Melhores
                    Locais</span> da Cidade
            </h1>

            <p class="text-slate-400 max-w-2xl mx-auto mb-10 text-lg sm:text-xl leading-relaxed">
                Cria o teu perfil, regista os teus restaurantes e hotéis favoritos, atribui notas e ajuda a gerar o top
                ideal em
                tempo real.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="w-full sm:w-auto bg-gradient-to-r from-amber-500 to-orange-600 text-slate-950 font-bold px-8 py-3.5 rounded-xl shadow-xl shadow-orange-500/10 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-right"></i> Entrar na Dashboard
                </Link>
                <template v-else>
                    <Link :href="route('register')"
                        class="w-full sm:w-auto bg-gradient-to-r from-amber-500 to-orange-600 text-slate-950 font-bold px-8 py-3.5 rounded-xl shadow-xl shadow-orange-500/10 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        Começar — é grátis <i class="fa-solid fa-arrow-right text-xs"></i>
                    </Link>
                    <Link :href="route('login')"
                        class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 font-semibold px-8 py-3.5 rounded-xl transition flex items-center justify-center gap-2">
                        Já tenho conta
                    </Link>
                </template>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-slate-900/40 border border-slate-900 rounded-2xl p-6 hover:border-slate-800 transition duration-300">
                    <div
                        class="w-12 h-12 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-utensils text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-100 mb-2">Restaurantes & Cafés</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Classifica e adiciona detalhes sobre ementas,
                        atendimento
                        e ambiente dos teus spots de refeição favoritos.</p>
                </div>

                <div
                    class="bg-slate-900/40 border border-slate-900 rounded-2xl p-6 hover:border-slate-800 transition duration-300">
                    <div
                        class="w-12 h-12 bg-blue-500/10 text-blue-400 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-hotel text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-100 mb-2">Hotéis & Estadias</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Guarda notas sobre alojamentos locais, resorts ou
                        hotéis.
                        Avalia a relação qualidade-preço de forma exata.</p>
                </div>

                <div
                    class="bg-slate-900/40 border border-slate-900 rounded-2xl p-6 hover:border-slate-800 transition duration-300">
                    <div
                        class="w-12 h-12 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-bolt text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-100 mb-2">Painel Interativo</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Uma dashboard pessoal em Vue 3 rápida para
                        inserires,
                        editares ou removeres os teus registos sem recarregar a página.</p>
                </div>
            </div>
        </main>
    </div>
</template>