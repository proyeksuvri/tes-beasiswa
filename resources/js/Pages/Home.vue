<script setup>
import { Head } from '@inertiajs/vue3';
defineProps({
  application: { type: String, required: true },
  module: { type: String, required: true },
  status: { type: String, required: true },
});
</script>
<template>
  <Head :title="application" />
  <main class="min-h-screen bg-slate-50 px-6 py-16 text-slate-900">
    <section class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
      <p class="text-sm font-semibold uppercase tracking-wide text-indigo-700">UIN Palopo</p>
      <h1 class="mt-3 text-3xl font-bold">{{ application }}</h1>
      <p class="mt-2 text-lg text-slate-600">{{ module }}</p>
      <div class="mt-8 rounded-xl bg-slate-50 p-4"><p class="text-sm text-slate-500">Status fondasi</p><p class="mt-1 font-semibold">{{ status }}</p></div>
      <p class="mt-6 text-sm leading-6 text-slate-600">Fondasi awal mengikuti PRD. Data penerima, SK, dan rekening belum dimuat pada tahap ini.</p>
    </section>
  </main>
</template>
