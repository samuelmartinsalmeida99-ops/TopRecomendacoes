<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

// Definir as props blindadas com arrays vazios por defeito para evitar ecrãs em branco
defineProps({
    restaurants: {
        type: Array,
        default: () => []
    },
    hotels: {
        type: Array,
        default: () => []
    }
});

// Função para eliminar um item com confirmação nativa do browser
const deleteItem = (type, id) => {
    if (confirm('Tens a certeza que desejas eliminar esta avaliação?')) {
        router.delete(route(`${type}.destroy`, id));
    }
};
</script>

<template>

    <Head title="Painel Principal — TopRecomendações" />

    <component :is="'script'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" async>
    </component>

    <div class="min-h-screen bg-slate-950 text-slate-100 font-sans antialiased relative overflow-hidden">
        <div
            class="absolute -top-40 right-0 w-[500px] h-[400px] bg-gradient-to-b from-amber-500/10 to-transparent blur-[120px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute top-1/3 left-1/4 w-[350px] h-[350px] bg-orange-600/5 blur-[100px] rounded-full pointer-events-none">
        </div>

        <nav class="border-b border-slate-900 bg-slate-950/70 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center gap-2 group">
                    <i
                        class="fa-solid fa-ranking-star text-amber-500 text-2xl transition-transform group-hover:rotate-12"></i>
                    <span
                        class="text-xl font-bold tracking-wider bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">TopRecomendações</span>
                </div>

                <div class="flex items-center gap-6">
                    <div
                        class="flex items-center gap-2 bg-slate-900/60 border border-slate-800/60 px-3 py-1.5 rounded-xl">
                        <i class="fa-solid fa-user text-xs text-slate-500"></i>
                        <span class="text-xs font-semibold text-slate-300 uppercase tracking-wider">{{
                            $page.props.auth.user.name }}</span>
                    </div>

                    <Link :href="route('logout')" method="post" as="button"
                        class="text-sm text-slate-400 hover:text-rose-400 transition flex items-center gap-2 font-medium">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i> Sair
                    </Link>
                </div>
            </div>
        </nav>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">

            <div
                class="bg-gradient-to-r from-slate-900/60 to-slate-900/20 border border-slate-800/60 rounded-3xl p-8 mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 backdrop-blur-sm">
                <div>
                    <span
                        class="text-xs font-bold text-amber-500 uppercase tracking-widest bg-amber-500/10 px-2.5 py-1 rounded-md mb-2 inline-block">Área
                        de Membro</span>
                    <h1 class="text-3xl font-black text-white tracking-tight">Os Meus Tops de Elite</h1>
                    <p class="text-slate-400 text-sm mt-1 max-w-md">Gere, ordena e visualiza os melhores spots que já
                        visitaste de forma instantânea.</p>
                </div>

                <Link href="/restaurants/create"
                    class="group relative w-full md:w-auto bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 text-slate-950 font-black px-6 py-4 rounded-xl shadow-xl shadow-orange-500/10 transition transform hover:-translate-y-0.5 text-sm flex items-center justify-center gap-3 overflow-hidden">
                    <div
                        class="absolute inset-0 w-full h-full bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <i class="fa-solid fa-circle-plus text-base transition-transform group-hover:rotate-90"></i>
                    <span>Adicionar Nova Avaliação</span>
                </Link>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div
                    class="bg-slate-900/30 border border-slate-900/80 rounded-2xl backdrop-blur-xl overflow-hidden flex flex-col transition hover:border-slate-800/60 duration-300">
                    <div
                        class="px-6 py-5 border-b border-slate-900/80 flex items-center justify-between bg-slate-900/40">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center border border-amber-500/10">
                                <i class="fa-solid fa-utensils text-sm"></i>
                            </div>
                            <h3 class="font-bold text-white tracking-wide">Top Restaurantes</h3>
                        </div>
                        <i class="fa-solid fa-star text-xs text-amber-500/40"></i>
                    </div>

                    <div v-if="restaurants.length > 0" class="p-4 space-y-3">
                        <div v-for="(item, index) in restaurants" :key="item.id"
                            class="flex items-center justify-between bg-slate-950/40 border border-slate-900/60 p-4 rounded-xl hover:border-slate-800 transition group">
                            <div class="flex items-center gap-4">
                                <span class="text-lg font-black text-amber-500/60 w-6">#{{ index + 1 }}</span>

                                <div class="relative group/tooltip cursor-help">
                                    <h4
                                        class="font-bold text-white text-sm border-b border-dotted border-slate-700 inline-block transition hover:text-amber-400">
                                        {{ item.name }}</h4>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ item.cuisine_type }}</p>

                                    <div v-if="item.review"
                                        class="absolute left-0 bottom-full mb-2 w-64 bg-slate-900 border border-slate-800 text-slate-200 text-xs p-3 rounded-xl shadow-2xl opacity-0 scale-95 pointer-events-none group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-200 z-50 leading-relaxed">
                                        <div class="font-bold text-amber-400 mb-1 flex items-center gap-1">
                                            <i class="fa-solid fa-comment-dots"></i> Crítica:
                                        </div>
                                        "{{ item.review }}"
                                        <div
                                            class="absolute top-full left-4 w-2 h-2 bg-slate-900 border-r border-b border-slate-800 rotate-45 -mt-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div
                                    class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-200">
                                    <Link :href="route('restaurants.edit', item.id)"
                                        class="w-8 h-8 bg-slate-900 border border-slate-800 text-slate-400 hover:text-amber-500 rounded-lg flex items-center justify-center transition">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </Link>
                                    <button @click="deleteItem('restaurants', item.id)"
                                        class="w-8 h-8 bg-slate-900 border border-slate-800 text-slate-400 hover:text-rose-500 rounded-lg flex items-center justify-center transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                                <div
                                    class="flex items-center gap-1.5 bg-amber-500/10 border border-amber-500/20 px-2.5 py-1 rounded-lg text-amber-400 font-bold text-xs shrink-0">
                                    <i class="fa-solid fa-star text-[10px]"></i> {{ item.rating }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="p-8 flex flex-col items-center justify-center py-16 text-center">
                        <div
                            class="w-14 h-14 bg-slate-950 border border-slate-800/80 text-slate-700 rounded-2xl flex items-center justify-center mb-4 shadow-inner">
                            <i class="fa-solid fa-plate-wheat text-xl"></i>
                        </div>
                        <h4 class="text-slate-300 font-bold text-sm mb-1">Ainda sem restaurantes</h4>
                        <p class="text-slate-500 text-xs max-w-xs leading-relaxed">Usa o botão acima para criar a tua
                            primeira avaliação e definir o teu top 1.</p>
                    </div>
                </div>

                <div
                    class="bg-slate-900/30 border border-slate-900/80 rounded-2xl backdrop-blur-xl overflow-hidden flex flex-col transition hover:border-slate-800/60 duration-300">
                    <div
                        class="px-6 py-5 border-b border-slate-900/80 flex items-center justify-between bg-slate-900/40">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 bg-blue-500/10 text-blue-400 rounded-xl flex items-center justify-center border border-blue-500/10">
                                <i class="fa-solid fa-hotel text-sm"></i>
                            </div>
                            <h3 class="font-bold text-white tracking-wide">Top Hotéis</h3>
                        </div>
                        <i class="fa-solid fa-star text-xs text-blue-500/40"></i>
                    </div>

                    <div v-if="hotels.length > 0" class="p-4 space-y-3">
                        <div v-for="(item, index) in hotels" :key="item.id"
                            class="flex items-center justify-between bg-slate-950/40 border border-slate-900/60 p-4 rounded-xl hover:border-slate-800 transition group">
                            <div class="flex items-center gap-4">
                                <span class="text-lg font-black text-blue-400/60 w-6">#{{ index + 1 }}</span>

                                <div class="relative group/tooltip cursor-help">
                                    <h4
                                        class="font-bold text-white text-sm border-b border-dotted border-slate-700 inline-block transition hover:text-blue-400">
                                        {{ item.name }}</h4>
                                    <p class="text-xs text-slate-400 mt-0.5"><i
                                            class="fa-solid fa-location-dot text-[10px] mr-1"></i>{{ item.location }}
                                    </p>

                                    <div v-if="item.review"
                                        class="absolute left-0 bottom-full mb-2 w-64 bg-slate-900 border border-slate-800 text-slate-200 text-xs p-3 rounded-xl shadow-2xl opacity-0 scale-95 pointer-events-none group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-200 z-50 leading-relaxed">
                                        <div class="font-bold text-blue-400 mb-1 flex items-center gap-1">
                                            <i class="fa-solid fa-comment-dots"></i> Crítica:
                                        </div>
                                        "{{ item.review }}"
                                        <div
                                            class="absolute top-full left-4 w-2 h-2 bg-slate-900 border-r border-b border-slate-800 rotate-45 -mt-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div
                                    class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-200">
                                    <Link :href="route('hotels.edit', item.id)"
                                        class="w-8 h-8 bg-slate-900 border border-slate-800 text-slate-400 hover:text-blue-400 rounded-lg flex items-center justify-center transition">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </Link>
                                    <button @click="deleteItem('hotels', item.id)"
                                        class="w-8 h-8 bg-slate-900 border border-slate-800 text-slate-400 hover:text-rose-500 rounded-lg flex items-center justify-center transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                                <div
                                    class="flex items-center gap-1.5 bg-blue-500/10 border border-blue-500/20 px-2.5 py-1 rounded-lg text-blue-400 font-bold text-xs shrink-0">
                                    <i class="fa-solid fa-star text-[10px]"></i> {{ item.rating }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="p-8 flex flex-col items-center justify-center py-16 text-center">
                        <div
                            class="w-14 h-14 bg-slate-950 border border-slate-800/80 text-slate-700 rounded-2xl flex items-center justify-center mb-4 shadow-inner">
                            <i class="fa-solid fa-bed text-xl"></i>
                        </div>
                        <h4 class="text-slate-300 font-bold text-sm mb-1">Ainda sem hotéis</h4>
                        <p class="text-slate-500 text-xs max-w-xs leading-relaxed">Guarda as tuas melhores estadias e
                            deixa que o sistema ordene as tuas notas.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>